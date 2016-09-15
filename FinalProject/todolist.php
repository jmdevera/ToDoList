<?php
	/* 

		
		This page displays a user's todo list where they can 
		add and delete items
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
		<h2><?=trim($_SESSION["name"])?>'s To do List </h2>
		
		<table id="todolist">
			<tr> 
				<th>Task</th>
				<th>Importance</th>
				<th>Due</th>
				<th>Fun?</th>
				<th>PP</th>
				<th>Done?</th>
			</tr>
			<?php
				if (file_exists("todo_$_SESSION[name].txt")) {
					$counter = 0;
					foreach (file("todo_$_SESSION[name].txt") as $line) {
					$items = explode("+", $line)
			?>
				<tr>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="delete" />
						<input type="hidden" name="index" value = "<?=$counter?>" />
						<input type="hidden" name="points" value = "<?=$items[1]*500-$items[4]?>" />
						<input type="hidden" name="importance" value = "<?=$items[1]?>" /> 
						<input type="hidden" name="due" value = "<?=$items[2]?>" /> 
						<input type="hidden" name="effort" value = "<?=$items[4]?>" /> 
						<input type="hidden" name="fun" value = "<?=$items[3]?>" /> 
						<input type="hidden" name="task" value = "<?=$items[0]?>" /> 
					
						<td><?=trim(htmlspecialchars($items[0]))?></td>
						<td><?=trim(htmlspecialchars($items[1]))?></td>
						<td><?=trim(htmlspecialchars($items[2]))?></td>
						<td><?=trim(htmlspecialchars($items[3]))?></td>
						<td><?=$items[1]*500-$items[4]*3?>pts</td>
						<td><input type="submit" value="Done" /></td>
					</form>
				</tr>
			<?php
						$counter++;
					}
				}
			?>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="" required="required" autofocus="autofocus" placeholder="task"/>
						<select name="importance" required="required">
							<option value="2" selected="selected">Importance</option> 
							<option value="1">Low(1)</option> 
							<option value="2" >Med(2)</option> 
							<option value="3">High(3)</option> 
						</select>
						<input name="due" type="date" required="required"
							<?php echo "value=".date('Y-m-d')."/>"?>
						<select name="effort" size ="1">
							<option value="2" selected="selected">Effort Required</option> 
							<option value="1">Low(Minutes)</option> 
							<option value="2" >Med(Hours)</option> 
							<option value="3">High(Days)</option> 
						</select>
						<select name="fun" size ="1">
							<option value=":|" selected="selected">Fun?</option>
							<option value=":)">:)</option> 
							<option value=":|">:| </option> 
							<option value=":(">:(</option> 
						</select>
						<input type="submit" value="Add" />
					</form>
		</table>
		
		<div>
			<a href="logout.php"><strong>Log Out</strong></a> 
			<em>(logged in since <?=$_COOKIE["logintime"]?>)</em>
		</div>

<?php 
	bottom();
?>
