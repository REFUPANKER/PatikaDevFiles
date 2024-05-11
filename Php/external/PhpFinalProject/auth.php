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
    <div style="background-color: rgba(0,0,0,0.8);" class="d-flex w-100 h-100 overflow-auto justify-content-center align-items-center">
        <div class="w-50 h-75 bgCl2 rounded rounded-3 p-2 d-flex flex-column text-center">
            <h2 class="p-3">What Is Next ?</h2>
            <div class="d-flex flex-row w-100">
                <form class="w-50 <?php echo isset($_GET["login"]) ? "bgCl3" : "" ?>"><button class="authuibutton" type="submit" name="login" value="1">login</button></form>
                <form class="w-50 <?php echo isset($_GET["signup"]) ? "bgCl3" : "" ?>"><button class="authuibutton" type="submit" name="signup" value="1">join us</button></form>
            </div>
            <div>
                <?php
                if (isset($_POST["sent"])) {
                    if (isset($_GET["signup"])) {
                        $vals = selectData("select * from users where email=? ", [$_POST["email"]]);
                        if (isset($vals)) {
                            echo "<h5 class=\"alert alert-danger p-2\">account already exists</h5>";
                        } else {
                            addUser($_POST["name"], $_POST["email"], $_POST["password"]);
                            $_SESSION["authed"] = "true";
                            $_SESSION["user"] = lastId();
                            header("location:home.php");
                        }
                    } else {
                        $vals = selectData("select * from users where email=? ", [$_POST["Lemail"]]);
                        if (isset($vals)) {
                            if ($_POST["Lpassword"] == $vals["password"]) {
                                $_SESSION["authed"] = "true";
                                $_SESSION["user"] = $vals["id"];
                                header("location:home.php");
                            } else {
                                echo "<h5 class=\"alert alert-danger p-2\">Wrong password</h5>";
                            }
                        } else {
                            echo "<h5 class=\"alert alert-danger p-2\">User not exists</h5>";
                        }
                    }
                }
                if (isset($_GET["signup"])) {
                    unset($_GET["login"]);
                ?>
                    <form id="authform" class="d-flex flex-column" method="post">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" <?php echo "value=\"" . getPostValue("name") . "\"" ?>>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" <?php echo "value=\"" . getPostValue("email") . "\"" ?>>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" <?php echo "value=\"" . getPostValue("password") . "\"" ?>>
                        <button type="submit" name="sent" value="1">Sign Up</button>
                    </form>
                <?php
                } else {
                    unset($_GET["signup"]);
                    $_GET["login"] = "1";
                ?>
                    <form id="authform" class="d-flex flex-column" method="post">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="Lemail" <?php echo "value=\"" . getPostValue("Lemail") . "\"" ?>>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="Lpassword" <?php echo "value=\"" . getPostValue("Lpassword") . "\"" ?>>
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