<?php
$db_users = "users";

// Connect to database
function db_connect($db) {
    $username = getenv("MYSQL_USERNAME");
    $password = getenv("MYSQL_PASSWORD");
    $host = "127.0.0.1";
    $path = "mysql:host=".$host.";dbname=".$db;

    $database = new PDO($path, $username, $password);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $database;
}


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $token = $_GET["token"];
    // $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Validate the token
    $stmt = $pdo->prepare('SELECT * FROM password_resets WHERE token = ? AND expires > ?');
    $stmt->execute([$token, date('U')]);
    $reset_request = $stmt->fetch();

    if ($reset_request) {
        // Update the user's password
        $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
        $stmt->execute([$new_password, $reset_request['email']]);

        // Delete the token
        $stmt = $pdo->prepare('DELETE FROM password_resets WHERE token = ?');
        $stmt->execute([$token]);

        echo "Your password has been successfully reset.";
    } else {
        echo "Invalid or expired token.";
    }
}
?>