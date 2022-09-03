<?php
	include_once 'class/tasks.php';
	include_once 'class/api_locator.php';
	$item = new ClientTask($API_URL);

	$owner = isset($_GET['owner']) ? $_GET['owner'] : '';
//	$len = isset($_GET['len']) ? $_GET['len'] : '';
	$len = '';
	$data = $item->getAll($len, $owner);
?>

<html>

<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=UTF-8">

	<title>View List</title>

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<link rel="stylesheet"
		href="css/style.css">
</head>

<body>
	<div class="container mt-5">
		
		<!-- top -->
		<div class="row">
			<div class="col-lg-8">
				<h1>View Task List</h1>
				<a href= "add.php?owner=<?php echo $owner; ?>" > 
					Add Item
				</a>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-8">
						
						Owner Filtering
						<form method="get" action="">
							<input type="text"
								class="form-control"
								maxlength="70"
								placeholder="filter by owner"
								name="owner">
						
							<div class="col-lg-4"
								method="get"> 
								<input type="submit"
								class="btn btn-danger"
								name="btn" value="filter">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Grocery Cards -->
		<div class="row mt-4">
			<?php
				if (!empty($data[0]))
					foreach ($data as $qq)
					{
			?>

			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">
						<?php 
							echo $qq['description']; 
						?>							
						</h5>
						<h6 class="card-subtitle mb-2 text-muted">
							<?php echo
							$qq['owner']; ?>
						</h6>
						<?php
						if($qq['status'] == 'ONGOING') {
						?>
						<p class="text-info">ONGOING</p>

						<?php
						} else if($qq['status'] == 'COMPLETE') {
						?>
						<p class="text-success">COMPLETE</p>

						<?php } else { ?>
						<p class="text-danger">NOT STARTED</p>

						<?php } ?>
						<a href=
						"delete.php?id=<?php echo $qq['id']; ?>"
							class="card-link">
							Delete
						</a>
						<a href=
						"update.php?id=<?php echo $qq['id']; ?>"
							class="card-link">
							Update
						</a>
					</div>
				</div><br>
			</div>
			<?php
			};
			?>
		</div>
	</div>
</body>

</html>
