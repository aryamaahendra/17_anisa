<?php

namespace App\Jobs;

use App\Actions\GLCM;
use App\Models\Data;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PreprocessImgUjiLatih implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $dataID
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = Data::findOrFail($this->dataID);

        $glcm = new GLCM();
        [$img, $matrix] = $glcm->matrix(Storage::get('public/' . $data->original_image));

        $contrast = $glcm->contrast($matrix);
        $contrastPath = $glcm->adjustImgContrast(clone $img, $glcm->mapContrast($contrast));

        $energy = $glcm->energy($matrix);
        $energyPath = $glcm->adjustImgEnergy(clone $img, $glcm->mapEnergy($energy));

        $correlation = $glcm->correlation($matrix);
        $correlationPath = $glcm->adjustImgCorrelation(clone $img, $correlation);

        $homogeneity = $glcm->homogeneity($matrix);
        $homogeneityPath = $glcm->adjustImgHomogeneity(clone $img, $glcm->mapHomogeneity($homogeneity));

        // $data->matrix = json_encode($matrix);
        $data->contrast =  $contrast;
        $data->contrast_image =  $contrastPath;

        $data->correlation =  $correlation;
        $data->correlation_image =  $correlationPath;

        $data->energy =  $energy;
        $data->energy_image =  $energyPath;

        $data->homogeneity =  $homogeneity;
        $data->homogeneity_image =  $homogeneityPath;

        $data->save();
    }
}
