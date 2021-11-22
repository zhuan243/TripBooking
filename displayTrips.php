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

<!---This page is to get all the trip information and display them --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}
//get the information for listing the information - order by and order in
$OrderBy = $_POST['OrderBy'];
$OrderIn = $_POST['OrderIn'];

//query to get all bus trips ordered in the information given above
$sql = "SELECT * FROM BusTrip ORDER BY $OrderBy $OrderIn";
$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}
//table to display the bus trips
echo '<h1> Bus Trips </h1>';

echo "<table border='1'>
<tr>
<th>Trip Number</th>
<th>Start Date</th>
<th>End Date</th>
<th>Country Visited</th>
<th>Trip Name</th>
<th>Bus Number</th>
<th>Trip Image</th>
<th>Update</th>
<th>Delete</th>
</tr>";

while($output = mysqli_fetch_array($results)){
?>

<!---Add a form to the table in order to add options to update or delete a bus trip --->

<form action= "alterRow.php" method ="post">
<tr>

<?php  
  echo "<td>" . $output['TripID'] . "</td>";
  echo "<td>" . $output['StartDate'] . "</td>";
  echo "<td>" . $output['EndDate'] . "</td>";
  echo "<td>" . $output['CountryVisted'] . "</td>";
  echo "<td>" . $output['TripName'] . "</td>";
  echo "<td>" . $output['BusID'] . "</td>";
  echo "<td>" . "<img src='" . $output['urlmage'] . "' height='120' width='120'> </td>";
  echo "<input type='hidden' id='TripID' name='TripID' value =" . $output['TripID']  . ">";
?>
<td> <input type="submit" name="action" value="Update" /> </td>
<td> <input type="submit" name="action" value="Delete" onclick='return confirm("Deletions are Permanent, Are you sure?");' /> </td>
<tr>

</form>

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
