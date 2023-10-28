<?php
	$server="sql12.freesqldatabase.com";
	$username="sql12656939";
	$password="4UITiqPpTW";
	$db="sql12656939";
	$con=mysqli_connect($server,$username,$password,$db);
	if(!$con)
	{
		echo"Error connecting";
	}
   
?>