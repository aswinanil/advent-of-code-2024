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

$useDampener = true;  // Toggle for part 1 answer

$safeCount = 0;
foreach($reports as $report) {
    $isSafe = processReport($report, true);

    if ($isSafe) {
        $safeCount++;
    }
}

echo "<div>";
echo $safeCount;
echo "</div>";

function reprocess($report) {
    for ($i=0; $i < count($report); $i++) {
        $fixedReport = $report;
        array_splice($fixedReport, $i, 1);
        if (processReport($fixedReport, false)) {
            return true;
        }
    }

    return false;
}

function processReport($report, $isFirstTry) {
    global $useDampener;

    $startingDiff = $report[0] - $report[1];

    if ($startingDiff == 0) {
        if ($useDampener && $isFirstTry) {
            return reprocess($report);
        } else {
            return false;
        }
    } else if ($startingDiff > 0) {
        return checkSequence($report, false, $isFirstTry);
    } else {
        return checkSequence($report, true, $isFirstTry);
    }
}

function isFailChecks($diff, $isAsc) {
    if ($isAsc) {
        return $diff >= 0 || $diff < -3;
    } else {
        return $diff <= 0 || $diff > 3;
    }
}

function checkSequence($report, $isAsc, $isFirstTry) {
    global $useDampener;

    for ($i = 0; $i < count($report) - 1; $i++) {
        $diff = $report[$i] - $report[$i + 1];

        if (isFailChecks($diff, $isAsc)) {
            if ($useDampener && $isFirstTry) {
                return reprocess($report);
            } else {
                return false;
            }
        }
    }
    return true;
}

?>
