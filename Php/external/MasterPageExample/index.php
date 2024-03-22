<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php
/*
require_once("../sort.php");
require("../sort.php");
include_once("../sort.php");
include("../sort.php");
*/
?>
<div class="d-flex flex-row w-100 bg-dark" style="height:100vh;">
    <div class="w-25 h-100 overflow-auto" style="background-color: #151515;">
    <form method='post' action="./NoDbAuthExample.php">
            <button name='exit' value="exit" type='submit' class="btn m-2 p-3 bg-danger text-white">Exit</button>
        </form>
        <div class="align-items-center d-flex flex-column w-100 h-75">
            <div class="mt-5 bg-secondary rounded-lg shadow-lg" style="display:grid;grid-template-rows: 20vh auto;width:20vh;">
                <div class="w-100" style="background-image: url('https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo-shadow.png');background-repeat:no-repeat;background-size:contain;background-position:center;">

                </div>
                <label class="w-100 text-white p-2">
                    <?php
                    if (isset($_SESSION["name"])) {
                        echo $_SESSION["name"];
                    } else {
                        echo "Username";
                    }
                    ?>
                </label>
            </div>
        </div>
    </div>
    <div class="w-75 h-100 bg-dark overflow-auto text-white">
        <h1 class="text-center">Giris islemi basarili</h1>
    </div>
</div>