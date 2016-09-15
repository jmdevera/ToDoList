<?php
	/* 
		John-Martin Devera
		Section CF
		TA Elise Neroutsos
		HW# 5
		May 7, 2014
		
		This page includes common code shared throughout the
		Remember the Cow website.
	*/
	
	function top(){ 
?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8" />
				<title>Tower of Eisenhower</title>
				<link href="my.css" type="text/css" rel="stylesheet" />
				<link href="tower.ico" type="image/ico" rel="shortcut icon" />
			</head>

			<body>
				<div class="headfoot">
					<h1>
						Tower<br />of Eisenhower
					</h1>
				</div>

				<div id="main">
			<!-- End of shared top -->
<?php
	}
	
	function bottom() {
?>
	<!--This is a shared bottom-->
				<div class="headfoot">
	

					<div id="w3c">
						<a href="https://webster.cs.washington.edu/validate-html.php">
							<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
						<a href="https://webster.cs.washington.edu/validate-css.php">
							<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
					</div>
				</div>
			</body>
		</html>
<?php 
	}
?>