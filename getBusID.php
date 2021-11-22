<!---Author:45 --->

<?php
//this page is used in conjuntion with the homepage to display all the different Bus options for selection
 include "connect.php";
 $dbselected = mysqli_select_db($link, DB_name);

 if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
 }

 $sql = "SELECT * FROM Bus";
 $result = mysqli_query($link,$sql);

if (!$result) {
  die("databases query failed.");
 }

 //display all possible license plates for the busses
 while ($row = mysqli_fetch_assoc($result)) {
  echo "<option value= \"" . $row["LicensePlate"] . "\">";
  echo $row["LicensePlate"];
  echo "</option>";
  echo "\n";
 }
 mysqli_free_result($result);
 mysqli_close($link);

?>
