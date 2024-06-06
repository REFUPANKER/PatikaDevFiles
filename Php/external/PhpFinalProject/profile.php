<?php
require_once("./managers/dbm.php");
if (!isset($_SESSION["authed"])) {
    header("location:auth.php");
}
?>
<html>

<head>
    <title>What Is Next</title>
    <link rel="stylesheet" href="res/bootstrap.min.css">
    <script src="scripts/jquery.min.js"></script>
    <script src="scripts/site.js"></script>
    <script src="scripts/timeout.js"></script>
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div class="whatisnextBackground w-100 m-0 overflow-auto bgCl2 " style="overflow:auto;height:100vh;">
        <a class="text-white fs-1 btn btn-dark m-3" href="./home.php">back to home</a>
        <a class="text-white fs-1 btn btn-success m-3" href="./managers/excel.php">Save your data to Excel</a>
        <?php 
        $logfile="./db_excel/LogsOf_" . $_SESSION['user'] . ".xlsx";
        if (file_exists($logfile)) {
        ?>
            <a class="text-white fs-1 btn btn-warning m-3" href="<?= $logfile?>">Downlaod your Excel data</a>
        <?php
        } ?>

        <h1 class="text-center">Profile</h1>
        <?php
        $sizeLimit = 5;
        if (isset($_POST["updatePfp"]) && isset($_FILES["pfp"])) {
            $file = $_FILES["pfp"];
            $allowedTypes = array("image/jpeg", "image/png");
            if (!in_array($file["type"], $allowedTypes)) {
                echo "only JPEG and PNG allowed";
            } else {
                $maxFileSize = $sizeLimit * 1024 * 1024;
                if ($file["size"] > $maxFileSize) {
                    echo "file size over the limit <i>" . $sizeLimit . "mb</i>";
                } else {
                    updateUserImage($file["tmp_name"]);
                    header("location:./profile.php");
                }
            }
        }
        ?>
        <div class="d-flex flex-row w-100 p-2 justify-content-center align-items-center">
            <div class="bgimg" style="width: 20vmax;aspect-ratio: 1;border:0.3vmax solid white;background-color: rgba(255,255,255,0.5);border-radius: 0.5vmax;<?php getUserImage($_SESSION["user"]); ?>"></div>
            <div class="w-25 align-items-center justify-content-center d-flex flex-column">
                <?php $userdata = getUser($_SESSION["user"]); ?>
                <h3 class="m-0 w-50 text-center" style="text-wrap: wrap;word-break: break-all;" title="<?= htmlspecialchars($userdata["id"]) ?>"><?= htmlspecialchars($userdata["name"]) ?></h3>
                <h3 class="w-50 m-1 btn btn-<?= ($userdata["active"] == 1 ? "success" : "danger") ?>"> <?= ($userdata["active"] == 1 ? "Active" : "Deactive") ?></h3>
                <h3 class="w-50 btn btn-primary pl-2 pr-2 pb-1 pt-1 m-1 d-flex flex-column">Followers
                    <label><?= FsFollowerCount($_SESSION["user"]) ?></label>
                </h3>
                <h3 class="w-50 btn btn-primary pl-2 pr-2 pb-1 pt-1 m-1 d-flex flex-column">You Followed
                    <label><?= FsFollowedsCount($_SESSION["user"]) ?></label>
                </h3>
            </div>
        </div>
        <div class="d-flex flex-column w-100 justify-content-center align-items-center">
            <form method="post" enctype="multipart/form-data" class="d-flex flex-row align-items-center justify-content-around w-75">
                <div>
                    <h2>change profile photo</h2>
                    <label for="pfpslct" class="btn btn-dark w-100 m-1">Select Image</label>
                    <input id="pfpslct" onchange="onProfileImageSelected()" class="d-none w-100" type="file" name="pfp" title="select file" accept="image/jpeg, image/png">
                    <button class="w-100 p-1 btn btn-dark m-1" type="submit" name="updatePfp" value="1">Update photo</button>
                    <p class="w-100 p-1 rounded rounded-3 m-1 text-center"><i>size limit : <?php echo $sizeLimit . "mb" ?></i></p>

                </div>
                <div>
                    <h6 class="m-0 text-center">selected image</h6>
                    <div id="selectedImage" class="bgimg" style="width: 14vmax;aspect-ratio: 1;border:0.3vmax solid white;background-color: rgba(255,255,255,0.5);border-radius: 0.5vmax;"></div>
                </div>
            </form>
        </div>
        <div class="d-flex flex-row w-100 justify-content-center bgCl2 p-2">
            <a class="ml-2 mr-2 text-white btn btn-<?= !isset($_GET["view"]) || $_GET["view"] == "viewNextTexts.php" ? "primary" : "outline-primary" ?> " href="?view=viewNextTexts.php">Texts</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"]) && $_GET["view"] == "viewNextImages.php" ? "primary" : "outline-primary" ?> " href="?view=viewNextImages.php">Images</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"]) && $_GET["view"] == "viewNextVideos.php" ? "primary" : "outline-primary" ?> " href="?view=viewNextVideos.php">Videos</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"]) && $_GET["view"] == "viewFollowers.php" ? "success" : "outline-success" ?> " href="?view=viewFollowers.php">Followers</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"]) && $_GET["view"] == "viewFolloweds.php" ? "success" : "outline-success" ?> " href="?view=viewFolloweds.php">You Followed</a>
        </div>
        <div class="d-flex bgCl1 flex-column w-100 min-vh-100 align-items-center" style="padding-bottom:2vmax;overflow:auto; ">
            <?php
            if (isset($_GET["view"])) {
                if (str_starts_with($_GET["view"], "view") && file_exists($_GET["view"])) {
                    require_once($_GET["view"]);
                } else {
                    echo "<h4 class='alert alert-danger m-3'>page not existing : 404</h4>";
                }
            } else {
                require_once("viewNextTexts.php");
            }
            ?>
        </div>
    </div>
</body>
<script>
    function onProfileImageSelected() {
        var pfpfile = document.getElementById("pfpslct");
        var pfpimg = document.getElementById("selectedImage");
        if (pfpfile.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                pfpimg.style.backgroundImage = "url('" + e.target.result + "')";
            }
            reader.readAsDataURL(pfpfile.files[0]);
        }
    }
</script>

</html>