<?php
session_start();
include_once '../../Database/Database.php'; 
include_once '../../Database/config.php';






// Login process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
$connection = $database->connect();

    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    
    $sql = "SELECT id, username FROM login WHERE username = :username AND password = :password";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $count = $stmt->rowCount();
    if ($count == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: Admin.php"); // Redirect to welcome page after successful login
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../src/log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <a class="navbar-brand" href="/p/Template/Convert.php">-  <img width="25" height="25" src="https://vectorflags.s3.amazonaws.com/flags/tn-circle-01.png">TN Money</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="/p/Template/Convert.php">Currency Converter</a>
        <a class="nav-item nav-link" href="/p/Template/Dashboard.php">Live Board</a>
        <a class="nav-item nav-link" href="#">API</a>
        
      </div>
    </div>
  
  
    <form class="form-inline">
    <a class="nav-item nav-link" href="/p/Template/Login.php">LOGIN</a>
    </form>
  </nav>
<section class="vh-100 gradient-custom">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
              <label class="form-label" for="typeEmailX">Email</label>
                <input type="text" id="username" name="username" class="form-control form-control-lg" />
                
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                
              </div>


              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

   

          </div>
        </div>
      </div>
    </div>
  </div>
</form>
</section>
</body>
</html>