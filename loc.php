<?php
session_start();
error_reporting(E_ALL);
try {
include 'db.php';
// ✅ DEBUG CHECK (TEMPORARY)
if (!isset($conn)) {
    die("❌ PDO is NOT connected. Check db.php.");
}
$sql ="select id , state_name, city_name, pincode from locations  ORDER BY id asc";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<h2>Locations Table</h2>
<table border="5" class=" table table-striped-columns" style="width: 50rem;">
    <thead>
        <p>Total Records: <?php echo count($locations);?></p>
        <tr>
            <th>ID</th>
            <th>state_name</th>
            <th>city_name</th>
            <th>pincode</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($locations)): ?>
        <?php foreach ($locations as $row): ?>
          <tr>
            <td><?=htmlspecialchars($row['id'])?></td>
            <td><?=htmlspecialchars($row['state_name'])?></td>
            <td><?=htmlspecialchars($row['city_name'])?></td>
            <td><?=htmlspecialchars($row['pincode'])?></td>  
          </tr>    
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">No records found.</td></tr>
    <?php endif; ?>
</tbody>
</table>
</body>
</html>