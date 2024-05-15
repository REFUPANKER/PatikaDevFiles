<?php
# Nexts Manager : Text
require_once("dbm.php");
switch ($_POST["name"]) {
    case "remove":
        echo json_encode(RemoveNextText($_POST["id"]));
        break;
    case "edit":
        echo json_encode(EditNextText($_POST["id"],$_POST["title"],$_POST["content"]));
        break;
    case "next":
        echo json_encode(PostNextText($_POST["title"], $_POST["content"]));
        break;
}
