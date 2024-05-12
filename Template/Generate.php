<?php
include_once '../API/session.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['appName']) && isset($_POST['email'])) {
        $name = $_POST['appName'];
        $email = $_POST['email'];

        $data = generateME($name, $email);

        if ($data) {
            $apiKey = $data['key'];
            $expired = $data['expired'];
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate API Key</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="/p/Template/Convert.php">- <img width="25" height="25"
                src="https://vectorflags.s3.amazonaws.com/flags/tn-circle-01.png">TN Money</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="/p/Template/Convert.php">Currency Converter</a>
                <a class="nav-item nav-link" href="/p/Template/Dashboard.php">Live Board</a>
                <a class="nav-item nav-link" href="/p/Template/Generate.php">API</a>
                <a class="nav-item nav-link" href="/p/Template/Dev.php">Developer</a>

            </div>
        </div>


        <form class="form-inline">
            <a class="nav-item nav-link" href="/p/Template/Login.php">LOGIN</a>
        </form>
    </nav>
    <div class="container">
        <h1 class="mt-5">Generate API Key</h1>

        <form id="generateKeyForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="appName" class="form-label">App Name</label>
                <input type="text" class="form-control" name="appName" placeholder="Enter your app name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate API Key</button>
        </form>
        <div id="apiKeyResult" class="mt-4" style="<?php echo isset($apiKey) ? 'display: block;' : 'display: none;'; ?>">
            <h3>Your API Key:</h3>

            <p id="apiKey"><?php echo $apiKey; ?></p>
          <p>Expiration Date: <?php echo $expired; ?></p>
        </div>

    </div>


</body>

</html>