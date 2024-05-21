<?php
# Nexts Manager : Video
require_once("dbm.php");
switch ($_POST["name"]) {
    case "remove":
        echo json_encode(RemoveNextVideo($_POST["id"]));
        break;
    case "edit":
        echo json_encode(EditNextVideo($_POST["id"],$_POST["title"],$_POST["descr"]));
        break;
    case "next":
        echo json_encode(PostNextVideo($_POST["video"],$_POST["title"],$_POST["descr"]));
        break;
}
