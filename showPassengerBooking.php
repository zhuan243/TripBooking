<!---Author:45 --->

<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Passenger Booking</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>

<!---The page visualizes all the Bookings of the user selected passenger --->

<?php
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}
//get the relevant passenger ID
$PassengerID = (is_numeric($_POST['PassengerID']) ? (int)$_POST['PassengerID'] : 0);

//query used to get all passenger, booking and trip information of the selected passegner
$sql = "SELECT a.*, b.*, c.* FROM Passenger a, Book b, BusTrip c WHERE a.PassengerID = $PassengerID AND a.PassengerID = b.PassengerID AND b.TripID = c.TripID";
$results = mysqli_query($link, $sql);

if(!$results){
  die('Invalid query: ' . mysqli_error());
}

//display all information in a table

if(mysqli_num_rows($results) == 0){
echo '<h1> No Active Bookings </h1>';
}else{

echo '<h1> Passenger Booking </h1>';

echo "<table border='1'>
<tr>
<th>Passenger ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Booking ID</th>
<th>Price</th>
<th>Trip ID</th>
<th>Trip Name</th>
<th>Country Visited</th>
<th>Start Date</th>
<th>End Date</th>
<th>Delete Booking</th>
</tr>";

while($output = mysqli_fetch_array($results)){
?>
<!---Add a form to the table that is displaying the bookings in order to add deletion functionality --->

<form action= "deleteBooking.php" method ="post">
<tr>

<?php
  echo "<td>" . $output['PassengerID'] . "</td>";
  echo "<td>" . $output['FirstName'] . "</td>";
  echo "<td>" . $output['LastName'] . "</td>";
  echo "<td>" . $output['BookID'] . "</td>";
  echo "<td>" . $output['Price'] . "</td>";
  echo "<td>" . $output['TripID'] . "</td>";
  echo "<td>" . $output['TripName'] . "</td>";
  echo "<td>" . $output['CountryVisted'] . "</td>";
  echo "<td>" . $output['StartDate'] . "</td>";
  echo "<td>" . $output['EndDate'] . "</td>";
  echo "<input type='hidden' id='BookID' name='BookID' value =" . $output['BookID']  . ">";
?>
<!---Warning user that deletion is final --->

<td style="text-align:center"> <input type="submit" name="Delete" value="Delete" onclick='return confirm("Deletions are Permanent, Are you sure?");' /> </td>

<tr>

</form>

<?php
}

echo "</table>";

echo "<br><br>";

}

mysqli_close($link);
?>
<!---Buttons to return home and back to previous page --->

<form action="displayPassengers.php" class = "ReturnButton">
    <br>
    <input type="submit" value="Go Back" />
    <br>
</form>
<form action="homepage.php" class = "ReturnButton">
    <br>
    <input type="submit" value="Go Home" />
    <br><br><br>
</form>

</html>
