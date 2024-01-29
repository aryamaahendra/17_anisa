<?php

namespace App\Actions;

use App\Models\Data;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class KNN
{
    public function predict(object $newData, int $k, ?array $traindIDs = null): array
    {
        $result = [];

        Log::error('new data ==============');
        Log::error($newData);

        // calc euclidean distance between train data and new data
        Data::when(
            $traindIDs,
            fn (Builder $query) => $query->whereIn('id', $traindIDs)
        )->chunk(10, function (Collection $datas) use (&$result, $newData) {
            foreach ($datas as $data) {
                array_push($result, [
                    'id' => $data->id,
                    'distance' => $this->euclidean($data, $newData),
                    'class' => $data->class,
                ]);
            }
        });

        // short distance desc. start from small to big
        usort($result, function ($a, $b) {
            if ($a['distance'] == $b['distance']) return 0;
            return ($a['distance'] < $b['distance']) ? -1 : 1;
        });


        Log::error('Hasil');
        Log::error(array_slice($result, 0, $k));
        Log::error('End Process ====================');
        // Get n / $k distance terkecil and find class appears the most
        return $this->findClass(array_slice($result, 0, $k));
    }

    /**
     * find class appears the most
     */
    protected function findClass(array $data): array
    {
        $classCounts = [];

        foreach ($data as $item) {
            $class = $item["class"];
            if (!isset($classCounts[$class])) {
                $classCounts[$class] = 1;
            } else {
                $classCounts[$class]++;
            }
        }

        arsort($classCounts); // Sort the class counts in descending order
        $class = array_key_first($classCounts);

        return [$class, $classCounts[$class]]; // Get the key of the first element (most frequent class)
    }

    /**
     * calculate distance between $data and $newData
     * @param $a data train
     * @param $b new data
     * 
     * @return float distance
     */
    protected function euclidean($a, $b): float
    {
        $contrast = pow($a->contrast - $b->contrast, 2);
        $energy = pow($a->energy - $b->energy, 2);
        $correlation = pow($a->correlation - $b->correlation, 2);
        $homogeneity = pow($a->homogeneity - $b->homogeneity, 2);
        $entropy = pow($a->entropy - $b->entropy, 2);

        return sqrt($contrast + $energy + $correlation + $homogeneity + $entropy);
    }
}
