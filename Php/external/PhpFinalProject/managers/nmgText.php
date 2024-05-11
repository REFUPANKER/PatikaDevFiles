<?php
# Nexts Manager : Text
require_once("dbm.php");
switch ($_POST["name"]) {
    case "remove":
        echo json_encode(RemoveNextText($_POST["id"]));
        break;
    case "edit":
        print_r($_POST);
        //echo json_encode(PostNextText($_POST["title"], $_POST["content"],$_POST["categories"]));
        break;
    case "next":
        echo json_encode(PostNextText($_POST["title"], $_POST["content"], $_POST["categories"]));
        break;
}
