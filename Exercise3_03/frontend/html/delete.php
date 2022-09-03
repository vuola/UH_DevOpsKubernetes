<?php
	include_once 'class/tasks.php';
	include_once 'class/api_locator.php';
	$item = new ClientTask($API_URL);

	$item->id = isset($_GET['id']) ? $_GET['id'] : '';
	$item->deleteRow();
	header("location:index.php");	
?>
<html>
	<body>
		<h1>Task deleted</h1>
		<a href=
		"index.php"
			class="card-link">
			return to list
		</a>
	</body>
</html>