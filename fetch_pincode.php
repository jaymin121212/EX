<?php
include "db.php";

if (isset($_POST['city_name'])) {
    $city_name = $_POST['city_name'];

    $sql = "SELECT pincode FROM locations WHERE city_name = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$city_name]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo $row['pincode'];
}
?>
