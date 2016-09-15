<?php
	/* 
		This page prompts the user for input on their dating
		preferences.
	*/
	session_start(); 
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: start.php");

?>