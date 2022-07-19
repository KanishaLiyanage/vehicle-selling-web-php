<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$p_id = " ";
$t_price = 0;
$double_tprice = (double)$t_price;

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
    <title>My Orders</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
        <h1>My Orders</h1>
    </center>

<?php

    $orders_query = "SELECT
                     orders.*,
                     products.*
                     FROM
                     orders
                     INNER JOIN products ON orders.product_id = products.product_id
                     WHERE orders.customer_id = '{$_SESSION['cus_id']}' AND orders.is_deleted = 0";

    $check_order_query = mysqli_query($connection, $orders_query);

    if ($check_order_query) {
        echo mysqli_num_rows($check_order_query) . " Records found!";

        if (mysqli_num_rows($check_order_query) > 0) { ?>

            <div class="gridContainer">

                <?php while ($record = mysqli_fetch_array($check_order_query)) {

                    $_GET['p_id'] = $record['product_id'];
                    $_GET['purchased_qty'] = $record['order_qty'];
                    $_GET['products_qty'] = $record['qty'];

                ?>
                    <div>

                        <a class="linkedPage" href="item.php?item_id=<?= $_GET['p_id'] ?>">

                            <div class="itemCard">

                                <img class="itemImage" src="../assets/uploads/products/<?= $record['product_img'] ?>" alt="<?= $record['product_img'] ?>">

                                <p class="itemName"><?php echo $record['product_brand']." ".$record['product_name'] ?></p>
                                <p class="itemPrice"><strong> $<?php echo $record['order_price'] ?> </strong></p>
                                <p class="itemQty">Purchased Units: <?php echo $record['order_qty'] ?> </p>

                            </div>

                        </a>

                        <a class="ordersFavBtn" href="#?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-heart" style="font-size:25px"> </i></i> </a>

                        <a class="ordersTrashBtn" href="removeOrder.php?item_id=<?=$_GET['p_id']?>&purchased_qty=<?=$_GET['purchased_qty']?>&products_qty=<?=$_GET['products_qty']?>"> <i class="fa fa-trash-o" style="font-size:25px"> </i></i> </a>

                    </div>

                <?php } ?>

        </div>

    <?php }
    } else {
        echo "DB failed!";
    }

?>

<?php

        $total_query = "SELECT
                        orders.*,
                        products.*
                        FROM
                        orders
                        INNER JOIN products ON orders.product_id = products.product_id
                        WHERE
                        orders.customer_id = '{$_SESSION['cus_id']}' AND orders.is_deleted = 0";

        $total_check = mysqli_query($connection, $total_query);

        if($total_check){

            while($price = mysqli_fetch_array($total_check)){

                $u_price = $price['price'];
                $o_price = $price['order_price'];

                $double_uprice = (double)$o_price;

                $double_tprice += $double_uprice;

            }

        }

?>

    <center> <p class="tPrice">Orders Total: $<?php echo $double_tprice; ?></p> </center>


</body>

</html>

<?php mysqli_close($connection); ?>
