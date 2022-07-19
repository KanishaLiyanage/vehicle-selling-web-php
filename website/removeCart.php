<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}else{
    if(isset($_GET['item_id'])){
        echo "ID Passed!";

        $delete = "UPDATE cart SET is_deleted = 1
                   WHERE product_id = {$_GET['item_id']} AND customer_id = {$_SESSION['cus_id']}
                   LIMIT 1";
                   

        $result = mysqli_query($connection, $delete);

        if($result){
            header("location: myCart.php?item_id={$_GET['item_id']}has_successfuly_removed_from_your_cart");
        }

    }else{
        echo "ID pass failed!";
    }
}

?>

<?php mysqli_close($connection); ?>