<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/CSS/Contact.css">
    <title>Contact Management</title>
</head>

<body>
<?php session_start(); ?>
    <script src="../public/JS/signup_validation.js"></script>
    <div class="container">
        <h1>Contact <br> Management System</h1>
        
        <form method="post" action="../Controllers/ContactController.php" onsubmit="return validateForm()">
            <input type="hidden" name="action" value="edit">
            <div class="contact-card">
                <div class="input-group">
                    <label for="contactName">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['Name']; ?>" readonly>
                </div>

                <div class="input-group">
                    <label for="contactEmail">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>" required>
                    <?php if (isset($_SESSION["emailErr"])): ?>
                        <p class="error"><?php echo $_SESSION["emailErr"]; ?></p>
                    <?php endif; ?>
                </div>

                <div class="input-group">
                    <label for="contactPhone">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $_SESSION['Phone']; ?>" required>
                    <?php if (isset($_SESSION["phonenoErr"])): ?>
                        <p class="error"><?php echo $_SESSION["phonenoErr"]; ?></p>
                    <?php endif; ?>
                </div>

                <button class="submit-btn">Submit</a>

            </div>
        </form>
        <?php
      unset($_SESSION["nameErr"]);
      unset($_SESSION["phonenoErr"]);
      unset($_SESSION["emailErr"]);
      ?>
    </div>
</body>

</html>