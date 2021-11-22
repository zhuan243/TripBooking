<!---Author:45 --->
<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Display Passengers</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---Page is used to display Passengers --->

<?php
//connect to databases
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

//query to get passengers and passport information ordered by last name
$sql = "SELECT a.*, b.* FROM Passenger a, Passport b WHERE a.PassportID = b.PassportNum ORDER BY a.LastName ASC";

$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}
//create a table to display query results
echo '<h1> Passengers </h1>';

echo "<table border='1'>
<tr>
<th>Passenger ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Passport Number</th>
<th>Expiry Date</th>
<th>Country of Citizenship</th>
<th>Birth Date</th>
<th>Show Bookings</th>
</tr>";

while($output = mysqli_fetch_array($results)){
?>
<!---add a form to the table so that user can choose to show bookings for specific passengers --->

<form action= "showPassengerBooking.php" method ="post">
<tr>

<?php
  echo "<td>" . $output['PassengerID'] . "</td>";
  echo "<td>" . $output['FirstName'] . "</td>";
  echo "<td>" . $output['LastName'] . "</td>";
  echo "<td>" . $output['PassportNum'] . "</td>";
  echo "<td>" . $output['ExpiryDate'] . "</td>";
  echo "<td>" . $output['CitizenCountry'] . "</td>";
  echo "<td>" . $output['BirthDate'] . "</td>";
  echo "<input type='hidden' id='PassengerID' name='PassengerID' value =" . $output['PassengerID']  . ">";
?>

<td style = "text-align:center"> <input type="submit" name="ShowBookings" value="Submit" alig/> </td>

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
