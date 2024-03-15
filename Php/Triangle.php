<?php
function ucgen($sayi)
{
    echo "</br>";
    for ($i = 0; $i < $sayi; $i++) {
        $trash = $i;
        for ($j = 0; $j < $sayi - $trash; $j++) {
            echo "&nbsp;";
        }
        while ($trash >= 0) {
            echo "o";
            $trash -= 1;
        }
        echo "</br>";
    }
}
ucgen(5);
