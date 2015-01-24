<?php
$error1 = "Please enter your name";
$error2 = "Please specify a valid email address";
$person_name = "";
$person_nameErr = "";
$email = "";
$emailErr = "";
$file = "";
$timestamp = 0;
@$name = $_FILES['file']['name'];
$extension = strtolower(substr($name,strpos($name,'.')+1));
@$type = $_FILES['file']['type'];
@$size = $_FILES['file']['size'];
$max_size = 40485760;
@$tmp_name = $_FILES['file']['tmp_name'];
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
	if (empty($_POST["person_name"]) || !preg_match("/^[a-zA-z]*$/", test_input($_POST["person_name"]))) {
  		$person_nameErr = "Name is required";
  	} else {
    	$person_name = test_input($_POST["person_name"]);
  	}
  
  	if ( empty($_POST["email"]) || !spamcheck($_POST["email"]) ) {
   		$emailErr = "Email is required";
  	} else {
    	$email = test_input($_POST["email"]);
  	}
	if (isset($name))
	{
		if ( !empty($name) && !empty($person_name) && !empty($email) )
		{
			if (($extension=='pdf'||$extension=='doc'||$extension=='docx')&&($type=='application/pdf'||$type=='application/doc'||$type=='application/docx')
				&&$size<$max_size)
			{
				$location='C:\xampp\htdocs\project\bazmdtu\competitions\essay\data\\';
				$con=mysqli_connect("localhost","root","","basmdtu");
				$name=md5(uniqid()).'_'.mysql_real_escape_string($name);
				if (move_uploaded_file($tmp_name,$location.$name))
				{
					$file=$name;
					$timestamp=time();
					$timestamp=date('Y:m:d H:i:s',$timestamp);
					include "insert.php";
					if ($count==1)
					{
						$success=true;
						mail($email,'Baszdtu Essay Competition','hello'."\n\n".'Details'."\n".'Name:'.$person_name."\n".'Email:'.$email."\n".'File uploaded:'
							.$location,'From:dtubazm@gmail.com ');
					}
				} else {
					$success=false; 
				}
			} else {
				$success=false;
			}
		} else {
			$success=false;
		}
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

 function spamcheck($field) {
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
    return TRUE;
  } else {
    return FALSE;
  }
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
		<?php
			if (isset($success) && $success==false) {
				?>
				<div>
					Name, email, and file upload are Required<br>
					Name and Email should be valid<br>
					File uploaded should have extension .pdf/.docx/.doc and should be 10 MB or less in size<br>
				</div>
				<?php
			}else if (isset($success) && $success==true) {
				?>
				<div>Form submitted successfully. We will contact you soon.</div>
				<?php
			}
		?>
		<div id="left-box">
			<form action="index.php" method="POST" enctype="multipart/form-data">
				Name<input type="text" id="name_text" name="person_name" value="<?php echo $person_name; ?>" required 
					onblur="blur_func('name_text','error1','<?php echo $error1?>')"><br><div id="error1"></div><br>
				Email<input type="email" id="email" name="email" value="<?php echo $email; ?>" required 
					onblur="blur_func('email','error2','<?php echo $error2?>')"><br><div id="error2"></div><br>
				Upload file<input type="file" name="file" required><br><br>
				<input type="submit" value="submit">
			</form>
		</div>

	</section>
</body>
</html>