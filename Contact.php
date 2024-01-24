<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../public/CSS/Contact.css">
  <title>Contact Management</title>
</head>
<style>
 .buttons {
    display: flex;
    justify-content: center; 
    text-align: center; 
  }
  </style>
<body>
<?php session_start(); ?>
  <div class="container">
    <h1>Contact <br> Management System</h1>

    <div class="contact-card">
      <div class="input-group">
        <label for="contactName">Name:</label>
        <input type="text" id="contactName" value="<?php echo $_SESSION['Name']; ?>" readonly>
      </div>

      <div class="input-group">
        <label for="contactEmail">Email:</label>
        <input type="email" id="contactEmail" value="<?php echo $_SESSION['Email']; ?>" readonly>
      </div>

      <div class="input-group">
        <label for="contactPhone">Phone Number:</label>
        <input type="tel" id="contactPhone" value="<?php echo $_SESSION['Phone']; ?>" readonly>
      </div>

      <div class="buttons">
    <a href="Edit.php" class="edit-btn">Edit</a>
    <form method="post" action="../Controllers/ContactController.php">
        <input type="hidden" name="action" value="delete">
        <button type="submit" class="delete-btn">Delete</button>
    </form>
</div>

    </div>
  </div>
</body>
</html>