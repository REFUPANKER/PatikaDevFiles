<?php
    echo "</br>";
    function ucgen($sayi)
    {
        for ($i = 0; $i < $sayi; $i++) {
            $trash = $i;
            for ($j = 0; $j < $sayi - $trash; $j++) {
                echo "&nbsp;";
            }
            $line = "";
            while ($trash >= 0) {
                $line .= "o";
                $trash -= 1;
            }
            echo $line.$line;
            echo "</br>";
        }
    }
    ucgen(15);
    echo "</br>";