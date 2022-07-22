<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
        <form action="contact.php" method="POST" class="emailForm">
            To <input type="text" name="to" required>
            <br>
            Subject <input type="text" name="subject" required>
            <br>
            Body <textarea name="body" rows="20" cols="80" required></textarea>
            <br>
            <input type="submit" name="Send" required>
        </form>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>
