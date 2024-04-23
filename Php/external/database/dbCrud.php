<html>

<head>
    <style>
        body {
            margin: 0;
            color: white;
            background-color: black;
            font-size: 1vmax;
        }
    </style>
</head>

<body>
    <?php
    // db crud 

    $vt_host       = "localhost";
    $vt_kullanici  = "root";
    $vt_sifre      = "";
    $vt_adi        = "phpdb";

    $conn = mysqli_connect($vt_host, $vt_kullanici, $vt_sifre, $vt_adi);
    $conn->set_charset("utf8");
    if ($conn->connect_error) {
        die("Baglanti basarisiz: " . $conn->connect_error);
    }
    session_start();
    $inactive = 600;

    //if ($_SESSION["ad"]!=''){

    if (isset($_POST["sent"])) {
        $q = "insert into Users (name,email) values (\"" . $_POST["name"] . "\",\"" . $_POST["email"] . "\")";
        echo $q;
        echo mysqli_query($conn, $q);
        echo "gonderildi";
    }
    ?>
    <form method="post" style="display:flex;flex-direction:column;width:25%;">
        <h3>Name</h3>
        <input name="name" />
        <h3>Email</h3>
        <input name="email" />
        <button name="sent" value="true">Sign Up</button>
    </form>
</body>

</html>