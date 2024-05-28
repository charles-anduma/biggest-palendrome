<?php

namespace App;

class BiggestPalendrome
{

    public function calc(string $numbers)
    {
        $numbers = str_split($numbers);

        $carriedNumber = '';
        $finalCombinations = [];
        $this->createTreeItems($numbers, $carriedNumber, $finalCombinations);
        $this->getPalindromes($finalCombinations);
        $finalCombinations = array_filter($finalCombinations, function ($number) {
            return $number == strrev($number);
        });

        return $this->getBiggestNumber($finalCombinations);
    }

    /**
     * Create all combination of an array of number chars recursively
     * Each branch of each level of the tree is an int character from the current array of strings.
     * The children of each branch are all the other numbers of the parent branch with the parent number withheld
     * Each branch becomes another combionation of int chars.
     *                                             123456
     *                               /        /      |       \      \
     *                           23456     13456   12456   12356   12346
     *                         /      \
     *                      3456     2456
     *                     /    \
     *                  456     356
     *                /    \
     *              56      46
     *            /  \
     *          5     6
     * Each calculated combination is appended to the &$finalCombinations pointer
     * @param $numbers Array of int chars which are recursively analsysed to get all the different combinations of the ints
     * @param $carriedNumber All of the 'parent' ints going up the tree to the top. This is concationated to get the current
     *                      combionation of ints
     * @param $finalCombinations Each calculated combination of ints are attached here
     * @return void
     */
    public function createTreeItems($numbers, $carriedNumber, &$finalCombinations)
    {
        for ($i = 0; $i < count($numbers); $i++) {
            $currentNumber = $numbers[$i];
            $childNumbers = [];
            for ($j = 0; $j < count($numbers); $j++) {
                if ($j != $i) {
                    $childNumbers[] = $numbers[$j];
                }
            }

            $newCarriedNumber = $carriedNumber . $currentNumber;
            if ($newCarriedNumber[0] !== '0') {
                $finalCombinations[] = $newCarriedNumber;
                $this->createTreeItems($childNumbers, $newCarriedNumber, $finalCombinations);
            }
        }
    }

    /**
     * Filter Array of int character combinations, and only return those that are palindromes.
     * @param String[] $finalCombinations
     * @return array
     */
    protected function getPalindromes($finalCombinations)
    {
        return array_filter($finalCombinations, function ($number) {
            return $number == strrev($number);
        });
    }

    /**
     * Get the biggest number in array of numbers
     * @param $finalCombinations
     * @return false|mixed
     */
    protected function getBiggestNumber(array $finalCombinations)
    {
        if (!count($finalCombinations)) {
            return false;
        }
        sort($finalCombinations);

        return end($finalCombinations);
    }
}
