<?php 

require_once 'config.php';

$name = $email = $surname = '';
$nameErr = $emailErr = $surnameErr = '';

if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$input_name = trim($_POST['name']);

	if(empty($input_name))
	{
		$nameErr = "Please enter your name";
	}else if(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[a-zA-Z\s]+$/')))){
		$nameErr = 'Please enter valid name';
	}else{
		$name = $input_name;
	}
	
	$input_surname = trim($_POST['surname']);

	if(empty($input_surname))
	{
		$surnameErr = "Please enter your surname";
	}else if(!filter_var($input_surname, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[a-zA-Z\s]+$/')))){
		$surnameErr = 'Please enter valid surname';
	}else{
		$surname = $input_surname;
	}
	
	$input_email = trim($_POST['email']);

	if(empty($input_email))
	{
		$emailErr = 'Please enter your email';
	}else if(!filter_var($input_email, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[a-zA-Z0-9\-_\.]+@[a-zA-Z\.0-9]+\.[a-z]+$/')))){
		$emailErr = 'Please enter valid email';
	}else{
		$email = $input_email;
	}

	$formErr = empty($name) || empty($surname) || empty($email);
	if(empty($nameErr) && empty($surnameErr) && empty($emailErr))
	{
		$sql = 'UPDATE guests SET name=?, surname=?, email=? WHERE id=?';
		if($stmt = mysqli_prepare($conn, $sql))
		{
			mysqli_stmt_bind_param($stmt, 'sssi', $param_name, $param_surname, $param_email, $param_id);

			$param_name = $name;
			$param_surname = $surname;
			$param_email = $email;
			$param_id = $id;

			if (mysqli_stmt_execute($stmt)) {
				header('location: /lesson3.php');
				exit();
			}else{
				echo 'Error, try again';
			}
		}

		mysqli_stmt_close($stmt);
	}

}else{

	if(isset($_GET['id']) && !empty(trim($_GET['id'])))
	{
		$id = trim($_GET['id']);

		$sql = 'SELECT * FROM guests WHERE id = ?';

		if($stmt = mysqli_prepare($conn, $sql))
		{
			mysqli_stmt_bind_param($stmt, 'i', $param_id);

			$param_id = $id;

			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);

				if(mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					$name = $row['name'];
					$surname = $row['surname'];
					$email = $row['email'];

				}else{
					header('location: error.php');
					exit();
				}
			}else{
				echo "Error, try again";
			}
		}
	}else{
		// header('location: error.php');
		// exit();
	}

}


 ?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Users</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	
	<style>
		.error label{
			background-color: red;
			color: #fff;
		}
	</style>
</head>
<body>
	
	<div class="container">
		

		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
					<h2>Update Record</h2>
				</div>
				<p>Please input values and update</p>

				<form action="edit.php" method="post">
					
					<div class="form-group <?= (!empty($nameErr)) ? 'error' : '' ?>">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value='<?= $name ?>'>
						<span class="error"> <?= $nameErr ?> </span>
					</div>

					<div class="form-group <?= (!empty($surnameErr)) ? 'error' : '' ?>">
						<label>Surname</label>
						<input type="text" name="surname" class="form-control" value='<?= $surname ?>'>
						<span class="error"> <?= $surnameErr ?> </span>
					</div>

					<div class="form-group <?= (!empty($emailErr)) ? 'error' : '' ?>">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value='<?= $email ?>'>
						<span class="error"> <?= $emailErr ?> </span>
					</div>

					<input type="hidden" name='id' value="<?= $id ?>">

					<input type="submit" class="btn btn-primary" value="Submit">
					<a href="lesson3.php" class="btn btn-danger">Cancel</a>

				</form>

			</div>
		</div>



	</div>



</body>
</html>