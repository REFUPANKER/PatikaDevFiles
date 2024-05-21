<?php
require_once("./managers/dbm.php");
if (!isset($_SESSION["authed"])) {
    header("location:auth.php");
}
if (isset($_POST["logout"])) {
    unset($_SESSION["authed"]);
    header("location:index.php");
}
$user = getUser($_SESSION["user"]);
?>
<html data-bs-theme="dark">

<head>
    <title>What Is Next</title>
    <link rel="stylesheet" href="res/bootstrap.min.css">
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/popper.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./res/style.css">

</head>

<body style="display:grid;grid-template-rows: min-content auto;">
    <div class="home-navbar">
        <a title="Profile" href="./profile.php" class="home-profile-img" style="<?php getUserImage($user["id"]); ?>"></a>
        <a title="Home" href="./" class="align-content-center text-center rounded rounded-3 text-decoration-none h-100 border border-5 overflow-hidden border-secondary whatisnextbtn" style="aspect-ratio:3/1;">
            <p class="m-0">What Is Next</p>
        </a>
        <form method="post" class="h-100 bg-dark m-0 p-0 btn">
            <button type="submit" class="home-logout-btn" name="logout" value="1">Logout</button>
        </form>
    </div>
    <div style="background-color: rgba(0,0,0,0.8);display:grid;grid-template-columns:20% auto;" class=" w-100 overflow-auto">
        <div class="home-sidebar">
            <div class="dropdown mt-3 ml-2 mr-2" data-bs-toggle="dropdown">
                <h5 class="text-center">Share</h5>
                <button class="btn bg-dark text-white dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    N E X T
                </button>
                <div class="dropdown-menu w-100 bgCl3" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?view=sharenexttext.php">Text</a>
                    <a class="dropdown-item" href="?view=sharenextimage.php">Image</a>
                    <a class="dropdown-item" href="?view=sharenextvideo.php">Video</a>
                </div>
            </div>
        </div>
        <div>
            <?php
            if (isset($_GET["view"])) {
                if (str_starts_with($_GET["view"], "share") && file_exists($_GET["view"])) {
                    require_once($_GET["view"]);
                } else {
                    echo "<h4 class='alert alert-danger m-3'>page not existing : 404</h4>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>