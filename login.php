<html>
	<head>
	<style media="screen" type="text/css">
		html, body
		{			
			font-family:arial,tahoma;
			font-size:15px;
			color:green;
			
		}
	
	</style>
		
	</head>
	<body>
	
	<?php include 'dataProcess.php';?>		
	
	<?php					
		
		if(isset($_POST['submit'])){
			
			echo '<h2>Welcome'.$_POST['username'].'to our website.</h2>';			
			$user = $_POST['username'];
			$pwd  = $_POST['password'];
			//$Ldate = date("Y-m-d");//today date
			
			if(!isset($_SESSION))
			{
				session_start();
			}
			$_SESSION['email'] = $_POST['username'];//keep login email into session
			
			echo "<br> session email in login.php is ".$_SESSION['email'];
			
			//echo "Date = ".$Ldate;
			
			$query = "select * from peroowner where email='".$_POST['username']."' and password='".$_POST['password']."'";		
						
			if(checkLoginID($query))//check account name and password
			{				
				if(isset($_SESSION['ownid']))
				{
					$ownerid = $_SESSION['ownid'];
					//echo "owner id in login.php ".$ownerid ;
				} 
				
				if(isset($_SESSION['ownname']))
				{
					$ownname = $_SESSION['ownname'];
					//echo "****owner name in login.php ".$ownname;
				}
				
				if(isset($_SESSION['email']))
				{
					$ownemail = $_SESSION['email'];
					//echo "email in login.php ".$ownemail;
				}			
				
				
				$conn = new mysqli("localhost", "root", "mysql", "peroduacarservice");
				$query = "INSERT INTO logindetail(loginName, ownerid)
				VALUES ('".$_POST['username']."',".$ownerid.")";
				$conn->query($query);
				$conn->close();
				
				//echo "<br> session email in login.php before going index.php is ".$ownemail;
				//echo "<br> session owner name in login.php before going index.php is ".$ownname;
				//header("Location: http://localhost/carservicec2/index.php?useremail='".$_POST['username']."'");
				header("Location: http://localhost/peroduacarservice/index.php");
			}
			else
			{				
				echo "unknown redirect";
			}		
			//UserName='".$_REQUEST['txtname']."' and Password='".$_REQUEST['txtpassword']."' 
			
					
		}else{
		
	?>			
			
	<?php
		}
	?>
</body>
</html>