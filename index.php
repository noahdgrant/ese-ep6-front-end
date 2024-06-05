<!DOCTYPE html>
<html lang="en">
    <?php $title = "Home"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>

            <div id="content">
                <img src="images/4WyattNoahWithLove.png" alt=“Group_logo” title=“Group_logo” class="centered_image"/>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <input type="image" class="centered_image" id="btn_3" onclick="floor_select(3)" src="./images/elevator_btns/elevator-btn-3.png"><br>
                        <input type="image" class="centered_image" id="btn_2" onclick="floor_select(2)" src="./images/elevator_btns/elevator-btn-2.png"><br>
                        <input type="image" class="centered_image" id="btn_1" onclick="floor_select(1)" src="./images/elevator_btns/elevator-btn-1.png">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <form action="./login.php" method="post" id="login">
                            <fieldset>
                                <legend>Login</legend>
                                <div>
                                    <label for="username" class="form_label">Username: </label>
                                    <input id="username" class="form_input" type="text" name="username">
                                </div>
                                <div>
                                    <label for="password" class="form_label">Password:</label>
                                    <input id="password" class="form_input" type="text" name="password">
                                </div>
                                <br>
                                <input type="submit" value="Log in" id="submit">
                                <br><br>
                                <p><a href="./request_access.php">Cant login? Request Access</a></p>
                            </fieldset>
                        </form>
                    </div>
                </div>  
                <audio loop src="./music/elevator_music.mp3" id="audioElement"></audio>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>

        <script>
            function floor_select(floor) {
                document.getElementById("audioElement").play();
                let btn_1 = document.getElementById("btn_1");
                let btn_2 = document.getElementById("btn_2");
                let btn_3 = document.getElementById("btn_3");
                btn_1.src = "./images/elevator_btns/elevator-btn-1.png"
                btn_2.src = "./images/elevator_btns/elevator-btn-2.png"
                btn_3.src = "./images/elevator_btns/elevator-btn-3.png"
                if (floor==1) {
                    btn_1.src = "./images/elevator_btns/elevator-btn-1-grn.png"
                }
                else if (floor==2) {
                    btn_2.src = "./images/elevator_btns/elevator-btn-2-grn.png"
                }
                else if(floor==3){
                    btn_3.src = "./images/elevator_btns/elevator-btn-3-grn.png"
                }
            }
        </script>

        <?php include("./common/bottom.php");?>
    </body>
</html>
