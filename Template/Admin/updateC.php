<?php

include_once '../../Database/Database.php';
include_once '../../Database/config.php';

$database = new Database($dbHost, $dbName, $dbUser, $dbPassword);
$connection = $database->connect();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Currency Unit and Value</title>
</head>
<body>
    <h2>Update Currency Unit and Value</h2>
    <form action="update_currency.php" method="POST">
        <label for="currency">Currency:</label>
        <select name="currency" id="currency">
        <?php
        if (!$connection) {
            echo "<option value='' disabled>No connection to database</option>";
        } else {
            $sql = "SELECT Currency FROM currency_tn";
            $result = $connection->query($sql);

            if ($result) {
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["Currency"] . "'>" . $row["Currency"] . "</option>";
                    }

                    $database->close();
                } else {
                    echo "<option value='' disabled>No currencies found</option>";
                }
            } else {
                echo "<option value='' disabled>Error fetching currencies</option>";
            }
        }
        ?>
        </select><br><br>
        <label for="unit">Unit:</label>
        <input type="text" id="unit" name="unit"><br><br>
        <label for="value">Value:</label>
        <input type="text" id="value" name="value"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
