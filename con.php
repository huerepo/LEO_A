#DB CONNECTION
<?php
require_once '../../config.php';
 

	$mysqli = new mysqli("localhost","dbuser","password","dbname"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

?>
