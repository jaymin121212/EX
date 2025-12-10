<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: list.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>

<h2>Welcome to Dashboard</h2>
<a href="logout.php">Logout</a>

</body>
</html>

