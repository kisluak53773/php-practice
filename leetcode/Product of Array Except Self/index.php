<?php 

declare(strict_types=1);

class Solution {

    function productExceptSelf(array $nums):array {
        $totalProduct = array_product($nums);
        $answers = [];

        for ($i = 0; $i < count($nums); $i++) {
            if ($nums[$i] === 0) {
                $arr = unserialize(serialize($nums));
                unset($arr[$i]);
                $productExceptCurrent = empty($arr) ? 0 : array_product($arr);
            } else {
                $productExceptCurrent = $totalProduct / $nums[$i];
            } 
            $answers[] = $productExceptCurrent;
        }

        return $answers;
    }
}