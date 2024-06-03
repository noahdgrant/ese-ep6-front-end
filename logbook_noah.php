<!DOCTYPE html>
<html lang="en">
    <?php $title = "Noah's Logbook"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
                <h1>Noah's Weekly Log Book</h1>
                <figure id="photo_of_noah">
                    <img src="images/noah.jpeg" alt=“picture_of_noah” title=“noah”/>
                    <figcaption>Noah</figcaption>
                </figure>
                <br>
                <iframe style="width:100%;height:463px;" src="https://docs.google.com/document/d/e/2PACX-1vRf4CWQzn-qqKGigM83uK10gWpo9R2PWCaHUwi_Q3MRejF53I4HMDTqQz_Ga2CEilixd6ENaCjq5lrI/pub?embedded=true"></iframe>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
