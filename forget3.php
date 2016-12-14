<? ob_start(); ?>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?php 
include 'core/init.php';
include 'header.php';
logged_in_redirect();



?>
<div class="box" style="margin-top:5%; margin-left:25%; padding:5%">
<p align="center"  style="text-decoration:none; font-family:Baskerville, 'Palatino Linotype', Palatino, 'Century Schoolbook L', 'Times New Roman', serif">Your Password has been reset. Close this tab and login to access your account.</p>    
      </div>



		<? ob_flush(); ?>
