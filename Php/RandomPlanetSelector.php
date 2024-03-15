<?php
$planets = ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune", "", "", NULL];
$planets = array_filter(
    $planets,
    function ($n) {
        if ($n != null && strlen($n) != 0) {
            return $n;
        }
    }
);
function rndPlanet($range)
{
    global $planets;
    $selecteds = [];
    for ($i = 0; $i < $range; $i++) {
        array_push($selecteds, $planets[array_rand($planets)]);
    }
    return $selecteds;
}
