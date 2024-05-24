<?php

namespace Algorithms;

class SortAlgorithms
{
    public function bubbleSort($array)
    {
        if(sizeof($array) <=0){
            return $array;
        };

        $toSort = true;

        do {
            $toSort = false;

            for ($i = 0; $i < sizeof($array); $i++) {
                if ($i + 1 < sizeof($array) && $array[$i] > $array[$i + 1]) {
                    $toSort = true;
                    $currElem = $array[$i];
                    $array[$i] = $array[$i + 1];
                    $array[$i + 1] = $currElem;
                }
            }
        } while ($toSort);

        return $array;
    }

    public function mergeSort($array)
    {
        if(sizeof($array) <= 1){
            return $array;
        };

        $mid = ceil(sizeof($array)/2);
        
        return $this->merge($this->mergeSort(array_slice($array, 0, $mid)),$this->mergeSort(array_slice($array, $mid)));
    }

    public function quickSort($array)
    {
        $length = count($array);
    
        if ($length <= 1) {
            return $array;
        }
        
        $pivot = $array[0];
        $left = $right = [];

        for ($i = 1; $i < $length; $i++) {
            if ($array[$i] < $pivot) {
                $left[] = $array[$i];
            } else {
                $right[] = $array[$i];
            }
        }
        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    private function merge($left,$right){
        $finalArray = [];

        while(sizeof($left) > 0 && sizeof($right)>0){
            if($left[0]<$right[0]){
                array_push($finalArray, $left[0]);
                array_shift($left);
            }else{
                array_push($finalArray, $right[0]);
                array_shift($right);
            }
        }

        $finalArray = array_merge($finalArray, $left, $right);
        
        return $finalArray;
    }
}