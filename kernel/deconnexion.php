<?php
	try {
	session_start();
	session_destroy ();
	} catch(Exception $e) {
		echo "Problème de session";
	}
	header('location: ../index.php');
?>