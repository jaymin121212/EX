<?php
session_start();

error_reporting(E_ALL);

try{
include 'db.php';
// Ensure connection is valid
if (!isset($conn)) {
    die("Database connection failed.");
}
$sql = "SELECT DISTINCT state_name FROM locations ORDER BY state_name asc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Locations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>    
    <section class="container mt-5 text-center "> 
        <form class=" text-center " >
        <div class="container text-center mb-4"> 
            <div class="row g-3 container card-centre-body bg-null" style="width: 40rem;">
            <h2>locform Table</h2>
       <div>
         <?php
          include_once 'state_name.php';
         ?>
       </div>
       <div>
        <?php
         include_once 'city_name.php';
        ?>
       </div>
       <div>
        <?php
          include_once 'pincode.php';
        ?>
       </div>
<!-- <p id="result"> </p> -->
    <button class="submit btn btn-smal ">submit</button>
   </div> 
  </div>
 </form>
</section>  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script> 
</body>
</html>