<?php 

if (isset($_POST['id']) && !empty($_POST['id'])) {
	require_once 'config.php';

	$sql = 'DELETE FROM guests WHERE id = ?';

	if ($stmt = mysqli_prepare($conn, $sql)) {
		mysqli_stmt_bind_param($stmt, 'i', $param_id);
		$param_id = trim($_POST['id']);

		if (mysqli_stmt_execute($stmt)) {
			header('location: lesson3.php');
			exit();
		}else{
			echo "Error";
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}else{
	if (empty(trim($_GET['id']))) {
		header('location: error.php');
		exit();
	}
}


 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete record</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h1>Delete record</h1>
				</div>
				<form action="delete.php" method="post">
					<div class="alert alert-danger fade show">
						<input type="hidden" name="id" value="<?= trim($_GET['id'])?>">

						<p> Are you sure to delete this record?</p>

						<div>
							<input type="submit" value="Yes" class="btn btn-success">
							<a href="lesson3.php" class="btn btn-danger">No</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>