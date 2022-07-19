<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['pw']);

    $query = "SELECT * FROM customers
              WHERE email = '{$email}' AND password = '{$password}' AND is_deleted = 0
              LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $customer = mysqli_fetch_assoc($result);
            $_SESSION['cus_id'] = $customer['customer_id'];
            $_SESSION['cus_username'] = $customer['username'];
            header("Location: home.php");
        }
    } else {
        echo "Login Failed!";
    }
    // echo "Logged in successfuly!";
} else {
    echo "Failed to Login!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>

<body>
    <h1>Sign In Page</h1>

    <a href="landing_page.php"> back </a>

    <form action="signin.php" method="POST" autocomplete="off">

        Email: <input type="email" name="email" required>
        <br>
        Password: <input type="password" name="pw" required>
        <br>
        <input type="submit" name="login" value="Log in">

    </form>

    <P>Don't you have an account? <a href="signup.php"> Sign Up </a></P>

</body>

</html>

<?php mysqli_close($connection); ?>