<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Php Auth</title>
    <style>
        body {
            background-color: #151515;
        }
    </style>
</head>

<body class="d-block overflow-auto h-100 w-100 m-0 text-white">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 class="m-0">Patika.dev Tasks</h1>
        <h4 class="m-0">src : <a class="text-primary" target="_blank" href="https://academy.patika.dev/tr/courses/php-temel/">patika.dev php temelleri</a></h4>
    </div>
    <?php
    #task 1
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
            echo $line . $line;
            echo "</br>";
        }
    }
    ucgen(15);
    echo "</br>";

    # task2

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

    print_r(rndPlanet(2));
    echo "</br>";
    print_r(rndPlanet(5));
    ?>

    <!-- task 3
         src : https://academy.patika.dev/tr/courses/php-temel/form-islemleri-odev -->

    <form method="post">
        bir sayi girin
        <input name="sayi" type="number" />
        <?php

        if (isset($_POST["sayi"])) {
            $num = $_POST["sayi"];
            echo "<h3>girilen sayi : $num </h3>";
            if ($num == null) {
                echo "<h3 style='color:red;'>gecerli bir sayi giriniz</h3>";
            } else {
                if ($num % 3 != 0) {
                    echo "<h3 style='color:orange;'>girdiginiz sayi 3 e tam bolunmuyor</h3>";
                    while ($num % 3 != 0) {
                        $num++;
                    }
                    echo "<h3 style='color:green;'> 3 e bolunen ilk sayi " . $num . "</h3>";
                }
                echo "<h3 style='color:lightgreen;'> 3 e bolum sonucu : " . ($num / 3) . "</h3>";
            }
        }
        ?>
    </form>

</body>

</html>