<!---Author:45 --->
<?php
//get all the connection information
define ('DB_host','localhost');
define ('DB_user','root');
define ('DB_password','cs3319');
define ('DB_name','45_assign2db');

//connect to the relevant database and throw errors if there was issue connecting
$link = mysqli_connect(DB_host,DB_user,DB_password);

if(!$link){
  die('could not connect' . mysqli_error());
}

$dbselected = mysqli_select_db($link, DB_name);

if(!$dbselected){
  die('could not connect to ' . DB_name . ': ' . mysqli_error());
}

?>
