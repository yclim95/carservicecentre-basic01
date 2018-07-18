<html>
	<head>
		<title>Welcome Form</title>
		<style media="screen" type="text/css" >
		
			body,html{
				
				background:#ddf;
				background-image: url("../images/carleaf.jpg")
				background-position: center; 	
				width:auto; height: auto; padding:0; margin:0;
				font-family:arial,tahoma;
				font-size:15px;
				color:lightgreen;				
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
				color:darkblue;
				margin-top:200px;
			}
			label
			{
				 display:inline-block; 
				 width:100%;
				 height:400px;
				 padding:10px;
				 text-align:center;
			}
			h3{	
				font-family:arial,tahoma;
				font-size:25px;
				color:green;			
			}
			#backButton
			{				
				
				margin-top:10%;
				
			}
		</style>
		<script>
			function pagechange()
			{
				
				window.location = "http://localhost/peroduacarservice/home.php";
				
				
			}	
		</script>
	</head>
	<body>
		<?php 
				if(!isset($_SESSION))
				{
					session_start();
				}
				//if(!empty($_SESSION['newreg']))
				//{
					//session_unset($_SESSION['sname']);
					//session_destroy();
					//echo $_SESSION['newreg'];
				//}
				
				
				//{
					//session_unset($_SESSION['sname']);
					//session_destroy();
					//echo $_SESSION['owname'];
				//}
					
		?>
		<div id="header">
			<h2>Toyota Car Service Center</h2>
			<h2>Welcome&nbsp;&nbsp;&nbsp;&nbsp; Page</h2>
		</div>
		<center>
		<h3>
					Thank you for your registration!!!!
					<?php 
							if(!empty($_SESSION['owname'])){
							echo $_SESSION['owname'];
						}
					?> <br><br>
					
					Your car registration number is 
					<?php 
							if(!empty($_SESSION['newreg'])){
							echo "<i>".$_SESSION['newreg']."</i>";
						}
					?>
					
		</h3>
		</center>
		<center>
			<div id="backbutton">
				<button type="button" onClick="pagechange()">Back</button>
			</div>
		</center>
		
	<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>			
	</body>
</html>