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