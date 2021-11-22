<!---Author:45 --->
<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Add Booking</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---Adding the Title for this page --->
<h1 class="PageHeader">
        ADD BOOKING
        <strong> Add bookings on this page </strong>
</h1>

<br>

<!---Connect to the database --->
<?php

include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

//Get the variables needed to add a booking

$BookID = (is_numeric($_POST['BookID']) ? (int)$_POST['BookID'] : 0);
$Price = floatval($_POST['Price']);
$PassengerID = (is_numeric($_POST['PassengerID']) ? (int)$_POST['PassengerID'] : 0);
$TripID = (is_numeric($_POST['TripID']) ? (int)$_POST['TripID'] : 0);

//query to insert new Booking

$sql = "INSERT INTO Book (BookID, TripID, PassengerID, Price)
VALUES ($BookID,$TripID,$PassengerID,$Price)";

$results = mysqli_query($link, $sql);

if(!$results){
  die('Booking ID already exists');
}
?>
<!---Display message if Successful Add --->

<p1 class=SectionHeader> Booking Add Successful </p1>
<br><br><br><br>

<!---Go back to home page --->

<form action="homepage.php" class = "ReturnButton">
    <input type="submit" value="Go Home" />
    <br>
</form>

</html>
