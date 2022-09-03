<?php
	include_once 'class/tasks.php';
	include_once 'class/api_locator.php';
	$item = new ClientTask($API_URL);
	if (isset($_GET['id']))
		$id = $_GET['id']; 
	else
		throw new Exception("Update: Task id is missing.", 1);
	$res = $item->getRow($id);

	if(isset($_POST['btn']))
	{
		$item->id = $id;
		$item->description=$_POST['description'];
		$item->owner=$_POST['owner'];
		$item->status=$_POST['status'];
		$item->created=$_POST['created'];
		$item->updateRow();
		header('location:index.php');
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
						if($res['status'] == 'NOT_STARTED') { 
					?>
					<option value="NOT_STARTED" selected>NOT STARTED</option>
					<option value="ONGOING">ONGOING</option>
					<option value="COMPLETE">COMPLETE</option>
					<?php } else if($res['status'] == 'ONGOING') { ?>
					<option value="NOT_STARTED">NOT STARTED</option>
					<option value="ONGOING" selected>ONGOING</option>
					<option value="COMPLETE">COMPLETE</option>
					<?php } else { ?>
					<option value="NOT_STARTED">NOT STARTED</option>
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
