<?php

/*$filename = 'input/sample_day_2.txt';*/
$filename = 'input/input_day_2.txt';
$contents = file($filename);

$reports = array();
foreach($contents as $line) {
    $numbers = explode(" ", $line);
    $numbers = array_map("intval", $numbers);
    $reports[] = $numbers;
}

// Part 1
$safeCount = 0;
foreach($reports as $report) {
    $isSafe = processReport($report);

    if ($isSafe) {
        $safeCount++;
    }
}

echo "<div>";
echo "safe count: " . $safeCount;
echo "</div>";

function processReport($report) {

    $startingDiff = $report[0] - $report[1];

    if ($startingDiff == 0) {
        return false;
    } else if ($startingDiff > 0) {
        return checkDescSequence($report);
    } else {
        return checkAscSequence($report);
    }
}

function checkDescSequence($report) {
    for ($i = 0; $i < count($report) - 1; $i++) {
        $diff = $report[$i] - $report[$i+1];

        if ($diff <= 0 || $diff > 3) {
            return false;
        }
    }
    return true;
}

function checkAscSequence($report) {
    for ($i = 0; $i < count($report) - 1; $i++) {
        $diff = $report[$i] - $report[$i+1];

        if ($diff >= 0 || $diff < -3) {
            return false;
        }
    }
    return true;
}

?>
