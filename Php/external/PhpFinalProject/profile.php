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
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div class="whatisnextBackground w-100 m-0 overflow-auto bgCl2 " style="overflow:auto;height:100vh;">
        <a class="text-white fs-1" href="./home.php">back to home</a>
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
        <div class="d-flex flex-row w-100 p-2">
            <div class="bgimg" style="width: 10vmax;height:10vmax;border:0.3vmax solid white;background-color: rgba(255,255,255,0.5);border-radius: 0.5vmax;<?php getUserImage($_SESSION["user"]); ?>"></div>
            <p class="p-1">
                <?php
                foreach (getUser($_SESSION["user"]) as $key => $value) {
                    echo $key . " : " . htmlspecialchars($value) . "<br>";
                }
                ?>
            </p>
        </div>
        <div class="d-flex flex-column w-100 justify-content-center align-items-center">
            <form method="post" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                <h2>change profile photo</h2>
                <input id="pfpslct" onchange="onProfileImageSelected()" class="w-100" type="file" name="pfp" title="select file" accept="image/jpeg, image/png">
                <button class="w-100 p-1" type="submit" name="updatePfp" value="1">update photo</button>
                <p class="w-100 bg-dark p-1">size limit : <?php echo $sizeLimit . "mb" ?></p>
                <h6>selected image</h6>
                <div id="selectedImage" class="bgimg" style="width: 7vmax;height:7vmax;border:0.3vmax solid orange;background-color: rgba(255, 68, 0, 0.5);border-radius: 0.5vmax;"></div>
            </form>
        </div>
        <div class="d-flex flex-row w-100 justify-content-center bgCl2 p-2">
            <a class="ml-2 mr-2 text-white btn btn-<?= !isset($_GET["view"])|| $_GET["view"]=="viewNextTexts.php"?"primary":"outline-primary"?> " href="?view=viewNextTexts.php">Texts</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"])&& $_GET["view"]=="viewNextImages.php"?"primary":"outline-primary"?> " href="?view=viewNextImages.php">Images</a>
            <a class="ml-2 mr-2 text-white btn btn-<?= isset($_GET["view"])&& $_GET["view"]=="viewNextVideos.php"?"primary":"outline-primary"?> " href="?view=viewNextVideos.php">Videos</a>
        </div>
        <div class="d-flex bgCl1 flex-column w-100 min-vh-100 align-items-center" style="padding-bottom:2vmax;overflow:auto; ">
            <?php
            if (isset($_GET["view"])) {
                if (str_starts_with($_GET["view"], "view") && file_exists($_GET["view"])) {
                    require_once($_GET["view"]);
                } else {
                    echo "<h4 class='alert alert-danger m-3'>page not existing : 404</h4>";
                }
            }else{
                 require_once("viewNextTexts.php") ;
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