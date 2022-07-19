<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

$updated_qty = " ";
$products_qty = " ";

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}else{
    if(isset($_GET['item_id']) && isset($_GET['purchased_qty']) && isset($_GET['products_qty'])){

        echo "ID: ".$_GET['item_id']."<br>"."Purchased Units: ".$_GET['purchased_qty']."<br>"."Products Units: ".$_GET['products_qty']."<br>";

        $updated_qty = $_GET['products_qty'] + $_GET['purchased_qty'];

        echo "Updated Qty: ".$updated_qty;

        $delete = "UPDATE orders SET is_deleted = 1
                   WHERE product_id = {$_GET['item_id']} AND customer_id = {$_SESSION['cus_id']}
                   LIMIT 1";
        
        $update_qty = "UPDATE products SET qty = '{$updated_qty}'
                       WHERE product_id = {$_GET['item_id']}
                       LIMIT 1";

        $delete_result = mysqli_query($connection, $delete);
        $update_qty_result = mysqli_query($connection, $update_qty);

        if($delete_result && $update_qty_result){
            header("location: myOrders.php?item_id={$_GET['item_id']}order_cancelled_successfuly.");
        }

    }else{
        echo "ID pass failed!";
    }
}

?>

<?php mysqli_close($connection); ?>