<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Events in the North East">
		<meta name="author" content="Mateusz Beclawski">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin</title>
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
				<form action="addevent.php" method="post">
     <h1>Create a new event:</h1>
     <p class='rfield'>* required field</p>
     <fieldset>
         <legend>About Event</legend>
         <label>Event Title:
          <br>
             <input type="text" name="title" accesskey="t"  required>
             <span class='rfield'>*</span>
         </label>
         <br>
         <label>Description:
          <br>
             <textarea name="desc" rows="10" cols="50" rows accesskey="d"></textarea>
         </label>
         <br>
         <label>Start Date:
          <br><input type="date" name="startDate" accesskey="s" required>
         <span class='rfield'>*</span>
         </label>
         <br>
         <label>End Date:
          <br><input type="date" name="endDate" accesskey="e" required>
         <span class='rfield'>*</span>
         </label>
         <br>
         <label>Price:
          <br><input type="number" name="price" accesskey="p">
         </label>
         <br>
         	<?php
  include 'database_conn.php'; # Connect to the database
  $sqlcat = "SELECT catID, catDesc FROM NEE_category ORDER BY catID"; # Query to select all Category ID's and Descriptions
  $sqlven = "SELECT venueID, venueName FROM NEE_venue ORDER BY venueID"; # Query to select all Venue ID's and Names
  $queryResultC = $dbConn->query($sqlcat); # Send a query to database
  $queryResultV = $dbConn->query($sqlven); # Send a query to database
  if($queryResultC === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; #Show the error message if there is a problem with query
	exit;
  }
  else {
  	echo "<label>Event category:<br><select name='cat'>";
     while($rowObj = $queryResultC->fetch_object()){ 
	echo "<option value='{$rowObj->catID}'>{$rowObj->catDesc}</option>"; #Assign Category description and value of ID to the option
     }
     echo "	</select><span class='rfield'>*</span></label><br>";
  }
  $queryResultC->close(); #Close Query
  if($queryResultV === false) {
	echo "<p>Query failed: ".$dbConn->error."</p>\n</body>\n</html>"; #Show the error message if there is a problem with query
	exit;
  }
  else {
		echo "<label>Venue:<br><select name='venue'>";
     while($rowObj = $queryResultV->fetch_object()){
	echo "<option value='{$rowObj->venueID}'>{$rowObj->venueName}</option>"; #Assign Venue name and value of ID to the option
     }
     echo "</select><span class='rfield'>*</span></label>";
  }
  $queryResultV->close(); #Close Query
  $dbConn->close(); #Close connection with database
?>
     </fieldset>
     <div>
        <input type="submit" value="Submit" accesskey="u">
     </div>
</form>	
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