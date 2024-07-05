<?php
session_start();
// this info should be environment variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "mysql:host=127.0.0.1;dbname=users";
    $username = getenv('MYSQL_USERNAME');
    $password = getenv('MYSQL_PASSWORD');
    $login_table = "accounts";

    $login_user = array(
        'username' => $_POST['username'],
        'password' => $_POST['password']
    );

    // Connect to database
    $database = new PDO($servername, $username, $password);

    // should have a check to ensure we are connected to the database

    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Query database for password
    $query = "SELECT password FROM accounts WHERE username = :username";
    $statement = $database->prepare($query);
    $statement ->bindParam(':username', $login_user['username'], PDO::PARAM_STR);
    $result = $statement ->execute();

    $storedPassword = $statement->fetchColumn();

    if ($storedPassword === $login_user['password']){
        // start session
        $_SESSION['username'] = $login_user['username'];
    }
    else{
        session_unset();
        session_destroy();
    }
    // https://www.php.net/manual/en/function.password-hash.php
    // https://www.php.net/manual/en/function.password-verify.php

    // Close connection
    $database = null;
}
else if (isset($_GET["request"])) {
    if ($_GET['request']==='logout'){
        session_unset();
        session_destroy(); 
    }
}
header("Location: ./index.php");

?>