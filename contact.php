<?php>
	$connection=mysql_connect("localhost", "root", "");
if(!$connection){
	die("database connection failed!!". mysql_error());
}
mysql_select_db("Cistoner",$connection);
$username=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
if(isset($_SERVER['HTTP_REFERER']))$ref = $_SERVER['HTTP_REFERER'];
else $ref = "index.html";
$insert="INSERT INTO Contact(username,email,massage)VALUES
('$username'
,'$email','massage')";
if(!mysql_query($insert))
{
die('error:'.mysql_error($connection));
}
echo "1 record added";
mysql_close($connection);
<?php>