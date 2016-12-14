
 
 
                <div class="box" style="float:left;">
                <h2 id="heading2">Login/Register</h2>
                                     <form action="login.php" method="post">
                   <ul id="login">
                   
<?php
if (empty($_POST) == false && empty($username) == true) {

?> 

                                  <li class="register_error">
                                  
    <?php
} else if (empty($_POST) == false && $result->num_rows == 0) {
	?>
                                      <li class="register_error">

                                      
                 <?php
} else if (empty($_POST) == false && user_active($username) == false) {
				 ?>
                 <li class="register_error">
                 
                                   <?php
} else if (empty($_POST) == false && $errors[] = 'Username/Password is incorrect.'){
	?>
                       <li class="register_error">  
           

<?php
} else {
?>

                                  <li class="register">
                                  <?php
 }

?>
                   Username:<br />
                   <input type="text" name="username" /><br />
               <?php
               if (empty($_POST) == false && empty($username) == true) {
?> 
You must enter a username.
                              </li>
    <?php
	
} else if (empty($_POST) == false && $result->num_rows == 0) {
	if (empty($_POST) == false && $errors[] = 'Username does not exist') {
	?>Username does not exist.

    </li>
    <?php
	} else {
		?>
                              </li>

                           <?php
	}
} else if (empty($_POST) == false && user_active($username) == false) {
				 ?>
Your account has not been activated.
                              </li>
<?php
} else {
?>
</li>
<?php
}
?>

                                  <?php
 if (empty($_POST) == false && strlen($password) > 32) {
				 ?>
                      <li class="register_error">
                      
                                                        <?php
 } else if (empty($_POST) == false && empty($password) == true) {
				 ?>
                      <li class="register_error">  
                      
            
                             <?php
} else if (empty($_POST) == false && $errors[] = 'Username/Password is incorrect.'){
	?>
                       <li class="register_error">  

            
                 <?php
 }	 else {

?>

               <li  class="register" >
               <?php
				 }
 
				 ?>
               Password:<br />
               <input type="password" name="password" /><Br />

                                             <?php
 if (empty($_POST) == false && strlen($password) > 32) {
				 ?>
                 Password too long.
                 </li>


        
                 <?php
 } else
if (empty($_POST) == false && empty($password) == true) {
?>
                 You must enter a password.
                 </li>
                 <?php
} else if (empty($_POST) == false && $errors[] = 'Username/Password is incorrect.'){
	?>
    Username/Password incorrect.
    </li>
                 <?php
} else {
	
 ?> 
               </li>
<?php
 }
 
 ?>
                <li id="reg">
                <a href="forget1.php">Forgot Password?</a>
               </li>
               <input type="image" value="Log in"  src="images/login.png" style="height:50px; margin-left:100px;" name="login"/>
               </li>
               <li id="reg">
                New User? <a href="register.php">Register Here</a>
               </li>
                   </ul>
                   </form>
            </div>
