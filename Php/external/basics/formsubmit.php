<?php
foreach ($_POST as $key => $value) {
    echo $key . "|" . $value . "</br>";
}
if ($_POST==null) {
    echo "no post";
}
?>

<?php
/** 
        if ($_POST["islem"] != null) {
            $sonuc = 0;
            $islem=$_POST["islem"];
            switch ($islem) {
                case 'topla':
                    $sonuc = $_POST['sayi1'] + $_POST['sayi2'];
                    break;
                case 'cikar':
                    $sonuc = $_POST['sayi1'] - $_POST['sayi2'];
                    break;
                case 'bol':
                    $sonuc = $_POST['sayi1'] / $_POST['sayi2'];
                    break;
                case 'carp':
                    $sonuc = $_POST['sayi1'] * $_POST['sayi2'];
                    break;
            }
        }
        */ ?>