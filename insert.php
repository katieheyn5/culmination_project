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

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    ?>

    <div class="login-form">
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed"><br>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color"><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob"><br>

            <label for="iCondition">Intake Condition:</label>
            <input type="text" id="iCondition" name="iCondition"><br>

            <label for="iType">Intake Type:</label>
            <input type="text" id="iType" name="iType"><br>

            <label for="iFound">Found:</label>
            <input type="text" id="iFound" name="iFound"><br>

            <label for="iDateFound">Date Found:</label>
            <input type="text" id="iDateFound" name="iDateFound"><br>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age"><br>

            <label for="oDate">Outcome Date:</label>
            <input type="text" id="oDate" name="oDate"><br>

            <label for="oType">Outcome Type:</label>
            <input type="text" id="oType" name="oType"><br>

            <input type="submit" name="submit" value="Add New Animal">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $breed = $_POST['breed'];
        $color = $_POST['color'];
        $dob = $_POST['dob'];
        $iCondition = $_POST['iCondition'];
        $iType = $_POST['iType'];
        $iFound = $_POST['iFound'];
        $iDateFound = date('Y-m-d H:i:s', strtotime($_POST['iDateFound']));
        $age = $_POST['age'];
        $oDate = date('Y-m-d H:i:s', strtotime($_POST['oDate']));
        $oType = $_POST['oType'];

        // Insert Breed if it doesn't exist
        $insertBreedQuery = "INSERT INTO Breed (Breed) VALUES ('$breed') ON DUPLICATE KEY UPDATE BreedID = LAST_INSERT_ID(BreedID)";
        mysqli_query($con, $insertBreedQuery);
        $breedID = mysqli_insert_id($con);

        // Insert Intake if it doesn't exist
        $insertIntakeQuery = "INSERT INTO Intake (Animal_Condition, IntakeType, FoundLocation, IntakeDate, IntakeAge) 
                              VALUES ('$iCondition', '$iType', '$iFound', '$iDateFound', '$age') 
                              ON DUPLICATE KEY UPDATE IntakeID = LAST_INSERT_ID(IntakeID)";
        mysqli_query($con, $insertIntakeQuery);
        $intakeID = mysqli_insert_id($con);

        // Insert Outcome if it doesn't exist
        $insertOutcomeQuery = "INSERT INTO Outcome (OutcomeType, OutcomeDate, OutcomeAge) 
                               VALUES ('$oType', '$oDate', '$age') 
                               ON DUPLICATE KEY UPDATE OutcomeID = LAST_INSERT_ID(OutcomeID)";
        mysqli_query($con, $insertOutcomeQuery);
        $outcomeID = mysqli_insert_id($con);

        // Insert Animal
        $insertAnimalQuery = "INSERT INTO Animal (Name, AnimalType, Breed, Color, DateOfBirth, Intake, Outcome) 
                              VALUES ('$name', '1', '$breedID', '$color', '$dob', '$intakeID', '$outcomeID')";

        if (mysqli_query($con, $insertAnimalQuery)) {
            echo "New record inserted successfully";
        } else {
            echo "Error: " . $insertAnimalQuery . "<br>" . mysqli_error($con);
        }

    } ?>

    <?php
    mysqli_close($con);
    ?>

    </body>
</html>
