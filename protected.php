<? ob_start(); ?>
<body bgcolor="#ffffff">
<?php
include 'core/init.php';

include 'header.php';
include 'nav.php';
?>
<div style="margin-top:25%; margin-left:25%">

<?php
		include 'widgets/login.php';

?>
</div>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<?php
?>

</body>
<? ob_flush(); ?>