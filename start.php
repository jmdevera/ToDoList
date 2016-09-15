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
	
	if (!isset($_COOKIE["logintime"])) {
		date_default_timezone_set('America/Los_Angeles');
		setcookie("logintime", "never.", time() +60*60*24*7);
	}
	
	
	include("common.php");
	top();
?>


		<p>
			The best way to manage your tasks. <br />
		
		</p>

		<p>
			Log in now to manage your to-do list. <br />
			Must have an account to sign in! <br />
		</p>

		<form id="loginform" action="login.php" method="post">
			<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>Username</strong></div>
			<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
			<div><input type="submit" value="Log in" /></div>
		</form>

		<p>
			<em>(last login from this computer was <?=$_COOKIE["logintime"]?>)</em>
		</p>
	</div>
<?php 
	bottom();
?>