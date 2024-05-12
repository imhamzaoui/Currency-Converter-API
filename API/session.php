<?php


include_once '../Database/Database.php';
include_once '../Database/config.php';
include_once '../tools.php';



function addApiKey($apiKey , $pdo,$name,$email) {
    try {
        $createdAt = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("INSERT INTO api_keys (api_key, created_at,name,email) VALUES (?, ?, ?, ?)");        
        $stmt->execute([$apiKey, $createdAt,$name,$email]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function generateME($name,$email){
    global $dbHost, $dbName, $dbUser, $dbPassword;
    $database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
    $connection = $database->connect();

    if ($connection){            
        $first_key=generateApiKey(32);
        $key= generateSha256Hash($first_key); 
        $end_time = date('Y-m-d H:i:s', strtotime('+1 day'));

        addApiKey($key,$connection,$name,$email);
        //header('Content-Type: application/json');
        $database->close();
        return (array('key'=>$first_key,'expired'=> $end_time));
    }else{
        return null;
    }
    
}


if (($_SERVER['REQUEST_METHOD'] === 'GET') ) {
    if (isset($_GET['action']) && isset($_GET['pwd']) && isset($_GET['name']) && isset($_GET['email']) ){
        if ($_GET['action'] === 'register' && $_GET['pwd']==$secretKEY) { //secretKEY=123456789
            $database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
            $connection = $database->connect();

            if ($connection){            
                $first_key=generateApiKey(32);
                $key= generateSha256Hash($first_key); 
                $end_time = date('Y-m-d H:i:s', strtotime('+1 day'));

                addApiKey($key,$connection,$_GET['name'],$_GET['email']);
                header('Content-Type: application/json');
                echo json_encode(array('key'=>$first_key,'expired'=> $end_time));
            }
            $database->close();

        }else{
            http_response_code(400);
            echo json_encode(array("error" => "Action or other params not specified"));
            exit;
        }

    }


}



?>
