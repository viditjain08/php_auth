<? ob_start(); ?>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?php 
include 'core/init.php';




?>
<div class="box" style="margin-top:5%; margin-left:25%; padding:3%">
  <?php
if (logged_in() == false) {
 			  header("Location: login.php");
} else {
?>

<h1 align="center"> <a href="logout.php">LOGOUT</a></h1>

<?php
}

?>           

  
      </div>



		<? ob_flush(); ?>
