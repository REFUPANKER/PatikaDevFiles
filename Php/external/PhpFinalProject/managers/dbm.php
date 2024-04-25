<?php
$con = mysqli_connect("localhost", "root", "", "WhatIsNext_PhpGradProj");
$con->set_charset("utf8");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

session_start();
$inactive = 600;

function getPostValue($v)
{
    if (isset($_POST[$v])) {
        return $_POST[$v];
    } else {
        return null;
    }
}
function getFileValue($v)
{
    if (isset($_FILES[$v])) {
        return $_FILES[$v];
    } else {
        return null;
    }
}

function reqQuery($qstr)
{
    global $con;
    return mysqli_query($con, $qstr);
}

function selectData($qstr)
{
    global $con;
    return mysqli_fetch_assoc(mysqli_query($con, $qstr));
}
function lastId()
{
    global $con;
    return mysqli_insert_id($con);
}
function addUser($name, $email, $password)
{
    reqQuery("insert into users (name,email,password) values (\"" . $name . " \",\"" . $email . "\",\"" . $password . "\")");
}
function updateUserImage($image)
{
    global $con;
    $id = (int)$_SESSION["user"];
    $getImg = selectData("select user from profileImages where user=" . $id);
    $img = file_get_contents($image);
    $q = "";
    if (isset($getImg)) {
        $q = "update profileimages set image = ? where user=" . $id;
        $stmt = $con->prepare($q);
        $stmt->bind_param("s", $img);
    } else {
        $q = "INSERT INTO profileimages (user, image) VALUES (?, ?)";
        $stmt = $con->prepare($q);
        $stmt->bind_param("is", $id, $img);
    }
    $stmt->execute();
    $stmt->close();
}
function getUserImage($id)
{
    global $con;
    $q = "SELECT image FROM profileimages WHERE user = " . $id;
    $result = mysqli_query($con, $q);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $img = mysqli_fetch_assoc($result);
            echo "background-image:url('data:image/png;base64," . base64_encode($img["image"]) . "');";
        } else {
            echo "background-image:url('./res/user.png');";
        }
    } else {
        echo "background-image:url('./res/user.png')";
    }
}
function checkAuth()
{
    if (isset($_SESSION["authed"])) {
        header("location:home.php");
    } else {
        header("location:auth.php");
    }
}
