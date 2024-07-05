<?php
    $servername = "mysql:host=127.0.0.1;dbname=ElevatorOne";
    $username = getenv('MYSQL_USERNAME');
    $password = getenv('MYSQL_PASSWORD');

    // Connect to database
    $database = new PDO($servername, $username, $password);

    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $result = $database->query("INSERT INTO RequestHistory (Method, Floor) VALUES ('Website', 2)");
    
    // Close connection
    $database = null;
    
?>