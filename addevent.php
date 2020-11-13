<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Events in the North East">
		<meta name="author" content="Mateusz Beclawski">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Add Event</title>
	</head>
	<body>
		<div class="grid-container">
			<header>
				<a href="index.html"><img id="logo" src="photos/logo.png" alt="logo"></a>
			</header>
			<nav class="navi" id="mNav">
				<ul>
		  			<li><a href="index.html">HOME</a></li>
		  			<li><a href="events.php">VIEW EVENTS</a></li>
		  			<li><a class="active" href="admin.php">ADMIN</a></li>
		  			<li><a href="credits.html">CREDITS</a></li>
		  			<li><a href="wireframe.html">WIREFRAME</a></li>
		  			<li class="icon"><a href="javascript:void(0);" onclick="navFunction()">
    				<i class="fa fa-bars"></i></a></li>
				</ul>
			</nav>
			<main>
				<div>
					<?php
  include 'database_conn.php'; # Connect to the database
  	$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : null; #Variable requesting for title. If title is empty set variable to null. 
	$desc = isset($_REQUEST['desc']) ? $_REQUEST['desc'] : null; #Variable requesting for description. If description is empty set variable to null. 
	$cat = $_REQUEST['cat']; # Category id of new event
	$venue = $_REQUEST['venue']; # Venue id of new event
	$sqlC = "SELECT catDesc FROM NEE_category WHERE catID='$cat'"; #Query to select category description
	$sqlV = "SELECT venueName FROM NEE_venue WHERE venueID='$venue'"; #Query to select venue name
	$catQuery = $dbConn->query($sqlC); # Send a query to database
  	$venQuery = $dbConn->query($sqlV); # Send a query to database
  	$catName = $catQuery->fetch_object(); # Category name
  	$venName = $venQuery->fetch_object(); # Venue name
	$startDate = $_REQUEST['startDate']; #Start date
	$endDate = $_REQUEST['endDate']; # End date
  	$price = isset($_REQUEST['price']) ? $_REQUEST['price'] : null; #Price
  	$sql = "INSERT INTO NEE_events (eventTitle, eventDescription, venueID, catID, eventStartDate, eventEndDate, eventPrice)
VALUES ( '$title', '$desc', '$venue', '$cat', '$startDate', '$endDate', '$price')"; # Query to insert a new event to database
  	if($startDate > $endDate){
  		exit("End Date must be later than Start Date. New event cannot be created.");
  	}
  	if ($dbConn->query($sql) === TRUE) {
    echo "<h1>New event has been created:</h1><div class='event'>
						<img class='eimg' src='photos/{$catName->catDesc}.jpg' alt='{$catName->catDesc}'>
						<h2>$title</h2>
						<hr>
						<p><strong>Description: </strong>$desc</p>
						<hr>
						<p><strong>Start date: </strong>$startDate</p>
						<hr>
						<p><strong>End date: </strong>$endDate</p>
						<hr>
						<p><strong>Venue: </strong>{$venName->venueName}</p>
						<hr>
						<p><strong>Category: </strong>{$catName->catDesc}</p>
						<hr>
						<p><strong>Price: </strong>$price</p>
					</div>";
	}
	 else {
    echo "Error: " . $sql . "<br>" . $dbConn->close(); #Show error message if query fails
	}
	$catQuery->close();
	$venQuery->close();
	$dbConn->close();
?>
</div>

			</main>
			<footer>
				<p>Mateusz Beclawski. Student ID: 18030605</p>
				<button id="btop" onclick="window.location.href = '#top';">Top</button>
			</footer>
		</div>
		<script>
			function navFunction() {
 				var a = document.getElementById("mNav");
  				if (a.className === "navi") {
    				a.className += " mobile";
  				} 
  				else {
    				a.className = "navi";
    			}
    		}
		</script>
	</body>
</html>