<?php
$con = mysqli_connect("localhost", "root", "", "WhatIsNext_PhpGradProj");
$con->set_charset("utf8");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

session_start();
$inactive = 600;
function reqQuery($qstr)
{
    global $con;
    return mysqli_query($con, $qstr);
}

function checkAuth()
{
    if (isset($_SESSION["authed"])) {
        header("location:home.php");
    } else {
        header("location:auth.php");
    }
}
