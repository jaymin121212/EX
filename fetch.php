<?php
include 'db.php';

$type = $_POST['type'] ?? '';

/* ==========================
   ✅ LOAD STATES
========================== */
if ($type == "state_name") {
    $stmt = $conn->prepare("SELECT DISTINCT state_name FROM locations");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['state']}'>{$row['state']}</option>";
    }
}

/* ==========================
   ✅ LOAD CITIES BY STATE
========================== */
if ($type == "city_name") {
    $state = $_POST['state_name'];

    $stmt = $conn->prepare("SELECT DISTINCT city_name FROM locations WHERE state_name = ?");
    $stmt->execute([$state]);

    echo "<option value=''>Select City</option>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['city']}'>{$row['city']}</option>";
    }
}

/* ==========================
   ✅ LOAD PINCODES BY CITY
========================== */
if ($type == "pincode") {
    $city = $_POST['city_name'];

    $stmt = $conn->prepare("SELECT pincode FROM locations WHERE city_name = ?");
    $stmt->execute([$city]);

    echo "<option value=''>Select Pincode</option>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='{$row['pincode']}'>{$row['pincode']}</option>";
    }
}

/* ==========================
   ✅ SEARCH BY PINCODE
========================== */
if ($type == "searchPin") {

    $pincode = $_POST['pincode'];

    $stmt = $conn->prepare("SELECT state_name, city_name FROM locations WHERE pincode = ?");
    $stmt->execute([$pincode]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo "State: " . $row['state_name'] . " | City: " . $row['city_name'];
    } else {
        echo "Pincode not found";
    }
}


?>
