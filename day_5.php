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

$correctOrders = array();  // XXX: unused
$sum = 0;

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
        $correctOrders[] = $updateRow;
        $middleIndex = floor(count($updateRow) / 2);
        $sum += $updateRow[$middleIndex];
    }
}


echo "<div>";
echo "$sum";
echo "</div>";


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
