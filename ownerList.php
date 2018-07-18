<html>
	<head>
		<style media="screen" type="text/css">
			
			html, body
			{
				width:100%; height: 100%; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:15px;
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
				padding:12px;
				background:#A9A9A9;
				text-align:center;
				color:darkblue;
				margin-top:100px;
			}
			
			table{				
				margin: auto;
				width:100%;
				height:400px;
				padding:5px;
				background-color: #ddf;
				color:blue;
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
			<h2>O w n e r&nbsp;&nbsp;&nbsp;&nbsp;L i s t</h2>		
	</div>
	
	<?php
	   
		$conn = mysqli_connect('localhost','root','mysql','peroduacarservice')
		or die('Error connecting to MySQL server.');
		//echo 'Connected successfully';

		$query = "SELECT * FROM peroowner";
		mysqli_query($conn, $query) or die('Error querying database.');
		//	echo $query;
		
		$result=mysqli_query($conn,$query);
		//echo $result;
		
		if($result){
		?>		
		
		<table border="3" cellspacing="2" cellpadding="2" >
			<tr>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Owner ID</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Owner Name</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Address</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Date Of Birth</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Contact No</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Email</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Password</font>
				</th>
				<th>
					<font face="tahoma, Helvetica, sans-serif">Grant Level</font>
				</th>
				
			</tr>
			
			<?php
				while($row=mysqli_fetch_array($result)):?>
				<tr>
					<td><?php echo $row['ownerID'];?></td>
					<td><?php echo $row['ownerName'];?></td>
					<td><?php echo $row['address'];?></td>
					<td><?php echo $row['dateOfBirth'];?></td>
					<td><?php echo $row['contactNo'];?></td>
					<td><?php echo $row['email'];?></td>
					<td><?php echo $row['password'];?></td>
					<td><?php echo $row['grantLevel'];?></td>
				</tr>

			<?php 
					endwhile;
				}		
				mysqli_close($conn);
			?>
		</table>
		<br><br>
		<center>
			<div id="backbutton">
				<button type="button" onClick="pagechange()">Back</button>
			</div>
		</center>
		<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>	
	</body>
</html>