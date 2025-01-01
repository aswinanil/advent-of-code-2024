<?php

$filename = 'input/input_day_3.txt';
/*$filename = 'input/sample_day_3.txt';*/
$contents = file($filename);

$sum = 0;

foreach($contents as $line) {
    preg_match_all("/mul\(\d{1,3},\d{1,3}\)/m", $line, $matches);

    foreach($matches[0] as $match) {
        $sum += multiply($match);
    }
}

echo $sum;

function multiply($match) {
    preg_match_all("/\d{1,3}/m", $match, $numbers);
    return $numbers[0][0] * $numbers[0][1];
}

?>
