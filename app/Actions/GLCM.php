<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class GLCM
{
    public  function matrix(string $imgPath): array
    {
        // Get the input image
        $image = Image::make($imgPath)->greyscale();

        // Get image width and height
        $width = $image->width();
        $height = $image->height();

        // Convert the image to an array of pixel values
        $pixels = [];
        for ($y = 0; $y < $height; $y++) {
            $row = [];
            for ($x = 0; $x < $width; $x++) {
                $color = $image->pickColor($x, $y, 'array');
                $row[] = $color[0]; // Assuming grayscale, so only one channel
            }
            $pixels[] = $row;
        }

        // Initialize the GLCM matrix
        $glcmMatrix = array_fill(0, 256, array_fill(0, 256, 0));

        // Define the diagonal offsets
        $diagonalOffsets = [
            [1, 1],  // Down-right
            [-1, -1], // Up-left
            [1, -1], // Down-left
            [-1, 1], // Up-right
        ];

        // Loop through the image pixels and update the GLCM matrix
        for ($row = 0; $row < $height; $row++) {
            for ($col = 0; $col < $width; $col++) {
                $pixelValue = $pixels[$row][$col];

                foreach ($diagonalOffsets as $offset) {
                    $offsetRow = $row + $offset[0];
                    $offsetCol = $col + $offset[1];

                    // Check if the offset pixel is within the image boundaries
                    if ($offsetRow >= 0 && $offsetRow < $height && $offsetCol >= 0 && $offsetCol < $width) {
                        $neighborValue = $pixels[$offsetRow][$offsetCol];
                        $glcmMatrix[$pixelValue][$neighborValue]++;
                    }
                }
            }
        }


        // Normalize the GLCM matrix (optional)
        $glcmSum = array_sum(array_map('array_sum', $glcmMatrix));
        foreach ($glcmMatrix as &$row) {
            foreach ($row as &$value) {
                $value /= $glcmSum;
            }
        }

        return [$image, $glcmMatrix];
    }

    public function contrast($matrix): float
    {
        // Calculate the contrast feature from the GLCM matrix
        // Example: Calculate the sum of squared differences between pixel intensities
        $sum = 0;
        foreach ($matrix as $i => $row) {
            foreach ($row as $j => $value) {
                $diff = abs($i - $j);
                $sum += $diff * $diff * $value;
            }
        }
        $contrast = sqrt($sum);

        return $contrast;
    }

    // Map GLCM contrast value to a contrast adjustment factor
    public function mapContrast($glcmContrast): float
    {
        // Define contrast adjustment parameters
        $minGLCMContrast = 0;     // Minimum GLCM contrast value
        $maxGLCMContrast = 100;   // Maximum GLCM contrast value
        $minContrastFactor = 10.0; // Minimum contrast adjustment factor
        $maxContrastFactor = 100.0; // Maximum contrast adjustment factor

        // Map the GLCM contrast value to the contrast adjustment factor using linear interpolation
        $normalizedContrast = ($glcmContrast - $minGLCMContrast) / ($maxGLCMContrast - $minGLCMContrast);
        $adjustedFactor = $normalizedContrast * ($maxContrastFactor - $minContrastFactor) + $minContrastFactor;

        return $adjustedFactor;
    }

    function adjustImgContrast($adjustedImage, $contrastFactor): string
    {
        // Adjust the image contrast based on the contrast value
        // Example: Multiply the pixel values by a contrast factor
        $adjustedImage->contrast($contrastFactor);

        // Save the adjusted image
        $filename = Str::orderedUuid() . '.jpg';
        $path = 'data_glcm/contrast/' . $filename;
        $adjustedImagePath = Storage::path('public/' . $path);

        // Ensure the directory exists
        if (!is_dir(Storage::path('public/data_glcm/contrast/'))) {
            mkdir(Storage::path('public/data_glcm/contrast/'), 0777, true);
        }

        $adjustedImage->save($adjustedImagePath);

        return $path;
    }

    public function energy($glcmMatrix)
    {
        $energy = 0;

        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $energy += $value * $value;
            }
        }

        return $energy;
    }

    // Map GLCM contrast value to a contrast adjustment factor
    public function mapEnergy($glcmEnergy): float
    {
        // Define energy adjustment parameters
        $minGLCMEnergy = 0;      // Minimum GLCM energy value
        $maxGLCMEnergy = 1000;  // Maximum GLCM energy value
        $minBrightnessAdjustment = -25; // Minimum brightness adjustment value
        $maxBrightnessAdjustment = 25;   // Maximum brightness adjustment value

        // Map the GLCM energy value to the brightness adjustment value using linear interpolation
        $normalizedEnergy = ($glcmEnergy - $minGLCMEnergy) / ($maxGLCMEnergy - $minGLCMEnergy);
        $adjustedBrightness = $normalizedEnergy * ($minBrightnessAdjustment - $maxBrightnessAdjustment) + $maxBrightnessAdjustment;

        return $adjustedBrightness;
    }

    function adjustImgEnergy($adjustedImage, $brightnessAdjustment): string
    {
        // Adjust the image contrast based on the contrast value
        // Example: Multiply the pixel values by a contrast factor
        $adjustedImage = $adjustedImage->brightness($brightnessAdjustment);

        // Save the adjusted image
        $filename = Str::orderedUuid() . '.jpg';
        $path = 'data_glcm/energy/' . $filename;
        $adjustedImagePath = Storage::path('public/' . $path);

        // Ensure the directory exists
        if (!is_dir(Storage::path('public/data_glcm/energy/'))) {
            mkdir(Storage::path('public/data_glcm/energy/'), 0777, true);
        }

        $adjustedImage->save($adjustedImagePath);

        return $path;
    }

    function correlation($glcmMatrix): float
    {
        $meanI = $this->calculateMeanGLCMIndex($glcmMatrix);
        $meanJ = $this->calculateMeanGLCMIndexTranspose($glcmMatrix);
        $stdDevI = $this->calculateStdDevGLCMIndex($glcmMatrix, $meanI);
        $stdDevJ = $this->calculateStdDevGLCMIndexTranspose($glcmMatrix, $meanJ);

        $correlation = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $correlation += (($i - $meanI) * ($j - $meanJ) * $value) / ($stdDevI * $stdDevJ);
            }
        }
        return $correlation;
    }

    // Calculate the mean of GLCM index
    protected function calculateMeanGLCMIndex($glcmMatrix): float
    {
        $sum = 0;
        $totalEntries = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $sum += $i * $value;
                $totalEntries += $value;
            }
        }
        return $sum / $totalEntries;
    }

    // Calculate the mean of transposed GLCM index
    protected function calculateMeanGLCMIndexTranspose($glcmMatrix): float
    {
        $sum = 0;
        $totalEntries = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $sum += $j * $value;
                $totalEntries += $value;
            }
        }
        return $sum / $totalEntries;
    }

    // Calculate the standard deviation of GLCM index
    protected function calculateStdDevGLCMIndex($glcmMatrix, $mean): float
    {
        $sumSquaredDeviations = 0;
        $totalEntries = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $deviation = $i - $mean;
                $sumSquaredDeviations += $deviation * $deviation * $value;
                $totalEntries += $value;
            }
        }
        $variance = $sumSquaredDeviations / $totalEntries;
        return sqrt($variance);
    }

    // Calculate the standard deviation of transposed GLCM index
    protected function calculateStdDevGLCMIndexTranspose($glcmMatrix, $mean): float
    {
        $sumSquaredDeviations = 0;
        $totalEntries = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $deviation = $j - $mean;
                $sumSquaredDeviations += $deviation * $deviation * $value;
                $totalEntries += $value;
            }
        }
        $variance = $sumSquaredDeviations / $totalEntries;
        return sqrt($variance);
    }

    function adjustImgCorrelation($adjustedImage, $sharpnessAdjustment): string
    {
        // Get image width and height
        $width = $adjustedImage->width();
        $height = $adjustedImage->height();

        // Iterate through each pixel and adjust pixel values
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $color = $adjustedImage->pickColor($x, $y, 'array');
                $adjustedValue = $color[0] + $sharpnessAdjustment;

                // Ensure pixel value is within valid range (0-255)
                $adjustedValue = max(0, min(255, $adjustedValue));

                // Set the adjusted pixel value
                $adjustedImage->pixel([$adjustedValue, $adjustedValue, $adjustedValue], $x, $y);
            }
        }

        // Save the adjusted image
        $filename = Str::orderedUuid() . '.jpg';
        $path = 'data_glcm/correlation/' . $filename;
        $adjustedImagePath = Storage::path('public/' . $path);

        // Ensure the directory exists
        if (!is_dir(Storage::path('public/data_glcm/correlation/'))) {
            mkdir(Storage::path('public/data_glcm/correlation/'), 0777, true);
        }

        $adjustedImage->save($adjustedImagePath);

        return $path;
    }

    function homogeneity($glcmMatrix)
    {
        $homogeneity = 0;
        foreach ($glcmMatrix as $i => $row) {
            foreach ($row as $j => $value) {
                $homogeneity += $value / (1 + abs($i - $j));
            }
        }
        return $homogeneity;
    }

    // Map GLCM contrast value to a contrast adjustment factor
    public function mapHomogeneity($glcmHomogeneity): float
    {
        // Define homogeneity adjustment parameters
        $minGLCMHomogeneity = 0;  // Minimum GLCM homogeneity value
        $maxGLCMHomogeneity = 100; // Maximum GLCM homogeneity value
        $minSaturationAdjustment = -50; // Minimum saturation adjustment value
        $maxSaturationAdjustment = 50;   // Maximum saturation adjustment value

        // Map the GLCM homogeneity value to the saturation adjustment value using linear interpolation
        $normalizedHomogeneity = ($glcmHomogeneity - $minGLCMHomogeneity) / ($maxGLCMHomogeneity - $minGLCMHomogeneity);
        $adjustedSaturation = $normalizedHomogeneity * ($maxSaturationAdjustment - $minSaturationAdjustment) + $minSaturationAdjustment;

        return $adjustedSaturation;
    }

    function adjustImgHomogeneity($adjustedImage, $saturationAdjustment): string
    {
        // Adjust the image contrast based on the contrast value
        // Example: Multiply the pixel values by a contrast factor
        $adjustedImage = $adjustedImage->brightness($saturationAdjustment);

        // Save the adjusted image
        $filename = Str::orderedUuid() . '.jpg';
        $path = 'data_glcm/homogeneity/' . $filename;
        $adjustedImagePath = Storage::path('public/' . $path);

        // Ensure the directory exists
        if (!is_dir(Storage::path('public/data_glcm/homogeneity/'))) {
            mkdir(Storage::path('public/data_glcm/homogeneity/'), 0777, true);
        }

        $adjustedImage->save($adjustedImagePath);

        return $path;
    }
}
