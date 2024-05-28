<?php

namespace Algorithms;

class SearchAlgorithms
{
    public function linearSearch($array, $elem)
    {
        for($i = 0; $i < sizeof($array); $i++)
        {
            if($array[$i] === $elem){
                return $i;
            }
        }
        return -1;
    }

    public function binarySearch($array,$elem,$low,$max){
        if ($low >= $max) {
            return $array[$low] === $elem ? $low : -1;
        }

        $mid = floor(($low + ($max - $low) / 2));

        if ($array[$mid] === $elem) {
            return $mid;
        }

        if ($array[$mid] > $elem) {
            return $this->binarySearch($array, $elem, $low, $mid - 1);
        }

        return $this->binarySearch($array, $elem, $mid + 1, $max);
        
    }
}