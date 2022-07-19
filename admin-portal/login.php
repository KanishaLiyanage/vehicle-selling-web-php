<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($connection, $_POST["admin_mail"]);
    $pw = mysqli_real_escape_string($connection, $_POST["admin_pw"]);
    //$hashed_pw = sha1($pw);
    $query = "SELECT * FROM admin_accounts
              WHERE admin_email = '{$email}' AND admin_password = '{$pw}'
              LIMIT 1";

    $resultset = mysqli_query($connection, $query);

    if ($resultset) {
        if (mysqli_num_rows($resultset) == 1) {
            $admin = mysqli_fetch_assoc($resultset);
            $_SESSION['id'] = $admin['admin_id'];
            $_SESSION['username'] = $admin['admin_user_name'];
            header("Location: dashboard.php");
        } else {
            echo "Invalid email or password!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login as Admin</h1>
    <form action="login.php" method="post" autocomplete="off">
        <?php 
        if(isset($_GET['logout'])){
            echo '<p class="infomsg"> You have successfuly logout from the system.</p>';
        }
         ?>
        Email: <input type="email" name="admin_mail" maxlength="50" autocomplete="false" required>
        <br>
        Password: <input type="password" name="admin_pw" maxlength="20" autocomplete="false" required>
        <br>
        <input type="submit" name="submit" value="login">
    </form>
</body>

</html>

<?php mysqli_close($connection); ?>