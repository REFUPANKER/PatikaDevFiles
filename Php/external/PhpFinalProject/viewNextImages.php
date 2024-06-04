<div class="w-100 d-flex flex-column align-items-center ">
    <p style="white-space:pre-line;padding:0;">
        <?php
        $nTexts = selectData("select n.id,nx.image,nx.title,nx.descr,n.user,n.date from n_image as nx inner join nexts as n on nx.nextId=n.id and n.user=?;", [$_SESSION["user"]], false);
        if (count($nTexts) == 0) {
            echo "<h6 class='w-25 text-center alert alert-warning m-3'>no images yet</h6>";
            echo "<a href='home.php?view=sharenextimage.php' class='w-25 btn btn-success'>Share image</a>";
        }
        foreach ($nTexts as $key) {
        ?>
    <div <?php echo "id=\"image$key[0]\"" ?> class="w-75 m-2 p-3" style="background-color:#202020;border-radius:0.5vmax;">
        <div class="w-100 d-flex flex-row justify-content-center align-items-center">
            <div class="rounded rounded-3" id="preview" style="border: 1px solid white; padding: 1rem;background-position: center; background-repeat: no-repeat;background-size: contain;width:100%;height:40vh;background-image:url('<?= $key[1] ?>')"></div>
        </div>

        <h3 class='mt-3'><?= (isset($key[2]) > 0) && $key[2] != null ? htmlspecialchars($key[2]) : "<i>No Title</i>" ?> </h3>
        <p class='mt-2' style='width:100%;overflow: auto;word-break: pre-line;white-space:pre;'><?= htmlspecialchars($key[3]) ?></p>

        <?php
            if ($key[4] == $_SESSION["user"]) {
        ?>
            <button class=' btn bgCl2hover text-white border border-white' <?php echo "onclick=\"RemoveNext_Click('$key[0]')\"" ?>>Remove</button>
            <form class='d-inline' action="editnextimage.php" method="post"><button name="nextId" class="btn bgCl2hover text-white border border-white" value="<?php echo "$key[0]" ?>">Edit</button></form>
        <?php
            }
        ?>

        <h6 class="mt-2"><?= $key[5] ?></h6>
    </div>
<?php } ?>
</p>
<script>
    function RemoveNext_Click(id) {
        jQuery.ajax({
            type: "post",
            url: "./managers/nmgImage.php",
            data: {
                name: "remove",
                id: id
            },
            success: function(obj, textstatus) {
                if (obj != "null") {
                    let next = document.getElementById("image" + id);
                    next.parentElement.removeChild(next);
                    alert("Removed");
                }
            }
        });
    }
</script>
</div>