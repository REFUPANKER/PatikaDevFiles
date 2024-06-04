<?php
# Nexts Manager : Text
require_once("dbm.php");
switch ($_POST["name"]) {
    case "remove":
        echo json_encode(RemoveNext("n_image",$_POST["id"]));
        break;
    case "edit":
        echo json_encode(EditNextImage($_POST["id"],$_POST["title"],$_POST["descr"]));
        break;
    case "next":
        echo json_encode(PostNextImage($_POST["image"],$_POST["title"],$_POST["descr"]));
        break;
}
