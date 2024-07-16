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
                        <li class="active"><a data-toggle="tab" href="#home">Floor History</a></li>
                        <li><a data-toggle="tab" href="#menu1">User Activity</a></li>
                        <li><a data-toggle="tab" href="#menu2">Requests Activity</a></li>
                        
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <canvas id="HOMEChart" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <canvas id="menu1Chart" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <canvas id="menu2Chart" style="width:100%;max-width:700px"></canvas>
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
        <script src="./js/diagnostics.js"></script>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
