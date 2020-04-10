<?php
$username = " ";
$email = " ";
$errors = array();

$db = mysqli_connect('localhost', 'root', '','test');

if(isset($POST['register'])){
	$username = mysqli_real_escape_string($POST['username']);
	$email = mysqli_real_escape_string($POST['email']);
	$password_1 = mysqli_real_escape_string($POST['password_1']);
	$password_2 = mysqli_real_escape_string($POST['password_2']);

	if(empty($username)){
		array_push($errors, "Username is required");
	}

	if(empty($email)){
		array_push($errors, "Email is required");
	}

	if(empty($password_1)){
		array_push($errors, "Password is required");
	}

	if($password_1 != $password_2){
		array_push($errors, "The two passwords do not match");
	}

	if(count($errors) == 0)
	{
		$password = md5($password_1);
		$sql = "INSERT INTO users (username, email, password) Values ('$username', '$email', '$password')";
		mysqli_query($db, $sql);
	}
}