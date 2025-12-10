<?php
session_start();
session_destroy();
error_reporting(E_ALL);

include 'db.php';
// logout.php
header('Location: forme.php');
exit;

?>