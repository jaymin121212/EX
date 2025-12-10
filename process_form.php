<?php
session_start();
error_reporting(E_ALL);
// include 'db.php';

// ✅ DEBUG CHECK (TEMPORARY)
if (!isset($conn)) {
    die("❌ PDO is NOT connected. Check db.php.");
}

if(isset($_POST['submit'])){

    $F_name= $_POST['F_name'] ?? '';
    $L_name= $_POST['L_name'] ?? '';
    $city= $_POST['city'] ?? '';
    $state= $_POST['state'] ?? '';
    $pincode= $_POST['pincode'] ?? '';
    $email= $_POST['email'] ?? '';
    $password= $_POST['password'] ?? '';
    $comments = $_POST['comments'] ?? '';

    // ✅ CORRECT SQL
    $sql = "INSERT INTO userforme 
            (F_name, L_name, city, state, pincode, email, password, comments) 
            VALUES 
            (:F_name, :L_name, :city, :state, :pincode, :email, :password, :comments)";
    $stmt = $conn->prepare($sql);

    // ✅ CORRECT EXECUTE
    $result = $stmt->execute([
        ':F_name'=> $F_name,
        ':L_name'=> $L_name,
        ':city'=> $city,
        ':state'=> $state,
        ':pincode'=> $pincode,
        ':email'=> $email,
        ':password'=> $password,
        ':comments' => $comments
    ]);

    if ($result) {
        echo "✅ Record inserted successfully.";
        echo "<br><a href='forme.php'>Go Back</a>";
        header("Location: list.php");
        exit();
    } else {
        echo "❌ Error inserting record.";
    }
}

?>
