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
            display: grid;
            height: 100vh;
            grid-template-rows: min-content auto;
            color: white;
        }

        #login {
            font-size: 2vmax;
            background-color: #454545;
        }

        .dangerbox {
            font-size: 1vmax;
            margin: 0.5vmax 0;
        }
    </style>
</head>
<?php
session_start();
$posted = $_POST != null;
function post($val)
{
    if (isset($_POST[$val])) {
        return $_POST[$val];
    } else {
        return null;
    }
}
function session($val)
{
    if (isset($_SESSION[$val])) {
        return $_SESSION[$val];
    } else {
        return null;
    }
}
$authconfirm = post("username") == "admin" &&  post("password") == "123";

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    unset($_POST);
} else if (isset($_POST["login"])) {
    if ($authconfirm) {
        $_SESSION["username"] = post("username");
        $_SESSION["password"] = post("password");
    } else {
    }
}

?>

<body class="overflow-auto w-100 m-0 text-white">
    <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 class="m-0">Patika.dev Tasks</h1>
        <h4 class="m-0">src : <a class="text-primary" target="_blank" href="https://academy.patika.dev/tr/courses/php-temel/">patika.dev php temelleri</a></h4>
    </div>
    <div class="d-flex flex-column justify-content-center align-items-center">
        <?php if (!$authconfirm) : ?>
            <form id="login" class="d-flex flex-column justify-content-around p-3 rounded rounded-3" method="post">
                Username
                <input class="bg-secondary text-white border-0" name="username" spellcheck="false" type="text" value="<?= post("username") ?>" />
                <?php if ($posted && isset($_POST["login"]) && post("username") == null) :  ?>
                    <div class="alert alert-danger dangerbox p-2">Name field must be valid</div>
                <?php endif; ?>
                Password
                <input class="bg-secondary text-white border-0" name="password" spellcheck="false" type="text" value="<?= post("password") ?>" />
                <?php if ($posted && isset($_POST["login"]) && post("password") == null) :  ?>
                    <div class="alert alert-danger dangerbox p-2">Password field must be valid</div>
                <?php endif; ?>
                <button type="send" name="login" value="true" class="btn btn-success mt-3 ">Login</button>
                <?php if ($posted && isset($_POST["login"]) && !$authconfirm && (post("username") != null && post("password") != null)) : ?>
                    <div class="alert alert-danger dangerbox p-2">User not existing</div>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <div class="w-100 h-100">
                <h1>Hoş geldin <?= session("username") ?></h1>
                <form method="post">
                    <button name="logout" value="true" class="btn btn-danger p-3 ">logout</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>