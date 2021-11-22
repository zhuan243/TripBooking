<!---Author:45 --->
<?php

//purpose of this page is to list all countries for selection to be used in conjunction with home page
 include "connect.php";
 $dbselected = mysqli_select_db($link, DB_name);

 if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
 }

 $sql = "SELECT DISTINCT CountryVisted FROM BusTrip";
 $result = mysqli_query($link,$sql);

if (!$result) {
  die("databases query failed.");
 }
 while ($row = mysqli_fetch_assoc($result)) {
  echo "<option value= \"" . $row["CountryVisted"] . "\">";
  echo $row["CountryVisted"];
  echo "</option>";
  echo "\n";
 }
 mysqli_free_result($result);
 mysqli_close($link);

?>
