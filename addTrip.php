<!---Author:45 --->
<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Add Trips</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---This page is used to add a new trip --->
<h1 class="PageHeader">
        ADD TRIP
        <strong> Add trips on this page </strong>
</h1>

<br>

<!---Connect To Database --->
<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}
//get the relevant columns to add a new trip
$TripID = (is_numeric($_POST['TripID']) ? (int)$_POST['TripID'] : 0);
$TripName = $_POST["TripName"];
$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$CountryVisted = $_POST["CountryVisted"];
$BusID = $_POST["BusID"];
$urlmage = $_POST["urlmage"];

$sql = "INSERT INTO BusTrip (TripID, TripName, StartDate, EndDate, CountryVisted, BusID, urlmage)
VALUES ($TripID,'$TripName','$StartDate','$EndDate','$CountryVisted','$BusID','$urlmage')";

$results = mysqli_query($link, $sql);

if(!$results){
  die('TripID already exists');
}
?>

<p1 class=SectionHeader> Add Successful </p1>
<br><br><br><br>

<form action="homepage.php" class = "ReturnButton">
    <input type="submit" value="Go Home" />
    <br>
</form>

</html>
