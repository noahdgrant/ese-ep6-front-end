<?php 
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "../PHPMailer/src/Exception.php";
require "../PHPMailer/src/PHPMailer.php";
require "../PHPMailer/src/SMTP.php";

$MAIL_HOST = getenv("MAIL_HOST");
$MAIL_USERNAME = getenv("MAIL_USERNAME");
$MAIL_PASSWORD = getenv("MAIL_PASSWORD");
$SERVER_ADDRESS = getenv("SERVER_ADDRESS");

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient_email = $_POST["email"];
    
    // Check if the email exists in the database

    $database = db_connect($db_users);
    try {
        $statement = $database->prepare("SELECT * FROM accounts WHERE email = ?");
        $statement->execute([$recipient_email]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $user = $statement->fetch();

    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expires = date("U") + 1800; // Token valid for 30 minutes

        // Insert token into the database
        $database = db_connect($db_users);
        $statement = $database->prepare('INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)');
        $statement->execute([$recipient_email, $token, $expires]);

        // Send email to user

        $reset_link = "http://".$SERVER_ADDRESS."/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click on the following link to reset your password: <a href='$reset_link'>Link</a>";

        // Mail configuration
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $MAIL_HOST;
        $mail->Username = $MAIL_USERNAME;
        $mail->Password = $MAIL_PASSWORD;

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom($MAIL_USERNAME, "Elevator One");
        $mail->addAddress($recipient_email);

        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        if(!$mail->send()){
            return "Email not send. Please try again";
        }else{
            return "success";
        }
    } else {
        // do something idk
    }
}

?>