<?php

class Solution {

    /**
     * @param String[] $strs
     * @return String[][]
     */
    function groupAnagrams($strs) {
        $annagramGroups= [];
        $buffer = [];
        foreach ($strs as $str) {
            $sortedStr = $this->quickSort(str_split($str));
            $key = implode("", $sortedStr);
            $buffer[$key][] = $str;
        }
        foreach ($buffer as $item) {
            $annagramGroups[]=$item;
        }

        return $annagramGroups;
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
}