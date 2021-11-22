<!---Author:45 --->

<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Trips Without Bookings</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---This page is used to show all trips without bookings --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

//query to select all bus trips without bookings
$sql = "SELECT DISTINCT * FROM BusTrip WHERE BusTrip.TripID NOT IN (SELECT DISTINCT TripID FROM Book)";
$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}

//dusplay those bus trips in a table
echo '<h1> Bus Trips With No Bookings </h1>';

echo "<table border='1'>
<tr>
<th>Trip Number</th>
<th>Start Date</th>
<th>End Date</th>
<th>Country Visited</th>
<th>Trip Name</th>
<th>Bus Number</th>
<th>Trip Image</th>
</tr>";

while($output = mysqli_fetch_array($results)){
?>

<tr>

<?php
  echo "<td>" . $output['TripID'] . "</td>";
  echo "<td>" . $output['StartDate'] . "</td>";
  echo "<td>" . $output['EndDate'] . "</td>";
  echo "<td>" . $output['CountryVisted'] . "</td>";
  echo "<td>" . $output['TripName'] . "</td>";
  echo "<td>" . $output['BusID'] . "</td>";
  echo "<td>" . "<img src='" . $output['urlmage'] . "' height='120' width='120'> </td>";
?>

<tr>

<?php
}

echo "</table>";

echo "<br><br>";

mysqli_close($link);
?>

<form action="homepage.php" class = "ReturnButton">
    <input type="submit" value="Go Home" />
</form>

</html>
