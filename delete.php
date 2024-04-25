<!-- code for deleting rows of data in the database from the website goes here-->

<?php
session_start();

// Redirect if cancel button is clicked
if (isset($_GET['cancel'])) {
    header('Location: userPage.php');
    exit();
}

// Redirect if user is not logged in
if (!isset($_SESSION['login_user'])) {
    header('Location: userPage.php');
    exit();
}

// Database connection
$servername = "localhost";
$username = "aswann2";
$password = "LCSodhs1";
$database = "Team_Elephant";

$con = mysqli_connect($servername, $username, $password, $database);

// Handle delete request
if (isset($_POST['deleteAnimal'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $breed = mysqli_real_escape_string($con, $_POST['breed']);

    // Subquery to select Animal IDs based on join condition
    $selectAnimalIdsQuery = "SELECT Animal.AnimalID 
                             FROM Animal 
                             JOIN Breed ON Animal.Breed = Breed.BreedID 
                             WHERE Animal.Name = '$name' AND Breed.Breed = '$breed'";
    
    // Execute subquery
    $result = mysqli_query($con, $selectAnimalIdsQuery);
    
    if ($result) {
        // Fetch the IDs from the result set
        $animalIds = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $animalIds[] = $row['AnimalID'];
        }
    if(!empty($animalIds)){
        // Use the IDs to delete records from the Animal table
        $deleteAnimalQuery = "DELETE FROM Animal WHERE AnimalID IN (" . implode(',', $animalIds) . ")";
        
        if (mysqli_query($con, $deleteAnimalQuery)) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $deleteAnimalQuery . "<br>" . mysqli_error($con);
        }
    } else {
        echo "No records found to delete.";}
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Culmination Project B: Implementation</title>
    <link href="StyleSheet.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="top-bar">
    <h2>Hello <?php echo $_SESSION["login_user"]; ?>!</h2>
    <nav>
        <a href="?cancel">Cancel</a>
    </nav>
</div>

<div class="login-form">
    <form method="post">
        <label for="name">Animal Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="breed">Animal Breed:</label>
        <input type="text" id="breed" name="breed" required><br> 
        <input type="submit" name="deleteAnimal" value="Delete Animal">
    </form>
</div>
<?php mysqli_close($con); ?>

</body>
</html>

