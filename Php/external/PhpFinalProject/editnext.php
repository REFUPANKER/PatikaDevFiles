<?php
require_once("./managers/dbm.php");
checkAuth();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit My NEXT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
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
        $nText = selectData("select * from n_text where nextId=?", [$_POST["nextId"]]);
        print_r($nText);
    ?>
        <div class="d-flex justify-content-center align-items-center flex-column h-100">
            <div class="bg-dark p-3 rounded rounded-3" style="display:flex;flex-direction: column;width:50%;">
                Title
                <input spellcheck="false" id="nextTitle" <?php echo (isset($nText) ? "placeholder=\"" . $nText["title"] . "\"" : "") ?> style="font-size: 1.3rem;">
                Content
                <textarea spellcheck="false" id="nextContent" <?php echo (isset($nText) ? "placeholder=\"" . $nText["content"] . "\"" : "") ?> style="font-size:1.2rem;resize: none;height:25vh;"></textarea>
                <div>
                    <h6>Categories</h6>
                    <div id="categoriesHolder">
                        <?php
                        if (isset($nText)) {
                            $categories = selectData("select category from n_categories where nextId>?", [5]);
                            if (is_array($categories)) {
                                foreach ($categories as $key => $value) {
                                    echo $value . "<br>";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <button onclick="ConfirmEdit()">Update N E X T</button>
            </div>
        </div>
    <?php } ?>
    <script>
        let posted = false;
        const tTitle = document.getElementById("nextTitle");
        const tContent = document.getElementById("nextContent");

        function ConfirmEdit() {
            if (posted) {
                alert("ayo o_O you already shared this");
                return;
            }
            if (tTitle.value.replace(" ", "").length < 1) {
                alert("Fill all the fields");
                return;
            }
            if (tContent.value.replace(" ", "").length < 1) {
                alert("No content ? ok :/");
            }
        }
    </script>
</body>

</html>