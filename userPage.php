<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: loginPage.php');
    exit();
}

if (!isset($_SESSION['login_user'])) {
    header('Location: loginPage.php');
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
            <a href="?insert">Insert Data</a>
            <a href="?update">Update Data</a>
            <a href="?delete">Delete Data</a>
            <a href="?logout">Logout</a>
        </nav>
    </div>

    <?php
    $servername = "localhost";
    $username = "aswann2";
    $password = "LCSodhs1";
    $database = "Team_Elephant";

    $con = mysqli_connect($servername, $username, $password, $database);

    if (isset($_GET['insert'])) {
    ?>
        <div class="wrapper">
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="breed">Breed:</label>
            <input type="text" id="breed" name="breed"><br>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color"><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob"><br>

            <label for="intake">Intake Type:</label>
            <input type="text" id="intake" name="intake"><br>

            <label for="outcome">Outcome Type:</label>
            <input type="text" id="outcome" name="outcome"><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <input type="submit" name="Add New Animal" value="Submit">
        </form>
    </div>
    <?php

    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];
    $dob = $_POST['dob'];
    $intake = $_POST['intake'];
    $outcome = $_POST['outcome'];
    $gender = $_POST['gender'];

    $insertBreedQuery = "INSERT INTO Breed (Breed) VALUES ('$breed') ON DUPLICATE KEY UPDATE BreedID = LAST_INSERT_ID(BreedID)";
    mysqli_query($con, $insertBreedQuery);
    $breedID = mysqli_insert_id($con);

    // Insert into Intake table if intake does not already exist
    $insertIntakeQuery = "INSERT INTO Intake (IntakeType) VALUES ('$intake') ON DUPLICATE KEY UPDATE IntakeID = LAST_INSERT_ID(IntakeID)";
    mysqli_query($con, $insertIntakeQuery);
    $intakeID = mysqli_insert_id($con);

    // Insert into Outcome table if outcome does not already exist
    $insertOutcomeQuery = "INSERT INTO Outcome (OutcomeType) VALUES ('$outcome') ON DUPLICATE KEY UPDATE OutcomeID = LAST_INSERT_ID(OutcomeID)";
    mysqli_query($con, $insertOutcomeQuery);
    $outcomeID = mysqli_insert_id($con);

    // Insert into Animal table
    $insertAnimalQuery = "INSERT INTO Animal (Name, Breed, Color, DateOfBirth, Intake, Outcome, Gender) 
                          VALUES ('$name', '$breedID', '$color', '$dob', '$intakeID', '$outcomeID', '$gender')";

    if (mysqli_query($con, $insertAnimalQuery)) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $insertAnimalQuery . "<br>" . mysqli_error($con);
    }

    } elseif (isset($_GET['update'])) {?>
        <select>  
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
    <?php
    } elseif (isset($_GET['delete'])) {
        // Code for delete data form
    } else {
        $query = "SELECT a.*, b.Breed, i.*, o.*, p.PictureLink FROM Animal AS a
                LEFT JOIN Breed AS b ON a.Breed = b.BreedID
                LEFT JOIN Intake AS i ON a.Intake = i.IntakeID
                LEFT JOIN Outcome AS o ON a.Outcome = o.OutcomeID
                LEFT JOIN Pictures AS p ON a.Pictures = p.PicturesID";

    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="wrapper">
            <img src="<?php echo $row['PictureLink'] ?? 'https://t3.ftcdn.net/jpg/05/03/24/40/360_F_503244059_fRjgerSXBfOYZqTpei4oqyEpQrhbpOML.jpg';?>" class="animal-image"> 
            <p></p>

            <button class="like-btn">Like</button>
            <p></p>
        </div>

        <table style="margin: 0px auto;">
            <tr>
                <th>About</th>
                <th>Intake</th>
                <th>Outcome</th>
            </tr>
            <tr>
                <td>Name: <?php echo $row['Name'];?></td>
                <td>Condition: <?php echo $row['Animal_Condition'];?></td>
                <td>ID: <?php echo $row['OutcomeID'];?></td>
            </tr>
            <tr>
                <td>Breed: <?php echo $row['Breed'];?></td>
                <td>Type: <?php echo $row['IntakeType'];?></td>
                <td>Age: <?php echo $row['OutcomeAge'];?></td>
            </tr>
            <tr>
                <td>Color: <?php echo $row['Color'];?></td>
                <td>Found: <?php echo $row['FoundLocation'];?></td>
                <td>Date: <?php echo $row['OutcomeDate'];?></td>
            </tr>
            <tr>
                <td>DOB: <?php echo $row['DateOfBirth'];?></td>
                <td>Date Found: <?php echo $row['IntakeDate'];?></td>
                <td>Type: <?php echo $row['OutcomeType'];?></td>
            </tr>
        </table>

        <p></p>
        <hr style="width:55%">
        <p></p>
        <?php
        }
    }
    mysqli_close($con);
    ?>

    <script>
        const likeButtons = document.querySelectorAll('.like-btn');
        likeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                let liked = button.classList.toggle('liked');
                if (liked) {
                    button.textContent = 'Liked';
                } else {
                    button.textContent = 'Like';
                }
            });
        });
    </script>
    </body>
</html>
