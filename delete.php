<!-- code for deleting goes here -->
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




if (isset($_GET['delete'])){
        <form method="post">
        <label for="name">Animal Name:</label>
        <input type="text" id="name" name="name" required><br>
        <input type="submit" name="Delete Animal" value="Submit">
        </form>

        $deleteAnimalQuery = "DELETE ";
        if (mysqli_query($con, $deleteAnimalQuery)) {
         echo "Record deleted successfully";
        } else {
         echo "Error: " . $deleteAnimalQuery . "<br>" . mysqli_error($con);
        
