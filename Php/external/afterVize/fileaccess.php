<h1>
    <?php
    $dirs = scandir("../");
    unset($dirs[1], $dirs[0]);
    $dirs = array_values($dirs);
    foreach ($dirs as $i) {
        echo $i . "<br>";
    }
    echo "-------------------------------------------<br>";
    echo print_r($_FILES);
    if (isset($_POST["sent"])) {
        echo print_r($_FILES["filex"]);
    }
    ?>
    <form method="post"  enctype="multipart/form-data">
        <input name="filex" type="file">
        <button name="sent" value="true" type="submit">gonder</button>
    </form>
</h1>