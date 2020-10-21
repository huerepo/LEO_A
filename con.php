#DB CONNECTION
<?php
require_once '../../config.php';
 

	$mysqli = new mysqli("localhost","emanvdos","emanvdospass","eman18v2"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

?>
