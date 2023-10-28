<?php
include("../connection/connection.php");

if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$password=$_POST['password'];
    $sel="select * from tbl_manager where manager_email='$email' and  manager_password='$password'";	
	$m_res=$con->query($sel);
	if($m_res->num_rows>0)
	{
		$row=$m_res->fetch_assoc();
		$_SESSION['mid']=$row['manager_id'];
		$_SESSION['name']=$row['manager_name'];
		$_SESSION['pwd']=$row['manager_password'];
		header("location: ../manage/manage.html");
	}
	else
	{
		echo "<script>alert('invalid username or password !!!');</script>";
	}
}
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Login</title>
		<link rel="stylesheet" href="../shared.css">
		<link rel="stylesheet" href="login.css">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

		<script defer src="login.js"></script>
	</head>

	<body>
		<header class="main-header">
			<div class="main-header__div">
				<h2 class="main-header__title">Work Allocator</h2>
			</div>
		</header>

		<main>
			<div class="card">
				<h3>Login to sdkfjdsl</h3>

				<form method="post" class="login-form">
					<input required class="login-form__email" type="email" name="email" placeholder="email">
					<input required class="login-form__password" type="password" name="password" placeholder="password">

					<button class="login-form__submit but" type="submit" name="submit">Login</button>

					<a class="login-form__create" href="register.html">Create a new account</a>
				</form>
			</div>
		</main>
	</body>
</html>
