<?php



include_once '../Database/Database.php';
include_once '../Database/config.php';
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
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<html>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">-  <img width="25" height="25" src="https://vectorflags.s3.amazonaws.com/flags/tn-circle-01.png">TN Money</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
</nav>
<div class="container">
<table class="table table-bordered table-striped"><tbody ><tr height="20px"><td colspan="2" style="background: #277cb2;color: #fff;width:80px;">
     <center><b>Currency</b> </center></td> <td style="background: #277cb2;color: #fff;width:80px;">
                <center><b>Initials</b> </center>    </td> <td style="background: #277cb2;color: #fff;width:80px;">
                <center><b>Unit</b> </center>    </td>
     <td style="background: #277cb2;color: #fff;width:80px;">
                <center><b>Value</b> </center>    </td></tr> 
                  
                  


    <?php foreach ($data as $row): ?>
                <tr  height="20px">
                    <td><img src="<?php echo $url.$row['img']; ?>" alt="<?php echo $row['Initials']; ?>"></td>
                    <td><?php echo $row['Currency']; ?></td>
                    <td></center><?php echo $row['Initials']; ?></center></td>
                    <td></center><?php echo $row['Unit']; ?></center></td>
                    <td><center><?php echo $row['Value']; ?></center></td>
                    
                </tr>
            <?php endforeach; ?>
                              

</tbody></table>
</div>

    </body>
</html>
<?php

$database->close();
?>