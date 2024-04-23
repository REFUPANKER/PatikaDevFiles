<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a{
            color:lightblue;
        }
        a:hover{
            color:cyan;
        }
    </style>
</head>

<body style="overflow:auto;height:100vh;margin:0;background-color: black;color:white;">
    <div style="font-size:3vmax;display:flex;flex-direction:column;color:white;width:min-content;">
        <?php
        function getPages($path = null, $tab = 0)
        {
            if ($path == null) {
                $path = ".";
            }
            foreach (scandir($path) as $key => $value) {
                if ($value != "." && $value != "..") {
                    if (str_ends_with($value, ".php")) {
                        $space = "";
                        echo "<a style='margin-left:$tab"."vw;' href='$path/$value'> $value </a>";
                    }
                    if (is_dir($value)) {
                        echo $value . "</br>";
                        getPages($value, $tab + 5);
                    }
                }
            }
        }
        getPages();
        ?>
    </div>
    <?php
    if ($_POST != null) {
        echo "<h1>MERHABA " . $_POST["name"] . "</h1>";
    }
    ?>
    <form method="post" action="./formsubmit.php" style="height:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;font-size:3vmax !important;">
        name
        <input name="name" />
        surname
        <input name="surname" />
        bolum
        <select name="bolum">
            <option name="pcprog">pc prog</option>
            <option name="itfaiye">itfaiye</option>
            <option name="kaynak">kaynak</option>
        </select>
        <button type="submit">kaydet</button>
    </form>
</body>

</html>