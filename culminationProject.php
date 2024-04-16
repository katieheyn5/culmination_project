<?php
session_start();

$servername = "localhost";
$username = "aswann2";
$password = "LCSodhs1";
$database = "Team_Elephant";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Login WHERE username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login_user'] = $username;
    } else {
        $error = "Your Username or Password is incorrect. Please try again.";
    }
}
?>

<!DOCTYPE HTML>
<html>
    <header>
        <meta charset="UTF-8">
        <title>Culmination Project B: Implementation</title>
        <link href="StyleSheet.css" rel="stylesheet" type="text/css">
    </header>
    
    <body>
    
        <div class="login-form">
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
                <span><?php if(isset($error)) { echo $error; } ?></span>
            </form>
        </div>
    <?php
    //session variables
    ?>

    </body>
</html>
