<?php


require_once 'Database/config.php';
require_once 'Database/Database.php';




    function getCurrencyDetails($initials){
        $database = new Database();
        $connection = $database->connect();


        $sql = "SELECT Initials, Unit, Value FROM currency_tn WHERE Initials = ?";

        // Prepare and execute the statement
        $stmt = $connection->prepare($sql);
        $stmt->execute([$initials]);

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if result is not empty
        if ($result) {
            // Return the fetched data
            return $result;
        } else {
            // If no result found, return null
            return null;
        }
    
    }
    /*
    function convertCurrency($amount, $targetCurrency) {
        $convertedAmount = 0;
        $data = getCurrencyDetails($targetCurrency);
        
        $convertedAmount = ($amount * $data['Unit']) * $data['Value'];
    
        return $convertedAmount;
    }*/
    function convertCurrency($amount, $targetCurrency,$from) {   // USD = 3.1   unit=1   
        $convertedAmount = 0;
       
        if ($from!="TND"){
            $data = getCurrencyDetails($from);
            $convertedAmount = ($amount * $data['Unit']) * $data['Value'];

        }else{
            $data = getCurrencyDetails($targetCurrency);
            $convertedAmount = ($amount / $data['Unit']) / $data['Value']; 
        }
       
    
        return number_format($convertedAmount, 4);
    }
    

    function getSupportedCurrencies() {
        $supportedCurrencies = array(
            "DZD" => "Algerian Dinar",
            "SAR" => "Saudi Riyal",
            "CAD" => "Canadian Dollar",
            "DKK" => "Danish Krone",
            "USD" => "U.S Dollar",
            "GBP" => "Sterling Pound",
            "JPY" => "Japanese Yen",
            "MAD" => "Moroccan Dirham",
            "NOK" => "Norwegian Krone",
            "SEK" => "Swedish Krone",
            "CHF" => "Swiss Franc",
            "KWD" => "Kuwaiti Dinar",
            "AED" => "UAE Dirham",
            "EUR" => "Euro",
            "LYD" => "Libyan Dinar",
            "MRU" => "Mauritanian Ouguiya",
            "BHD" => "Bahrain Dinar",
            "QAR" => "Qatari Riyal",
            "CNY" => "Chinese Yuan",
            "TND" => "Tunisia"
        );

        return $supportedCurrencies;
    }


?>