<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Request Reset"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <form action="./php/reset_creds.php" method="post">
                    <label for="email">Enter your email:</label>
                    <input type="email" id="email" name="email" required>
                    <input type="submit" value="Request Password Reset">
                </form>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <script>
        </script>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
