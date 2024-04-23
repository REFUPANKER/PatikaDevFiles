<?php
session_start();
if (!isset($_SESSION["authed"])) {
    header("location:auth.php");
}
if (isset($_POST["logout"])) {
    unset($_SESSION["authed"]);
    header("location:index.php");
}
?>
<html>

<head>
    <title>What Is Next</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./res/style.css">
</head>

<body>
    <div class="bgCl6 text-white d-flex flex-row w-100 justify-content-around">
        <h1>its home</h1>
        <form method="post"><button name="logout" value="1">Logout</button></form>
    </div>
</body>

</html>