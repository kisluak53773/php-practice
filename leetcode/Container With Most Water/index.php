<?php

declare(strict_types=1);


class Solution
{
    public function maxArea(array $height): int
    {
        $res = 0;
        $left = 0;
        $right = count($height) - 1;

        while ($left < $right) {
            $area = ($right - $left) * min($height[$left], $height[$right]);
            $res = max($res, $area);

            if ($height[$left] < $height[$right]) {
                $left++;
            } else {
                $right--;
            }
        }

        return $res;
    }
}
