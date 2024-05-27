<div class="w-100 d-flex flex-column justify-content-center align-items-center">
    <p style="white-space:pre-line;padding:0;">
        <?php
        $nTexts = selectData("select n.id,nt.title,nt.content,n.user,n.date from n_text as nt inner join nexts as n on nt.nextId=n.id and n.user=?;", [$_SESSION["user"]], false);
        if (count($nTexts) == 0) {
            echo "<h6 class='w-25 text-center alert alert-warning m-3'>no texts yet</h6>";
            echo "<a href='home.php?view=sharenexttext.php' class='w-25 btn btn-success'>Share text</a>";
        }
        foreach ($nTexts as $key) {
        ?>
    <div <?php echo "id=\"text$key[0]\"" ?> class="w-75 m-2 p-3" style="background-color:#202020;border-radius:0.5vmax;">
        <?php
            echo "<h2 style='margin:0;'>" . htmlspecialchars($key[1]) . "</h2>";
            echo "<p style='width:min-content;word-break:pre-line;white-space:pre;'>" . htmlspecialchars($key[2]) . "</p>";
        ?>
        <br></br>
        <?php
            if ($key[3] == $_SESSION["user"]) {
        ?>
        <button class=' btn bgCl2hover text-white border border-white' <?php echo "onclick=\"RemoveNext_TextClick('$key[0]')\"" ?>>Remove</button>
        <form class='d-inline' action="editnexttext.php" method="post"><button name="nextId" class="btn bgCl2hover text-white border border-white" value="<?php echo "$key[0]" ?>">Edit</button></form>
        <?php
            }
        ?>
        <h6 class="mt-3"><?= $key[4] ?></h6>
    </div>
<?php } ?>
</p>
<script>
    function RemoveNext_TextClick(id) {
        jQuery.ajax({
            type: "post",
            url: "./managers/nmgText.php",
            data: {
                name: "remove",
                id: id
            },
            success: function(obj, textstatus) {
                if (obj != "null") {
                    let ntext = document.getElementById("text" + id);
                    ntext.parentElement.removeChild(ntext);
                    alert("Removed");
                }
            }
        });
    }
</script>
</div>