<? ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Title</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body style= "margin-left: 20%">
<?php
include 'core/init.php';
logged_in_redirect();

if (isset($_GET['success']) == true && empty($_GET['success']) == true) {
?>

<h2 class="congrats">
Thank You,
</h2>
<p class="register">Your registration is complete. Your account has been created<Br /> and now you are free to login and enjoy the special benefits.<Br />By logging in, you will be able to test how much you know.<Br /> You are very important to us.
<Br /><Br />

Thank You for joining <B>website</B>. I hope<Br /> you like our service and let us know if you want anything<Br /> to be updated or your suggestions.<Br /><BR />
Thank You<Br />
<a href="index.php" style="text-decoration:none">
Website
</a>
</p>
<?php
}

else if(isset($_GET['email'], $_GET['email_code']) == true) {
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);
	
	
	
	
$com = "SELECT * FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0";
$comd = $conn->query($com);	




	
$sql2 = "SELECT * FROM users WHERE email = '$email'";
$result2 = $conn->query($sql2);
	if ($result2->num_rows == 0) {
		$errors[] = 'Oops! Something went Wrong and we cannot find that email address!';
	}
	else if($comd->num_rows == 0) {
		$errors[] = 'We had problems activating your account.';
	}
	
	if (empty($errors) == false) {
	?>
    <h2> Oops</h2>
    <?php
	echo output_errors($errors);
} else {
	$conn->query("UPDATE users SET active = 1 WHERE email = '$email'");
	header ("Location: activate.php?success");
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
