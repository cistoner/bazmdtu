<?php
$connection=mysql_connect("localhost", "root", "");
if(!$connection){
	die("database connection failed!!". mysql_error());
}
mysql_select_db("registration",$connection);
$username=$_POST['username'];
$gender=$_POST['gender'];
$birthday=$_POST['date'];
$contact=$_POST['num'];
$email=$_POST['email'];
$nation=$_POST['nation'];
$event=$_POST['event'];
$message=$_POST['message'];
if(isset($_SERVER['HTTP_REFERER']))$ref = $_SERVER['HTTP_REFERER'];
else $ref = "login_page.html";
//if($password != $confirm){header("location: reg_page.html");exit;}
$insert="INSERT INTO inputs(username,password,confirm
,birthday,contact,gender,email,nation,occupation)VALUES
('$username'
,'$password'
,'$confirm','$birthday','$contact','$gender','$email','$nation','$occupation')";
if(!mysql_query($insert))
{
die('error:'.mysql_error($connection));
}
echo "1 record added";
mysql_close($connection);
?>