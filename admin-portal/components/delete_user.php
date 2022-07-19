<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
} else {
    if (isset($_GET['user_id'])) {
        $cus_id = mysqli_real_escape_string($connection, $_GET['user_id']);
        $query = "UPDATE customers SET is_deleted = 1 WHERE customer_id = '{$cus_id}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: ../users.php?message=user_deleted');
        } else {
            header('Location: ../users.php?error=user_delete_failed');
        }

    } else {
        header('Location: ../users.php');
    }
}

?>

<?php mysqli_close($connection); ?>