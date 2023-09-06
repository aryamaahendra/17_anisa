<?php

namespace App\Jobs;

use App\Actions\KNN;
use App\Models\Data;
use App\Models\Testing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $testID,
        public int $k,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $start = microtime(true);

        $true = 0;
        $false = 0;
        $k = $this->k;

        Data::where('type', 'test')->chunk(
            10,
            function (Collection $datas) use (&$true, &$false, $k) {
                $knn = new KNN();

                foreach ($datas as $data) {
                    $predicted = $knn->predict($data, $k);

                    if ($data->class == $predicted) {
                        $true++;
                    } else {
                        $false++;
                    }
                }
            }
        );

        $end = microtime(true);
        $executionTime = ($end - $start) * 1000; // Convert to milliseconds

        $accuracy = $true / ($true + $false);

        $testing = Testing::find($this->testID);
        $testing->akurasi = number_format($accuracy, 2);
        $testing->time = $executionTime;
        $testing->true = $true;
        $testing->false = $false;
        $testing->save();
    }
}
