<?php

namespace App\Jobs;

use App\Actions\KFold;
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
use Illuminate\Support\Facades\Log;

class ProcessTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $testID,
        public int $knn,
        public int $kfold = 5,
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
        $k = $this->knn;

        Data::where('type', 'test')->chunk(
            10,
            function (Collection $datas) use (&$true, &$false, $k) {
                $knn = new KNN();
                $IDs = Data::select(['id'])->where('type', 'train')->get()->pluck('id')->toArray();

                foreach ($datas as $data) {
                    [$predicted, $count] = $knn->predict($data, $k, $IDs);

                    if ($data->class == $predicted) {
                        $true++;
                    } else {
                        $false++;
                    }
                }
            }
        );

        $kFold = new KFold($this->kfold, $this->knn);
        $result = $kFold->process();

        $end = microtime(true);
        $executionTime = ($end - $start) * 1000; // Convert to milliseconds

        Log::info($result);
        Log::info(number_format($result['accuracy'], 2));

        $testing = Testing::find($this->testID);
        $testing->akurasi = number_format($result['accuracy'], 2);
        $testing->time = $executionTime;
        $testing->true = $true;
        $testing->false = $false;
        $testing->kfold_data = json_encode($result);
        $testing->save();
    }
}
