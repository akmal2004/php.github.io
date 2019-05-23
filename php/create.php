<?php 

require_once 'config.php';


$name = $surname = $email = "";
$nameErr = $surnameErr = $emailErr = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$input_name = trim($_POST['name']);

	if(empty($input_name))
	{
		$nameErr == "Please Enter Your name";
	}else if(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
		array('options'=>array('regexp' => '/^[a-zA-Z\s]+$/'))))
	{
		$nameErr = "Please enter a valid name";
	}else{
		$name = $input_name;
	}

	$input_surname = trim($_POST['surname']);

	if(empty($input_name))
	{
		$surnameErr == "Please Enter Your surname";
	}else if(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
		array('options'=>array('regexp' => '/^[a-zA-Z\s]+$/'))))
	{
		$surnameErr = "Please enter a valid surname";
	}else{
		$surname = $input_surname;
	}

	$input_email = trim($_POST['email']);

	if(empty($input_email))
	{
		$emailErr == "Please Enter Your email";
	}else if(!filter_var($input_email, FILTER_VALIDATE_REGEXP,
		array('options'=>array('regexp' => '/^[a-zA-Z0-9\-_\.]+@[a-zA-Z\.0-9]+\.[a-z]+$/'))))
	{
		$emailErr = "Please enter a valid email";
	}else{
		$email = $input_email;
	}

	$formErr = empty($name) || empty($surname) || empty($email);

	if(empty($nameErr) && empty($surnameErr) && empty($emailErr) && !$formErr)
	{
		$sql = "INSERT INTO guests (name, surname, email) VALUES (?, ?, ?)";

		if($stmt = mysqli_prepare($conn, $sql))
		{
			mysqli_stmt_bind_param($stmt, 'sss', $param_name, $param_surname, $param_email);

			$param_name = $name;
			$param_surname = $surname;
			$param_email = $email;

			if(mysqli_stmt_execute($stmt))
			{
				header('location: /lesson3.php');
				exit();
			}else{
				echo "Error ".mysqli_error($conn);
			}
		}


	}else{
		echo "Enter all fields";
	}

}





 ?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add new user</title>
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
					<h2>Create Record</h2>
				</div>
				<p>Fill this form and submit</p>
				
				<form action="create.php" method="post">
					<div class="form-group <?= (!empty($nameErr)) ? 'error' : ''; ?>">
						<label>Name</label>
						<input type="text" name="name" class="form-control"
						value="<?= $name?>">
					</div>

					<div class="form-group <?= (!empty($surnameErr)) ? 'error' : ''; ?>">
						<label>Surname</label>
						<input type="text" name="surname" class="form-control"
						value="<?= $surname?>">
					</div>

					<div class="form-group <?= (!empty($emailErr)) ? 'error' : ''; ?>">
						<label>Email</label>
						<input type="text" name="email" class="form-control"
						value="<?= $email?>">
					</div>

					<input type="submit" class="btn btn-primary" value="Submit">
					<a href="lesson3.php" class="btn btn-danger">Cancel</a>
				</form>

			</div>
		</div>

	</div>

</body>
</html>