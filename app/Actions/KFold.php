<?php

namespace App\Actions;

use App\Models\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Phpml\Metric\ClassificationReport;
use Phpml\Metric\ConfusionMatrix;
use Illuminate\Support\Arr;

class KFold
{
    function __construct(public int $KFold, public int $KNN)
    {
    }

    public function process()
    {
        $K = $this->KFold;
        $IDs = Data::select(['id'])->get()->pluck('id')->toArray();
        $IDs = Arr::shuffle($IDs);

        $result = [];

        $foldSize = ceil(count($IDs) / $K);
        $IDsChunks = array_chunk($IDs, $foldSize);

        $matrix = [];
        $totalAccuracy = 0;
        $totalRecallPremium = 0;
        $totalRecallMedium = 0;
        $totalPrecisionPremium = 0;
        $totalPrecisionMedium = 0;
        $totalF1scorePremium = 0;
        $totalF1scoreMedium = 0;

        for ($i = 0; $i < $K; $i++) {
            $testIDs = $IDsChunks[$i];
            $trainIDs = [];

            // Construct the training data by excluding the current testing fold
            for ($j = 0; $j < $K; $j++) {
                if ($j != $i) {
                    $trainIDs = array_merge($trainIDs, $IDsChunks[$j]);
                }
            }

            [$cm, $report] = $this->train($testIDs, $trainIDs);

            $mtx = [
                'TP' => $cm[0][0],
                'FP' => $cm[1][0],
                'FN' => $cm[0][1],
                'TN' => $cm[1][1],
            ];

            $mtx['accuracy'] = ($cm[0][0] + $cm[1][1]) / ($cm[0][0] + $cm[1][1] + $cm[0][1] + $cm[1][0]);
            $mtx['recall'] = $report->getRecall();
            $mtx['precision'] = $report->getPrecision();
            $mtx['f1score'] = $report->getF1score();

            $totalAccuracy += $mtx['accuracy'];
            $totalRecallPremium += $report->getRecall()['premium'];
            $totalRecallMedium += $report->getRecall()['medium'];
            $totalPrecisionPremium += $report->getPrecision()['premium'];
            $totalPrecisionMedium += $report->getPrecision()['medium'];
            $totalF1scorePremium += $report->getF1score()['premium'];
            $totalF1scoreMedium += $report->getF1score()['medium'];

            array_push($matrix, $mtx);
        }

        $result = [
            'accuracy' => $totalAccuracy / $K,
            'recall' => [
                'premium' =>  $totalRecallPremium / $K,
                'medium' => $totalRecallMedium / $K
            ],
            'precision' => [
                'premium' => $totalPrecisionPremium / $K,
                'medium' => $totalPrecisionMedium / $K
            ],
            'f1score' => [
                'premium' => $totalF1scorePremium / $K,
                'medium' =>  $totalF1scoreMedium / $K
            ],
            'data' => $matrix,
        ];

        return $result;
    }

    protected function train($testIDs, $trainIDs)
    {
        $K = $this->KNN;
        $origin = [];
        $predict = [];

        Data::whereIn('id', $testIDs)->chunk(
            10,
            function (Collection $datas) use (&$origin, &$predict, $K, $trainIDs) {
                $knn = new KNN();

                foreach ($datas as $data) {
                    [$predicted, $count] = $knn->predict($data, $K, $trainIDs);
                    array_push($origin, $data->class);
                    array_push($predict, $predicted);
                }
            }
        );

        return [
            ConfusionMatrix::compute($origin, $predict, ['premium', 'medium']),
            new ClassificationReport($origin, $predict)
        ];
    }
}
