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
    <link rel="stylesheet" href="css/landing.css">
</head>

<body>

    <div class="landing-page">
        <div class="container">
            <div class="header-area">
                <div class="logo">Vehicle <b>Selling</b></div>
                <ul class="links">
                    <li><a href="home.php"> Go to Home Page </a></li>
                    <li><a href="signin.php"> Sign In </a></li>
                    <li><a href="signup.php"> Sign Up </a></li>
                    <li><a class="headerBtn" href="signin.php" style="color: white;"> Get Started </a></li>
                </ul>
            </div>
            <div class="info">
                <h1>Looking For Buy A Vehicle</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus odit nihil ullam nesciunt quidem iste, Repellendus odit nihil</p>
                <button><a href="signin.php"> Get Started </a></button>
            </div>
            <div class="image">
                <img src="https://i.postimg.cc/65QxYYzh/001234.png">
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</body>

</html>

<?php mysqli_close($connection); ?>