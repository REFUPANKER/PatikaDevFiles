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

function reqQuery($qstr, $params = [])
{
    global $con;

    if (!empty($params)) {
        $stmt = $con->prepare($qstr);
        if ($stmt === false) {
            return;
        }

        $types = '';
        $bindParams = [];
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 's';
            }
            $bindParams[] = $param;
        }

        if (!empty($bindParams)) {
            $stmt->bind_param($types, ...$bindParams);
        }
        $stmt->execute();
        return $stmt;
    } else {
        return mysqli_query($con, $qstr);
    }
}

function selectData($qstr, $params = [], $single = true)
{
    global $con;
    if (!empty($params)) {
        $stmt = $con->prepare($qstr);
        if ($stmt === false) {
            return;
        }
        $types = '';
        $bindParams = [];
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 's';
            }
            $bindParams[] = $param;
        }
        if (!empty($bindParams)) {

            $stmt->bind_param($types, ...$bindParams);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            return;
        }
        $row = ($single == true ? $result->fetch_assoc() : $result->fetch_all());
        $stmt->close();
        return $row;
    } else {
        $result = mysqli_query($con, $qstr);
        if (!$result) {
            return;
        }
        $row = ($single == true ? mysqli_fetch_assoc($result) : mysqli_fetch_all($result));
        mysqli_free_result($result);
        return $row;
    }
}

function lastId()
{
    global $con;
    return mysqli_insert_id($con);
}
function addUser($name, $email, $password)
{
    reqQuery("insert into users (name,email,password) values (?,?,?)", [$name, $email, $password]);
}
function getUser($id)
{
    return selectData("select id,name,active from users where id= ?;", [$id]);
}
function checkAuth($target = "home.php")
{
    if (isset($_SESSION["authed"])) {
        return true;
    }
    header("location:auth.php");
    return false;
}
function updateUserImage($image)
{
    global $con;
    $id = (int)$_SESSION["user"];
    $getImg = selectData("select user from profileImages where user= ?", [$id]);
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

//TODO:fix sql injections
// NEXTS start

function PostNextText($title, $content)
{
    $nextsStmt = reqQuery("INSERT INTO nexts (user, type) VALUES (?, 1)", [$_SESSION["user"]]);
    $nextsId = $nextsStmt->insert_id;
    reqQuery("INSERT INTO n_Text (nextId, title, content) VALUES (?, ?, ?)", [$nextsId, $title, $content]);
    return "posted";
}

function RemoveNextText($id)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("delete from n_text where id=?", [$id]);
        //next gets removed with trigger
        return "deleted";
    } else {
        return;
    }
}

function EditNextText($id, $title, $content)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("update n_text set " . ($title != "" ? "title=?"  : "") . ($content != "" ? ",content=?" : "") . " where id=?", [$title, $content, $id]);
        return "confirmed";
    } else {
        return;
    }
}


function CheckUserIsOwnerOfNext($nextId)
{
    $isOwnerOfNext = selectData("select 1 from nexts where user=? and id=?", [$_SESSION["user"], $nextId]);
    if (isset($isOwnerOfNext)) {
        return true;
    } else {
        return false;
    }
}

// NEXTS end
