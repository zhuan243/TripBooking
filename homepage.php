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

<body>

<!--- The page title and subtitle --->
<h1 class="PageHeader">
	TRIPS & BOOKINGS
	<strong> A trip organizer </strong>
</h1>

<h1 class = "SectionHeader">
	Show and Edit Bus Trips
</h1>

<!---Form to get information to submit to display trips page --->

<form action="displayTrips.php" method="post">

<br>

<p> Which attribute to order by: </p>
<input type="radio" id="TripName" name="OrderBy" value="TripName" required>
<label for="TripName"> Trip Name </label>

<input type="radio" id="Country" name="OrderBy" value="CountryVisted">
<label for="Country"> Country </label>

<br><br>

<!---Allow user to pick which order to display information in--->

<p> In which order: </p>
<input type="radio" id="Ascending" name="OrderIn" value="Asc" required>
<label for="Ascending"> Ascending </label>

<input type="radio" id="Descending" name="OrderIn" value="Desc">
<label for="Descending"> Descending </label>

<br><br>

<input type="submit" value="Submit"/>
<input type="reset"/>

<br><br>

</form>

<br>

<!---A form to add a trip by asking user for relevant information to toss to add trip page --->

<h1 class = "SectionHeader">
	Add New Bus Trip Data
</h1>

<form action="addTrip.php" method="post">
<br>

<label for="TripID"> Trip ID: </label>
<input type="number" id="TripID" name="TripID" required>

<br><br>

<label for="TripName"> Trip Name: </label>
<input type="text" id="TripName" name="TripName" required maxlength="50">

<br><br>

<label for="StartDate"> Start Date: </label>
<input type="date" id="StartDate" name="StartDate" required>

<br><br>

<label for="EndDate"> End Date: </label>
<input type="date" id="EndDate" name="EndDate" required>

<br><br>

<label for="CountryVisited"> Country Visted: </label>
<input type="text" id="CountryVisted" name="CountryVisted" required maxlength="30">

<br><br>

<label for="BusID"> Bus ID: </label>
<select name= "BusID" id="BusID" required>
  <?php
				//display all busses avaiable to add
        include "getBusID.php";
  ?>
</select>

<br><br>

<label for="urlmage"> URL: </label>
<input type="text" id="urlmage" name="urlmage" maxlength="255">

<br><br>

<input type="submit" value="Add Trip"/>
<input type="reset"/>
<br><br>
</form>

<!---Form to display the trips by user input of country --->

<h1 class = "SectionHeader">
        See Trips
</h1>

<form action="seeTrips.php" method="post">
<br>

<label for="CountryVisted"> Bus ID: </label>
<select name= "CountryVisted" id="CountryVisted" required>
  <?php
        include "getCountries.php";
  ?>
</select>

<br><br>

<input type="submit" value="See Trips"/>

<br><br>

</form>

<!---Form to add a booking with user given price, booking ID and the Bus used --->

<h1 class = "SectionHeader">
        Add Booking
</h1>

<form action="addBooking.php" method="post">
<br>

<label for="BookID"> Book ID: </label>
<input type="number" id="BookID" name="BookID" required>

<br><br>

<label for="Price"> Price: </label>
<input type="number" id="Price" name="Price" step="0.01" min=0 required>

<br><br>

<label for="PassengerID"> Bus ID: </label>
<select name= "PassengerID" id="PassengerID" required>
  <?php
				//display all available passengers to make a booking
        include "getPassenger.php";
  ?>
</select>

<br><br>

<label for="TripID"> Trip ID: </label>
<select name= "TripID" id="TripID" required>
  <?php
				//display all available trips
        include "getTrips.php";
  ?>
</select>


<br><br>

<input type="submit" value="Add Booking"/>

<br><br>
</form>

<!---Form and button to display the passengers and bookings --->

<h1 class = "SectionHeader">
	Show Passengers and Bookings
</h1>

<form action="displayPassengers.php" method="post">

<br>

<input type="submit" value="Show"/>

<br><br>

</form>

<!---Form and button to display all trips without bookings --->


<h1 class = "SectionHeader">
	Show Bus Trips Without Bookings
</h1>

<form action="tripsWithNoBook.php" method="post">

<br>

<input type="submit" value="Show"/>

<br><br>

</form>

</body>

</html>
