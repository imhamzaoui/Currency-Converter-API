<?php


require_once '../CurrencyConverter.php';
require_once '../Database/Database.php';



$ipAddress = $_SERVER['REMOTE_ADDR'];


function generateApiKey($length = 32) {
    return hash('sha256', bin2hex(random_bytes($length)));
}

function generateSha256Hash($inputString) {
    return hash('sha256', $inputString);
}


function saveError($ipAddress, $errorMessage, $connection) {
    $stmt = $connection->prepare("INSERT INTO errors (ip_address, error_message) VALUES (?, ?)");
    $stmt->execute([$ipAddress, $errorMessage]);
}


function isValidApiKey($apiKey, $connection) {
    if(empty($apiKey)) {
        return false;
    }
    $hashedApiKey = hash('sha256', $apiKey);
    $stmt = $connection->prepare("SELECT * FROM api_keys WHERE api_key = ?");
    $stmt->execute([$hashedApiKey]);
    return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
}

function checkSupportedCurrencies($Code){
    $supportedCurrencies = getSupportedCurrencies();
    return array_key_exists($Code, $supportedCurrencies);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $database = new Database();
    $connection = $database->connect();
    if ($connection) {
        $apiKey = isset($_GET['apiKey']) ? $_GET['apiKey'] : null;
        if (!$apiKey) {
            http_response_code(400);
            echo json_encode(array("error" => "API key missing"));
            exit;
        }

        if (!isValidApiKey($apiKey, $connection)) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];

            if (checkAndBanIP($ipAddress, $connection)) {
                http_response_code(403); 
                echo json_encode(array("error" => "IP address banned"));
                exit;
            }

            //function saveError($ipAddress, $errorMessage, $connection)
            saveError($ipAddress,"Invalid API key",$connection);
            http_response_code(401);
            echo json_encode(array("error" => "Invalid API key"));
            exit;
            }

            if (isset($_GET['action'])) {
                if ($_GET['action'] === 'supportedCurrencies') {
                    
                
                        $supportedCurrencies = getSupportedCurrencies();
                        logRequest($apiKey,strtoupper($_GET['action']),$connection);
                        header('Content-Type: application/json');
                        echo json_encode($supportedCurrencies);
                        exit; 
                  
                }elseif ($_GET['action'] === 'convert') {
                    
                    if ( isset($_GET['from']) && isset($_GET['to']) && isset($_GET['amount'])) {
                        //public function convertCurrency($amount, $sourceCurrency, $targetCurrency) {
                            if (checkSupportedCurrencies($_GET['to']) && checkSupportedCurrencies($_GET['from'])){
                                logRequest($apiKey,strtoupper($_GET['action']),$connection);
                                $exx = convertCurrency($_GET['amount'],$_GET['to'],$_GET['from']);
                                echo json_encode(array( $_GET['to']=>$exx));
                                exit;
                            }else{
                                if (!checkSupportedCurrencies($_GET['to'])){
                                    echo json_encode(array( 'error'=>$_GET['to']." no supported"));
                                    exit;
                 
                                }
                                if (!checkSupportedCurrencies($_GET['from'])){
                                    echo json_encode(array( 'error'=>$_GET['from']." no supported"));
                                    exit;
                                }
                               
                            }

                    }else{
                        http_response_code(500); 
                        echo json_encode(array("error" => "format problem from and to"));
                        exit;
                    }
                }
            }
            http_response_code(400);
            echo json_encode(array("error" => "Action not specified"));
            exit;
        

        $database->close();
    } else {
        echo "Failed to connect to the database.";
    }

}

function logRequest($hash, $method, $connection) {
    $stmt = $connection->prepare("INSERT INTO log (hash_id, method) VALUES (?, ?)");
    $stmt->execute([generateSha256Hash($hash), $method]);
}


function checkAndBanIP($ipAddress, $connection) {
    $stmt = $connection->prepare("SELECT COUNT(*) AS error_count FROM errors WHERE ip_address = ? AND error_message = 'Invalid API key'");
    $stmt->execute([$ipAddress]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $errorCount = $result['error_count'];

    if ($errorCount >= 3) {
        
        $stmt = $connection->prepare("SELECT * FROM banned_ips WHERE ip_address = ?");
        $stmt->execute([$ipAddress]);
        $bannedIp = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$bannedIp) {           
            $banEndTime = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            $stmt = $connection->prepare("INSERT INTO banned_ips (ip_address, ban_end_time) VALUES (?, ?)");
            $stmt->execute([$ipAddress, $banEndTime]);

            

            return true;
        } else {
            $currentTime = date('Y-m-d H:i:s');
            $banEndTime = $bannedIp['ban_end_time'];

            if ($currentTime > $banEndTime) {
                $stmt = $connection->prepare("DELETE FROM banned_ips WHERE ip_address = ?");
                $stmt->execute([$ipAddress]);
                
                return false;
            } else {
                return true; 
            }
        }
    }

    return false;
}





?>