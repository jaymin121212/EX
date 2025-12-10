<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registered Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
  <h2 class="text-center">Users</h2>
    <?php
    try{
    require_once 'db.php';
    // Prepare the statement (with placeholders)
    $sql = "SELECT id, F_name, L_name, city, state, pincode, email, password, comments 
            FROM userforme 
            ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        if (count($users) > 0) { 
    // Get results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
  <table border="01"  cellpadding="10" class=" table table-striped-columns" style="width: 100rem;">           
      <p>Total Records: <?php echo count($users);?></p>
      
        <div class="row mb-3">
          <div class="col text-center">
    <button onclick="window.location.href='forme.php'" class="btn btn-primary ">new user</button>
    </div><div class="col  ">
        <p><a class="btn btn-danger" href="forme.php">log out</a></p></div>
        </div>
      <tr>
      <th>ID</th><th>First Name</th><th>Last name</th><th>State</th><th>City</th><th>pincode</th><th>Email</th><th>Password</th><th>comments</th><th>Actions</th>
       </tr>
      <?php foreach ($users as $user): ?>
    <tr>
     <td><?=htmlspecialchars($user['id'])?></td>
     <td><?=htmlspecialchars($user['F_name'])?></td>
     <td><?=htmlspecialchars($user['L_name'])?></td>
     <td><?=htmlspecialchars($user['city'])?></td>
     <td><?=htmlspecialchars($user['state'])?></td>
     <td><?=htmlspecialchars($user['pincode'])?></td>
     <td><?=htmlspecialchars($user['email'])?></td>
     <td><?=htmlspecialchars($user['password'])?></td>
     <td><?=htmlspecialchars($user['comments'])?></td>
     <td>
      <a class="btn btn-primary" href="edit.php?id=<?=htmlspecialchars($user['id'])?>">Edit</a>  
      <a class="btn btn-danger" href="delete.php?id=<?=htmlspecialchars($user['id'])?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>    
   </td>
  </tr> 
    <?php endforeach; ?> 
  </table> 
<?php
   }else{
     echo "<p>No records found.</p>";}     
      $stmt = null;
      $conn = null;     
    }catch(PDOException $e){
     echo "<p style='color: red;'>Database Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    }catch(Exception $e){
     echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
  }
 ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script> 
</body>
</html>