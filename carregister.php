<html>
	<head>
		
		<title>Toyota Car Register</title>
		
		<style media="screen" type="text/css">		
			
			html, body
			{
				width:100%; height: 100%; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:16px;
				float:auto;
				color:blue;
			}
			
			#header {
				padding:2px;
				background:#A9A9A9;
				text-align:center;
				color:darkblue;
				padding: 10 10 10 10;
			}
			
			#footer {
				clear:both;
				padding:12px;
				background:#A9A9A9;
				text-align:center;
				font-size:15px;
				color:darkblue;
				
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
			
			#carscreen{
				
				background:#ddf;
				width:660px;
				border:2px solid green;margin-top:0px;
				padding:2 2 2 2;
				height:80%;
				margin:auto;
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
			
			if(!empty($_SESSION['ownid'])){
				
				$ownid = $_SESSION['ownid'];
			}
			
			if(isset($_POST['submit']))
			{
				//retrieve last reg no from car table 
				$queryreg = "SELECT peroRegNo FROM perocar WHERE peroCarID=(SELECT MAX(peroCarID) FROM perocar)";
					
				$regDb = retrieveMaxRegNo($queryreg);//function call to dataProcess php file				
				echo 'MAX regno from database is '. $regDb;				
				
				$newregno = calculateRegNo($regDb);//new reg no is created
				echo "new reg number is " . $newregno;
				
				$_SESSION["newreg"] = $newregno;//session variable
				echo "session var is ".$_SESSION["newreg"];							
				
				//save cars information into database
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
				echo 'MAX carno from database is '. $lastCarID;	

				//save carowners information into database
				$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");
				
				$query4 = "INSERT INTO perocarowner(peroCarID, ownerID)
				VALUES ('".$lastCarID."','".$ownid."')";
				
				$conn->query($query4);
				$conn->close();	
				header('Location: http://localhost/peroduacarservice/index.php');
			}
	
	?>
		<div id="header">
				<h2>Perodua Service Center</h2>
				<h3>P E R O D U A &nbsp;&nbsp;&nbsp;&nbsp; C a r &nbsp;&nbsp;&nbsp;&nbsp;  R e g i s t r a t i o n</h3>
		</div> 
		<br><br>
		<div id="carscreen">
		<form action="carregister.php" method="POST">
			<br>
			<label>*Model:</label>
				<input type="text" name="peroModel" size="50" required><br/><br/>

				<label>*Year</label>
				<input type="text" name="peroYear" size="10" required><br/><br/>
				
				<label>*Car Number:</label>
				<input type="text" name="peroCarNo" size="30" required>
				<br><br>
				
				<label>*Fuel Type:</label>
				<select name="peroFuelType" id="fuel" size="1" required>
						  <option value="petrol">Petrol</option>			  
						  <option value="diesel">Diesel</option>
				</select><br><br>
				
				
				<label>Color:</label>
				<select name="peroColor" id="color" size="1">
						  <option value="Lava Red">Lava Red</option>
						  <option value="Peppermint Green">Peppermint Green</option>
						  <option value="Granite Grey">Granite Grey</option>
						  <option value="Mystical Purple">Mystical Purple</option>
						  <option value="Glittering Silver">Glittering Silver</option>
						  <option value="whiIvory Whitete">Ivory White</option>
				</select><br><br>

				
				<label>Transmission:</label>
				<select name="peroTransmission" id="color" size="1">
						  <option value="Automatic">Automatic</option>
						  <option value="Manual">Manual</option>
				</select><br><br>

				
				<label>Milleage:</label>
				<input type="text" name="peroMilleage" size="10"> KPL<br><br>

				<label>Engine Power:</label>
				<input type="text" name="peroEnginePower" size="10"> KW<br><br>

				<label>Engine Type:</label>
				<input type="text" name="peroEngineType" size="10"> CC<br><br>

				<center>
					<input type="submit" name="submit" value="submit">
				</center>

		</form>	
		</div>

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