<?php

declare(strict_types=1);

class Solution
{
    /**
     * Undocumented function
     *
     * @param array<int>
     * @return array
     */
    public function threeSum(array $nums): array
    {
        if (count($nums) === 3) {
            return $nums[0] + $nums[1] + $nums[2] === 0 ? [$nums] : [];
        }

        sort($nums);
        $result = [];

        foreach ($nums as $i => $elem) {
            if($i > 0 && $elem === $nums[$i - 1]) {
                continue;
            }

            $left = $i + 1;
            $right = count($nums) - 1;

            while ($left < $right) {
                $sum = $elem + $nums[$left] + $nums[$right];
                if ($sum === 0) {
                    $result[] = [$elem, $nums[$left], $nums[$right]];
                    $left++;
                    while ($nums[$left] === $nums[$left - 1]) {
                        $left++;
                    }
                } elseif ($sum > 0) {
                    $right--;
                } else {
                    $left++;
                }
            }
        }

        return $result;
    }
}
