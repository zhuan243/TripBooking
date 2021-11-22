<!---Author:45 --->
<!DOCTYPE html>
<html>
<!---Header for page includes a font from google --->
<head>
        <title>Delete Booking</title>
        <link rel="stylesheet" type="text/css" href="trip.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
</head>
<!---The page is used to delete a selected booking --->

<h1 class="PageHeader">
        DELETE BOOKING
</h1>

<br>

<?php
//connect to database
include "connect.php";
$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}
//get Book ID as an integer
$BookID = (is_numeric($_POST['BookID']) ? (int)$_POST['BookID'] : 0);

//delete query with the Book ID
$sqldel = "DELETE FROM Book WHERE BookID = $BookID";
$resultsDel = mysqli_query($link, $sqldel);

if(!$resultsDel){
 die('Unknown Error');
}

//throw out deletion successful message
echo "<br> <h1 class='SectionHeader'> Deletion Successful </p1> <br>";


mysqli_close($link);
?>

<form action="homepage.php" class = "ReturnButton">
    <input type="submit" value="Go Home" />
    <br><br>
</form>


</html>
