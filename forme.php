<?php
session_start();  
error_reporting(E_ALL); 
include "db.php";

// ✅ Default values
$selected_state = $_POST['state_name'] ?? "";
$selected_city  = $_POST['city_name'] ?? "";
$pincode = "";

// ✅ Fetch all states
$sql = "SELECT DISTINCT state_name FROM locations ORDER BY state_name ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$states = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ✅ If state selected → fetch cityes

if (isset($_POST['state_name'])) {
    $state_name = $_POST['state_name'];

    $sql = "SELECT DISTINCT city_name FROM locations WHERE state_name = ? ORDER BY city_name ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$state_name]);

    echo '<option value="">Select City</option>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$row['city_name']."'>".$row['city_name']."</option>";
    }
}
// ✅ If city selected → fetch pincode
$pincode = "";
if (!empty($_POST['city_name'])) {
    $city_name = $_POST['city_name'];

    $sql = "SELECT DISTINCT pincode FROM locations WHERE city_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$city_name]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pincode = $row['pincode'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body background="wallpaper.jpg">
    <!-- sing form -->
<section class="container mt-5">
 <div class="container text-center mb-4">
  <form class="mb-3 " style="width: 70rem;" action="process_form.php" method="post">
     <div class="row g-3 container card-body bg-null">
       <h1 class="text-white">Submit Your Information</h1>
         <div class="row">
           <div class="col-6 g-3">
             <input type="text" class="form-control" name="F_name" placeholder="First name" required>
           </div>
           <div class="col-6 g-3">
             <input type="text" class="form-control" name="L_name" placeholder="Last name" required>
           </div>          
             <div class="col-4 g-3 ">

            <!-- ✅ STATE DROPDOWN -->
              <select class="form-select" id="state_name" name="state_name" required>
                  <option value="">Select State</option>
                  <?php foreach ($states as $row): ?>
                    <option value="<?= $row['state_name']; ?>">
                        <?= $row['state_name']; ?>
                    </option>
                <?php endforeach; ?>
                </select>
              </div>
            <div class="col-4 g-3 ">
            <!-- ✅ CITY DROPDOWN -->
            <select class="form-select" id="city_name" name="city_name" required>
                <option value="">Select City</option>
                 <?php foreach ($cities as $row): ?>
            <option value="<?= $row['city_name']; ?>"
                <?= (isset($_POST['city_name']) && $_POST['city_name'] == $row['city_name']) ? "selected" : "" ?>>
                <?= $row['city_name']; ?>
            </option>
        <?php endforeach; ?>
            </select>
            </div>
             <div class="col-4 g-3">                          
            <input  class="form-control"type="number" id="pincode" name="pincode" placeholder="Pincode" readonly>
             </div>
              <div class="col-12 g-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
              </div>
             <div class="col-12 g-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <div class="form-floating g-3">
                  <label for="comments"></label>
               <textarea class="form-control" name="comments" style="height: 100px" required></textarea>
              </div>
                <button type="submit" name="submit" class="g-3 btn btn-primary mb-3">Submit</button>
          </div> 
     </div>
  </form>
 </div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>
</html>