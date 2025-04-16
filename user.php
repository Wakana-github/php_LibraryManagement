
<!--
Author: Wakana.G
Purpose:  Prompt username and password from user to sign in to the system.
Created: 03/02/2025
Last modified: 03/02/2025
-->

<?php
  require 'dbConnectBooks.php';
   if(isset($_POST['username'])){
     $username = $_POST['username'];
   }

   if(isset($_POST['password'])){
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
</head>
  <body>

      <!-- username-->
      <form action = "registerUser.php" method = "POST">
        <p class="name">Username:
          <input type="text" name="username"></p>

        <!-- password-->
        <p class="password">Password:
          <input type="password" name="password"></p>
          <input type="submit" value="register">
      </form>

  </body>
</html>
