<?php
session_start();
if (!isset($_SESSION['UserData']['Username'])) {
    header("Location: login.php");
    exit;
}
?>