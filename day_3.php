<?php

$filename = 'input/input_day_3.txt';
/*$filename = 'input/sample_day_3.txt';*/
//$filename = 'input/sample_day_3_2.txt';
$contents = file($filename);

$sum = 0;

$useConditional = true;  // Toggle for part 1 answer

$regex = $useConditional
    ? "/(do\(\))|(don't\(\))|(mul\(\d{1,3},\d{1,3}\))/m"
    : "/mul\(\d{1,3},\d{1,3}\)/m";

$isDo = true;

foreach($contents as $line) {
    preg_match_all($regex, $line, $matches);

    foreach($matches[0] as $match) {
        if ($match == "don't()") {
            $isDo = false;
        } else if ($match == "do()") {
            $isDo = true;
        } else if ($isDo) {
            $sum += multiply($match);
        } else {
        }
    }
}

echo $sum;

function multiply($match) {
    preg_match_all("/\d{1,3}/m", $match, $numbers);
    return $numbers[0][0] * $numbers[0][1];
}

?>
