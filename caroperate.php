<html>
	<head>
		<title>Perodua Car List and Operation</title>
		<style media="screen" type="text/css">
			
			html, body
			{
				width:100%; height: 100%; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:16px;
			}
			
			#header {
				padding:2px;
				background:#A9A9A9;
				text-align:center;
				color:darkblue;
				padding: 10 10 8 10;
			}
			
			#footer {
				clear:both;
				padding:10 10 8 10;
				background:#A9A9A9;				
				text-align:center;
				color:darkblue;
				font-family:arial,tahoma;
				font-size:15px;
				margin-top:100px;
			}
			
			table{				
				margin: auto;
				width:auto;
				height:auto;
				padding:5px;
				background-color: #ddf;
				color:darkblue;
			}	
			
			th, td {
				border: 1px solid black;
			}
			
			#backButton
			{				
				width:700px;				
				
			}
		</style>
		<script>
			function pagechange()
			{
				
				window.location = "http://localhost/peroduacarservice/index.php";
				
				
			}	
		</script>
		
	</head>
	<body style="background:#ddf">
	<div id="header">
			<h2>Perodua Car Service Center</h2>
			<h2>P E R O D U A&nbsp;&nbsp;&nbsp;&nbsp; C a r&nbsp;&nbsp;&nbsp;&nbsp;  List&nbsp;&nbsp;&nbsp;&nbsp; for&nbsp;&nbsp;&nbsp;&nbsp; Appointment</h2>		
	</div>
	<?php
	   
		$conn = mysqli_connect('localhost','root','mysql','peroduacarservice')
		or die('Error connecting to MySQL server.');
		//echo 'Connected successfully';
		$email = "";
		
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		if(!empty($_SESSION['ownid'])){
				$ownerid = $_SESSION['ownid'];
		}
		
		if(!empty($_SESSION['email'])){
				$email = $_SESSION['email'];
				//echo "Your email in carlist.php is ".$email;
		}
		
		$ST = "superman@gmail.com";
		
		if(strcmp($email,$ST) == 0)//admin
		{
			$query = "SELECT * FROM perocar";
		}
		else  //user
		{
			$query = "SELECT * FROM perocar where ownerID= ".$ownerid."";
			//echo "filter query is ok";
		}
		
		mysqli_query($conn, $query) or die('Error querying database.');
		//	echo $query;
		
		/*$result=mysqli_query($conn,$query);*/
		//echo $result;
		//*******************
		// get the records from the database
		if($result = $conn->query($query))//($result=mysqli_query($conn,$query))
		{
			// display records if there are records to display
			if ($result->num_rows > 0)
			{
				// display records in a table
				echo "<table border='2' cellspacing='2' cellpadding='3'>";

				// set table headers
				echo "<tr>
					  <th>ID</th>
					  <th>Brand</th>
					  <th>Model</th>
					  <th>Color</th>
					  <th>Serial No</th>
					  <th>Car Engine</th>
					  <th>Capacity</th>
					  <th>Horse Power</th>
					  <th>Car No</th>
					  <th>Register No</th>
					  <th></th>
					  </tr>";

				while ($row = $result->fetch_object())
				{
					// set up a row for each record
					echo "<tr>";
					echo "<td>" . $row->carid . "</td>";
					echo "<td>" . $row->brand . "</td>";
					echo "<td>" . $row->model . "</td>";
					echo "<td>" . $row->color . "</td>";
					echo "<td>" . $row->chasno . "</td>";
					echo "<td>" . $row->carengine . "</td>";
					echo "<td>" . $row->capacity . "</td>";
					echo "<td>" . $row->horsepower . "</td>";
					echo "<td>" . $row->carno . "</td>";
					echo "<td style='color:red'>" . $row->toyoRegNo . "</td>";
					echo "<td><a href='appoint.php?id=" . $row->toyocarID . "'>Appoint</a></td>";
					/* echo "<td><a href='cardelete.php?id=" . $row->carid . "'>Car Delete</a></td>"; */
					echo "</tr>";
				}

				echo "</table>";
			}
			// if there are no records in the database, display an alert message
			else
				{
					echo "No results to display!";
				}
		}
		// show an error if there is an issue with the database query
		else
		{
			echo "Error: " . $conn->error;
		}

		// close database connection
		$conn->close();
		
		?>	
		
		<br>
		<center>
			<div id="backbutton">
				<button type="button" onClick="pagechange()">Back</button>
			</div>
		</center>
		<br>
		<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>	
	</body>
</html>