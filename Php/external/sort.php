<body class="d-block overflow-auto text-white bg-dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <h1 class="w-100 text-center mt-3">Sorting numbers</h1>
    <form method="post" class="d-flex justify-content-center align-items-center flex-column gap-3 m-3">
        <?php
        $numcount = 5;
        for ($i = 1; $i <= $numcount; $i++) {
            echo "<input name='num" . $i . "' placeholder='Number " . $i  . "' type='number' class='form-control w-50'/></br>";
        }
        ?>
        <button type="submit" class="btn btn-secondary p-3 w-50">Sort</button>
    </form>

    <div class="d-flex align-items-center justify-content-center w-100">
        <?php
        if ($_POST != null && count($_POST)==$numcount) {
            //$nums = array($_POST["num1"], $_POST["num2"], $_POST["num3"], $_POST["num4"], $_POST["num5"]);
            $nums = array();
            for ($i = 0; $i < $numcount; $i++) {
                $nums[$i] = $_POST["num" . ($i + 1)];
            }
            echo "<div class='m-3 text-center'>Not Sorted";
            foreach ($nums as $key => $value) {
                echo "<h6>" . $value . "</h6>";
            }
            echo "</div>";
            $count = count($nums);
            for ($i = 0; $i < $count; $i++) {
                for ($j = $i; $j < $count; $j++) {
                    if ($nums[$j] > $nums[$i]) {
                        $nums[$j] += $nums[$i];
                        $nums[$i] = $nums[$j] - $nums[$i];
                        $nums[$j] -= $nums[$i];
                        /** 
                         * x=3,y=4
                         * x+=y     ->  7
                         * y=x-y    ->  3
                         * x-=y     ->  4
                        */
                    }
                }
            }

            echo "<div class='m-3 text-center'>Sorted ⬇️(Desc)";
            foreach ($nums as $key => $value) {
                echo "<h6>" . $value . "</h6>";
            }
            echo "</div>";

            echo "<div class='m-3 text-center'>Sorted ⬆️(Asc)";
            for ($i = $count - 1; $i >= 0; $i--) {
                echo "<h6>" . $nums[$i] . "</h6>";
            }
            echo "</div>";
        }

        ?>
    </div>
</body>