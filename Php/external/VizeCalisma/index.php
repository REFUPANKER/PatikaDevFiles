<html>

<head>
    <style>
        body {
            background-color: rgb(15, 15, 15);
            margin: 0;
            color: white;
            font-family: "minecraft";
            height: 100vh;
            display: grid;
            grid-template-rows: min-content auto;
            overflow: auto;
        }

        .center {
            width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            justify-content: center;
        }

        code {
            font-size: 1vmax;
            background-color: rgb(25, 25, 40);
            padding: 0.5vmax;
            border-radius: 0.5vmax;
            white-space: pre-line;
            text-align: left;
            margin: 0.5vmax;
            width: 50%;
        }

        .subtitle {
            font-size: 1.4vmax;
            font-family: consolas;
            margin: 0;
        }
    </style>
</head>

<body>
    <h1 class="center" style="margin-top:2vw;letter-spacing:0.5vmax;">Php Programming - Vize Study</h1>
    <div class="center" style="justify-content:unset;max-height:80vh;overflow:auto;">
        <h3 class="subtitle">Loops</h3>
        <code>
            <?php
            $bound = 5;
            for ($i = 0; $i < $bound; $i++) {
                echo "for loop : $i \n";
            }
            ?>
        </code>
        <code>
            <?php
            while ($i >= 0) {
                echo "while loop : $i \n";
                $i -= 1;
            }
            ?>
        </code>
        <code>
            <?php
            do {
                $i += 1;
                echo "do-while loop : $i \n";
            } while ($i <= $bound);
            ?>
        </code>
        <code>
            <?php
            $x = array(10);
            foreach ($x as $item => $v) {
                echo "foreach loop : $v \n";
            }
            ?>
        </code>
        <h3 class="subtitle">Fonksiyonlar</h3>
        <code>
            <?php
            function topla($sayi1, $sayi2)
            {
                return $sayi1 + $sayi2;
            }
            function selamYaz()
            {
                echo "<i>selam :)</i>";
            }
            echo topla(3, 1) . "\n";
            selamYaz();
            ?>
        </code>
        <code>
            <?php
            function inspect($txt)
            {
                $k = explode(" ", $txt);
                echo print_r($k);
            }
            inspect("hello world how are you guys");
            ?>
        </code>
        <code>
            <?php
            $p = 1;
            $c = 1;
            for ($i = 1; $i <= 10; $i++) {
                echo $c . "\n";
                $c = $c + $p;
                $p = $c - $p;
            }
            ?>
        </code>
    </div>
</body>

</html>