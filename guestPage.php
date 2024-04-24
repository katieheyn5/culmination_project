<!DOCTYPE HTML>
<html>
    <header>
        <meta charset="UTF-8">
        <title>Culmination Project B: Implementation</title>
        <link href="StyleSheet.css" rel="stylesheet" type="text/css">
    </header>

    <body>
        <div class="top-bar">
            <h2>Hello Guest!</h2>
            <nav>
                <a href="loginPage.php">Login</a>
            </nav>
        </div>

    <?php
      $servername = "localhost";
      $username = "aswann2";
      $password = "LCSodhs1";
      $database = "Team_Elephant";
  
      $con = mysqli_connect($servername, $username, $password, $database);
  
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
          <hr>
         <?php
        }
  
        mysqli_close($con);
          ?>
   </body>
</html>
