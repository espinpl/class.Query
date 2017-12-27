<?php

/* connect.php */
 
try {
	$pdo = new PDO('mysql:host=localhost;dbname=baza', 'user', 'password');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}    
catch(PDOException $error) {
	echo $error->getMessage();
}

?>