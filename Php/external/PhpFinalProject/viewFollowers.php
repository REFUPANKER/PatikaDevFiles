<?php
$FollowersOfWho = (isset($_GET["user"]) ? $_GET["user"] : $_SESSION["user"]);
$flUser = getUser($FollowersOfWho);
if (isset($_GET["remove"])) {
    FsRemoveFollower($_GET["remove"]);
}
?>
<div class="w-75 d-flex flex-column h-100 p-2 m-3 align-items-center" style="background-color: #303030;">
    <h1 class="text-center w-100 m-0 align-content-center">Listing followe<u>r</u>s of <?= $flUser["name"]  ?></h1>
    <hr class="bg-light w-25" style="height: 0.2rem;">
    <div class="w-75">
        <?php
        $getFollowers = FsGetFollowersOf($flUser["id"]);
        if (isset($getFollowers) && count($getFollowers)>0) {
            foreach ($getFollowers as $key => $value) { ?>
                <div onmousedown="followerItemClick(event,'<?= $value[1]?>')" class="text-white d-flex justify-content-between align-items-center w-100 mb-2 p-3 btn btn-secondary rounded rounded-3" style="background-color:#252525;">
                    <u style="font-size: 1.2rem;"><?= $value[0] ?></u>
                    <i style="float:right;color:#707070;font-size:0.8rem;" class="align-content-center"><?= $value[1] ?></i>
                    <a href="?view=viewFollowers.php&remove=<?= $value[2] ?>" id="removeFollower" class="d-inline-block btn btn-danger">remove</a>
                </div>
            <?php }
        } else { ?>
            <div class="alert alert-danger text-center">No followers found</div>
        <?php } ?>
    </div>
    <script>
        function followerItemClick(sender,popuptoken){
            if(sender.target.id!="removeFollower"){
                PopUpProfile(popuptoken);
            }
        }
    </script>
</div>