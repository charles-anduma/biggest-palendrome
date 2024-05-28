<?php
require __DIR__ . '/vendor/autoload.php';

use App\BiggestPalendrome;

$numbers = '9234252259';

$biggestPalendrome = new BiggestPalendrome();

echo 'Biggest palindromic number: ' .  $biggestPalendrome->calc($numbers) ."\n";
