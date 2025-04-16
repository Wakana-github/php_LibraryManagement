
<!--
Author: Wakana.G
Purpose: login to the system using username and password on the dasabase.
Created: 03/02/2025
Last modified: 04/02/2025
-->

<?php
    session_start();

    // connect database
    require 'dbConnectBooks.php';

    session_start();

    // create token
    if (empty($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      }


    //limit attempts
    $max_attempts = 5;
    $lockout_time = 120;
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt_time'] = 0;
      }

        if ($_SESSION['login_attempts'] >= $max_attempts) {
        $time_since_last_attempt = time() - $_SESSION['last_attempt_time'];

        if ($time_since_last_attempt < $lockout_time) {
        $remaining_time = ceil(($lockout_time - $time_since_last_attempt) / 60);
        die("Too many failed login attempts. Please try again in $remaining_time minutes.");
        } else {
        // reset
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_attempt_time'] = 0;
    }
}




    // check the requests
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       //validate token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token. Please reload the page.");}
        //recreate token
        unset($_SESSION['csrf_token']);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $username = $_POST['username'];
        $password = $_POST['password'];


    // Prevent SQL injection
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Bind result
    $stmt->bind_result($user_id, $db_username, $db_password);

    // Check if the username exists
    if ($stmt->fetch()) {
        // Verify password
        if (password_verify($password, $db_password)) {
            // Set session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['login_attempts'] = 0;
            $_SESSION['last_attempt_time'] = 0;

            session_regenerate_id(true);


            // Redirect to search-page.php after login
            header("Location: search-page.php");
            exit();
        } else {
            $_SESSION['login_attempts']++;
            $_SESSION['last_attempt_time'] = time();
            $error = "Incorrect password.";
        }
    } else {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        $error = "Username not found.";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

<!-- login form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="m-3">Library System</h1>
    <h2 class="m-4">Login</h2>
    <form method="POST" action="index.php" class="m-3">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <label for="username" class="form-label">Username:</label>
        <div class="col-sm-10">
          <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <label for="password" class="form-label">Password:</label>
        <div class="col-sm-10">
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mt-3">
          <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </form>

    <?php
    // error message
    if (isset($error)) {
    echo "<p style='color: red;'>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>

    <p class="my-2 mx-3 fs-6 fw-light"><span class="text-danger">*</span> Please use the following information to browse the portfolio.<br><br>Username:browsingUser<br>Password:examplePassword</p>
    <p class="mx-3 mt-5 text-end" style="font-size:0.8rem;">Created by Wakana Gushi, 2025</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
