<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Update Trips</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<h1 class="PageHeader">
        TRIP UPDATE
</h1>

<br>

<!---This page is used to make updates to the trips --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

//get all relevant information to update the trip with
$TripID = $_POST["TripID"];
$TripName = $_POST["TripName"];
$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$urlmage = $_POST["urlmage"];


//put attributes and values for the attributes into arrays
$attributeList = [$TripName, $StartDate, $EndDate, $urlmage];
$attributes = ["TripName", "StartDate", "EndDate", "urlmage"];

//loop through the array of attributes
//This loop was originally made to check if each attribute was empty before updating
//decided against looping over empty attributes but kept the loop
for ($index = 0; $index < count($attributes); $index++) {

  //update each attribute one by one
  $sql = "UPDATE BusTrip SET $attributes[$index] = '$attributeList[$index]' WHERE TripID = $TripID";

  $results = mysqli_query($link, $sql);

  if(!$results){
    die('Invalid query: ' . mysqli_error());
  }
  //used to display the changes made 
  echo $attributes[$index] . " changed to " . $attributeList[$index] . "<br>";

}

?>
<h1 class="SectionHeader"> Update Successful </p1>
<br><br><br>

<form action="homepage.php">
    <br>
    <input type="submit" value="Go Home" />
    <br><br>
</form>

</html>
