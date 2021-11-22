<!---Author:45 --->

<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Trips</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---Page to display bus trips based on user given country --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}
//get the country of the trips we want to see
$CountryVisted = $_POST['CountryVisted'];

//query reflects the necessary trips based on country
$sql = "SELECT * FROM BusTrip WHERE CountryVisted = '$CountryVisted'";
$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}

//display all relevant trips in a table
echo '<h1> Bus Trips </h1>';

echo "<table border='1'>
<tr>
<th>Trip Number</th>
<th>Start Date</th>
<th>End Date</th>
<th>Country Visited</th>
<th>Trip Name</th>
<th>Bus Number</th>
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
