<?php

$filename = 'input/input_day_1.txt';
$contents = file($filename);

$column1 = array();
$column2 = array();

foreach($contents as $line) {
    $numbers = explode("   ", $line);

    $column1[] = +$numbers[0];
    $column2[] = +$numbers[1];
}

// Part 1
sort($column1);
sort($column2);

$diffSum = 0;

for ($i = 0; $i < count($column1); $i++) {
    $diff = abs($column1[$i] - $column2[$i]);
    $diffSum += $diff;
}

echo "<div>";
echo $diffSum;
echo "</div>";

// Part 2
$freqColumn2 = new stdClass();

foreach ($column2 as $row) {
    if (
        property_exists(
            $freqColumn2,
            $row
        )
    ) {
        $freqColumn2->{$row} += 1;
    } else {
        $freqColumn2->{$row} = 1;
    }
}

$similarityScore = 0;
foreach ($column1 as $row) {
    if (
        property_exists(
            $freqColumn2,
            $row
        )
    ) {
        $freq = $freqColumn2->{$row};
        $similarityScore += $row * $freq;
    }
}

echo "<div>";
echo $similarityScore;
echo "</div>";

?>
