<?php 
session_start(); 
error_reporting(E_ALL); 
// update.php
include 'db.php'; 
 
// ✅ DEBUG CHECK (TEMPORARY) 
if (!isset($conn)) { 
    die("❌ PDO is NOT connected. Check db.php."); 
} 
echo " ✅ PDO is connected. \n";

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("User ID is missing from form!");
}

$id = $_POST['id'];

// ✅ FIXED VARIABLE NAME ($conn instead of $con)
$id     = $_POST['id'];
$fname  = $_POST['F_name'];
$lname  = $_POST['L_name'];
$city   = $_POST['city'];
$state   = $_POST['state'];
$pincode    = $_POST['pincode'];
$email  = $_POST['email'];
$pass   = ($_POST['password']);

$sql = "UPDATE userforme 
        SET F_name=?, L_name=?, city=?, state=?, pincode=?, email=?, password=?
        WHERE id=?";

$stmt = $conn->prepare($sql);

if ($stmt->execute([$fname, $lname, $city, $state, $pincode, $email, $pass, $id])) {
    header("Location: edit.php?id=$id&success=1");
    header("Location: list.php"); 
    exit;
} else {
    die("❌ Update failed!");
}

?> 