<?php
// Include the CurrencyConverter class
include_once '../CurrencyConverter.php';

// Function to fetch conversion rate from an external API
function fetchConversionRate($fromCurrency, $toCurrency,$amount) {
    $apiKey = 'YOUR_API_KEY'; // Replace 'YOUR_API_KEY' with your actual API key
    $url = "http://".$_SERVER["HTTP_HOST"]."/P/API/api.php?apiKey=f216c8f6fe0bc638a3f385540dee2ad3202402f13304cbaf5bd7605ddd95533c&action=convert&from=".$fromCurrency."&to=".$toCurrency."&amount=".$amount;

    // Initialize cURL session
    $curl = curl_init();
    // Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // Execute cURL session
    $response = curl_exec($curl);
    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $data = json_decode($response, true);

    // Check if response contains rates for the 'toCurrency'
    if (isset($data['rates'][$toCurrency])) {
        return $data['rates'][$toCurrency];
    } else {
        return null;
    }
}

// Initialize variables
$amount = '';
$fromCurrency = '';
$toCurrency = '';
$result = '';
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $amount = $_POST['amount'];
    $fromCurrency = $_POST['fromCurrency'];
    $toCurrency = $_POST['toCurrency'];

    // Validate input
    if (!empty($amount) && is_numeric($amount)) {
        // Fetch conversion rate

        $conversionRate = fetchConversionRate($fromCurrency, $toCurrency,$amount);
        if ($conversionRate !== null) {
            // Perform conversion
            $result = $amount * $conversionRate;
        } else {
            $error = "Conversion rate not available.";
           // $error = $amount."+".$fromCurrency."+".$toCurrency;
           //$url = "http://".$_SERVER["HTTP_HOST"]."/P/API/api.php?apiKey=f216c8f6fe0bc638a3f385540dee2ad3202402f13304cbaf5bd7605ddd95533c&action=convert&from=".$fromCurrency."&to=".$toCurrency."&amount=".$amount;

           
        }
    } else {
        $error = "Please enter a valid amount.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="../src/style.css">
</head>
<body>
<div class="container">
    <div class="currency-container">
        <h1>Currency<br>Converter</h1>
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-box">
                <label for="amount">Enter amount</label>
                <input type="text" id="amount" name="amount" value="<?php echo $amount; ?>" placeholder="100" required />
                
            </div>
            <div class="currency">
                <div class="box">
                    <select class="select-option" name="fromCurrency">
                        <?php
                        $supportedCurrencies = getSupportedCurrencies();
                        foreach ($supportedCurrencies as $currencyCode => $currencyName) {
                            echo "<option value='$currencyCode' " . ($fromCurrency == $currencyCode ? 'selected' : '') . ">$currencyName</option>";
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
                            echo "<option value='$currencyCode' " . ($toCurrency == $currencyCode ? 'selected' : '') . ">$currencyName</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="convert">Convert</button>
            </div>
        </form>
        <p class="result"><?php echo $result; ?></p>
        <p class="error"><?php echo $error; ?></p>
    </div>
</div>
</body>
</html>
