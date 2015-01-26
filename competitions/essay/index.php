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
				$location = __DIR__ .'/data';
				$con = mysqli_connect("localhost","root", "", "");
				$name = md5(uniqid()).'_'.mysql_real_escape_string($name);
				if (move_uploaded_file($tmp_name,$location.$name))
				{
					$file=$name;
					$timestamp=time();
					$timestamp=date('Y:m:d H:i:s',$timestamp);
					include "insert.php";
					if ($count==1)
					{
						$success=true;
						mail($email,'Baszdtu Essay Competition','hello'."\n\n".'Details'."\n".'Name:'.$person_name."\n".'Email:'.$email."\n".'File location: http://bazmdtu.com/competitions/essay/data/'
							.$name,'From:admin@bazmdtu.com ');
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
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>bAzm Essay Competition</title>   

<meta name="description" content="Insert Your Site Description" /> 

<!-- Mobile Specifics -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="HandheldFriendly" content="true"/>
<meta name="MobileOptimized" content="320"/>   

<!-- Mobile Internet Explorer ClearType Technology -->
<!--[if IEMobile]>  <meta http-equiv="cleartype" content="on">  <![endif]-->

<!-- Bootstrap -->
<link href="../../_include/css/bootstrap.min.css" rel="stylesheet">

<!-- Main Style -->
<link href="../../_include/css/main.css" rel="stylesheet">

<!-- Supersized -->
<link href="../../_include/css/supersized.css" rel="stylesheet">
<link href="../../_include/css/supersized.shutter.css" rel="stylesheet">

<!-- FancyBox -->
<link href="../../_include/css/fancybox/jquery.fancybox.css" rel="stylesheet">

<!-- Font Icons -->
<link href="../../_include/css/fonts.css" rel="stylesheet">

<!-- Shortcodes -->
<link href="../../_include/css/shortcodes.css" rel="stylesheet">

<!-- Responsive -->
<link href="../../_include/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="../../_include/css/responsive.css" rel="stylesheet">

<!-- Supersized -->
<link href="../../_include/css/supersized.css" rel="stylesheet">
<link href="../../_include/css/supersized.shutter.css" rel="stylesheet">

<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900' rel='stylesheet' type='text/css'>

<!-- Fav Icon -->
<link rel="shortcut icon" href="#">

<link rel="apple-touch-icon" href="#">
<link rel="apple-touch-icon" sizes="114x114" href="#">
<link rel="apple-touch-icon" sizes="72x72" href="#">
<link rel="apple-touch-icon" sizes="144x144" href="#">

<!-- Modernizr -->
<script src="../../_include/js/modernizr.js"></script>

<!-- Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'Insert Your Code']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- End Analytics -->

</head>


<body>


<!-- Header -->
<header>
    <div class="sticky-nav">
    	<a id="mobile-nav" class="menu-nav" href="#menu-nav"></a>
        
        <div id="logo">
        	<!--<a id="goUp" href="#home-slider">bAzm</a>-->
        </div>
        
        <nav id="menu">
        	<ul id="menu-nav">
            	<li><a href="../../" target="blank" class="external">Home</a></li>
				<!--<li><a href="#work">About</a></li>-->
                <li><a href="../../#about">About us</a></li>
                <li><a href="../../#contact">Contact us</a></li>
            </ul>
        </nav>
        
    </div>
</header>


<!-- Contact Section -->
<div id="contact" class="page">
<div class="container">
    <!-- Title Page -->
    <div class="row">
        <div class="span12">
            <div class="title-page">
                <h2 class="title">Online Essay Competition</h2>
                <h3 class="title-description">Fill in necessary details and press submit!</h3>
            </div>
        </div>
    </div>
    <!-- End Title Page -->
    <?php
    	if (isset($success)) {
    		if ($success) echo 'Successfully submitted! You\'ll be contacted soon!';
    		else echo 'Failed! Please try again!';
    	}
    ?>
    
    <!-- Contact Form -->
    <div class="row">
    	<div class="span9">
        
        	<form id="contact-form" class="contact-form" action="index.php" method="post" enctype="multipart/form-data">
            	<p class="contact-name">
            		<input id="contact_name" type="text" required placeholder="Full Name" value="" name="person_name" />
                </p>
                <p class="contact-email" method="post">
                	<input id="contact_email" type="text" required placeholder="Email Address" value="" name="email" />
                </p>
                <p class="contact-message">
                	<input type="file" name="file">
                </p>
                <p class="contact-submit">
                	<input id="contact-submit" class="submit" type="submit" value="Send your message"/>
                </p>
                
                <div id="response">
                
                </div>
            </form>
            <div>
                <h4>Note:</h4>
                Name, email, and file upload are Required<br>
                Name and Email should be valid<br>
                File uploaded should have extension .pdf/.docx/.doc and should be 10 MB or less in size<br>
            </div>
        </div>
        
        <div class="span3">
        	<div class="contact-details">
        		<h3>Contact Details</h3>
                <ul>
                    <!--<li><a href="#">hello@brushed.com</a></li>
                    <li>(916) 375-2525</li>
                    <li>-->
                        
                        <br>
                        dtubazm@gmail.com
                        <br>
                        Izzat Ali Khan
						+919911708993
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<div id="social-area" class="page">
	<div class="container">
    	<div class="row">
            <div class="span12">
                <nav id="social">
                    <ul>
						<li><a href="https://www.facebook.com/bAzmDTU?ref=br_tf" title="Follow Us on Facebook" target="_blank"><span class="font-icon-social-facebook"></span></a></li>
                        </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<a id="back-to-top" href="#">
	<i class="font-icon-arrow-simple-up"></i>
</a>
<!-- End Back to Top -->

</body>
</html>