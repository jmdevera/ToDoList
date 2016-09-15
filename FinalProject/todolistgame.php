<?php
	/* 

		This page displays a user's todo list statistics 
	*/
	
	include("common.php");
	session_start();
	if (!isset($_SESSION["name"])) {
		header("Location: start.php");
	}
	
	top();
?>

		<div id="Links">
			<a href="todolist.php">Task View</a>
			<a href="todolistdata.php">Data View</a>
			<a href="todolistgame.php">Game View</a>
		</div>
		<h2><?=trim($_SESSION["name"])?>'s Productivity Point History </h2>


		<p>
			SHOP COMING SOON <br />
			Spend your hard earned points here! <br />
			Total Points earned: <?=points()?>
		
		</p>


		

		<p>
			<em>(last login from this computer was <?=$_COOKIE["logintime"]?>)</em>
		</p>
	</div>
<?php 
	bottom();
	
	function points() {
		$points = 0;
		$file = file("data_$_SESSION[name].tsv");
		for($i=1; $i<count($file); ($i++)){
			$items = explode("\t", $file[$i]);
			$points += $items[1];
		}
		echo($points);
	}
?>