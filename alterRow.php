<!---Author:45 --->
<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Alter Trips</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---Page is used to change trip information --->

<h1 class="PageHeader">
        ALTER TRIPS
        <strong> Alter trips on this page </strong>
</h1>

<br>

<!---Connect to Database --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

//get the trip ID to change or delete
$TripID = (is_numeric($_POST['TripID']) ? (int)$_POST['TripID'] : 0);

//query to get all information regarding the selected bus trip
$sql = "SELECT * FROM BusTrip WHERE TripID = $TripID";
$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}

$output = mysqli_fetch_array($results);

//if we are updating the data
if ($_POST["action"] == "Update"){
  ?>
  <!---Create a form to edit properties of the trip --->

  <form action="updateTrip.php" method="post">

  <br>

  <?php

  echo "<p> Which attributes to update for ID " . $output['TripID']  . " - " . $output['TripName']  . ": </p>";

  ?>

  <label for="TripName"> Trip Name: </label>
  <input type="text" id="TripName" name="TripName" value=<?php echo "'$output[TripName]'";?> maxlength="50" required>

  <br><br>

  <label for="Start Date"> Start Date: </label>
  <input type="date" id="StartDate" name="StartDate" value=<?php echo "$output[StartDate]";?> required>

  <br><br>

  <label for="End Date"> End Date: </label>
  <input type="date" id="EndDate" name="EndDate" value=<?php echo "$output[EndDate]";?> required>

  <br><br>

  <label for="URL"> URL: </label>
  <input type="text" id="urlmage" name="urlmage" maxlength="255" value=<?php echo "$output[urlmage]";?>>

  <br><br>

  <?php

  echo "<input type='hidden' id='TripID' name='TripID' value =" . $TripID  . ">";

  ?>

  <input type="submit" value="Submit"/>
  <input type="reset"/>

  <br><br>

  </form>

  <?php

//otherwise, if purpose is to delete the trip
}else if($_POST["action"] == "Delete"){


   $sqldel = "DELETE FROM BusTrip WHERE TripID = $TripID";
   $resultsDel = mysqli_query($link, $sqldel);

//will throw error if the booking ID already exists
   if(!$resultsDel){
     die('Can not delete, booking active ');
   }

   echo "<br> <h1 class='SectionHeader'> Deletion Successful </p1> <br>";

}else{
  echo "Invalid Option";
}

mysqli_close($link);
?>

<form action="homepage.php" class = "ReturnButton">
    <input type="submit" value="Go Home" />
    <br><br>
</form>


</html>
