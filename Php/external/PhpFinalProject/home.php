<?php
require_once("./managers/dbm.php");
if (!isset($_SESSION["authed"])) {
    header("location:auth.php");
}
if (isset($_POST["logout"])) {
    unset($_SESSION["authed"]);
    header("location:index.php");
}
$user = selectData("select id,name,email from users where id= " . $_SESSION["user"] . ";");
?>
<html>

<head>
    <title>What Is Next</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./res/style.css">
</head>

<body style="display:grid;grid-template-rows: min-content auto;">
    <div class="home-navbar">
        <a title="Profile" href="./profile.php" class="home-profile-img" style="<?php getUserImage($user["id"]); ?>"></a>
        <form method="post"  class="h-100 bg-dark m-0 p-0">
            <button type="submit" class="home-logout-btn" name="logout" value="1">Logout</button>
        </form>
    </div>
    <div style="background-color: rgba(0,0,0,0.8);" class="d-flex w-100 overflow-auto p-2">
        <?php
        if (isset($_GET["view"])) {
            require_once($_GET["view"]);
        } else {

        }
        ?>
    </div>
</body>

</html>