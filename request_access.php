<!DOCTYPE html>
<html lang="en">
    <?php $title = "Request Access"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <form action="./access_requested.php" method="post" id="login">
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
                            <input id="password" class="form_input" type="text" name="password">
                        </div>
                        <div>
                            <label for="id" class="form_label">ID:</label>
                            <input id="id" class="form_input" type="text" name="id">
                        </div>
                        <input type="submit" value="Request Access">
                    </fieldset>
                </form>  
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
