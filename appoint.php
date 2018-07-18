<html>
	<head>
	<title>Appointment Form</title>
	<style media="screen" type="text/css">		
			
			html, body
			{
				width:100%; height: 100%; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:16px;
				margin:auto;
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
			#svice option{
				width:200px;
			}
						
			label
			{
				 display:inline-block;width:200px; text-align:left;
			}
			
			form{
				
				text-align:left;
				color:blue;
				margin:auto;
				overflow:hidden;
			
			}			
			
			#appscreen{
				
				background:#ddf;
				width:660px;
				border:2px solid green;margin-top:0px;
				padding:10 10 10 10;
				height:60%;
			}
		</style>
		<script>
			function pagechange()
			{
				
				window.location = "http://localhost/peroduacarservice/caroperate.php";
				
				
			}	
		</script>
	</head>
	<body>		
		
		<?php include 'dataProcess.php';?>	
		<?php
		
			if(!isset($_SESSION))
			{
				session_start();
			}				
			
			if(isset($_GET['id']))
			{
				$carid = $_GET['id'];//take appoint car id
				$_SESSION['carid'] = $carid;
			}
			//echo "car id to make appointment is ".$carid;
			
			$query = "select peroRegNo from car where peroCarID=".$carid."";
			$regno = getRegNo($query);//to display in appointment form
			//echo "car reg no to make appointment is ".$regno;
			
			if(isset($_POST['submit']))
			{
					$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");
					
					$appstatus = "confirmed";		
					
					if(!empty($_SESSION['ownid'])){
						$ownerid = $_SESSION['ownid'];
					}
					
					if(!empty($_SESSION['carid'])){
						$carid = $_SESSION['carid'];
					}
					
					$query3 = "INSERT INTO appointment(reqappdate, reqapptime, servicetype,appstatus,remark,ownerid,carid)
					VALUES ('".$_POST['apdate']."','".$_POST['aptime']."','".$_POST['svice']."','".$appstatus."','".$_POST['remark']
					."',".$ownerid.",".$carid.")";
							
					$conn->query($query3);
					$conn->close();		
					header('Location: http://localhost/carservice/caroperate.php');
			}
		?>
		<div id="header">
				<h2>Super Man Car Service Center</h2>
				<h3>A p p o i n t m e n t &nbsp;&nbsp;&nbsp;&nbsp;for&nbsp;&nbsp;&nbsp;&nbsp;S E R V I C E</h3>
		</div> 
		
		<br><br>	
		<center>
		<div id="appscreen">
		<form action="appoint.php" method="POST">
			<?php "<h3>"."Your Car Registration No is ".$regno."</h3>";?>
			<label>Car Registration Number</label>
				<input type="text" name="rgno" size="50" style="font-size:16px;font-weight:bold" value=<?php echo $regno ?> disabled><br><br>
			<label>*Appointment Date:</label>
				<input type="date" name="apdate" size="30"><br><br>
			<label>*Appointment Time:</label>
				<input type="time" name="aptime" placeholder="hh:mm:ss" size="30"><br><br>
			<label>*Service Type:</label>
				<select name="svice" id="svice" size="1">
						  <option value="Oil and filter">Oil and filter change</option>			  
						  <option value="New air filter">New air filter</option>
						  <option value="New fuel filter">New fuel filter</option>
						  <option value="New spark plugs">New spark plugs</option>
						  <option value="Removal of wheels and brakes checked">Removal of wheels and brakes checked</option>
						  <option value="Wheel bearings checked">Wheel bearings checked for excessive play</option>
						  <option value="Brake cylinders, pipes and hoses checked">Brake cylinders, pipes and hoses checked for leaks or damage</option>
						  <option value="Suspension checkeds">Suspension checked for wear or damage</option>
						  <option value="Handbrake operation checked">Handbrake operation checked and adjusted if necessary</option>
						  <option value="Brake fluid tested">Brake fluid tested and replaced if necessary</option>
						  <option value="Tyres checked">Tyres checked for wear, damage and signs of misalignment</option>
						  <option value="Clutch operation">Clutch operation checked</option>
						  <option value="Exhaust system checked">Exhaust system checked for corrosion, damage or leaks</option>
						  
				</select><br><br>
				<label>Remark</label>
					<textarea rows="2" cols="27" name="remark" wrap="hard"></textarea>				
				<br><br>
				<center>
					<input type="submit" name="submit" value="submit">&nbsp;&nbsp;
					<button type="button" onClick="pagechange()">Cancel</button>
					
				</center>
		</form>	
		</div>
		</center>
		
		<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>
	</body>	
</html>