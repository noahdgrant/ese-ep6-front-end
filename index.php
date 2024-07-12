<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Home"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>

            <div id="content">
                <img src="images/4WyattNoahWithLove.png" alt=“Group_logo” title=“Group_logo” class="centered_image"/>
                <div>
                    <p id="current_date" class="centered_text"></p>
                </div>
                <div class="row">
                    <?php
                    if(isset($_SESSION['username'])){
                        echo <<<EOT
                        <div class="col-xs-12 col-md-6">
                            <input type="image" class="centered_image" id="btn_3" src="./images/elevator_btns/elevator-btn-3.png"><br>
                            <input type="image" class="centered_image" id="btn_2" src="./images/elevator_btns/elevator-btn-2.png"><br>
                            <input type="image" class="centered_image" id="btn_1" src="./images/elevator_btns/elevator-btn-1.png">
                            <p id="debug"></p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <img src="./images/elevator_1.png" id="elevator_image"></img>
                        </div>
                        EOT;
                    }
                    else{
                        echo <<<EOT
                        <div class="col-xs-12">
                            <form action="./php/db_crud.php" method="post" id="login">
                                <fieldset>
                                    <legend>Login</legend>
                                    <div>
                                        <label for="username" class="form_label">Username: </label>
                                        <input id="username" class="form_input" type="text" name="username">
                                    </div>
                                    <div>
                                        <label for="password" class="form_label">Password:</label>
                                        <input id="password" class="form_input" type="password" name="password">
                                    </div>
                                    <br>
                                    <input type="submit" value="Log in" id="submit">
                                    <br><br>
                                    <a href="./request_access.php" id="request_access_link">Can't login? Request Access</a>
                                    <a href="./request_reset.php" id="request_reset_link">Forgot Password</a>
                                    <div>
                                        <p id="user_errror_msg"></p>
                                        <p id="pswd_errror_msg"></p>
                                    </div>
                                </fieldset>
                                <input type="hidden" name="function" value="login">
                            </form>
                        </div>
                        EOT;
                    }
                    ?>
                    
                </div>  
                <audio loop src="./music/elevator_music.mp3" id="audioElement"></audio>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>

        <script src="./js/login.js"></script>
        <?php include("./common/bottom.php");?>
    </body>
</html>
