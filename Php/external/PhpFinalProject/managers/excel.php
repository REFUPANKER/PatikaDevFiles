<?php

require './dbm.php';
if (!isset($_SESSION["authed"])) {
    header("location:../auth.php");
}

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//$sheet->setCellValue('A1', 'merhaba dünya');

$sheet->setCellValue("A1", "User : ID");
$sheet->setCellValue("B1", "Name");
$sheet->setCellValue("C1", "Active");
$sheet->setCellValue("D1", "Token");

$udat = getUser($_SESSION["user"]);
$udatAV = array_values($udat);
for ($i = 0; $i < count($udat); $i++) {
    $sheet->setCellValue(chr(65 + $i) . "2", $udatAV[$i]);
}

$fsCount = FsFollowerCount($_SESSION["user"]);
$sheet->setCellValue("A3", "Follower count");
$sheet->setCellValue("B3", $fsCount);

$fdsCount = FsFollowedsCount($_SESSION["user"]);
$sheet->setCellValue("A4", "Followeds count");
$sheet->setCellValue("B4", $fdsCount);


$nextRow = 10;
$sheet->setCellValue("A9", "Followers of User");
$frs = FsGetFollowersOf($_SESSION["user"]);
foreach ($frs as $key => $value) {
    for ($i = 0; $i < count($value); $i++) {
        $sheet->setCellValue(chr(65 + $i) . $key + $nextRow, $value[$i]);
    }
}
$nextRow += $fsCount + 3;

$sheet->setCellValue("A" . ($nextRow - 1), "Followers of User");
$fds = FsGetFollowedsOf($_SESSION["user"]);
foreach ($fds as $key => $value) {
    for ($i = 0; $i < count($value); $i++) {
        $sheet->setCellValue(chr(65 + $i) . $key + $nextRow, $value[$i]);
    }
}
$nextRow += $fdsCount;

$writer = new Xlsx($spreadsheet);
$filename = '../db_excel/LogsOf_' . $_SESSION["user"] . '.xlsx';
?>
<link rel="stylesheet" href="../res/bootstrap.min.css">
<div class="w-100 h-100 d-flex flex-column m-0 p-5 bg-dark">
    <?php try {
        $writer->save($filename);
    ?>
        <h1 class="alert alert-success">Your data successfully inserted to Excel</h1>
        <h4 class="alert alert-warning">Redirecting back to home (in 3s)</h4>
    <?php
        header("refresh:3;url=../home.php");
    } catch (Exception $e) { ?>
        <h1 class="alert alert-danger">Error thrown while inserting your data to Excel</h1>
        <h4 class="alert alert-warning">Redirecting back to home (in 3s)</h4>
    <?php header("refresh:3;url=../home.php");
    } ?>
</div>