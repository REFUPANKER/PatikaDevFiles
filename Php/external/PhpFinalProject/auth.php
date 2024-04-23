<?php
include_once("./managers/dbm.php");
if (isset($_SESSION["authed"])) {
    header("location:home.php");
}
?>
<html>

<head>
    <title>What Is Next - Auth</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div class="d-flex w-100 h-100 overflow-auto justify-content-center align-items-center">
        <div class="w-25 h-75 bgCl2 rounded rounded-3 p-2 d-flex flex-column text-center">
            <h2 class="p-3">What Is Next ?</h2>
            <div class="d-flex flex-row w-100">
                <form class="w-50 <?php echo isset($_GET["login"]) ? "bgCl3" : "" ?>"><button class="authuibutton" type="submit" name="login" value="1">login</button></form>
                <form class="w-50 <?php echo isset($_GET["signup"]) ? "bgCl3" : "" ?>"><button class="authuibutton" type="submit" name="signup" value="1">join us</button></form>
            </div>
            <div>
                <?php
                if (isset($_POST["sent"])) {
                    if (isset($_GET["signup"])) {
                        //reqQuery("insert into users (name,email,password) values (\"" . $_POST["name"] . " \",\"" . $_POST["email"] . "\",\"" . $_POST["password"] . "\")");
                        $_SESSION["authed"] = "true";
                        header("location:home.php");
                    } else {
                        echo "logging up";
                        echo print_r($_POST);
                    }
                }
                if (isset($_GET["signup"])) {
                    unset($_GET["login"]);
                ?>
                    <form id="authform" class="d-flex flex-column" method="post">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <button type="submit" name="sent" value="1">Sign Up</button>
                    </form>
                <?php
                } else {
                    unset($_GET["signup"]);
                    $_GET["login"] = "1";
                ?>
                    <form id="authform" class="d-flex flex-column" method="post">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                        <button type="submit" name="sent" value="1">Login</button>
                    </form>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>
<html>