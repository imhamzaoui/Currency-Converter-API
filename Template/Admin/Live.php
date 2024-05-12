
<?php

include_once '../../Database/Database.php';
include_once '../../Database/config.php';
$url="https://www.bct.gov.tn/bct/siteprod/images/drapeaux/";


$database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
$connection = $database->connect();



if (!$connection) {
exit;
}else{
$sql = "SELECT Currency, Initials, Unit, Value, img FROM currency_tn";
$stmt = $connection->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="Admin.php">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="Admin.php">Update</a>
      <a class="nav-item nav-link" href="Live.php">Live</a>
      <a class="nav-item nav-link" href="API.php">APIs</a>
      
    </div>
  </div>
</nav>
<div class="container">

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th colspan="2" class="text-center">Currency</th>
            <th class="text-center">Initials</th>
            <th class="text-center">Unit</th>
            <th class="text-center">Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><img src="<?php echo $url . $row['img']; ?>" alt="<?php echo $row['Initials']; ?>"></td>
                <td><?php echo $row['Currency']; ?></td>
                <td class="text-center"><?php echo $row['Initials']; ?></td>
                <td class="text-center"><?php echo $row['Unit']; ?></td>
                <td class="text-center"><?php echo $row['Value']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</div>


</body>
</html>

