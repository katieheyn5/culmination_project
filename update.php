<?php
session_start();

if (isset($_GET['cancel'])) {
    header('Location: userPage.php');
    exit();
}

if (!isset($_SESSION['login_user'])) {
    header('Location: userPage.php');
    exit();
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
    <div class="top-bar">
        <h2>Hello <?php echo $_SESSION["login_user"]; ?>!</h2>
        <nav>
            <a href="?cancel">Cancel</a>
        </nav>
    </div>

    <?php
    $servername = "localhost";
    $username = "aswann2";
    $password = "LCSodhs1";
    $database = "Team_Elephant";

    $con = mysqli_connect($servername, $username, $password, $database);
     ?>
    <div class="wrapper">
        <form method="post">
          <select name="subject">
            <option value="Select">Select</option>
            <option value="Name">Name</option>}
            <option value="Breed">Animal Breed</option>
            <option value="Color">Animal Color</option> 
            <option value="DateOfBirth">DOB</option>
            <option value="Condition">Intake Condition</option>
            <option value="IntakeType">Intake Type</option>
            <option value="FoundLocation">Location Found</option>
            <option value="IntakeAge">FoundDate</option>
            <option value="OutcomeAge">Outcome Age</option>
            <option value="OutcomeDate">OutcomeDate</option>
            <option value="OutcomeType">Outcome Type</option>
          </select>
            <input type="submit" name="submit" value="Choose">
        </form>
    </div>

     <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $changeValue = $_POST['subject'];
        }?>
     <div class="wrapper">
        <form method="post">
            <label for="data">Data:</label>
            <input type="text" id="data" name="data" required><br>
            <input type="submit" name="submit" value="Submit">
        </form>
     </div>
     <?php  
      mysqli_close($con);
     ?>

    </body>

</html>






