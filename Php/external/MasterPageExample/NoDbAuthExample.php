<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Masterpage without db</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    $n = "asd";
    $p = "qwe";
    session_start();
    if (isset($_POST["exit"])) {
        session_destroy();
        session_unset();
        header("Refresh:0");
    }
    // if (isset($_SESSION["name"]) && isset($_SESSION["password"])) {
    //     // echo "<form method='post'><button name='exit' type='submit'>exit</button></form>";
    //     require_once("./index.php");
    // } else
    if (isset($_POST["name"]) && isset($_POST["password"])) {
        $name = $_POST["name"];
        $password = $_POST["password"];
        if ($name == $n && $password == $p) {
            $_SESSION["name"] = $name;
            $_SESSION["password"] = $password;
            require_once("./index.php");
        } else {
            $style="<div class='text-center fs-1 bg-danger text-white p-3'>";
            if ($name != $n) {
                echo "$style isim hatali</div></br>";
            }
            if ($password != $p) {
                echo "$style sifre hatali</div></br>";
            }
            require_once("./authform.php");
        }
    } else {
        require_once("./authform.php");
    }
    ?>

</body>

</html>