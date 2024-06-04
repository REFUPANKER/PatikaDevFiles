<div class="d-flex flex-column align-items-center h-100">
    <div class="border border-dark m-2 p-3 w-75 h-100" style="max-height:97%;background-color: #15151590;display:grid;grid-template-rows:min-content auto;">
        <form class="w-100 m-0" method="post" action="home.php?view=searchNext.php">
            <label class="w-100 text-center">Search Next <i>by title</i></label>
            <input spellcheck="false" name="searchNext" value="<?= isset($_POST["searchNext"]) ? $_POST["searchNext"] : "" ?>" required placeholder="type name" class="form-control bg-dark text-white">
            <h6 class="mt-1" style="color:#909090;" class="m-0">press enter to search</h6>
        </form>
        <div class="w-100 d-flex flex-column overflow-auto ">
            <?php

            if (isset($_POST["searchNext"])) {
                $searchNextResult = searchNext($_POST["searchNext"]);
                print_r($searchNextResult);
                if (isset($searchNextResult["text"])) {
                    if (count($searchNextResult["text"]) > 0) {
                        foreach ($searchNextResult as $key => $value) {
                            echo print_r($value) . "<br></br>";
                        }
                    }
                }
                if (isset($searchNextResult["image"])) {
                    if (count($searchNextResult["image"]) > 0) {
                        foreach ($searchNextResult as $key => $value) {
                            echo print_r($value) . "<br></br>";
                        }
                    }
                }
                if (isset($searchNextResult["video"])) {
                    if (count($searchNextResult["video"]) > 0) {
                        foreach ($searchNextResult as $key => $value) {
                            echo print_r($value) . "<br></br>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>