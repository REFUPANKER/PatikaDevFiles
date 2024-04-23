<?php

$array = array("adana" => 1, "ankara" => 06, "zonguldak" => 67, "karabük" => 78, 0 => "icardi", 7 => "goat", 10 => "goat");

echo $array["adana"] . "</br>";
echo $array[10] . "</br>";
unset($array["adana"]);
foreach ($array as $key => $value) {
    echo $key . " : " . $value . "</br>";
}

$dizi2 = array("x" => array("r0", "r1", "r2", "r3"));

foreach ($dizi2 as $key => $value) {
    foreach ($value as $key2 => $value2) {
        echo $value2 . "</br>";
    }
}

$table = array();
$tablesize = 10;

for ($i = 0; $i < $tablesize; $i++) {
    for ($j = 0; $j < 10; $j++) {
        $table[$j][$i] = ($i + 1) . "x" . ($j + 1) . "=" . ($i + 1) * ($j + 1);
    }
}


echo "<table style='border:0.3vmax solid gray;'>";
foreach ($table as $key => $value) {
    $rx = 255 - ($key * 10) ;
    echo "<tr style='background-color:rgb(" . ($rx) . "," . ($rx) . "," . ($rx) . ");'>";
    foreach ($value as $key2 => $value2) {
        echo "<td style='text-align:center;padding:0.5vmax;cursor:default;'>";
        echo $value2;
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
