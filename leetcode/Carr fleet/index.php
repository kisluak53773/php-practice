<?php

declare(strict_types=1);

class Solution {

    function carFleet(int $target,array $position,array $speed): int
    {
        $data = array_combine($position, $speed);
        krsort($data);
        $stack = [];

        foreach($data as $pos => $sp){
            $time = ($target - $pos)/$sp;

            if(empty($stack)){
                array_push($stack,$time);
            }

            if(!empty($stack) && end($stack) < $time){
                array_push($stack,$time);
            }
        }

        return count($stack);
    }
}