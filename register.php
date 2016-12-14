<? ob_start(); ?>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?php 
include 'core/init.php';
include 'header.php';


logged_in_redirect();


if (empty($_POST) == false) {
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) == true) {
			$errors[] = 'Fields marked with asterisk are required.';
			break 1;
		}
	}
	if(empty($errors) == true){
		$abc = $_POST['username'];
$sql = "SELECT * FROM users WHERE username = '$abc'";
$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
		}
		if(preg_match("/\\s/", $_POST['username']) == true) {
	$errors[] = 'Your username must not contain spaces.';
		}
		if(strlen($_POST['password']) < 6) {
				$errors[] = 'Your password must be at least 6 characters.';
		}
				if($_POST['password'] !== $_POST['password_again']) {
				$errors[] = 'Your passwords do not match.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
			$errors[] = 'A valid email address is required.';

		}
				$abc2 = $_POST['email'];
$sql2 = "SELECT * FROM users WHERE email = '$abc2'";
$result2 = $conn->query($sql2);
		
		if ($result2->num_rows > 0) {
$errors[] = 'Sorry, the email address \'' . $_POST['email'] . '\' is already in use.';
		}
	}
}

 ?><div class="box" style="margin-top:5%; margin-left:30%">
      <h2 id="heading2">Register Your Account</h2>
      <?php
	  
	  if(isset($_GET['success']) && empty($_GET['success'])) {
		 echo 'Please check your email to activate your account and log in.'; 
	  } else {
	  
	  if(empty($_POST) == false && empty($errors) == true) {
		  $register_data = array(
		  'username' 		=> $_POST['username'],
		  'password' 		=> $_POST['password'],
		  'first_name'	    => $_POST['first_name'],
		  'last_name' 		=> $_POST['last_name'],
		  'state' 			=> $_POST['state'],
		  'email' 			=> $_POST['email'],
		  'email_code'      => md5($_POST['username'] + microtime())
		  );
		  
		  register_user($register_data);
		  header("Location: register_post.php");
		  exit();
	  }
	  
	  ?>

<form action="" method="post">
<ul>

<?php
if((empty($_POST) == false) && empty($value) && in_array($key, $required_fields) == true) {
	?>



<li class="register_error">
Fields marked with an asterisk are required.<br />
Username*:<br>
<input type="text" name="username">
</li>



<li class="register_error">
Password*:<br>
<input type="password" name="password">
</li>

    <li class="register_error">
Password Again*:<br>
<input type="password" name="password_again">
</li>

<li class="register_error">
First name*:<br>
<input type="text" name="first_name">
</li>
<li class="register_error">
Last name:<br>
<input type="text" name="last_name">
</li>
<li class="register_error">
State:<br>

				<div>
                		<select id="register" name="state" style="width:200px; border:solid 1px #3b5998;">
<option value="Andaman and Nicobar Islands">Andaman and Nicobar</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Orissa">Orissa</option>
<option value="Pondicherry">Pondicherry</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Tripura">Tripura</option>
<option value="Uttaranchal">Uttaranchal</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="West Bengal">West Bengal</option>
                 		</select>
                        </div></li>




    <li class="register_error">
Email*:<br>

<input type="text" name="email">
</li>


<li>
<input type="image" value="Register" src="images/signup.png" style="height:50px; margin-left:100px;" >
</li>











    <?php
} else {
?>
<?php
$abc = $_POST['username'];
$sql = "SELECT * FROM users WHERE username = '$abc'";
$result = $conn->query($sql);
	if ((empty($_POST) == false) && ($result->num_rows > 0)) {

?>

<li class="register_error">

Username*:<br>
This username is already taken
<input type="text" name="username">
</li>
<?php
	}
else if((empty($_POST) == false) && preg_match("/\\s/", $_POST['username']) == true) {
?>
<li class="register_error">
Username*:<br>
Username must not contain spaces.
<input type="text" name="username">
</li>

<?php
	} else {
		?>
<li class="register">
Username*:<br>
<input type="text" name="username">
</li>
<?php
	}
	?>
<?php
		if((empty($_POST) == false) && strlen($_POST['password']) < 6) {
?>

<li class="register_error">
Password*:<br>
Your password is less than 6 characters.
<input type="password" name="password">
</li>
<?php
		} else 
		{
			?>


<li class="register">
Password*:<br>
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
<li class="register">
First name*:<br>
<input type="text" name="first_name">
</li>
<li class="register">
Last name:<br>
<input type="text" name="last_name">
</li>
<li class="register">
State:<br>
				<div>
                		<select id="register" name="state" style="width:200px; border:solid 1px #3b5998;">
<option value="Andaman and Nicobar Islands">Andaman and Nicobar</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Orissa">Orissa</option>
<option value="Pondicherry">Pondicherry</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Tripura">Tripura</option>
<option value="Uttaranchal">Uttaranchal</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="West Bengal">West Bengal</option>
                 		</select></div></li>

<?php
					$abc2 = $_POST['email'];
$sql2 = "SELECT * FROM users WHERE email = '$abc2'";
$result2 = $conn->query($sql2);	
if ((empty($_POST) == false) && ($result2->num_rows > 0)) {
?>
    <li class="register_error">
Email*:<br>
This email is already in use.
<input type="text" name="email">
</li>
<?php

}
	else if ((empty($_POST) == false) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {

				?>

    <li class="register_error">
Email*:<br>
This email is invalid.
<input type="text" name="email">
</li>

<?php
		} else {
			?>
    <li class="register">
Email*:<br>

<input type="text" name="email">
</li>
<?php
		}
		?>

<li>
<input type="image" value="Register" src="images/signup.png" style="height:50px; margin-left:100px;" >
</li>
<?php
}
?>

</ul>
</form>
<?php
		}
	  
		
		?>
        </div>
        

		<? ob_flush(); ?>
