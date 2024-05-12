<?php
include_once '../CurrencyConverter.php';


$amount = '';
$fromCurrency = '';
$toCurrency = '';
$result = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $amount = $_POST['amount'];
    $fromCurrency = $_POST['fromCurrency'];
    $toCurrency = $_POST['toCurrency'];

    if (!empty($amount) && is_numeric($amount)) {
        $result = convertCurrency($amount, $toCurrency, $fromCurrency);
    } else {
        $error = "Please enter a valid amount.";
    }
}

$supportedCurrencies = getSupportedCurrencies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="../src/style.css">
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
      <a class="nav-item nav-link" href="/p/Template/Generate.php">API</a>
      <a class="nav-item nav-link" href="/p/Template/Dev.php">Developer</a>
      
    </div>
  </div>


  <form class="form-inline">
  <a class="nav-item nav-link" href="/p/Template/Admin/Login.php">LOGIN</a>
  </form>
</nav>
<div class="container">
    <div class="currency-container">
        <h1>Currency<br>Converter</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-box">
                <label for="amount">Enter amount</label>
                <input type="text" id="amount" name="amount" value="<?php echo $amount; ?>" placeholder="100" required />
                <div id="amountError" class="error" style="display: none;">Please enter a valid amount</div>
            </div>
            <div class="currency">
                <div class="box">
                    <select class="select-option" name="fromCurrency">
                        <?php
                        foreach ($supportedCurrencies as $currencyCode => $currencyName) {
                            $selected = ($currencyCode == $fromCurrency) ? 'selected' : '';
                            echo "<option value='$currencyCode' $selected>$currencyName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <span>TO</span>
                </div>
                <div class="box">
                    <select class="select-option" name="toCurrency">
                        <?php
                        foreach ($supportedCurrencies as $currencyCode => $currencyName) {
                            $selected = ($currencyCode == $toCurrency) ? 'selected' : '';
                            echo "<option value='$currencyCode' $selected>$currencyName</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="convert">Convert</button>
            </div>
        </form>
        <p class="result"><?php echo $result." ".$toCurrency; ?></p>
        <p class="error"><?php echo $error; ?></p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fromCurrencySelect = document.querySelector('select[name="fromCurrency"]');
        const toCurrencySelect = document.querySelector('select[name="toCurrency"]');

        fromCurrencySelect.addEventListener('change', function() {
            if (fromCurrencySelect.value !== 'TND') {
                toCurrencySelect.value = 'TND';
            }
        });

        toCurrencySelect.addEventListener('change', function() {
            if (toCurrencySelect.value !== 'TND') {
                fromCurrencySelect.value = 'TND';
            }
        });
    });
    document.getElementById("amount").addEventListener("input", function(event) {
      var regex = /^[0-9]*$/;
      var input = event.target.value;
      if (!regex.test(input)) {
        document.getElementById("amountError").style.display = "block";
      } else {
        document.getElementById("amountError").style.display = "none";
      }
    });
</script>

</body>
</html>
