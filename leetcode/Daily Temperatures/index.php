<?php

declare(strict_types=1);

class Solution
{
    public function dailyTemperatures(array $temperatures): array
    {
        $result = array_fill(0, count($temperatures), 0);
        $stack = new Stack();

        foreach ($temperatures as $i => $temp) {
            while (!$stack->isEmpty() && $temp > $temperatures[$stack->top()]) {
                $prevIndex = $stack->pop();
                $result[$prevIndex] = $i - $prevIndex;
            }

            $stack->push($i);
        }

        return $result;
    }
}

class Node
{
    public $next;

    public function __construct(public int $value, public int $minValue)
    {
        $this->next = null;
    }
}

class Stack
{
    private ?Node $top;
    private $size;

    public function __construct()
    {
        $this->top = null;
        $this->size = 0;
    }

    public function push(int $val): void
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

    public function pop(): int
    {
        if ($this->isEmpty()) {
            return null;
        }
        $data = $this->top->value;
        $this->top = $this->top->next;
        $this->size--;

        return $data;
    }

    public function top(): int
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->top->value;
    }

    public function getMin(): int
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
