
<?php
include_once '../../Database/Database.php';
include_once '../../Database/config.php';


session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
$connection = $database->connect();


$sql = "SELECT * FROM api_keys";
$stmt = $connection->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['key_id']) && !empty($_POST['key_id'])) {
    // Retrieve the key_id from the POST data
    $key_id = $_POST['key_id'];

    try {
        // Create a new instance of the Database class
        $db = new Database();
        $conn = $db->connect();

        // Prepare and execute the SQL DELETE statement
        $sql = "DELETE FROM api_keys WHERE id = :key_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':key_id', $key_id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the page where the removal was initiated
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } catch(PDOException $e) {
        // Handle database errors here
        echo "Error: " . $e->getMessage();
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api</title>
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
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>API Key</th>
            <th>Created At</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['api_key']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><button class="btn btn-danger">Remove</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>