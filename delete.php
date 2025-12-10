<?php
session_start();
error_reporting(E_ALL);
include 'db.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = $_GET['id'];

try {
    require_once 'db.php';
    // Prepare DELETE query
    $sql = "DELETE FROM userforme WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $affected_rows = $stmt->rowCount();
      if ($affected_rows > 0) {
        // Success - redirect to list with success message
        header('Location: list.php?deleted=1');
    } else {
        // No rows affected (user not found)
        header('Location: list.php?error=User not found');
    }
    // Close connection
    $stmt = null;
    $conn = null;
    
} catch(PDOException $e) {
    // Handle database errors
    header('Location: list.php?error=' . urlencode($e->getMessage()));
    exit;
}

?>