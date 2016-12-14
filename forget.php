<? ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset your password</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include 'core/init.php';
logged_in_redirect();
include 'header.php';

if (empty($_POST) == false) {
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) == true) {
			$errors[] = 'Fields marked with asterisk are required.';
			break 1;
		}
	}
		if(empty($errors) == true){
		if(strlen($_POST['password']) < 6) {
				$errors[] = 'Your password must be at least 6 characters.';
		}
				if($_POST['password'] !== $_POST['password_again']) {
				$errors[] = 'Your passwords do not match.';
		}
			}
}







if (isset($_GET['emailcode2']) == true) {
	  if(empty($_POST) == false && empty($errors) == true) {
$a = $_POST['password'];
$a = md5($a);

	include 'core/connect.php';

	$c = trim($_GET['emailcode2']);
	$sql2 = "SELECT * FROM users WHERE email = '$c'";
$result2 = $conn->query($sql2);
			$conn->query("UPDATE users SET password = '$a' WHERE email_code = '$c'");

	
			  header("Location: forget3.php");

		  exit();
	  }
?>
<div class="box" style="margin-top:5%; margin-left:30%">
      <h2 id="heading2">Reset your password</h2>
<?php 
?>
<form action="" method="post">
<ul>

<?php
if((empty($_POST) == false) && empty($value) && in_array($key, $required_fields) == true) {
	?>

<li class="register_error">
New Password*:<br>
<input type="password" name="password">
</li>

    <li class="register_error">
Password Again*:<br>
<input type="password" name="password_again">
</li>
<li>
<input type="image" value="submit" src="images/submit.png" style="height:50px; margin-left:100px;" >
</li>
   <?php
} else {
?>
<?php
		if((empty($_POST) == false) && strlen($_POST['password']) < 6) {
?>

<li class="register_error">
New Password*:<br>
Your password is less than 6 characters.
<input type="password" name="password">
</li>
<?php
		} else 
		{
			?>


<li class="register">
New Password*:<br>
<input type="password" name="password">
</li>
<?php
		} ?>
<?php

if((empty($_POST) == false) && $_POST['password'] !== $_POST['password_again']) {
	?>
<li class="register_error">
Password Again*:<br>
Your passwords do not match.
<input type="password" name="password_again">
</li>
<?php
} else {
	?>
    <li class="register">
Password Again*:<br>
<input type="password" name="password_again">
</li>
<?php
}
?>
<li>
<input type="image" value="submit" src="images/submit.png" style="height:50px; margin-left:100px;" >
</li>

<?php
}
?>


</form>
</div>
<?php
}

else if(isset($_GET['email'], $_GET['email_code']) == true) {
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
$GLOBALS['bar'] = $email;
	
	
	
$com = "SELECT * FROM users WHERE email = '$email' AND email_code = '$email_code'";
$comd = $conn->query($com);	




	
$sql2 = "SELECT * FROM users WHERE email = '$email'";
$result2 = $conn->query($sql2);
	if ($result2->num_rows == 0) {
		$errors[] = 'Oops! Something went Wrong and we cannot find that email address!';
	}
	else if($comd->num_rows == 0) {
		$errors[] = 'We had problems resetting your password.';
	}
	
	if (empty($errors) == false) {
	?>
    <h2> Oops</h2>
    <?php
	echo output_errors($errors);
} else {

	header ("Location: forget.php?emailcode2=" . $email_code . "");
	exit();
}
	
} else {
header("Location: index.php");
exit();	
}


 ?>
 </body>
 </html>
 <? ob_flush(); ?>
