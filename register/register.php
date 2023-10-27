<?php
include("../connection/connection.php");

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
    $existingUserQuery = "SELECT COUNT(*) as count FROM tbl_manager WHERE manager_email = '$email'";
  $result = $con->query($existingUserQuery);
  $row = $result->fetch_assoc();
  $userCount = $row['count'];

  if ($userCount === '0') {
    if ($_POST["password"] == $_POST["confirm_password"]) {
        echo $insertQuery = "INSERT INTO tbl_manager (manager_name, manager_email, manager_password) VALUES ('$name','$email','$password')";
        if ($con->query($insertQuery) === TRUE) {
        echo "<script>alert('User registered successfully!');</script>";
        header("location: ../manage/manage.html");
      }
      } else {
        echo "<script>alert('User with this email already exists!');</script>";
  }
}
}
?>
    <!DOCTYPE html>

    <html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Register-Task Master</title>
        <link rel="stylesheet" href="../shared.css">
        <link rel="stylesheet" href="../login/login.css">
        <link rel="stylesheet" href="register.css">

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
                <h3>Create new DEV account</h3>

                <form method="post" class="login-form">
                    <input required class="login-form__name" type="text"  name="name" placeholder="name">

                    <div class="box">
                        <select  name="branch">
                            <option selected disabled>Choose your branch</option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                            <option value="3">Option 3</option>
                            <option value="4">Option 4</option>
                            <option value="5">Option 5</option>
                            <option value="6">Option 6</option>
                        </select>
                    </div>

                    <input required class="login-form__email" type="email" name="email" placeholder="email">
                    <input required class="login-form__password__confirm" type="password" name="password" placeholder="password">
                    <input required class="login-form__password" type="password" name="confirm_password" placeholder="confirm password">

                    <button class="login-form__submit but" type="submit" name="submit">Register</button>

                    <a class="login-form__create" href="login.php">Login to existing account</a>
                </form>
            </div>
        </main>
    </body>

    </html>