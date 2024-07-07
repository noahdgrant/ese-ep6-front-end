<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
    <?php $title = "Update Password"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>

            <?php
            // Include db connect functions & variables
            require "php/db_connect.php";

            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                $token = $_GET["token"];
                $database = db_connect($db_users);
                // Validate the token
                try{
                    $statement = $database->prepare("SELECT * FROM password_resets WHERE token = ? AND expires > ?");
                    $statement->execute([$token, date('U')]);
                } catch (PDOException $e) {
                    die(json_encode(array("success" => false, "message" => "Error: ". $e->getMessage())));
                }

                $reset_request = $statement->fetch();

                if ($reset_request) {
                    // Update the user's password
                    $email = $reset_request["Email"];
                    echo <<<EOT
                    <div id="content">
                        <form action="./php/db_crud.php" method="post" id="reset_password">
                            <label for="password">Enter your new password:</label>
                            <input type="password" id="password" name="password" required autocomplete="new-password">
                            <input type="submit" value="Update Password">
                            <input type="hidden" id="function" name="function" value="update_user">
                            <input type="hidden" id="token" name="token" value=$token>
                            <input type="hidden" id="email" name="email" value=$email>
                        </form>
                        <p id="pswd_errror_msg"></p>
                    </div>
                    <script src="./js/reset_password.js"></script>
                    EOT;
                } else {
                    echo <<<EOT
                    <div id="content">
                        <p>Invalid Token</p>
                    </div>
                    EOT;
                }
            }
            ?>

            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>