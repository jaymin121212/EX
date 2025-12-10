<?php
session_start();
error_reporting(E_ALL);
include 'db.php';

if(!isset($conn)) {
    die("❌ PDO is NOT connected. Check db.php.");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

?>

