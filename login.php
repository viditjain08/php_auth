<? ob_start(); ?>
<title>Login</title>
<body bgcolor="#ffffff">
<?php
include 'core/init.php';
logged_in_redirect();


if (empty($_POST) == false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
	if (empty($username) == true || empty($password) == true) {
		$errors[] = 'You need to enter a username and password';
	} 
	else if ($result->num_rows == 0) {
				$errors[] = 'Username does not exist';
	}
		else if (user_active($username) == false) {
				$errors[] = 'You have not activated your account!';
	}
	else {
		
		if(strlen($password) > 32) {
			$errors[] = 'Password too long';
		}
		
		$username1 = sanitize($username);
$password1 = md5($password);
$a = "SELECT user_id FROM users WHERE username = '$username1' AND password = '$password1'";
$b = $conn->query($a);
		
if ($b->num_rows == 1) {
    // output data of each row
    while($row = $b->fetch_assoc()) {
        $login = $row["user_id"];
    }
}	else { $login = false;
}		
		
		
		if ($login == false) {
			$errors[] = 'Username/Password is incorrect.';
	} else {
	$_SESSION['user_id'] = $login;
	header("Location: index.php");
	exit();
	}
	}
	
} else {
	$errors[] = 'No data recieved.';
}
include 'header.php';

?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
?>
<div style="margin-top:5%; margin-left:25%">
<?php
include 'widgets/login.php';
?>
</div>
</body>
<? ob_flush(); ?>
