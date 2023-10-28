<?php
include("../connection/connection.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $branch = $_POST['branch'];
    $existingUserQuery = "SELECT COUNT(*) as count FROM tbl_dev WHERE dev_email = '$email'";
    $result = $con->query($existingUserQuery);
    $row = $result->fetch_assoc();
    $userCount = $row['count'];

    if ($userCount === '0') {
        if ($_POST["password"] == $_POST["confirm_password"]) {
            echo $insertQuery = "INSERT INTO `tbl_dev`(`dev_name`, `dev_branch`, `dev_email`, `dev_password`) VALUES ('$name','$branch','$email','$password')";
            if ($con->query($insertQuery) === TRUE) {
                echo "<script>alert('Dev registered successfully!');</script>";
                header("location: ../login/login.php");
            }
        } else {
            echo "<script>alert('Dev with this email already exists!');</script>";
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
                <input required class="login-form__name" type="text" name="name" placeholder="name">

                <div class="box">
                    <select required id="branch" name="branch">
                        <option value="choose">Choose</option>
                        <option value="frontend">Frontend</option>
                        <option value="backend">Backend</option>
                        <option value="full-stack">Full Stack</option>
                        <option value="cloud">Cloud</option>
                        <option value="aiml">AI/ML</option>
                    </select>
                </div>
        </div>

        <input required class="login-form__email" type="email" name="email" placeholder="email">
        <input required class="login-form__password__confirm" type="password" name="password" placeholder="password">
        <input required class="login-form__password" type="password" name="confirm_password" placeholder="confirm password">

        <button class="login-form__submit but" type="submit" name="submit">Register</button>

        <a class="login-form__create" href="../login/login.php">Login to existing account</a>
        </form>
        </div>
    </main>
</body>

</html>