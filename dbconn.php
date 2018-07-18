<?php
	function db_connect()
	{
		
		$connection=mysql_pconnect('localhost','root','mysql');
		if(!$connection)	
		{
			return false;
		}
		if(!mysql_select_db('peroduacarservice'))
		{
			return false;	
		}
		return $connection;
	}
	
	function db_save($query)
	{
		db_connect();
		$req=mysql_query($query) or die("Fail to insert data....");	
		if(!$req)
		{
			return false;
		}
		else
		{
			return true;	
		}
	}
	
	function db_edit($query1)
	{
		db_connect();
		$req1=mysql_query($query1) or die("Fail to edit data....");
		if(!$req1)
		{
			return false;
		}
		else
		{
			return true;	
		}
	}
	
	function db_delete($query2)
	{
		db_connect();
		$req2=mysql_query($query2) or die("Fail to edit data....");
		if(!$req2)
		{
			return false;
		}
		else
		{
			return true;	
		}
	}
	
	function db_result_to_array($result)
	{
		$res_array=array();
		for($count=0;$row=mysql_fetch_array($result);$count++)
		{
			$res_array[$count]=$row;
			
		}
		return $res_array;
	}
	
	function retrieve_data($query)
	{
		db_connect();
		$result=mysql_query($query);
		$result=db_result_to_array($result);
		return $result;
	}
	
	function check_duplicate($query)
	{
		db_connect();
		$result=mysql_query($query);
		$result=mysql_num_rows($result);
		return $result;	
	}
	
	
?>