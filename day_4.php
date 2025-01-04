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
$isPart1 = false;  // Toggle for part 1 answer

if ($isPart1) {
    foreach($lines as $y=>$line) {
        foreach($line as $x=>$char) {
            if ($char == "X") {
                calcXmasCount($x, $y);
            }
        }
    }
} else {
    foreach($lines as $y=>$line) {
        foreach($line as $x=>$char) {
            if ($char == "A") {
                calcTwoMasCount($x, $y);
            }
        }
    }
}

function calcTwoMasCount($x, $y) {
    global $height;
    global $width;
    global $count;

    if (!isLeftMas($x, $y)) {
        return;
    }

    if (!isRightMas($x, $y)) {
        return;
    }

    $count++;
}

function isLeftMas($x, $y) {
    global $lines;

    if (
        isOutOfBounds($x-1, $y+1) ||
        isOutOfBounds($x+1, $y-1)
    ) {
        return false;
    }

    $topLeft = $lines[$y+1][$x-1];
    $btmRight = $lines[$y-1][$x+1];

    return $topLeft == "M" && $btmRight == "S"
        || $topLeft == "S" && $btmRight == "M";
}

function isRightMas($x, $y) {
    global $lines;

    if (
        isOutOfBounds($x+1, $y+1) ||
        isOutOfBounds($x-1, $y-1)
    ) {
        return false;
    }

    $topRight = $lines[$y+1][$x+1];
    $btmLeft = $lines[$y-1][$x-1];

    return $topRight == "M" && $btmLeft == "S"
        || $topRight == "S" && $btmLeft == "M";
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
