<?php

function email($to, $subject, $body) {
	mail($to, $subject, $body);
}

function logged_in_redirect() {
	include 'connect.php';

if (logged_in() == true) {
header("Location: index.php");
exit();	
}
}
function protect_page() {
		include 'connect.php';

if (logged_in() == false) {
header("Location: protected.php");
exit();	
}
}
function array_sanitize($item) {
		include 'connect.php';

	$item = mysqli_real_escape_string($conn,$item);
}
function sanitize($data) {
		include 'connect.php';

return mysqli_real_escape_string($conn,$data);	
}
function output_errors($errors) {
		include 'connect.php';

$output = array();
foreach($errors as $error) {
$output[] = '<li>' . $error . '</li>';	
}
return '<ul>' . implode('', $output) . '</ul>';
}
?>
