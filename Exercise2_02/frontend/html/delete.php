<?php
	include("connect.php");
	$id = $_GET['id'];
	$q = "delete from $dbtable where id = $id ";
	mysqli_query($con,$q);	
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