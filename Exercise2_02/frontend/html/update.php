<?php
	include("connect.php");
	if(isset($_POST['btn']))
	{
		$description=$_POST['description'];
		$owner=$_POST['owner'];
		$status=$_POST['status'];
		$created=$_POST['created'];
		$id = $_GET['id'];
		$q= "update $dbtable set description='$description', owner='$owner',
		status='$status', created='$created' where id=$id";
		$query=mysqli_query($con,$q);
		header('location:index.php');
	}
	else if(isset($_GET['id']))
	{
		$q = "SELECT * FROM $dbtable WHERE id='".$_GET['id']."'";
		$query=mysqli_query($con,$q);
		$res= mysqli_fetch_array($query);
	}
?>
<html>

<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=UTF-8">
	
	<title>Update List</title>

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container mt-5">
		<h1>Update Task</h1>
		<form method="post">
			<div class="form-group">
				<label>Description</label>
				<input type="text"
					class="form-control"
					maxlength="140"
					placeholder="Description"
					name="description"
					value=
		"<?php echo $res['description'];?>" />
			</div>

			<div class="form-group">
				<label>Item owner</label>
				<input type="text"
					maxlength="70"
					class="form-control"
					placeholder="Item owner"
					name="owner"
value="<?php echo $res['owner'];?>" />
			</div>

			<div class="form-group">
				<label>Item status</label>
				<select class="form-control"
					name="status">
					<?php 
						if($res['status'] == 'NOT STARTED') { 
					?>
					<option value="NOT STARTED" selected>NOT STARTED</option>
					<option value="ONGOING">ONGOING</option>
					<option value="COMPLETE">COMPLETE</option>
					<?php } else if($res['status'] == 'ONGOING') { ?>
					<option value="NOT STARTED">NOT STARTED</option>
					<option value="ONGOING" selected>ONGOING</option>
					<option value="COMPLETE">COMPLETE</option>
					<?php } else { ?>
					<option value="NOT STARTED">NOT STARTED</option>
					<option value="ONGOING">ONGOING</option>
					<option value="COMPLETE" selected>COMPLETE</option>
					<?php
						}
					?>
				</select>
			</div>

			<div class="form-group">
				<label>Creation Date</label>
				<input type="date" class="form-control"
					name="created" placeholder="Date"
					value="<?php echo $res['created']?>">
			</div>

			<div class="form-group">
				<input type="submit" value="Update"
					name="btn" class="btn btn-danger">
			</div>
		</form>
	</div>
</body>

</html>
