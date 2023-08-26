<?php

namespace App\Jobs;

use App\Actions\GLCM;
use App\Actions\KNN;
use App\Models\History;
use App\Models\Testing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessKNN implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $ID
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = History::findOrFail($this->ID);

        $glcm = new GLCM();
        [$img, $matrix] = $glcm->matrix(Storage::get('public/' . $data->image));
        unset($img);

        $contrast = $glcm->contrast($matrix);
        $energy = $glcm->energy($matrix);
        $correlation = $glcm->correlation($matrix);
        $homogeneity = $glcm->homogeneity($matrix);
        $entropy = $glcm->entropy($matrix);

        // $data->matrix = json_encode($matrix);
        $data->contrast =  $contrast;
        $data->correlation =  $correlation;
        $data->energy =  $energy;
        $data->homogeneity =  $homogeneity;
        $data->entropy =  $entropy;

        $data->save();
        $data->refresh();

        $knn = new KNN();
        $predited = $knn->predict($data, (int) $data->k);

        $data->class = $predited;
        $data->save();
    }
}
