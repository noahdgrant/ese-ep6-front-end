<?php
session_start();
/*
* Password Reset Proccess:
* request_reset.php & request_reset.js call reset_creds.php
* reset_creds.php checks database for email addr, creates a token, emails token to user w/ link to reset_password.php
* reset_password.php allows user to change password if token isnt expired
*/
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Request Reset"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <form action="./php/reset_creds.php" method="post" id="request_reset">
                    <label for="email">Enter your email:</label>
                    <input type="email" id="email" name="email" required>
                    <input type="submit" value="Request Password Reset">
                </form>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <script src="./js/request_reset.js"></script>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>