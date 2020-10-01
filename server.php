<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "test";
$errors = array();

$db = mysqli_connect($host, $user, $pass, $dbname);

if(isset($POST['register'])){
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password_1 = $POST['password_1'];
	$password_2 = $POST['password_2'];
	
	/* to prevent sql injection mysqli_real_escape_string */
	$username = mysqli_real_escape_string($username);
	$email = mysqli_real_escape_string($email);
	$password_1 = mysqli_real_escape_string($password_1);
	$password_2 = mysqli_real_escape_string($password_2);
	
	/* to prevent xss attack htmlentities */
	$username = htmlentities($username);
	$email = htmlentities($email); 
        $password_1 = htmlentities($password_1);
	$password_2 = htmlentities($password_2); 

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
		$sql = "INSERT INTO users (username, email, password) Values ('$username', '$email', '$password_1')";
		mysqli_query($db, $sql);
	}
}
