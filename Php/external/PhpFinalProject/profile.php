<?php
require_once("./managers/dbm.php");
if (!isset($_SESSION["authed"])) {
    header("location:auth.php");
}

?>
<html>

<head>
    <title>What Is Next</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div style="background-color: rgba(0,0,0,0.8);" class="w-100 h-100 m-0 overflow-auto bgCl2 ">
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
        <div class="bgimg" style="width: 5vmax;height:5vmax;border:0.3vmax solid white;background-color: rgba(255,255,255,0.5);margin:1vmax;border-radius: 0.5vmax;<?php getUserImage($_SESSION["user"]); ?>">

        </div>
        <form method="post" enctype="multipart/form-data" class="d-flex flex-column" style="width: min-content;">
            <input type="file" name="pfp" title="select file" accept="image/jpeg, image/png">
            <button type="submit" name="updatePfp" value="1">update photo</button>
            size limit is <?php echo $sizeLimit . "mb" ?>
        </form>
    </div>
</body>

</html>