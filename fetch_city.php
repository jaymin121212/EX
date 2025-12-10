
<?php
include "db.php";

if (isset($_POST['state_name'])) {
    $state_name = $_POST['state_name'];

    $sql = "SELECT DISTINCT city_name FROM locations WHERE state_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$state_name]);

    echo '<option value="">Select City</option>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$row['city_name']."'>".$row['city_name']."</option>";
    }
}
?>
