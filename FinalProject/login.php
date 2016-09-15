<?php
	/* 

		This page prompts determines if the user is valid and can
		login and redirects them to an appropriate page
	*/
	$name = $_POST["name"];
	$pass = $_POST["password"];
	date_default_timezone_set('America/Los_Angeles');
	
	if (!$name || !$pass) {
		die("error: missing parameter[s] ");
	}
	
	if (!file_exists("users.txt")) {
		add_new_user($name, $pass);
	} else {
		foreach(file("users.txt") as $userinfo) {
			$userinfoarray = explode(":", $userinfo);
			if ($userinfoarray[0] == $name) {
				if (trim($userinfoarray[1]) == $pass) {
					header("Location: todolist.php");
					session_start();
					$_SESSION["name"] = $name;
					setcookie("logintime", date("D y M d, g:i:s a"), time() +60*60*24*7);
					die();
				} else {
					header("Location: start.php");
				}
			} else {#name doesn't exist in users.txt
				add_new_user($name, $pass);
			}
		}
	}
	
	/*
	this function will add a user to users.txt and log them
	in to todolist.php if they input legal information, and 
	will redirect them to start.php if illegal.
	*/
	function add_new_user($name, $pass) {
		if (preg_match("/^[a-z0-9]{3,8}$/", $name) && preg_match("/^\d.{4,10}[\W|_]$/", $pass)) {
			file_put_contents("users.txt", "$name:$pass \n", FILE_APPEND);
			session_start();
			$_SESSION["name"] = $name;
			setcookie("logintime", date("D y M d, g:i:s a"), time() + 60*60*24*7);
			die();
			header("Location: todolist.php");
		} else {
			header("Location: start.php");
		}
	}
?>