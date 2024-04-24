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
        // Code for create data form
    } elseif (isset($_GET['update'])) {
        // Code for update data form
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
