<html>	
	<head>
		<style media="screen" type="text/css">		 
		 html, body
		{
			width:100%; height: 100%; padding:0; margin:0;
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
		#content-1 {
			float:left;
			width:16%;
			height:70%;
			padding:10 10 12 19;
			background:#787878;
		}
		#content-2-1 {
			
			float:left;
			width:78%;
			height:70%;
			padding:10 14 12 11;
			background:#ddf;
			
		}
		#content-2-2 {
			float:right;
			width:220px;
			padding:10px;
			background:#dff;
		}
		#footer {
			clear:both;
			padding:12px;
			background:#A9A9A9;
			text-align:center;
			color:darkblue;
		}
		h3{	
				font-family:arial,tahoma;
				font-size:25px;
				color:green;
			
		}
		</style>
	</head>
	<body>		
		<div id="header">
			<h2>Perodua Car Service Center</h2>
		</div>				
			<div id="content-1">	
				<ul>
					  <li><a href="carregister.php">Perodua Car Register</a></li><br>
					  <li><a href="carlist.php">Perodua Car List</a></li><br>
					  <?php 	
													
							if(!isset($_SESSION))
							{
								session_start();	
							}
							$scompare = false;
							
							$reg  = "R000000";
							$email= "aa@gmail.com";
							
							if(!empty($_SESSION['newreg'])){
								
									$reg = $_SESSION['newreg'];
									//echo "session reg in index.php is ".$reg;									
							}
							
							if(!empty($_SESSION['email'])){
								
									$email = $_SESSION['email'];
									//echo "session email in index.php is ".$email;									
							}
							
							$ST = 'ironman@gmail.com';
							
							if(strcmp($email, $ST) == 0){//admin
							
								//echo "str compare is ok <br>";							
								$scompare = true;								
							}						
							
					  ?>						
							
					  <?php						
							if($scompare == true){
					   ?>					   
							<li><a href="ownerlist.php">Owner List</a></li><br>
					   <?php
							}
					   ?>
					   <?php						
							if($scompare == false){
					   ?>	
							<li><a href="caroperate.php">Appointment</a></li><br>
					  <?php
							}
					   ?>
					  <li><a href="appointList.php">Appointment List</a></li><br>
					  <li><a href="logout.php">Logout</a></li> <br>         
				</ul>
			</div>
			<div id="content-2-1">
				<h3>
					Hi! 
					<?php						
						
						if(!empty($_SESSION['ownname'])){
							
							echo $_SESSION['ownname']."<br><br>";
							echo "Welcome to Perodua Car Service Centre<br><br>";
						}
						if(!empty($_SESSION['newreg'])){	
						
							echo "Your car registration number is "."<i>".$reg."</i>";
						}				
					?>				
				</h3>
				
			</div>			
			<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>
		</div>
	</body>
</html>