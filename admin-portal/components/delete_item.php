<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>
<?php

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
} else {
    if (isset($_GET['item_id'])) { //check wether the passed parameter is passed or not
        $item_id = mysqli_real_escape_string($connection, $_GET['item_id']);
        $query = "UPDATE products SET is_deleted = 1 WHERE product_id = '{$item_id}' LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            header('Location: ../items_list.php?message=item_deleted');
        } else {
            header('Location: ../items_list.php?error=item_delete_failed');
        }
    } else {
        header('Location: ../items_list.php');
    }
}

?>

<?php mysqli_close($connection); ?>