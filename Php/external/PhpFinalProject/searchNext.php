<div class="d-flex flex-column align-items-center h-100">
    <div class="border border-dark m-2 p-3 w-75 h-100" style="max-height:97%;background-color: #15151590;display:grid;grid-template-rows:min-content auto;">
        <form class="w-100 m-0" method="post" action="home.php?view=searchNext.php">
            <label class="w-100 text-center">Search Next <i>by title</i></label>
            <input spellcheck="false" name="searchNext" value="<?= isset($_POST["searchNext"]) ? $_POST["searchNext"] : "" ?>" required placeholder="type name" class="form-control bg-dark text-white">
            <h6 class="mt-1" style="color:#909090;" class="m-0">press enter to search</h6>
        </form>
        <div class="w-100 d-flex flex-row overflow-auto flex-wrap" style="gap:0.3vmax;">

            <?php
            if (isset($_POST["searchNext"])) {
                $searchNextResult = searchNext($_POST["searchNext"]);
            ?>
                <div class='w-100 d-flex flex-row justify-content-center' style='height:min-content;'>
                    <?= isset($searchNextResult["text"]) && count($searchNextResult["text"]) > 0 ? "" : "<div class='p-1 m-1 alert alert-warning '>no texts found</div>"; ?>
                    <?= isset($searchNextResult["image"]) && count($searchNextResult["image"]) > 0 ? "" : "<div class='p-1 m-1 alert alert-warning '>no image found</div>"; ?>
                    <?= isset($searchNextResult["video"]) && count($searchNextResult["video"]) > 0 ? "" : "<div class='p-1 m-1 alert alert-warning '>no video found</div>"; ?>
                </div>
                <!-- TEXTS -->
                <div class="d-flex p-1 w-100 h-auto flex-wrap justify-content-around">
                    <?php if (isset($searchNextResult["text"])) {
                        if (count($searchNextResult["text"]) > 0) {
                            foreach ($searchNextResult["text"] as $key => $value) {
                    ?>
                                <div title="show profile" onclick="PopUpProfileWithId(<?= $value[3] ?>)" class="NextItem overflow-hidden m-2 d-flex flex-column d-flex justify-content-between rounded rounded-3 border border-light" style="width:40%;">
                                    <h5 class="m-0 w-100 p-1 overflow-hidden" style="background-color: #90909090;height:min-content;" title="<?= $value[4] ?>"><?= $value[4] ?></h5>
                                    <h4 class="m-0 h-25 p-1" style="background-color: #60606090;"><?= htmlspecialchars($value[1]) ?></h4>
                                    <p class="text-wrap w-100 h-75 overflow-auto m-0 p-1" style="background-color: #25252590;">
                                        <?= htmlspecialchars($value[2]) ?>
                                    </p>
                                </div>

                    <?php }
                        }
                    }
                    ?>
                </div>
                <!-- IMAGES -->
                <div class="d-flex p-1 w-100 h-auto flex-wrap justify-content-around">
                    <?php
                    if (isset($searchNextResult["image"])) {
                        if (count($searchNextResult["image"]) > 0) {
                            foreach ($searchNextResult["image"] as $key => $value) {
                    ?>
                                <div title="show profile" onclick="PopUpProfileWithId(<?= $value[4] ?>)" class="NextItem overflow-hidden m-2 d-flex flex-column d-flex justify-content-end rounded rounded-3 border border-light" style="aspect-ratio: 1;background-color: #252525;background-image:url('<?= $value[1] ?>');background-repeat:no-repeat;background-size:contain;background-position:center;">
                                    <h5 class="m-0 w-100 p-1 overflow-hidden" style="background-color: #25252590;height:min-content;" title="<?= $value[5] ?>"><?= $value[5] ?></h5>
                                    <?php if (isset($value[3]) && strlen($value[3])) { ?>
                                        <p class="text-wrap w-100 overflow-auto m-0 p-1" style="max-height:30%;height:auto;background-color: #15151590;">
                                            <?= htmlspecialchars($value[3]) ?>
                                        </p>
                                    <?php } ?>
                                </div>

                    <?php }
                        }
                    }
                    ?>
                </div>
                <!-- VIDEOS -->
                <div class="d-flex p-1 w-100 h-auto flex-wrap justify-content-around">
                    <?php
                    if (isset($searchNextResult["video"])) {
                        if (count($searchNextResult["video"]) > 0) {
                            foreach ($searchNextResult["video"] as $key => $value) {
                    ?>
                                <div title="show profile" onclick="PopUpProfileWithId(<?= $value[1] ?>)" class="NextItem overflow-hidden m-2 d-flex flex-column d-flex justify-content-between rounded rounded-3 border border-light w-50" style="height:25vw;background-color:#151515;">
                                    <h5 class="m-0 w-100 p-1 overflow-hidden" style="min-height:10%;background-color: #90909090;" title="<?= $value[4] ?>"><?= $value[4] ?></h5>
                                    <iframe class="h-100" src="<?= GenerateVideoPath($value[0], ".", $value[1]) ?>"></iframe>
                                    <h4 class="m-0 p-1" style="height:min-content;background-color: #60606090;" title="<?= htmlspecialchars($value[2]) ?>"><?= htmlspecialchars($value[2]) ?></h4>
                                    <?php if (isset($value[3]) && strlen($value[3])) { ?>
                                        <p class="text-wrap w-100 h-25 overflow-auto m-0 p-1" style="background-color: #25252590;" title="<?= htmlspecialchars($value[3]) ?>">
                                            <?= htmlspecialchars($value[3]) ?>
                                        </p>
                                    <?php } ?>
                                </div>
                <?php
                            }
                        }
                    }
                }
                ?>
                </div>
        </div>
    </div>
</div>