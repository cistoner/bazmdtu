<?php
$count=0;

if(mysqli_connect_errno())
{
	die("Error connecting to database");
}
if(!mysqli_query($con,"INSERT INTO users(id,name,email,file,timestamp)
	VALUES('' ,'".mysql_real_escape_string($person_name)."' , '".mysql_real_escape_string($email)."' , '".mysql_real_escape_string($file)."' , '".mysql_real_escape_string($timestamp)."')"))
die('Unable to update the database.Try again.');
$count=1;
mysqli_close($con);
?>