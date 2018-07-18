<html>
	<head>
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
		<h2>P E R O D U A&nbsp;&nbsp;&nbsp;&nbsp; C a r&nbsp;&nbsp;&nbsp;&nbsp; L i s t</h2>		
	</div>
	
	<?php if(isset($_GET['$flag']) && $_GET['$flag'] == true){?>					
				
		<div id="footer">
			<h3 style="color:red">
				Your record is successfully deleted!
			</h3>
		</div>
							
	<?php } ?>
	
	<?php
	   	
		if(isset($_GET['$flag']))
		{
			echo "del flag= ".$_GET['$flag'];
		}
		
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
		
		$isAdmin = false;
		
		$ST = "ironman@gmail.com";
		
		if(strcmp($email,$ST) == 0)//admin
		{
			$query = "SELECT * FROM perocar";
			$isAdmin = true;
		}
		else  //user
		{
			$query = "SELECT * FROM perocar where peroCarID in(select peroCarID from perocarowner where ownerID= ".$ownerid.")";
			//echo "filter query is ok";
		}
		
		mysqli_query($conn, $query) or die('Error querying database.');
		//	echo $query;
		
		$result=mysqli_query($conn,$query);
		
		if($result){
			
			 if($result->num_rows === 0)
			{
				echo "<h3>".'No result for car '. "<h3>";
			
			}else{
		?>
			
			<table border="3" cellspacing="2" cellpadding="2" >
				<tr>
					<th>
						<font face="Arial, Helvetica, sans-serif">Car ID</font>
					</th>				
					<th>
						<font face="Arial, Helvetica, sans-serif">Car No</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Car Model</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Year</font>
					</th>				
					<th>
						<font face="Arial, Helvetica, sans-serif">Fuel Type</font>
					</th>										
					<th>
						<font face="Arial, Helvetica, sans-serif">Color</font>
					</th>						
					<th>
						<font face="Arial, Helvetica, sans-serif">Transmission</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Milleage</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Engine Power</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Engine Type</font>
					</th>
					<th>
						<font face="Arial, Helvetica, sans-serif">Car Registered No</font>
					</th>
					<?php if($isAdmin == false){ ?>
						<th>&nbsp;</th>	
					<?php } ?>
				</tr>
				
				<?php
					while($row=mysqli_fetch_array($result)):?>
					<tr>
						<td><?php echo $row['peroCarID'];?></td>
						<td><?php echo $row['peroCarNo'];?></td>
						<td><?php echo $row['peroModel'];?></td>
						<td><?php echo $row['peroYEAR'];?></td>
						<td><?php echo $row['peroFuelType'];?></td>						
						<td><?php echo $row['peroColor'];?></td>
						<td><?php echo $row['peroTransmission'];?></td>
						<td><?php echo $row['peroMilleage'];?></td>
						<td><?php echo $row['peroEnginePower'];?></td>
						<td><?php echo $row['peroEngineType'];?></td>						
						<td style="color:red"><?php echo $row['peroRegNo'];?></td>		
						<?php if($isAdmin == false){ ?>
							<td><a href='deletecar.php?id=<?php echo $row['peroCarID'];?>'>Delete</a></td>
						<?php } ?>
					</tr>

				<?php 
					endwhile;
					}
		}//end result
		// if there are no records in the database, display an alert message
		else
			{
				echo "No result to display!";
			}				
			
			mysqli_close($conn);
		?>
		</table>
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