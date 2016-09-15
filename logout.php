<?php
	/* 
		John-Martin Devera
		Section CF
		TA Elise Neroutsos
		HW# 5
		May 7, 2014
		
		This page prompts the user for input on their dating
		preferences.
	*/
	session_start(); 
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: start.php");

?>