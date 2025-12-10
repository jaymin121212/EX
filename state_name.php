<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <section class="container mt-5 "> 
        <div class="container text-center mb-4"> 
            <div class="row g-3 container card-centre-body bg-null" style="width: 50rem;">
<select name="state">
        <?php if (!empty($locations)): ?>
        <option value="">-- Select state --</option>
        <?php foreach ($locations as $row): ?>
        <option value="<?= $state['id'] ?>"><?= $row['state_name'] ?></option>
    <?php endforeach; ?>
    <?php else: ?>
        <option value="">No data found</option>
    <?php endif; ?>
</select>
</div>
</div>
</section>
<?php
// include_once 'city_name.php';
?>
<?php
// include_once 'pincode.php';
?>
</body>
</html>


