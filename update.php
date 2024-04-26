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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animalName = $_POST['animalName'];
    $feature = $_POST['feature'];
    $newValue = $_POST['newValue'];
    
    $servername = "localhost";
    $username = "aswann2";
    $password = "LCSodhs1";
    $database = "Team_Elephant";

    $con = mysqli_connect($servername, $username, $password, $database);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    switch ($feature) {
        case "Name":
            // Update the Name in the Animal table
            $updateQuery = "UPDATE Animal SET Name = '$newValue' WHERE Name = '$animalName'";
            break;
        case "Breed":
            // Update the Breed in the Animal table
            // Assuming the Breed is stored as an ID in the Animal table
            // You may need to join with the Breed table if the Breed is stored as a separate entity
            $updateQuery = "UPDATE Animal SET Breed = (SELECT BreedID FROM Breed WHERE Breed = '$newValue') WHERE Name = '$animalName'";
            break;
        case "Color":
            // Update the Color in the Animal table
            $updateQuery = "UPDATE Animal SET Color = '$newValue' WHERE Name = '$animalName'";
            break;
        case "DateOfBirth":
            // Update the DateOfBirth in the Animal table
            $updateQuery = "UPDATE Animal SET DateOfBirth = '$newValue' WHERE Name = '$animalName'";
            break;
        case "Condition":
            // Update the Animal_Condition in the Intake table
            $updateQuery = "UPDATE Intake SET Animal_Condition = '$newValue' WHERE IntakeID = (SELECT Intake FROM Animal WHERE Name = '$animalName')";
            break;
        case "IntakeType":
            // Update the IntakeType in the Intake table
            $updateQuery = "UPDATE Intake SET IntakeType = '$newValue' WHERE IntakeID = (SELECT Intake FROM Animal WHERE Name = '$animalName')";
            break;
        case "FoundLocation":
            // Update the FoundLocation in the Intake table
            $updateQuery = "UPDATE Intake SET FoundLocation = '$newValue' WHERE IntakeID = (SELECT Intake FROM Animal WHERE Name = '$animalName')";
            break;
        case "IntakeAge":
            // Update the IntakeAge in the Intake table
            $updateQuery = "UPDATE Intake SET IntakeAge = '$newValue' WHERE IntakeID = (SELECT Intake FROM Animal WHERE Name = '$animalName')";
            break;
        case "OutcomeAge":
            // Update the OutcomeAge in the Outcome table
            $updateQuery = "UPDATE Outcome SET OutcomeAge = '$newValue' WHERE OutcomeID = (SELECT Outcome FROM Animal WHERE Name = '$animalName')";
            break;
        case "OutcomeDate":
            // Update the OutcomeDate in the Outcome table
            $updateQuery = "UPDATE Outcome SET OutcomeDate = '$newValue' WHERE OutcomeID = (SELECT Outcome FROM Animal WHERE Name = '$animalName')";
            break;
        case "OutcomeType":
            // Update the OutcomeType in the Outcome table
            $updateQuery = "UPDATE Outcome SET OutcomeType = '$newValue' WHERE OutcomeID = (SELECT Outcome FROM Animal WHERE Name = '$animalName')";
            break;
        default:
            echo "Invalid feature selected";
            exit();
    }

    if (mysqli_query($con, $updateQuery)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    mysqli_close($con);
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

        <div class="login-form">
            <form method="post">
                <label for="animalName">Animal Name:</label>
                <input type="text" id="animalName" name="animalName" required><br>
                
                <label for="feature">Select Feature:</label>
                <select id="feature" name="feature">
                    <option value="Name">Name</option>
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
                </select><br>
                
                <label for="newValue">New Value:</label>
                <input type="text" id="newValue" name="newValue" required><br>
                
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>
