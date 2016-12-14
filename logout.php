<? ob_start(); ?>
<?php
session_start();
session_destroy();
header("Location: index.php");
?>
<? ob_flush(); ?>