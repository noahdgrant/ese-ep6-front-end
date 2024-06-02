<!DOCTYPE html>
<html lang="en">
    <?php $title = "About"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <h1>Project VI About</h1>
                <figure id="team_photo">
                    <img src="../images/group.jpg" alt=“group_picture” title=“group_picture”/>
                    <figcaption>Group photo</figcaption>
                </figure>
                <br>
                <p>In this project we will build a ‘connected’ elevator with database and control features that will be accessible via a web-page</p>
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5799.040350043009!2d-80.39990002431495!3d43.387055969604425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b8a7ec9d60715%3A0xd5e712873de8af2d!2sConestoga%20College%20Cambridge%20-%20Fountain%20Street%20campus!5e0!3m2!1sen!2sca!4v1715958426967!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div>
                    <h2>Project Video</h2>
                    <iframe width="560" height="315" id="intro_vid" src="https://www.youtube.com/embed/xy_NKN75Jhw?si=wAWGBU66CGAGqjvv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
