<!DOCTYPE html>
<html lang="en">
    <?php $title = "Request Access"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <form action="./access_requested.php" method="post" id="request_access">
                    <fieldset>
                        <legend>Request Access</legend>
                        <div>
                            <label for="email" class="form_label">Email:</label>
                            <input id="email" class="form_input" type="text" name="email">
                        </div>
                        <div>
                            <label for="username" class="form_label">Username:</label>
                            <input id="username" class="form_input" type="text" name="username">
                        </div>
                        <div>
                            <label for="password" class="form_label">Password:</label>
                            <input id="password" class="form_input" type="password" name="password">
                        </div>
                        <div>
                            <label for="verify_password" class="form_label">Verify Password:</label>
                            <input id="verify_password" class="form_input" type="password" name="verify_password">
                        </div>
                        <div>
                            <label for="conestoga_id" class="form_label">Conestoga ID:</label>
                            <input id="conestoga_id" class="form_input" type="text" name="conestoga_id">
                        </div>
                        <br>
                        <input type="submit" value="Request Access" id="submit">
                    </fieldset>
                </form>  
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
        <script src="js/request_access.js"></script>
    </body>
</html>
