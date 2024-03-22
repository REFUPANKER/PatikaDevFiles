<style>
    body {
        margin: 0;
    }
</style>
<div style="font-size:3vmax;">
    <?php
    for ($i = 1; $i <= 5; $i++) {
        $ir = ($i * 5) . "px";
        echo "<div style='position:absolute;left:$ir;'>" . $i . "</div></br>";
    }
    while ($i <= 10) {
        $ir = (50 - ($i * 5)) . "px";
        echo "<div style='position:absolute;color:red;left:$ir;'>" . $i . "</div></br>";
        $i++;
    }
    ?>
</div>
<div style="width:100%;height:100vh;left:0px;top:0px;display:flex;flex-direction: column;justify-content: center;align-items:center;">
    <form method="post">
        <input style="font-size:3vmax;" name="number" type="number" placeholder="Sayi gir" />
    </form>
    <?php
    // if ($_POST != null && $_POST["number"] != null) {
    //     if ($_POST["number"] <= 0) {
    //         echo '<script>alert("0 dan büyük bir sayı gir")</script>';
    //     } else {
    //         echo "<table style='font-size:2vmax;background:white;z-index:3;' border='3'>";
    //         for ($k = 1; $k <= 10; $k++) {
    //             echo "<tr style='font-family:arial;'>";
    //             for ($j = 1; $j <= $_POST["number"]; $j++) {
    //                 echo "<td style='padding:0.3vmax;'>" . $j . "x" . $k  . "=" . $j * $k . "</td>";
    //             }
    //             echo "</tr>";
    //         }
    //         echo "</table>";
    //     }
    // } else if ($_POST != null && $_POST["number"] == null) {
    //     echo '<script>alert("Bir sayi girmeniz gerekmektedir.")</script>';
    // }
    ?>
</div>
<div style="height:100vh;top:100vh;width:100%;background-color:#151515;color:White;">
    <form method="post">
        <input style="font-size:3vmax;" name="star" placeholder="yildiz sayisi" />
    </form>
    <?php
    if ($_POST != null && $_POST["star"] != null) {
        $ns = $_POST["star"];
        $nx = $ns * 2;
        for ($i = $ns; $i > 0; $i--) {
            $spaces = " ";
            for ($a = 1; $a <= $i; $a++) {
                $spaces .= "-";
            }
            echo $spaces;
            for ($b = 0; $b <= $nx - $a - 1; $b++) {
                echo "*";
            }
            echo $spaces;
            echo "</br>";
        }
        for ($i = 0; $i < $ns; $i++) {
            $spaces = " ";
            for ($a = 0; $a <= $i; $a++) {
                $spaces .= "-";
            }
            echo $spaces;
            for ($b = $ns - $a + 1; $b >= 0; $b--) {
                echo "*";
            }
            echo $spaces;
            echo "</br>";
        }
        echo "</br></br></br>";
        $table = array();
        for ($i = 0; $i < $ns; $i++) {
            $sp = "";
            $st = "";
            for ($j = 0; $j < $ns - $i; $j++) {
                $sp .= "-";
            }
            for ($j = $i; $j >= 0; $j--) {
                $st .= "*";
            }
            echo $sp . "" . $st . "" . $st . "" . $sp . "</br>";
        }
    }
    ?>
</div>
