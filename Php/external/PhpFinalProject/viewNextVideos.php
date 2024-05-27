<div class="w-100 d-flex flex-column align-items-center ">
    <p style="white-space:pre-line;padding:0;">
        <?php
        $nTexts = selectData("select n.id,nx.title,nx.descr,n.user,n.date from n_video as nx inner join nexts as n on nx.nextId=n.id and n.user=?;", [$_SESSION["user"]], false);
        if (count($nTexts) == 0) {
            echo "<h6 class='w-25 text-center alert alert-warning m-3'>no videos yet</h6>";
            echo "<a href='home.php?view=sharenextvideo.php' class='w-25 btn btn-success'>Share video</a>";
        }
        foreach ($nTexts as $key) {
        ?>
    <div <?php echo "id=\"video$key[0]\"" ?> class="w-75 m-2 p-3" style="background-color:#202020;border-radius:0.5vmax;">
        <iframe src="<?= GenerateVideoPath($key[0],".")?>" class="w-100 d-flex flex-row justify-content-center align-items-center" style="height:50vh;border: 1px solid white;padding:0.5rem">
        </iframe>
        <h3 class='mt-3'><?= htmlspecialchars($key[1]) ?> </h3>
        <p class='mt-2' style='width:min-content;word-break:pre-line;white-space:pre;'><?= htmlspecialchars($key[2]) ?> </p>
        <?php
            if ($key[3] == $_SESSION["user"]) {
        ?>
            <button class=' btn bgCl2hover text-white border border-white' <?= "onclick=\"RemoveNext_Click($key[0])\"" ?>>Remove</button>
            <form class='d-inline' action="editnextvideo.php" method="post"><button name="nextId" class="btn bgCl2hover text-white border border-white" value="<?php echo "$key[0]" ?>">Edit</button></form>
        <?php
            }
        ?>

        <h6 class="mt-2"><?= $key[4] ?></h6>
    </div>
<?php } ?>
</p>
<script>
    function RemoveNext_Click(id) {
        jQuery.ajax({
            type: "post",
            url: "./managers/nmgVideo.php",
            data: {
                name: "remove",
                id: id
            },
            success: function(obj, textstatus) {
                if (obj != "null") {
                    let next = document.getElementById("video" + id);
                    next.parentElement.removeChild(next);
                    alert("Removed");
                }
            }
        });
    }
</script>
</div>