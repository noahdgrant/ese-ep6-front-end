<?php
    $servername = "mysql:host=127.0.0.1;dbname=users";
    $username = getenv('MYSQL_USERNAME');
    $password = getenv('MYSQL_PASSWORD');

    $login_user = array(
        'username' => 'wyatt',
        'password' => 'password_test'
    );

    // Connect to database
    $database = new PDO($servername, $username, $password);

    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $result = $database->query("SELECT Username, Password FROM accounts WHERE Username = '" . $login_user['username']."'");
    
    foreach($result as $row){
        echo "Username: " . $row["Username"]. " - Password: " . $row["Password"]. "<br><br>";
    }

    

    // Close connection
    $database = null;
?>