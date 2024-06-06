<!-- IMPORT site.js for popupProfileClose -->
<link rel="stylesheet" href="./res/animate.min.css" />
<div id="popupProfile" onmousedown="popupProfileClose(event)" class="animate__animated animate__fadeIn d-flex flex-column justify-content-center align-items-center" style="margin:0;left:0;top:0;position:fixed;width:100%;height:100vh;background-color:rgba(0,0,0, 0.8);z-index:10;">
    <div class="animate__animated animate__zoomIn w-50 h-75 bg-dark rounded rounded-3 text-break overflow-auto p-5 d-flex flex-column align-items-center">
        <?php
        require_once("./managers/dbm.php");

        if (isset($_POST["Follow"])) {
        }
        if (isset($_POST["token"])) {
            $PPprofileData = getUserT($_POST["token"]);
        } else if (isset($_POST["userid"])) {
            $PPprofileData = getUser($_POST["userid"]);
        } else {
            return "<h5 class='alert alert-danger w-100'>no user available for this token</h5>";
        }
        if (isset($_POST["state"])) {
            switch ($_POST["state"]) {
                case 'Follow':
                    FsFollowTo($PPprofileData["id"]);
                    break;
                case 'Unfollow':
                    FsUnFollow($PPprofileData["id"]);
                    break;
            }
        }
        ?>
        <div class="w-25 rounded rounded-3 border border-light" style="aspect-ratio:1;background-position:center;background-repeat:no-repeat;background-size:cover;<?= getUserImage($PPprofileData["id"]); ?>"></div>
        <h1 class=" d-flex m-0 p-0 align-content-center" title="<?=$PPprofileData['id']?>"><?= $PPprofileData["name"] ?></h1>
        <div class="m-0 d-flex justify-content-around">
            <?= "<h3 class='m-2 btn text-white align-content-center bg-" . ($PPprofileData["active"] == 1 ? "success" : "danger") . "'>" . ($PPprofileData["active"] == 1 ? "Active" : "Deactive") . "</h3>"; ?>
            <?php
            if ($PPprofileData["id"] != $_SESSION["user"]) {
                $followtype = (FsFollows($PPprofileData["id"]) == true ? "Unfollow" : "Follow");
            ?>
                <button class="m-2 align-content-center btn btn-primary" onclick="ChangeFollowState('<?= $followtype ?>','<?= $PPprofileData['token'] ?>')"><?= $followtype ?></button>
            <?php
            } else { ?>
                <a class="m-2 btn btn-outline-warning" href="./profile.php">Edit your profile</a>
            <?php }
            ?>
        </div>
        <div class="d-flex flex-row justify-content-center h-25 w-100">
            <div class="h-100 d-flex flex-column p-2 rounded rounded-3 shadow border border-light" style="background-color: #252525;">
                <h6 class="m-0">Followers</h6>
                <h4 class="text-center h-100 align-content-center justify-content-center w-100 m-0"> <?= FsFollowerCount($PPprofileData["id"]) ?></h4>
            </div>
        </div>
    </div>
</div>