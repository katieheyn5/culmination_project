<?php
session_start();
if(isset($_SESSION['Username'])) {
    echo "You are logged in " . $_SESSION['Username'];
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
    <?php
    $servername = "localhost";
    $username = "aswann2";
    $password = "LCSodhs1";
    $database = "Team_Elephant";

    $con = mysqli_connect($servername, $username, $password, $database);

    $query = "SELECT a.*, b.Breed, i.*, o.* FROM Animal a
              LEFT JOIN Breed b ON a.Breed = b.BreedID
              LEFT JOIN Intake i ON a.Intake = i.IntakeID
              LEFT JOIN Outcome o ON a.Outcome = o.OutcomeID";

    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div style="text-align: center;" class="wrapper">
            <img src="https://t3.ftcdn.net/jpg/05/03/24/40/360_F_503244059_fRjgerSXBfOYZqTpei4oqyEpQrhbpOML.jpg">
            <p></p>
            <button class="button button-like">
                <i class="fa fa-heart"></i>
                <span>Like</span>
                <a class="liked" href="#"></a>
            </button>
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

    mysqli_close($con);
    ?>

    </body>
</html>
