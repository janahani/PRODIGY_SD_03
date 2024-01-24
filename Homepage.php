<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../public/CSS/Register&Login.css">
  <title>Contact Management</title>
</head>
<body>
    <?php session_start(); ?>
    <script src="../public/JS/signup_validation.js"></script>
    <div class="container">
      <h1>Welcome to <br> Contact Management System</h1>
  
      <form method="post" action="../Controllers/ContactController.php" onsubmit="return validateForm()">
        <input type="hidden" name="action" value="signup">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <?php if (isset($_SESSION["nameErr"])): ?>
          <p class="error"><?php echo $_SESSION["nameErr"]; ?></p>
        <?php endif; ?>

        <input type="email" id="email" name="email" placeholder="Email Address" required>
        <?php if (isset($_SESSION["emailErr"])): ?>
          <p class="error"><?php echo $_SESSION["emailErr"]; ?></p>
        <?php endif; ?>

        <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
        <?php if (isset($_SESSION["phonenoErr"])): ?>
          <p class="error"><?php echo $_SESSION["phonenoErr"]; ?></p>
        <?php endif; ?>

        <button type="submit">Sign up</button>
      </form>
      <?php
      unset($_SESSION["nameErr"]);
      unset($_SESSION["phonenoErr"]);
      unset($_SESSION["emailErr"]);
      ?>
      <p class="signInText">Already Have an Account? <a class="signIn" href="Signin.php">Sign in</a></p>
    </div>
</body>
</html>