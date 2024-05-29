<?php

declare(strict_types=1);

class MinStack {
    private $stack = [];
  
    function push(int $val): void {
        $this->stack [] = $val;
    }

    function pop():void {
        array_pop($this->stack);
    }
  
    function top():int {
        return end($this->stack);
    }
  
    function getMin(): int {
        return min($this->stack);
    }
}