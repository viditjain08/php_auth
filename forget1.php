<? ob_start(); ?>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?php 
include 'core/init.php';
include 'header.php';
logged_in_redirect();


if (empty($_POST) == false) {
	$required_fields = array('email');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $required_fields) == true) {
			$errors[] = 'Fields marked with asterisk are required.';
			break 1;
		}
	}
	if(empty($errors) == true){
						$abc2 = $_POST['email'];
$sql2 = "SELECT * FROM users WHERE email = '$abc2'";
$result2 = $conn->query($sql2);
		
		if ($result2->num_rows == 0) {
$errors[] = 'Sorry, the email address \'' . $_POST['email'] . '\' is not in use.';
		}
	}
}

?>
<div class="box" style="margin-top:5%; margin-left:30%">
      <h2 id="heading2">Forgot Password?</h2>
<?php

	  if(isset($_GET['success']) && empty($_GET['success'])) {
		 echo 'Please check your email to activate your account and log in.'; 
	  } else {
	  if(empty($_POST) == false && empty($errors) == true) {
		  $forget = array(
		  'email' 			=> $_POST['email'],
		  );
		  
		  forget($forget);
		  header("Location: forget2.php");
		  exit();
	  }
?>

      
      <ul style="list-style:none;">
<li style="text-decoration:none; font-family:Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter the email id you entered while signing up</li><br>      
<form action="" method="post">
      
<?php
if((empty($_POST) == false) && empty($value) && in_array($key, $required_fields) == true) {
	?>
   <li class="register_error">
Fields marked with an asterisk are required.<br /> 
Email*:<br>

<input type="text" name="email">
</li> 
<input type="image" value="forget" src="images/submit.png" style="height:50px; margin-left:100px;" >
     
        <?php
} else {

					$abc2 = $_POST['email'];
$sql2 = "SELECT * FROM users WHERE email = '$abc2'";
$result2 = $conn->query($sql2);	
if ((empty($_POST) == false) && ($result2->num_rows == 0)) {
?>
    <li class="register_error">
Email*:<br>
This email is not in use.
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
    <input type="image" value="forget" src="images/submit.png" style="height:50px; margin-left:100px;" >
    
        
        <?php
}
		?>

<li>
</li>  
</ul>  
 </form>     
      </div>

<?php
	  }
	  ?>

		<? ob_flush(); ?>
