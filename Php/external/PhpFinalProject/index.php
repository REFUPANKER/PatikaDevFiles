<html>

<head>
    <title>What Is Next - Redirecting</title>
    <link rel="stylesheet" href="./res/bootstrap.min.css"/>
    <link rel="stylesheet" href="./res/style.css"/>
</head>

<body>
    <div style="background-color: rgba(0,0,0,0.8);" class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
        <h1>You need to account for continue</h1>
        <h3>Redirecting to auth page</h3>
        <h2 id="cd">5</h2>
        <a href="auth.php" class="btn btn-success fs-1">Go To Auth</a>
    </div>
    <script>
        const cd = document.getElementById("cd");
        function countdown(time) {
            if (time >= 0) {
                setTimeout(() => {
                    cd.innerHTML = time;
                    countdown(time -= 1);
                }, 1000);
            } else {
                window.open("./auth.php", "_self");
            }
        }
        <?php
        session_start();
        if (!isset($_SESSION["authed"])) {
        ?>
            countdown(5);
        <?php
        } else {
            header("location:home.php");
        }
        ?>
    </script>
</body>

</html>