<?php
	/* 

		This page modify's a user's todo list and redirects them back
		to todolist.php
	*/
	
	#include("common.php");
	
	session_start();
	if (!isset($_SESSION["name"])) {
		header("Location: start.php");
	}
	
	if ($_POST["action"] == "add") {
		$today = date_create();
		$todaystr = $today->format("y-m-d");		
		$due = date_create("$_POST[due]");
		$origdue = clone $due;
		$due->sub(new DateInterval("P$_POST[effort]D"));
		$goalduestr=$due->format("y-m-d");
		$origduestr=$origdue->format("y-m-d");
		$interval = $today->diff($due);
		$intervalstr = $interval->format("%Y%m%d");
		$value = intval($intervalstr);		
		file_put_contents("todo_$_SESSION[name].txt", "$_POST[item]+$_POST[importance]+$_POST[due]+$_POST[fun]+$value+$_POST[effort]\n", FILE_APPEND);
	} else {
		$today = date_create();
		$todaystr = $today->format("y-m-d");		
		$due = date_create("$_POST[due]");
		$origdue = clone $due;
		$due->sub(new DateInterval("P$_POST[effort]D"));
		$goalduestr=$due->format("y-m-d");
		$origduestr=$origdue->format("y-m-d");
		$interval = $today->diff($due);
		$intervalstr = $interval->format("%Y%m%d");
		$value = intval($intervalstr);
		
		$points = $_POST[points];
		if (!file_exists("data_$_SESSION[name].tsv")){
			file_put_contents("data_$_SESSION[name].tsv", "day\tproductivity");
		}
		//to-do; account for missing days
		$file = file("data_$_SESSION[name].tsv");
		$lastline = explode("\t", $file[count($file)-1]);
		if (strcmp($lastline[0], $todaystr) == 0) { // same day
			$lastline[1] += $points;
			$file[count($file)-1] = implode("\t", $lastline);		
			file_put_contents("data_$_SESSION[name].tsv", $file);
		} else { // different day
			file_put_contents("data_$_SESSION[name].tsv", "\n$todaystr\t$points", FILE_APPEND);
		}
		$index = $_POST["index"];
		$todolist = file("todo_$_SESSION[name].txt");
		if ($index+1 > count($todolist)) {
			die("Error: out of bounds");
		}
		unset($todolist[$index]);
		file_put_contents("todo_$_SESSION[name].txt", $todolist);
	}
	header("Location: todolist.php");
?>