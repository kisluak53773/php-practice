<?php

declare(strict_types=1);

class Solution {

    function dailyTemperatures(array $temperatures): array
    {
        $result = array_fill(0, count($temperatures), 0);
        $stack = new MinStack();

        foreach ($temperatures as $i => $temp) {
            while (!$stack->isEmpty() && $temp > $temperatures[$stack->top()]) {
                $prev_index = $stack->pop();
                $result[$prev_index] = $i - $prev_index;
            }

            $stack->push($i);
        }

        return $result;
    }
}

class Node
{
    public $value;
    public $next;
    public $minValue;

    function __construct(int $value,int $minValue)
    {
        $this->value = $value;
        $this->minValue = $minValue;
        $this->next = null;
    }
}

class MinStack
{
    private ?Node $top;
    private $size;

    function __construct()
    {
        $this->top = null;
        $this->size = 0;
    }

    function push(int $val): void
    {
        $minValue = $val;
        if (!$this->isEmpty()) {
            $minValue = min($val, $this->getMin());
        }
        $node = new Node($val, $minValue);
        $node->next = $this->top;
        $this->top = $node;
        $this->size++;
    }

    function pop(): int
    {
        if ($this->isEmpty()) {
            return null;
        }
        $data = $this->top->value;
        $this->top = $this->top->next;
        $this->size--;

        return $data;
    }

    function top(): int
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->top->value;
    }

    function getMin(): int
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->top->minValue;
    }

    public function isEmpty(): bool
    {
        return $this->top === null;
    }
}

