<?php

$filename = 'input/input_day_5.txt';
/*$filename = 'input/sample_day_5.txt';*/
$contents = file($filename);

$count = 0;

$updateData = array();
$orderMap = new stdClass();

$isUpdateData = false;
foreach($contents as $line) {
    $line = trim($line);

    if ($line == "") {
        $isUpdateData = true;
        continue;
    }

    if ($isUpdateData) {
        $updateData[] = explode(",", $line);
    } else {
        $rule = explode("|", $line);

        if (property_exists($orderMap, $rule[0])) {
            $orderMap->{ $rule[0] }[] = +$rule[1];
        } else {
            $orderMap->{ $rule[0] } = array();
            $orderMap->{ $rule[0] }[] = +$rule[1];
        }
    }
}

$incorrectOrders = array();
$sum = 0;

// Part 1
foreach($updateData as $updateRow) {
    $isCorrectRow = true;

    foreach($updateRow as $i=>$initialNum) {
        $copyUpdateRow = $updateRow;
        $updatePageOrder = array_splice($copyUpdateRow, $i+1);

        if (
            !isCorrectOrder($initialNum, $updatePageOrder)
        ) {
            $isCorrectRow = false;
        };
    }

    if ($isCorrectRow) {
        $sum += getMiddleEle($updateRow);
    } else {
        $incorrectRows[] = $updateRow;
    }
}

echo "<div>";
echo "$sum";
echo "</div>";

function getMiddleEle($row) {
    $middleIndex = floor(count($row) / 2);
    return $row[$middleIndex];
}

// Part 2
$fixedSum = 0;
foreach($incorrectRows as $row) {
    $fixedRow = fixRow($row);
    $fixedSum += getMiddleEle($fixedRow);
}

echo "<div>";
echo "$fixedSum";
echo "</div>";

function compareOrder($a, $b) {
    global $orderMap;

    if (property_exists($orderMap, $a)) {
        $orderRules = $orderMap->{ $a };

        if(in_array($b, $orderRules)) {
            return -1;  // $a must come before b
        } else {
            return 1;
        }

    }

    return 1;  // $a must come last
}

function fixRow($row) {
    usort($row, "compareOrder");
    return $row;
}

function isCorrectOrder($initialNum, $updatePageOrder) {
    global $orderMap;
    if (property_exists($orderMap, $initialNum)) {
        $orderRules = $orderMap->{$initialNum};
    } else {
        return count($updatePageOrder) == 0;
    }

    foreach($updatePageOrder as $pageNum) {
        if(!in_array($pageNum, $orderRules)) {
            return false;
        }
    }

    return true;
}

?>
