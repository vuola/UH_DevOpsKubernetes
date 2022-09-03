<?php
	include_once 'class/tasks.php';
	include_once 'class/api_locator.php';
	$item = new ClientTask($API_URL);

	$owner = isset($_GET['owner']) ? $_GET['owner'] : '';
//	$len = isset($_GET['len']) ? $_GET['len'] : '';
	$len = '7';
	$data = $item->getAll($len, $owner);
?>

<html>

<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=UTF-8">

	<title>Task Adding Frontend</title>

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

    <style>
    * {
        box-sizing: border-box;
    }

    /* Create two page bottom columns that float next to each other */
    .column1 {
        float: left;
        width: 30%;
        padding: 100px;
    }

    .column2 {
        float: left;
        width: 70%;
        padding: 100px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
    </style>
</head>

<body>
	<div class="container mt-5">
		<h1>Add Task</h1>
		<form action="add.php" method="POST">

			<div class="form-group">
				<label>Description</label>
				<input type="text"
					class="form-control"
                    maxlength="140"
					placeholder="Description"
					name="description" />
			</div>

			<div class="form-group">
				<label>Item owner</label>
				<input type="text"
                    maxlength="70"
					class="form-control"
					placeholder="Item owner"
					name="owner" />
			</div>

			<div class="form-group">
				<label>Item status</label>
				<select class="form-control"
					name="status">
					<option value="NOT_STARTED">
						NOT STARTED
					</option>
					<option value="ONGOING">
						ONGOING
					</option>
					<option value="COMPLETE">
						COMPLETE
					</option>
				</select>
			</div>

			<div class="form-group">
				<label>Creation Date</label>
				<input type="date"
					class="form-control"
					value="<?php echo date("Y-m-d"); ?>"
					name="created">
			</div>
			<div class="form-group">
				<input type="submit"
					value="Add"
					class="btn btn-danger"
					name="btn">
			</div>
</div>

	<?php
		if(isset($_POST["btn"])) {
	
			$item->description = $_POST['description'];
			$item->owner = $_POST['owner'];
			$item->status = $_POST['status'];
			$item->created = $_POST['created'];

			$item->postRow();
			header("location:index.php");
		}		
	?>

<div id="lowsection">
    <div class="column1" id="picture">
        <form>
            <img src="picture.php" alt="Picture of the day" width="200" height="200">    
        </form>
    </div>
    <div class="column2" id="tasklist">
	    <h3>Latest entries</h3>
		<?php

			if (!empty($data[0]))
				foreach ($data as $qq)
				{
			?>
				<div> 
					<?php 
						echo $qq['description']; 
					?>
				</div>
			<?php
				};
			?>
	</div>
</div>

</body>
</html>
