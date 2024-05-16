<?php
$submitted = !empty($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='assets/css/style.css' rel='stylesheet'>
  <link rel="icon" href="assets/images/icon.png">
  <title>Login Handler</title>
</head>
<body>
  <div>
    <a href="../index.html" style="text-decoration:none;">Home</a>
    <a href="../about.html" style="text-decoration:none;">About</a>
    <a href="../project_plan.html" style="text-decoration:none;">Project Plan</a>
    <hr>
  </div>

  <p>Form Submitted? <?php echo (int) $submitted; ?></p>
  <p>Your new login info is</p>
  <ul>
    <li>Username: <?php echo $_POST['username']; ?></li>
    <li>Password: <?php echo $_POST['password'];?></li>
  </ul>
</body>
</html>