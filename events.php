<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Events in the North East">
		<meta name="author" content="Mateusz Beclawski">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Events</title>
	</head>
	<body>
		<div class="grid-container">
			<header>
				<a href="index.html"><img id="logo" src="photos/logo.png" alt="logo"></a>
			</header>
			<nav class="navi" id="mNav">
				<ul>
		  			<li><a href="index.html">HOME</a></li>
		  			<li><a class="active" href="events.php">VIEW EVENTS</a></li>
		  			<li><a href="admin.php">ADMIN</a></li>
		  			<li><a href="credits.html">CREDITS</a></li>
		  			<li><a href="wireframe.html">WIREFRAME</a></li>
		  			<li class="icon"><a href="javascript:void(0);" onclick="navFunction()">
    				<i class="fa fa-bars"></i></a></li>
				</ul>
			</nav>
			<main>
				<?php
				include 'database_conn.php'; # Connect to the database
				$sql = "SELECT eventTitle, eventDescription, venueName, catDesc, eventStartDate, eventEndDate, eventPrice
						FROM NEE_events
						INNER JOIN NEE_venue
						ON NEE_venue.venueID = NEE_events.venueID
						INNER JOIN NEE_category
						ON NEE_category.catID = NEE_events.catID
						GROUP BY eventID
						ORDER BY eventTitle ASC"; #Query to select all events and information about them, then order them in alphabetical order.
				$queryResult = $dbConn->query($sql); #Send the query to database
				if($queryResult === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; #If query fails show error message
	exit;
  }
   else {
     while($rowObj = $queryResult->fetch_object()){ #Loop which takes result from query until there is no more results
					echo "<div class='event'>
						<img class='eimg' src='photos/{$rowObj->catDesc}.jpg' alt='{$rowObj->catDesc}'>
						<h2>{$rowObj->eventTitle}</h2>
						<hr>
						<p><strong>Description: </strong>{$rowObj->eventDescription}</p>
						<hr>
						<p><strong>Start date: </strong>{$rowObj->eventStartDate}</p>
						<hr>
						<p><strong>End date: </strong>{$rowObj->eventEndDate}</p>
						<hr>
						<p><strong>Venue: </strong>{$rowObj->venueName}</p>
						<hr>
						<p><strong>Category: </strong>{$rowObj->catDesc}</p>
						<hr>
						<p><strong>Price: </strong>&#163;{$rowObj->eventPrice}</p>
					</div>";
				}
			}
				  $queryResult->close(); #Close query
  				  $dbConn->close(); #Close a connection with database
			?>
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