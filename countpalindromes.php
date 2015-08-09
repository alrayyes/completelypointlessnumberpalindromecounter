<?php

$max = $argv[1];

$start = microtime(true);
$countString = countPalindromes($max, "string");
$diffString = microtime(true) - $start;

$start = microtime(true);
$countInteger = countPalindromes($max, "integer");
$diffInteger = microtime(true) - $start;

echo sprintf("%s palindromes found the string way in %s seconds\n", $countString, $diffString);
echo sprintf("%s palindromes found the integer way in %s seconds\n", $countInteger, $diffInteger);

/**
 * @param $max try 0 to $max
 * @param $type the type of check we want to do (string|integer)
 * @return int number of palindromes found
 * @throws Exception doesn't know how to processed passed type
 * @uses checkPalindromeString()
 * @uses checkPalindromeInteger()
 *
 * Iterate from 0 to $max and check if every number is a palindrome by trying the method passed by type
 */
function countPalindromes($max, $type){
    $count = 0;

    for($i=11;$i<=$max;$i++){
        $stringVal = strval($i);
        switch($type){
            case "string":
                if(checkPalindromeString($i)){
                    $count++;
                }
                break;
            case "integer":
                if(checkPalindromeInteger($i)){
                    $count++;
                }
                break;
            default:
                throw new Exception(sprintf("Don't know what to do with compare type %s", $type));
        }
    }

    return $count;
}

/**
 * @param $number
 * @return bool
 *
 * Check if passed number is palindrome by converting it to a string and comaparing it to a reversed value of itself
 */
function checkPalindromeString($number){
    $stringVal = strval($number);
    if($stringVal == strrev($stringVal)){
        return true;
    }

    return false;
}

/**
 * @param $number
 * @return bool
 *
 * Check if passed number is palindrome by comparing it to a reversed value of itself
 */
function checkPalindromeInteger($number){
    $reverseNumber = 0;
    $passedNumber = $number;

    while($number > 0){
        $diff10 = $number % 10;
        $reverseNumber = $reverseNumber * 10 + $diff10;
        $number = ($number - $diff10) / 10;
    }

    if($passedNumber == $reverseNumber) {
        return true;
    }

    return false;
}