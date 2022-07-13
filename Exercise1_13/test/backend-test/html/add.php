<html>

<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=UTF-8">

	<title>Add List</title>

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

    <style>
    * {
        box-sizing: border-box;
    }

    /* Create two columns that float next to each other */
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
					<option value="0">
						NOT STARTED
					</option>
					<option value="1">
						ONGOING
					</option>
					<option value="2">
						COMPLETE
					</option>
				</select>
			</div>

			<div class="form-group">
				<label>Creation Date</label>
				<input type="date"
					class="form-control"
					placeholder="Date"
					name="date">
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
			include("connect.php");
			$item_name=$_POST['description'];
			$item_qty=$_POST['owner'];
			$item_status=$_POST['status'];
			$date=$_POST['date'];
	

			$q="insert into grocerytb(Description,
			Owner,Status,Date)
			values('$description',$owner,
			'$status','$date')";

			mysqli_query($con,$q);
			header("location:index.php");
		}
		
		// if(!mysqli_query($con,$q))
		// {
			// echo "Value Not Inserted";
		// }
		// else
		// {
			// echo "Value Inserted";
		// }
	?>

<div id="lowsection">
    <div class="column1" id="picture">
        <form>
            <img src="picture.php" alt="Picture of the day" width="200" height="200">    
        </form>
    </div>
    <div class="column2" id="tasklist">
	    <h3>Latest entries</h3>
        <div> plan a</div>
        <div> do b</div>
        <div> check c</div>
        <div> act d</div>               
	</div>
</div>

</body>
</html>
