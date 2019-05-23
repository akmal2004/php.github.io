<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = 'users';

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn)
{
	die('Error: could not connect: '.mysqli_connect_error());
}

 ?>