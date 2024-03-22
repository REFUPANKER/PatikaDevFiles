<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-size: 3vmax;
            row-gap: 2vmax;
        }
    </style>
</head>

<body style="display:flex;justify-content:center;align-items:center;margin:0;">
    <form method="post" style="display:flex;flex-direction:column;">
        sayi 1
        <input name="sayi1" type="number" value="<?php echo ($_POST == null ? 0 : $_POST['sayi1']) ?>" />
        sayi 2
        <input name="sayi2" type="number" value="<?php echo ($_POST == null ? 0 : $_POST['sayi2']) ?>" />
        <div style="display:flex;flex-direction:row;justify-content:space-around;">
            islem sec
            <select name="islem">
                <option>+</option>
                <option>-</option>
                <option>/</option>
                <option>x</option>
            </select>
        </div>
        <button type="submit">hesapla</button>
        <button type="reset">temizle</button>
        <?php
        if ($_POST != null) {
            $sonuc = 0;
            $islem = $_POST["islem"];
            switch ($islem) {
                case '+':
                    $sonuc = $_POST['sayi1'] + $_POST['sayi2'];
                    break;
                case '-':
                    $sonuc = $_POST['sayi1'] - $_POST['sayi2'];
                    break;
                case '/':
                    $sonuc = $_POST['sayi1'] / $_POST['sayi2'];
                    break;
                case 'x':
                    $sonuc = $_POST['sayi1'] * $_POST['sayi2'];
                    break;
            }
            echo "Sonuç " . $sonuc;
        }
        ?>
    </form>
</body>

</html>