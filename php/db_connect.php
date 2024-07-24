<?php
// Databases
$db_users = "users";
$db_elevator_one = "ElevatorOne";

// Connect to database
function db_connect($db, $username = null, $password = null, $host = null) {
    if($username === null){
        $username = getenv("MYSQL_USERNAME");
        $password = getenv("MYSQL_PASSWORD");
        $host = getenv("MYSQL_ADDRESS");
    }
    
    $path = "mysql:host=".$host.";dbname=".$db;

    $database = new PDO($path, $username, $password);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $database;
}

function db_shutdown() {
    global $database;
    if ($database) {
        $database = null;
    }
}

register_shutdown_function("db_shutdown");
?>