<?php
$error1="Please enter your name";
$error2="Please specify a valid email address";
$person_name="";
$person_nameErr="";
$email="";
$emailErr="";
$file="";
$timestamp=0;
@$name=$_FILES['file']['name'];
$extension=strtolower(substr($name,strpos($name,'.')+1));
@$type=$_FILES['file']['type'];
@$size=$_FILES['file']['size'];
$max_size=10485760;
@$tmp_name=$_FILES['file']['tmp_name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["person_name"])) {
    $person_nameErr = "Name is required";
  } else {
    $person_name = test_input($_POST["person_name"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
}
if(isset($name))
{
	if(!empty($name))
	{
		if(($extension=='pdf'||$extension=='doc'||$extension=='docx')&&($type=='application/pdf'||$type=='application/doc'||$type=='application/docx')
			&&$size<$max_size)
		{
			$location='data/';
			if(move_uploaded_file($tmp_name,$location.$name))
			{
			$file=$name;
			$timestamp=time();
			$timestamp=date('Y:m:d H:i:s',$timestamp);
			include "insert.php";
			if($count==1)
			{
			echo '<center><b><br><br><br>FORM SUBMITTED.</b></center>';
			die();
			}
				echo 'File uploaded';
			}
			else
			{
				echo 'Error in uploading the file'; 
			}
		}
		else
		{
			echo 'File must be pdf/doc/docx and must be 10MB or less.';
		}
	}
	else
	{
	 echo 'Please choose a file.';
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="public.css">
	<script type="text/javascript" src="error.js"></script>
</head>
<body>
	
	<section>
		<div id="left-box">
			<form action="index.php" method="POST" enctype="multipart/form-data">
				Name<input type="text" id="name_text" name="person_name" required value="<?php echo $person_name?>" onblur="blur_func('name_text','error1','<?php echo $error1?>')"><br><div id="error1"></div><br>
				Email<input type="email" id="email" name="email" required value="<?php echo $email?>" onblur="blur_func('email','error2','<?php echo $error2?>')"><br><div id="error2"></div><br>
				Upload file<input type="file" name="file" required><br><br>
				<input type="submit" value="submit">
			</form>
		</div>

	</section>
</body>
</html>