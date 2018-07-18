<html>
<head>
<title>Logout</title>
</head>
<body>
	<?php
		
		function dologout()
		{
			  
			session_start(); //to ensure you are using same session
			session_unset();
			session_destroy(); //destroy the session
			header("location:http://localhost/peroduacarservice/home.php"); //to redirect back to "index.php" after logging out
			//exit();
		
						
		}
		dologout();
	?>

</body>
</html>