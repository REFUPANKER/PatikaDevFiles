<?php
$con = mysqli_connect("localhost", "root", "", "WhatIsNext_PhpGradProj");
$con->set_charset("utf8");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

session_start();

$inactive = 5 *60;
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        header("Location: auth.php");
        exit();
    }
}
$_SESSION['timeout'] = time();

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
    return selectData("select id,name,active,token from users where id= ?;", [$id]);
}
function getUserT($token)
{
    return selectData("select id,name,active,token from users where token= ?;", [$token]);
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
function RemoveNext($tableName, $id)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("delete from " . $tableName . " where nextId=?", [$id]);
        return "deleted";
    } else {
        return;
    }
}
// nexts text start
function PostNextText($title, $content)
{
    $nextsStmt = reqQuery("INSERT INTO nexts (user, type) VALUES (?, 1)", [$_SESSION["user"]]);
    $nextsId = $nextsStmt->insert_id;
    reqQuery("INSERT INTO n_Text (nextId, title, content) VALUES (?, ?, ?)", [$nextsId, $title, $content]);
    return "posted";
}

function EditNextText($id, $title, $content)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("update n_text set " . ($title != "" ? "title=?"  : "") . ($content != "" ? ",content=?" : "") . " where nextId=?", [$title, $content, $id]);
        return "confirmed";
    } else {
        return;
    }
}

// nexts text end
// nexts image start
function PostNextImage($image, $title, $descr)
{
    $nextsStmt = reqQuery("INSERT INTO nexts (user, type) VALUES (?, 2)", [$_SESSION["user"]]);
    $nextsId = $nextsStmt->insert_id;
    reqQuery("INSERT INTO n_image (nextId, image,title, descr) VALUES (?,?, ?, ?)", [$nextsId, $image, $title, $descr]);
    return "posted";
}

function EditNextImage($id, $title, $descr)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("update n_image set title= ? , descr=? where nextId=?", [$title, $descr, $id]);
        return "confirmed";
    } else {
        return;
    }
}
// nexts image end

// nexts video start
function PostNextVideo($video, $title, $descr)
{
    // video column holds token for video files on sever side
    $nextsStmt = reqQuery("INSERT INTO nexts (user, type) VALUES (?, 3)", [$_SESSION["user"]]);
    $nextsId = $nextsStmt->insert_id;
    reqQuery("INSERT INTO n_video (nextId, title, descr) VALUES (?, ?, ?)", [$nextsId, $title, $descr]);
    file_put_contents(GenerateVideoPath($nextsId), "<body style='margin:0;'><video style='height:100%;width:100%;' controls='all' src='$video'></video></body>");
    return "posted";
}

function EditNextVideo($id, $title, $descr)
{
    if (CheckUserIsOwnerOfNext($id)) {
        reqQuery("update n_video set title=?,descr=? where nextId=?", [$title, $descr, $id]);
        return "confirmed";
    } else {
        return;
    }
}

function RemoveNextVideo($id)
{
    if (CheckUserIsOwnerOfNext($id)) {
        $filename = GenerateVideoPath($id);
        unlink($filename);
        RemoveNext("n_video", $id);
        return "confirmed";
    } else {
        return;
    }
}
function GenerateVideoPath($id, $pathBefore = "..", $user = -1)
{
    return "$pathBefore/db_videos/from" . ($user == -1 ? $_SESSION["user"] : $user) . "_id" . $id . ".html";
}
// nexts video end

function CheckUserIsOwnerOfNext($nextId)
{
    $isOwnerOfNext = selectData("select 1 from nexts where user=? and id=?", [$_SESSION["user"], $nextId]);
    if (isset($isOwnerOfNext)) {
        return true;
    } else {
        return false;
    }
}

function GetSingleNext($id)
{
    $getNextType = selectData("select * from nexts where id=?", [$id]);
    $nextTypes = array("n_text", "n_image", "n_video");
    $nextPropertyColumns = "," . ($getNextType["type"] == 1 ? "nx.content as content" : "nx.descr as descr");
    return selectData("select nx.*,u.id as userid,u.name as username $nextPropertyColumns from  " . $nextTypes[$getNextType["type"] - 1] . " as nx inner join users as u on u.id=? where nx.nextId=?", [$getNextType["user"], $id]);
}
// NEXTS end



/*
------- Following system
*/

function FsFollows($targetId)
{
    $data = selectData("select * from follows where user=? and follow=?", [$_SESSION["user"], $targetId]);
    return isset($data) ? true : null;
}
function FsFollowTo($targetId)
{
    if (!FsFollows($targetId)) {
        reqQuery("insert into follows (user,follow) values (?,?)", [$_SESSION["user"], $targetId]);
    }
}

function FsUnFollow($targetId)
{
    reqQuery("delete from follows where user=? and follow=?", [$_SESSION["user"], $targetId]);
}

function FsRemoveFollower($targetId)
{
    reqQuery("delete from follows where follow=? and user=?", [$_SESSION["user"], $targetId]);
}

function FsFollowerCount($targetId)
{
    $data = selectData("select count(distinct id) as count from follows where follow=?", [$targetId]);
    return isset($data) ? $data["count"] : 0;
}

function FsFollowedsCount($targetId)
{
    $data = selectData("select count(distinct id) as count from follows where user=?", [$targetId]);
    return isset($data) ? $data["count"] : 0;
}

function FsGetFollowersOf($target)
{
    $data = selectData("select distinct u.name,u.token,u.id from follows as f join users as u on f.user=u.id where f.follow=?", [$target], false);
    return isset($data) ? $data : null;
}

function FsGetFollowedsOf($target)
{
    $data = selectData("select distinct u.name,u.token,u.id from follows as f join users as u on u.id=f.follow where f.user=?", [$target], false);
    return isset($data) ? $data : null;
}

/*
------- Search
*/

function SearchUser($value)
{
    return selectData(
        "select id,token,name from users where id != ? and name like ? or name like ? or name like ? or name like ?",
        [
            $_SESSION["user"],
            "%" . $value . "%",
            $value . "%",
            "%" . $value,
            $value
        ],
        false
    );
}
function SearchNext($value)
{
    $txt = selectData(
        "select n.id,nx.title,nx.content,n.user,u.name from nexts as n inner join n_text as nx on n.id=nx.nextId inner join users as u on n.user=u.id where 
        nx.title like ? or
        nx.title = ?
        order by n.id desc ",
        ["%$value%", $value],
        false
    );
    $img = selectData(
        "select n.id,nx.image,nx.title,nx.descr,n.user,u.name from nexts as n inner join n_image as nx on n.id=nx.nextId inner join users as u on n.user=u.id where 
        nx.title like ? or
        nx.title = ?
        order by n.id desc ",
        ["%$value%", $value],
        false
    );
    $video = selectData(
        "select n.id,n.user,nx.title,nx.descr,u.name from nexts as n inner join n_video as nx on n.id=nx.nextId inner join users as u on n.user=u.id where 
        nx.title like ? or
        nx.title = ?
        order by n.id desc ",
        ["%$value%", $value],
        false
    );

    return ["text" => $txt, "image" => $img, "video" => $video];
}

/*
------- NEXTS from followeds
*/

function GetNextsFromFolloweds()
{
    return selectData("select n.* from nexts as n inner join follows as f on f.follow=n.user where f.user=? order by n.type desc , n.id desc", [$_SESSION["user"]], false);
}

