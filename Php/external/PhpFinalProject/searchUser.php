<div class="d-flex flex-column align-items-center h-100">
    <div class="border border-dark m-2 p-3 w-75 h-100" style="max-height:97%;background-color: #15151590;display:grid;grid-template-rows:min-content auto;">
        <form class="w-100 m-0" method="post" action="home.php?view=searchUser.php">
            <label class="w-100 text-center">Search User</label>
            <input spellcheck="false" name="searchUser" value="<?= isset($_POST["searchUser"]) ? $_POST["searchUser"] : "" ?>" required placeholder="type name" class="form-control bg-dark text-white">
            <h6 class="mt-1" style="color:#909090;" class="m-0">press enter to search</h6>
        </form>
        <div class="w-100 d-flex flex-column overflow-auto ">
            <?php

            if (isset($_POST["searchUser"])) {
                $searchUserResult = SearchUser($_POST["searchUser"]);
                if (count($searchUserResult) <= 0) {
                    echo "No users found";
                } else {
                    foreach ($searchUserResult as $key => $value) { ?>
                        <button onclick="PopUpProfile('<?= $value[1] ?>')" class="text-white d-flex justify-content-between align-items-center w-100 mb-2 p-3 btn btn-secondary rounded rounded-3" style="background-color:#252525;">
                            <u style="font-size: 1.2rem;"><?= $value[2] ?></u>
                            <i style="float:right;color:#707070;font-size:0.8rem;" class="align-content-center"><?= $value[1] ?></i>
                        </button>
            <?php }
                }
            }
            ?>
        </div>
    </div>
</div>