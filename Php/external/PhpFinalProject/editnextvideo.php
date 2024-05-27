<?php
require_once("./managers/dbm.php");
checkAuth();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My NEXT</title>
    <link rel="stylesheet" href="res/bootstrap.min.css">
    <script src="scripts/jquery.min.js"></script>
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div class="whatisnextBackground w-100 h-100 m-0 overflow-auto bgCl2 " style="overflow:auto;height:100vh;">
        <script>
            function backtoProfile() {
                alert("No texts available,redirecting back to profile");
                setTimeout(() => {
                    window.open("profile.php", "_self");
                }, 2000);
            }
        </script>
        <?php
        $backtoProfile = "<script>backtoProfile();</script>";
        $nText = null;
        if (!isset($_POST["nextId"])) {
            echo $backtoProfile;
        } else {
            $nText = selectData("select nextId,title,descr from n_video where nextId=?", [$_POST["nextId"]]);
            
        ?>
            <div class="d-flex justify-content-center align-items-center flex-column h-100">
                <div style="background-color: #151515;padding:0.5rem 2rem;border-radius:1rem 1rem 0 0;border:0.05rem solid white;border-bottom:none;">Edit NEXT : Image</div>
                <div class="p-3 rounded rounded-3 overflow-auto d-flex flex-column" style="height:75%;width:50%;background-color: #151515;border:0.05rem solid white;">
                    <div class=" p-2">
                        <a href="profile.php" class="btn btn-warning mb-1">Back to profile</a>
                        <iframe src="<?= GenerateVideoPath($nText["nextId"], ".") ?>" class="w-100 d-flex flex-row justify-content-center align-items-center" style="height:50vh;border: 1px solid white;padding:0.5rem"></iframe>
                        <h6 class="text-center text-warning mt-2">you cant change video</h6>
                    </div>
                    <div class=" p-2 d-flex flex-column">
                        Title
                        <input class="form-control bg-dark text-white" spellcheck="false" max="128" id="nextTitle" <?php echo (isset($nText) ? "placeholder=\"" . htmlspecialchars($nText["title"]) . "\"" : "") ?> style="font-size: 1.3rem;">
                        <button onclick="tTitle.value=defaultTitle" class="btn btn-secondary mt-1 mb-1">Use default title</button>
                        Description
                        <textarea class="form-control bg-dark text-white" spellcheck="false" maxlength="512" id="nextDescr" <?php echo (isset($nText) ? "placeholder=\"" . htmlspecialchars($nText["descr"]) . "\"" : "") ?> style="font-size:1.2rem;resize: none;height:25vh;margin-bottom:1rem;"></textarea>
                        <button class="btn btn-dark w-100" onclick="ConfirmEdit()">Update N E X T</button>
                    </div>
                </div>
            </div>
        <?php } ?>
        <script>
            const nextId = <?php echo $_POST["nextId"] ?>;
            const tTitle = document.getElementById("nextTitle");
            const tDescr = document.getElementById("nextDescr");
            const defaultTitle = tTitle.placeholder;
            let edited = false;

            function ConfirmEdit() {
                if (edited) {
                    alert("redirecting to profile,please wait");
                    return;
                }
                if (tTitle.value.replace(" ", "").length <= 0) {
                    alert("Title must be valid!");
                    return;
                }
                if (tDescr.value.replace(" ", "").length <= 0) {
                    alert("No description");
                }
                jQuery.ajax({
                    type: "post",
                    url: "./managers/nmgVideo.php",
                    data: {
                        name: "edit",
                        id: nextId,
                        title: tTitle.value,
                        descr: tDescr.value
                    },
                    success: function(obj, textstatus) {
                        if (obj != "null") {
                            edited = true;
                            alert("Next Edited\nRedirecting to profile");
                            window.open("./profile.php", "_self");
                        }
                    }
                });
            }
        </script>
    </div>
</body>

</html>