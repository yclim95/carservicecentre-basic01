<html>
<head>
<style media="screen" type="text/css">

		#img {
			float:auto;
			position:relative;
			width: 500 px;
			height: 300 px;
			background:#ddf;			
		}

		html, body
		{
			width:100%; height: 100%; padding:0; margin:0;
			font-family:arial,tahoma;
			color:lightblue;
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
			padding:10 0 12 19;
			background:#787878;
		}
		#content-2-1 {
			
			float:left;
			width:82%;
			height:70%;
			padding:10 0 12 11;
			background:#ddf;
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
				font-size:30px;
				color:green;
			
		}
</style>
<script type="text/javascript">
	
		function checkNull(){
			
			val1 = document.getElementById("uname").value;
			val2 = document.getElementById("pwd").value;
			
			if(val1=="")
			{
				alert("user name should not be null");
				document.getElementById("uname").focus();
				return;
			}				
			if(val2=="")
			{
				alert("password should not be null");
				document.getElementById("pwd").focus();
			}		
			
			
		}
	
</script>
</head>
<body>
<div id="body">
	
	<div id="header"><h2>Perodua Car Service Center</h2></div>
	<div id="main">
		<div id="content-1">
			<form action="login.php" method="POST">
				Login here.<br><br>
				<div width="18">*User Name</div>
				<input type="text" name="username" id="uname" width="200px" required><br/><br/>
				<div width="18">*Password</div>   
				<input type="password" name="password" id="pwd" width="200px" required><br/><br/>
				<center>
					<input type="submit" name="submit" value="login">
				</center>
				<br/>
			</form>
			
		</div>
		<div id="content-2-1">
			<h3>you can <a href="http://localhost/peroduacarservice/ownerregister.php">Register</a>  here.....</h3>
			<div id="img"><img src="images/servepic.jpg" alt="logo"></div>
			
		</div>
		
	</div>
	<div id="footer">OUR GOAL IS CUSTOMER SATISFACTION</div>
</div>
</body>
</html>