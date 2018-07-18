<html>
	<head>
		<title>Appointment List and Operation</title>
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
			<h3>A p p o i n t m e n t&nbsp;&nbsp;&nbsp;&nbsp;L i s t</h3>		
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
		
		$Pstatus = "confirmed";
		
		if(strcmp($email,$ST) == 0)//admin
		{
			$query = "SELECT peroowner.ownerID, peroowner.ownerName,
			perocar.peroCarID, perocar.peroModel, perocar.peroYear, perocar.peroColor,
			perocar.peroCarNo, perocar.peroRegNo,
			peroappointment.peroAppID, peroappointment.peroAppDateTime, peroappointment.peroEmployee,
			peroappointment.peroAppStatus FROM peroappointment
			INNER JOIN perocarappointment ON peroappointment.peroAppID=perocarappointment.peroAppID
			INNER JOIN perocar ON perocar.peroCarID=perocarappointment.peroCarID
			INNER JOIN perocarowner ON perocar.peroCarID=perocarowner.peroCarID
			INNER JOIN peroowner ON peroowner.ownerID=perocarowner.ownerID
			WHERE  peroappointment.peroAppStatus='".$Pstatus."'";
		}
		else  //user
		{
			$query = "SELECT peroowner.ownerID, peroowner.ownerName,
			perocar.peroCarID, perocar.peroModel, perocar.peroYear, perocar.peroColor,
			perocar.peroCarNo, perocar.peroRegNo,
			peroappointment.peroAppID, peroappointment.peroAppDateTime, peroappointment.peroEmployee,
			peroappointment.peroAppStatus FROM peroappointment
			INNER JOIN perocarappointment ON peroappointment.peroAppID=perocarappointment.peroAppID
			INNER JOIN perocar ON perocar.peroCarID=perocarappointment.peroCarID
			INNER JOIN perocarowner ON perocar.peroCarID=perocarowner.peroCarID
			INNER JOIN peroowner ON peroowner.ownerID=perocarowner.ownerID
			WHERE  peroappointment.peroAppStatus='".$Pstatus."'";
			//status confirm
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
			//echo "num_rows from appointment  query= ".$result->num_rows;
			// display records if there are records to display
			if ($result->num_rows > 0)
			{
				// display records in a table
				echo "<table border='2' cellspacing='2' cellpadding='3'>";

				// set table headers
				echo "<tr>
					  <th>Appointment ID</th>
					  <th>Appointment Date Time</th>
					  <th>Employee</th>
					  <th>Status</th>
					  <th>Reg No</th>
					  <th>Model</th>
					  <th>Car No</th>
					  <th>Owner No</th>
					  <th>Owner Name</th>
					  <th></th>
					  </tr>";

				while ($row = $result->fetch_object())
				{
					// set up a row for each record
					echo "<tr>";
					echo "<td>" . $row->peroAppID . "</td>";
					echo "<td style='color:red'>" . $row->peroAppDateTime . "</td>";
					echo "<td style='color:red'>" . $row->peroEmployee . "</td>";
					echo "<td>" . $row->peroAppStatus . "</td>";
					echo "<td style='color:red'>" . $row->peroRegNo . "</td>";
					echo "<td>" . $row->peroModel . "</td>";
					echo "<td>" . $row->peroCarNo . "</td>";
					echo "<td>" . $row->ownerID . "</td>";
					echo "<td>" . $row->ownerName . "</td>";
							
					/*
						//$regno = getRegNo($query);
						if ($result2=mysqli_query($conn,$query))
						{
							//echo "Result in while loop before fetch= ".$result;
							if($result2 != NULL)
							{
								// Get field information for all fields
								if ($fieldinfo=mysqli_fetch_object($result2))
								{					
									echo "<td style='color:red'>" . $fieldinfo->peroRegNo . "</td>";
									echo "<td>" . $fieldinfo->peroModel . "</td>";
									echo "<td>" . $fieldinfo->peroCarNo . "</td>";
									echo "<td>" . $fieldinfo->ownerID . "</td>";
									echo "<td>" . $fieldinfo->ownerName . "</td>";
									//$checkLog = True;			
								}
								
								// Free result set
								 mysqli_free_result($result2);
								//echo "login email get from database inner db code is ".$_SESSION['email'];
								//echo "login name get from database inner db code is ".$_SESSION['ownname'];
							}
							else{
										
										echo "sql result is null";
								}
						}		
						*/			
											
									
					
					echo "<td><a href='appointcancel.php?id=" . $row->appointid . "'>Cancel Appoint</a></td>";
					/* echo "<td><a href='deletecar.php?id=" . $row->carid . "'>Car Delete</a></td>"; */
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