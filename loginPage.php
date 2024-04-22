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
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM RegisteredUsers WHERE Username='$username' and Password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login_user'] = $username;
        header("Location:userPage.php");    //connect to userPage.php
        exit();
    } else {
        $error = "Your Username or Password is incorrect. Please try again or continue as guest.";
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

    <body style="background-image: url('https://as2.ftcdn.net/v2/jpg/01/91/13/11/1000_F_191131160_YJ6OxSQNPe2q2lHgffWhlHmfb0eAWLAu.jpg'); background-repeat: no-repeat; background-attachment: scroll; background-size: cover;">  
        <div class="login-form">
            <form action="" method="post">
                <label for="Username">Username:</label>
                <input type="text" id="Username" name="Username" required>
                <label for="Password">Password:</label>
                <input type="password" id="Password" name="Password" required>
                <button type="submit">Login</button>
                <span><?php if(isset($error)) { echo $error; } ?></span>
            </form>
            <a href="guestPage.php"><button type="submit">Continue as Guest</button></a>
        </div>
    <?php
    //session variables
    ?>

    </body>
</html>
