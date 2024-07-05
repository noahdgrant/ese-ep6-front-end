<?php
session_start();
?>

<?php
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
    <?php $title = "Access Requested"; include "./common/head.php"; ?>
    <body>
        <div id="page" class="container">
            <?php include "./common/header.php"; ?>
            <div id="content">
  <p>Form Submitted? <?php echo (int) $submitted; ?></p>
  <p>Your new login info is</p>
  <ul>
    <li>Email: <?php echo $_POST['email']; ?></li>
    <li>Username: <?php echo $_POST['username']; ?></li>
    <li>Password: <?php echo $_POST['password'];?></li>
    <li>ID: <?php echo $_POST['id'];?></li>
  </ul>
            </div>
            <?php include "./common/footer.php"; ?>
        </div>
        <?php include "./common/bottom.php"; ?>
    </body>
</html>
