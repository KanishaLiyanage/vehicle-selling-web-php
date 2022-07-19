<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>

<body>
    <h1>Landing Page</h1>
    <a href="home.php"> Go to Home Page </a>
    <hr>
    <a href="signin.php"> Sign In </a>
    <br>
    <a href="signup.php"> Sign Up </a>
    <br>
</body>

</html>

<?php mysqli_close($connection); ?>