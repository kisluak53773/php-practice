<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function longestConsecutive($nums) {
        sort($nums);
        $data = array_values(array_unique($nums));

        if(count($data) <=1){
            return count($data) === 1 ? 1 : 0;
        }

        $result=[];
        $count = 1;

        for($i = 1; $i< count($data); $i++){
            if($data[$i] === $data[$i-1]+1){
                $count++;
            }else{
                $result[] = $count;
                $count = 1;
            }
            if($i+1 === count($data)){
                $result[] = $count;
            }
        }

        return max($result);
    }
}