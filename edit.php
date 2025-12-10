<?php 
session_start();  
error_reporting(E_ALL); 
include 'db.php'; 
// ✅ DEBUG CHECK (TEMPORARY)
if (!isset($conn)) {
    die("❌ PDO is NOT connected !");
}
// Check if ID parameter exists
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("User ID is required!");
}
$id = $_GET['id'];
 // Fetch user data
    $sql = "SELECT id, F_name, L_name, city, state, pincode, email  
            FROM userforme 
            WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die("User not found!");
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
<body>  
<section class="container mt-5 text-center"> 
 <div class="container text-center mb-4"> 
   <div class="row g-3 container card-centre-body bg-null" style="width: 60rem;">
     <h1 class="text-center">Edit User Information</h1>
<form method="POST" action="edit_process.php" class=" p-4 bg-dark text-dark " >
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
  <div class="row text-centre g-3">
   <div class="col-6 g-3">        
    <input type="text" class="form-control" name="F_name" placeholder="<?= htmlspecialchars($user['F_name'] ) ?>" required >
   </div>
  <div class="col-6 g-3">
   <input type="text" class="form-control" name="L_name" placeholder="<?= htmlspecialchars($user['L_name'] ) ?>" required>
  </div>          
  <div class="col-4 g-3 ">
   <input type="text" class="form-control" name="city" placeholder="<?= htmlspecialchars($user['city'] ) ?>" required>
  </div>
  <div class="col-4 g-3">
   <input type="text" class="form-control" name="state" placeholder="<?= htmlspecialchars($user['state'] ) ?>" required>
  </div>
  <div class="col-4 g-3">
   <input type="number" class="form-control" name="pincode" placeholder="<?= htmlspecialchars($user['pincode'] ) ?>" minlength="6"  required>
  </div>
  <div class="col-12 g-3">
   <input type="email" class="form-control" name="email" placeholder="<?= htmlspecialchars($user['email'] ) ?>" required>
  </div>
  <div class="col-12 g-3">
   <input type="password" class="form-control" name="password" placeholder="Password" required>
  </div>
  
  <div class="col-12 text-center mt-3">
    <button type="submit" class=" btn btn-info">Edit</button>
    <a href="list.php" class="btn btn-danger">Cancel</a>
  </div> 
</div> 
</form>  
<div class="text-center">
<p class="mt-0 ">
  <a  class="btn btn-primary" href="list.php">← Back to Users List</a></p>  
</div>
</section> 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script> 
</body> 
</html> 