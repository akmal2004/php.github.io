<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lesson 3</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header my-3">
					<h2 class="float-left"> Users Details </h2>
					<a href="create.php" class="btn btn-success float-right">
						Add New
					</a>
				</div>
			</div>
		</div>

<?php 

	require_once 'config.php';

	$sql = "SELECT * FROM guests";

	if($result = mysqli_query($conn, $sql))
	{
		if(mysqli_num_rows($result)>0)
		{
 ?>
			<table class="table table-bordered table-dark table-striped mt-3">
				
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Surname</th>
					<th>Email</th>
					<th>Action</th>
				</tr>

				<?php 
					while($row = mysqli_fetch_array($result))
					{
				 ?>
				 <tr>
				 	<td><?= $row['id'] ?></td>
				 	<td><?= $row['name'] ?></td>
				 	<td><?= $row['surname'] ?></td>
				 	<td><?= $row['email'] ?></td>
				 	<td>
				 		<a href="edit.php?id=<?= $row['id'] ?>" class="text-warning mr-3"><i class="fas fa-pen"></i></a>
						<a href="delete.php?id=<?= $row['id'] ?>" class="text-danger"><i class="fas fa-trash-alt"></i></a>
				 	</td>
				 </tr>
				<?php 
					}
				?>
			</table>
			<?php 
			}else{
				echo "<h1> No records </h1>";
			}
		}else{
			echo "Error: ".mysqli_error($conn);
		}

			 ?>
				
</div>

</body>
</html>



<!-- "save_on_focus_lost": true, -->