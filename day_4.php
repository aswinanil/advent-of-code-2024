<?php

$filename = 'input/input_day_4.txt';
/*$filename = 'input/sample_day_4.txt';*/
$contents = file($filename);

$count = 0;

$lines = array();
foreach($contents as $line) {
    $chars = str_split($line);
    $lines[] = $chars;
}

$height = count($lines);
$width = count($lines[0]);

$pattern = "XMAS";

foreach($lines as $y=>$line) {
    foreach($line as $x=>$char) {
        if ($char == "X") {
            calcXmasCount($x, $y);
        }
    }
}

function calcXmasCount($x, $y) {
    global $height;
    global $width;

    checkNorth($x, $y);
    checkNorthEast($x, $y);
    checkEast($x, $y);
    checkSouthEast($x, $y);
    checkSouth($x, $y);
    checkSouthWest($x, $y);
    checkWest($x, $y);
    checkNorthWest($x, $y);
}

function isOutOfBounds($x, $y) {
    global $height, $width;

    if ($y < 0 || $y >= $height || $x < 0 || $x >= $width) {
        return true;
    }
}

function isExpectedValue($x, $y, $expected) {
    global $lines;

    if (isOutOfBounds($x, $y)) {
        return false;
    }
    $value = $lines[$y][$x];

    return $value == $expected;
}

function checkNorth($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x, $y-$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkNorthEast($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x+$i, $y-$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkEast($x, $y) {
    global $count, $pattern;
    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x+$i, $y, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkSouthEast($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x+$i, $y+$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkSouth($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x, $y+$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkSouthWest($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x-$i, $y+$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkWest($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x-$i, $y, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

function checkNorthWest($x, $y) {
    global $count, $pattern;

    for ($i=0; $i<strlen($pattern); $i++) {
        if (!isExpectedValue($x-$i, $y-$i, $pattern[$i])) {
            return;
        }
    }

    $count += 1;
}

echo $count;

?>
