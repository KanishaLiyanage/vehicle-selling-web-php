<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
</head>
<body>
    
</body>
</html>

<?php mysqli_close($connection); ?>