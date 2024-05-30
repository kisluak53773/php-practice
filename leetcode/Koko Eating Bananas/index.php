<?php

declare(strict_types=1);

class Solution
{
    public function minEatingSpeed(array $piles, int $h): int
    {
        $result = $this->binarySearch($h, 1, max($piles), 0, $piles);
        return $result;
    }

    public function binarySearch($hours, $low, $max, $minTime, $pile)
    {
        if ($low > $max) {
            return $minTime;
        }

        $mid = (int)(($low + $max) / 2);
        $hoursSpent = array_reduce($pile, fn ($acc, $item) => $acc + ceil($item / $mid), 0);

        if ($hoursSpent <= $hours) {
            $minTime = $mid;

            return $this->binarySearch($hours, $low, $mid - 1, $minTime, $pile);
        } else {
            return $this->binarySearch($hours, $mid + 1, $max, $minTime, $pile);
        }
    }
}
