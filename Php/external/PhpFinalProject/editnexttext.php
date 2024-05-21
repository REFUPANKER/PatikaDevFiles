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
            $nText = selectData("select nextId,title,content from n_text where nextId=?", [$_POST["nextId"]]);
        ?>
            <div class="d-flex justify-content-center align-items-center flex-column h-100">
                <div style="background-color: #151515;padding:0.5rem 2rem;border-radius:1rem 1rem 0 0;border:0.05rem solid white;border-bottom:none;">Edit NEXT : Text</div>
                <div class="p-3 rounded rounded-3" style="display:flex;flex-direction: column;width:50%;background-color: #151515;border:0.05rem solid white;">
                    Title
                    <input class="form-control bg-dark text-white" spellcheck="false" max="128" id="nextTitle" <?php echo (isset($nText) ? "placeholder=\"" . htmlspecialchars($nText["title"]) . "\"" : "") ?> style="font-size: 1.3rem;">
                    <button onclick="tTitle.value=defaultTitle" class="btn btn-secondary mt-1 mb-1">Use default title</button>
                    Content
                    <textarea class="form-control bg-dark text-white" spellcheck="false" maxlength="512" id="nextContent" <?php echo (isset($nText) ? "placeholder=\"" . htmlspecialchars($nText["content"]) . "\"" : "") ?> style="font-size:1.2rem;resize: none;height:25vh;margin-bottom:1rem;"></textarea>
                    <div class="d-flex flex-row justify-content-between">
                        <button class="btn btn-dark w-75" onclick="ConfirmEdit()">Update N E X T</button>
                        <a href="profile.php" class="btn btn-warning">Back to profile</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <script>
            const nextId = <?php echo $_POST["nextId"] ?>;
            const tTitle = document.getElementById("nextTitle");
            const tContent = document.getElementById("nextContent");
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
                let Ctitle = false, //C stands for Changed -> type
                    CContent = false;
                if (tTitle.value.replace(" ", "").length > 0) {
                    Ctitle = true;
                }
                if (tContent.value.replace(" ", "").length > 0) {
                    CContent = true;
                }
                let receipt = "";
                if (!Ctitle && !CContent) {
                    alert("no changes made\nturning back to profile");
                    window.open("profile.php", "_self");
                    return;
                } else
                if (Ctitle || CContent) {
                    receipt = "-----Changes-----\n" + (Ctitle ? "Title\n" : "") + (CContent ? "Content\n" : "") + "\n";
                }
                jQuery.ajax({
                    type: "post",
                    url: "./managers/nmgText.php",
                    data: {
                        name: "edit",
                        id: nextId,
                        title: tTitle.value,
                        content: tContent.value
                    },
                    success: function(obj, textstatus) {
                        if (obj != "null") {
                            edited = true;
                            alert(receipt+"Next Edited\nRedirecting to profile");
                            window.open("./profile.php", "_self");
                        }
                    }
                });
            }
        </script>
    </div>
</body>

</html>