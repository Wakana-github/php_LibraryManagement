<!--
Author: Wakana.G
Purpose:  Create username and password to store user data into the database.
Created: 03/02/2025
Last modified: 03/02/2025
-->

<?php
// connect database
require 'dbConnectBooks.php';

// register prosess
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get username and password
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // hash password
    // verify username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->store_result();

    if ($result->num_rows > 0) {
        // return error if username exist
        $error_message = "This username has already used.";
    } else {
        // store data into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $success_message = "<h2>User registered successfully.</h2>";
        } else {
            $error_message = "<h2>User registration failed. Please try again.</h2>";
        }
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>registration</title>
</head>
<body>
    <h1>User registration</h1>

    <!-- エラーメッセージや成功メッセージの表示 -->
    <?php if (isset($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } ?>
    <?php if (isset($success_message)) { echo "<p style='color: green;'>$success_message</p>"; } ?>

    <!-- ユーザー登録フォーム -->
    <form action="registerUser.php" method="POST">
        <p>username： <input type="text" name="username" required></p>
        <p>password： <input type="password" name="password" required></p>
        <input type="submit" value="register">
    </form>
</body>
</html>
