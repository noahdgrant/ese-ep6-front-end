<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Diagnostics"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


            <div id="content">
                <?php
                // floor history -> requests over time
                // user activity -> drop down of users, displays user over time
                // request activity -> pie chart of request mothods
                // raw data -> a table holding num of entries, num of users ...

                if(isset($_SESSION['username'])){
                    echo <<<EOT
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#fh_time">Floor History (Time)</a></li>
                        <li><a data-toggle="tab" href="#fh_day">Floor History (Day)</a></li>
                        <li><a data-toggle="tab" href="#rh_time">Requests History (Time)</a></li>
                        <li><a data-toggle="tab" href="#rh_day">Requests History (Day)</a></li>
                        <li><a data-toggle="tab" href="#pie">Pie Chart</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="fh_time" class="tab-pane fade in active">
                            <canvas id="fh_time_canv" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="fh_day" class="tab-pane fade">
                            <canvas id="fh_day_canv" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="rh_time" class="tab-pane fade">
                            <canvas id="rh_time_canv" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="rh_day" class="tab-pane fade">
                            <canvas id="rh_day_canv" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="pie" class="tab-pane fade">
                            <canvas id="pie_canv" style="width:100%;max-width:700px"></canvas>
                        </div>
                    </div>
                    EOT;
                }
                else{
                    echo <<<EOT
                    <div class="col-xs-12">
                        <p>Please Login to view Elevator Stats.
                    </div>
                    EOT;
                }
                ?>

            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <script src="./js/diagnostics.js?ver=0"></script>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
