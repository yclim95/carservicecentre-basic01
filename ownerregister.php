
<html>
	<head>
		<title>Owner Register</title>
		<style media="screen" type="text/css">		
			
			html, body
			{
				width:100%; height: 100%; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:14px;
			}
			
			#header {
				padding:2px;
				background:#A9A9A9;
				text-align:center;
				color:darkblue;
				padding: 5 10 3 10;
			}
			
			#footer {
				clear:both;
				padding:12px;
				background:#A9A9A9;
				text-align:center;
				color:darkblue;
				font-size:15px;
			}
			
			#container
			{
				width:779px;
				margin:auto;	
			}
			#leftscreen{
				float:left;
				background:#ddf;
				width:45%;	
				border:2px solid green;				
				padding:2 1 7 3;
				height:80%;
				margin-top:0px;
				
			}
			#rightscreen{
				float:right;
				background:#ddf;
				width:50%;
				border:2px solid green;margin-top:0px;
				padding:2 4 3 4;
				height:80%;
				margin-top:0px;
			}
		
			form{
				text-align:left;
				color:blue;
				margin:auto;
				overflow:scroll;
			
			}				
			
			#brand option{
				width:175px;
			}
			
			#caren option{
				width:175px;
			}
			
			#township option{
				width:175px;
			}
			
			#color option{
				width:175px;
			}	
			
			
			label
			{
				 display:inline-block;width:200px; text-align:left;
			}
			
			#subbutton
			{				
				
				float:right;
				padding:10 10 10 10;
				margin-top:25px;
				
							
			}
			
			#regsubmit
			{
				height:30px;
				width:100px;
				border:2 none;
				-webkit-border-radius:5px;
				border-radius:5px; 
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
	
		<?php include 'dataProcess.php';?>		
		
		<?php
		
			if(!isset($_SESSION))
			{
				session_start();
			}
			
			//to set grant level
			if(isset($_POST['submit']))
			{
				if($_POST['email'] == "ironman@gmail.com")//he is admin
				{
					$user='admin';
					//echo $user;
				}
				else
				{
					$user='user';	//grantlevel	
				}
				
				//save owners information into database
				
				$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");
				$query = "INSERT INTO peroowner(ownerName,address,contactNo,dateOfBirth,email,password,grantLevel)
				VALUES ('".$_POST["ownerName"]."','".$_POST["address"]."','".$_POST["contactNo"]."','".$_POST["dateOfBirth"]."','".$_POST["email"]."','".$_POST["password"]."','".$user."')"; 
				
				//$conn->query($query);
				//$conn->close();
				//find the last ID from owner table 
				$last_id = 1;
				if ($conn->query($query) === TRUE) {
							$last_id = $conn->insert_id;
							
							//echo "New record created successfully. Last inserted ID is: " . $last_id;
					} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
						   }

				echo "last owner id = ".$last_id;
				$conn->close();//close connection		
								
				//save car information into database
				
				$queryreg = "SELECT peroRegNo FROM perocar WHERE peroCarID=(SELECT MAX(peroCarID) FROM perocar)";
				
				$regDb = retrieveMaxRegNo($queryreg);//function call to dataProcess php file				
				echo 'MAX regno from database is '. $regDb;				
				
				$newregno = calculateRegNo($regDb);
				echo "new reg number is " . $newregno;
						   
				$_SESSION["newreg"] = $newregno;//session variable
				echo "session var is ".$_SESSION["newreg"];
				
				$_SESSION["owname"] = $_POST['ownerName'];//session variable
				echo "session var is ".$_SESSION["owname"];
								
				$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");
								
				$query3 = "INSERT INTO perocar(peroCarNo, peroModel, peroYear, peroColor, peroFuelType,peroTransmission,peroMilleage,peroEnginePower,peroEngineType,peroRegNo)
				VALUES ('".$_POST["peroCarNo"]."','".$_POST["peroModel"]."','".$_POST["peroYear"]."',
				'".$_POST["peroColor"]."','".$_POST["peroFuelType"]."','".$_POST["peroTransmission"]."',
				'".$_POST["peroMilleage"]."KPL','".$_POST["peroEnginePower"]."KW','".$_POST["peroEngineType"]."CC','".$newregno."')";
				
				$conn->query($query3);
				$conn->close();	
				
				//find maximum car id									
				$querycar = "SELECT peroCarID FROM perocar WHERE peroCarID=(SELECT MAX(peroCarID) FROM perocar)";
				
				$lastCarID = retrieveMaxcarNo($querycar);//function call to dataProcess php file				
				echo 'MAX perocarNo from database is '. $lastCarID;	
				
				//save carowners information into database
				$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");	
				
				$query4 = "INSERT INTO perocarowner(peroCarID, ownerID)
				VALUES ('".$lastCarID."','".$last_id."')";
				
				$conn->query($query4);
				$conn->close();	
				//header("Location:temp.php?user=".$user);
				header('Location: http://localhost/peroduacarservice/welcome.php');
	
			}

		?>
		<div id="header">
			<h2>Perodua Car Service Center</h2>
			<h3>O w n e r &nbsp; C a r  R e g i s t r a t i o n</h3>
		</div>
		
		<form action="ownerregister.php" method="POST"><br>
		<div id="rightscreen">				
				<br><br>
				<label style="font-family:arial;font-size:15px;font-weight:bold;width:300px">
					Please fill car information:
				</label>
				<br><br>

				<label>*Model:</label>
				<input type="text" name="peroModel" size="50" required><br/><br/>

				<label>Year</label>
				<input type="text" name="peroYear" size="10" ><br/><br/>
				
				<label>*Car Number:</label>
				<input type="text" name="peroCarNo" size="15" required>
				<br><br>
				
				<label>*Fuel Type:</label>
				<select name="peroFuelType" id="fuel" size="1" required>
						  <option value="petrol">Petrol</option>			  
						  <option value="diesel">Diesel</option>
				</select><br><br>
				
				
				<label>Color:</label>
				<select name="peroColor" id="color" size="1" >
						  <option value="Lava Red">Lava Red</option>
						  <option value="Peppermint Green">Peppermint Green</option>
						  <option value="Granite Grey">Granite Grey</option>
						  <option value="Mystical Purple">Mystical Purple</option>
						  <option value="Glittering Silver">Glittering Silver</option>
						  <option value="whiIvory Whitete">Ivory White</option>
				</select><br><br>

				
				<label>Transmission:</label>
				<select name="peroTransmission" id="color" size="1" >
						  <option value="Automatic">Automatic</option>
						  <option value="Manual">Manual</option>
				</select><br><br>

				
				<label>Milleage:</label>
				<input type="text" name="peroMilleage" size="10" > KPL<br><br>

				<label>Engine Power:</label>
				<input type="text" name="peroEnginePower" size="10" > KW<br><br>

				<label>Engine Type:</label>
				<input type="text" name="peroEngineType" size="10" > CC<br><br>
			
								
				<!--<label>Register Number:</label>
				<input type="text" size="30" name="regno" disabled><br>-->
		
		</div>
		<div id="leftscreen">
		<label style="font-family:arial;font-size:15px;font-weight:bold;width:400px">
				If you are a new customer, you register here.....
		</label>
		<br><br>
		
		<label style="font-family:arial;font-size:15px;font-weight:bold;width:400px">
			Please fill owner information:
		</label>
		<br><br>
		
		<label>*Owner Name:</label>
		<input type="text" name="ownerName" size="50" required>
		<br><br>
		
		<label>Address:</label>
		<textarea rows="2" cols="50" name="address" wrap="hard"></textarea>
		<br><br>

		<label>Date of Birth: (YYYY-MM-DD)</label>
		<input type="text" name="dateOfBirth" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" placeholder="Enter a date in format YYYY-MM-DD" size="50">
		<br><br>
			
		<label>*Phone:</label>
		<input type="phone" name="contactNo" size="20" required>
		<br><br>
		
		<label>*Email:</label>
		<input type="email" name="email" size="30" required>
		<br><br>
		
		<label>*Password:</label>
		<input type="password" name="password" size="30" required><br><br>
		<center>	
		
		<div id="subbutton">
			<input type="submit" id="regsubmit" name="submit" value="submit">
		</div>
		</center>
		
		</div>
		
		<br><br>
		
		</form>
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