
<?php




function activate($email, $email_code) {
	include 'connect.php';
	$email = mysqli_real_escape_string($conn,$email);
	$email_code = mysqli_real_escape_string($conn,$email_code);
	if (mysql_result($conn->query("SELECT COUNT(`user_id`) FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0"), 0) == 1) {
		$conn->query("UPDATE users SET active = 1 WHERE email = '$email'");
		
			return true;
	
	} else {
		return false;
	}
	}
	
	
	function forget2($email, $email_code) {
	include 'connect.php';
	$email = mysqli_real_escape_string($conn,$email);
	$email_code = mysqli_real_escape_string($conn,$email_code);
	if (mysql_result($conn->query("SELECT COUNT(`user_id`) FROM users WHERE email = '$email' AND email_code = '$email_code' AND active = 0"), 0) == 1) {
		$conn->query("UPDATE users SET active = 1 WHERE email = '$email'");
		
			return true;
	
	} else {
		return false;
	}
	}
	
	

function register_user($register_data) {
	include 'connect.php';

	array_walk($register_data, 'array_sanitize');
$register_data['password'] = md5($register_data['password']);

$fields = '`' . implode('`, `', array_keys($register_data)) . '`';	

$data = '\'' . implode('\', \'', $register_data) . '\'';
$conn->query("INSERT INTO users ($fields) VALUES ($data)");
email($register_data['email'], 'Activate Your Account', "Hello" . $register_data['first_name'] . ", \n\nYou need to activate your account, so use the link below \n\nhttp://localhost/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . " \n\Website" );


}




function forget($forget) {
	include 'connect.php';

	array_walk($forget, 'array_sanitize');

$fields = '`' . implode('`, `', array_keys($forget)) . '`';	

$a = $forget['email'];

$sql = "SELECT * FROM users WHERE email = '$a'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $email_code = $row["email_code"];
    }
}	

$data = '\'' . implode('\', \'', $forget) . '\'';
email($forget['email'], 'Reset your password', "Hello, \n\nYou need to activate your account, so use the link below \n\nhttp://localhost/forget.php?email=" . $forget['email'] . "&email_code=" . $email_code . " \n\Website" );

}




function user_data($user_id){
	include 'connect.php';

	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_Args();
	$func_get_args = func_get_Args();
	
	if ($func_num_args > 1) {
	unset($func_get_args[0]);
	
	$fields = '`' . implode('`, `', $func_get_args) . '`';
	$data = mysqli_fetch_assoc($conn->query("SELECT $fields FROM users WHERE user_id = '$user_id'"));
	return $data;
	}
}
function logged_in(){
	include 'connect.php';

return( isset($_SESSION['user_id'])) ? true : false;
}
function user_exists($username) {
	include 'connect.php';
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	return true;
	} else { return false; }	
	
	}



function email_exists($email) {
	include 'connect.php';

	$email = sanitize($email);
	return mysql_result($conn->query("SELECT COUNT(`user_id`) FROM users WHERE email = '$email'"), 0) == 1 ? true : false;
}

function user_active($usern) {
$connect_error = 'Sorry, we\' re experiencing connection problems. ';
$servername = "localhost";
$username = "********";
$password = "********";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	$username3 = sanitize($usern);
	$sql3 = "SELECT * FROM users WHERE username = '$username3' AND active = 1";
$result3 = $conn->query($sql3);
if ($result3->num_rows == 0) {
	return false;
	} else { return true; }	
	
	
}


function user_id_from_username($username){
	include 'connect.php';

		$username = sanitize($username);
		
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        return $row["user_id"];
    }
}	else {return false;
}
		}



function change_pass_verify($username, $password) {
	include 'connect.php';

	$username = sanitize($username);
	$password = md5($password);
	return (mysql_result($conn->query("SELECT COUNT(`user_id`) FROM users WHERE username = '$username' AND password = '$password'"), 0) == 1) ? true : false;
}

function login($username, $password) {
	include 'connect.php';

$user_id = user_id_from_username($username);
$username = sanitize($username);
$password = md5($password);
$sql = "SELECT user_id FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        return $row["user_id"];
    }
}	else {return false;
}


}
?>
