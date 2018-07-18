<?php
			
	function dbConnect()
	{
		$dbhost   = "localhost";
		$username = "root";
		$password = "mysql";
		$dbname   ="peroduacarservice";

		// Create connection
		//$conn = new mysqli($servername, $username, $password);

		// Check connection
		//if ($conn->connect_error) {
			//die("Connection failed: " . $conn->connect_error);
		//$link;
		$link=mysqli_connect($dbhost,$username,$password);
		//or die("Unable to connect '$dbhost'");
		/*if (mysqli_select_db($link,$dbname)) 
		or die("Could not open the db '$dbname'");*/
		if(!$link)	
		{
			return false;
		}
		if(!mysqli_select_db($link,$dbname))
		{
			return false;	
		}
		return $link;
	}
	
	function getRegNo($query)
	{
		$conn=mysqli_connect("localhost","root","mysql","peroduacarservice");
		if ($result=mysqli_query($conn,$query))
		{
			if($result != NULL)
			{
				// Get field information for all fields
				if ($fieldinfo=mysqli_fetch_object($result))
				{					
					$regno = $fieldinfo-> peroRegNo;	
					//echo "regno in data process is ";$regno;
				}				
				// Free result set
				mysqli_free_result($result);
				
			}
			else{
						
						echo "sql result is null";
				}
		}
		
		mysqli_close($conn);
		return $regno;
		
	}
	
	function checkLoginID($query)
	{	
				
		if(!isset($_SESSION))
		{
			session_start();
		}
		
		$checkLog = False;
		$conn=mysqli_connect("localhost","root","mysql","peroduacarservice");
		if ($result=mysqli_query($conn,$query))
		{
			if($result != NULL)
			{
				// Get field information for all fields
				if ($fieldinfo=mysqli_fetch_object($result))
				{					
					$_SESSION['ownid']   = $fieldinfo-> ownerID;
					$_SESSION['ownname'] = $fieldinfo-> ownerName;	
					$_SESSION['email'] 	 = $fieldinfo-> email;	
					$checkLog = True;					
					
				}
				// Free result set
				mysqli_free_result($result);
				//echo "login email get from database inner db code is ".$_SESSION['email'];
				//echo "login name get from database inner db code is ".$_SESSION['ownname'];
			}
			else{
						
						echo "sql result is null";
				}
		}
		
		mysqli_close($conn);
		return $checkLog;
		
	}
	
	
	function retrieveMaxRegNo($query)
	{
		//dbConnect();
		$conn=mysqli_connect("localhost","root","mysql","peroduacarservice");
		//$shfield = $mysqli->query($query)->fetch_object()->regno;
		$shfield = "abc";
		if ($result=mysqli_query($conn,$query))
		{
			if($result != NULL)
			{
				// Get field information for all fields
				if ($fieldinfo=mysqli_fetch_object($result))
				{
					//printf("regno: %s\n",$fieldinfo->regno);
					//printf("Table: %s\n",$fieldinfo->table);
					//printf("max. Len: %d\n",$fieldinfo->max_length);
					$shfield = $fieldinfo->peroRegNo;
					//echo "<br> max reg no= ".$shfield."<br>";
					
				}
				// Free result set
				mysqli_free_result($result);
			}
			else{
					$shfield = "R000000";//first time reg no
					echo "Result of sql is null";
				}
		}
		else{
					$shfield = "R000000";//first time reg no
			}

		mysqli_close($conn);
		return $shfield;
	
	}
	
	function retrieveMaxcarNo($query)
	{
		//dbConnect();
		$conn=mysqli_connect("localhost","root","mysql","peroduacarservice");
		//$shfield = $mysqli->query($query)->fetch_object()->regno;
		$shfield = 1;
		if ($result=mysqli_query($conn,$query))
		{
			if($result != NULL)
			{
				// Get field information for all fields
				if ($fieldinfo=mysqli_fetch_object($result))
				{
					//printf("regno: %s\n",$fieldinfo->regno);
					//printf("Table: %s\n",$fieldinfo->table);
					//printf("max. Len: %d\n",$fieldinfo->max_length);
					$shfield = $fieldinfo->peroCarID;
					//echo "<br> max reg no= ".$shfield."<br>";
					
				}
				// Free result set
				mysqli_free_result($result);
			}
			else{
					$shfield = 1;//first time reg no
					echo "Result of sql is null";
				}
		}
		else{
					$shfield = 1;//first time reg no
			}

		mysqli_close($conn);
		return $shfield;
	
	}
	
	function calculateRegNo($newstring)
	{
		//$newstring = 'R000010';
		$pchar ='a';
		$pos=-1;
		$newRegNo="aa";
	
		for($i=1;$i<strlen($newstring);$i++)
		{
			/*$str = (String)$i;
			echo "string is ".$str."<br>";
			$pos = strpos($newstring, $str); */// $pos = 7, not 0*/
			//echo "position is ".$newstring[$i]."<br>";
			
			if($newstring[$i]>0)//to find the number to trim sub string
			{	
				$pchar = $newstring[$i];				
				//echo "inner loop correct number char is ".$pchar."<br>";
				$pos = $i;			
				break;
			}		
			
		}
	
		if($pos == -1)
		{
			//echo "for r000000 position is ".$pos."<br>";
			$newRegNo = "R000001";
			//echo $newstring."<br>";
			//exit();
		}
		else
		{	
	
			 //echo $pchar." position is".$pos."<br>";
			 //echo "sub string is ".substr($newstring,$pos)."<br>";
			 $newst = substr($newstring,$pos);
			 $trimint = (int)$newst;
			 $inctrimint = $trimint + 1;
			 
			 //echo 'new incremented number is '.$inctrimint."<br>";			 
			 
			 if($inctrimint > 0 && $inctrimint <10)
				 $newRegNo = "R00000".$inctrimint;
			 
			 else if($inctrimint > 9 && $inctrimint <100)
				 $newRegNo = "R0000".$inctrimint;
			 
			 else if($inctrimint > 99 && $inctrimint <1000)
				 $newRegNo = "R000".$inctrimint;
			 
			 else if($inctrimint > 999 && $inctrimint <10000)
				 $newRegNo = "R00".$inctrimint;
			 
			 else if($inctrimint > 9999 && $inctrimint <100000)
				 $newRegNo = "R0".$inctrimint; 
			 
			 else if($inctrimint > 99999 && $inctrimint <1000000)
				 $newRegNo = "R".$inctrimint;
			 else
				 echo "limit excedded";
		}
	 
		return $newRegNo;
		
	}

?>