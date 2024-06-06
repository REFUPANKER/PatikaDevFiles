<?php
try {
    session_start();
    $min=4;$sec=60;
    $remainingTime = time() - $_SESSION['timeout'];
    $minutes = floor($remainingTime / 60);
    $seconds = $remainingTime % 60;
    echo ($min-$minutes) . ":" . ($sec - $seconds);
} catch (\Throwable $th) {
    return null;
}
