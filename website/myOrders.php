<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$p_id = " ";
$t_price = 0;
$double_tprice = (float)$t_price;

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
    <link rel="stylesheet" href="css/orders.css">
    <link rel="stylesheet" href="css/itemCard.css">
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
        echo mysqli_num_rows($check_order_query) . " Cars purchased";

        if (mysqli_num_rows($check_order_query) > 0) { ?>

            <div class="gridContainer">

                <?php while ($record = mysqli_fetch_array($check_order_query)) {

                    $_GET['p_id'] = $record['product_id'];
                    $_GET['purchased_qty'] = $record['order_qty'];
                    $_GET['products_qty'] = $record['qty'];

                ?>

                    <div class="product-card">
                        <a class="linkedPage" href="item.php?item_id=<?= $_GET['p_id'] ?>">
                            <?php
                            if ($record['discount'] > 0) {
                            ?> <div class="badge">
                                    <strong><?php echo $record['discount'] ?>% OFF</strong>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="product-tumb">
                                <img class="itemImage" src="../assets/uploads/products/<?php echo $record['product_img']; ?>" alt="<?php echo $record['product_name']; ?>">
                            </div>
                            <div class="product-details">
                                <span class="product-catagory"><?php echo $record['product_brand'] ?></span>
                                <h4>
                                    <p><?php echo $record['product_brand'] . " " . $record['product_name'] ?></p>
                                </h4>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p> -->
                                <p><?php echo $record['qty'] ?> Items Available</p>
                                <p>Purchased Units: <?php echo $record['order_qty'] ?> </p>
                                <div class="product-bottom-details">
                                    <div class="product-price">$<?php echo $record['order_price'] ?></div>
                                    <div class="product-links">
                                        <a href="favFunction.php?item_id=<?= $_GET['p_id'] ?>"><i class="fa fa-heart"></i></a>
                                        <a href="removeOrder.php?item_id=<?= $_GET['p_id'] ?>&purchased_qty=<?= $_GET['purchased_qty'] ?>&products_qty=<?= $_GET['products_qty'] ?>"> <i class="fa fa-trash-o"> </i></i> </a>
                                    </div>
                                </div>
                            </div>
                        </a>
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

    if ($total_check) {

        while ($price = mysqli_fetch_array($total_check)) {

            $o_price = $price['order_price'];

            $double_o_price = (float)$o_price;

            $double_tprice += $double_o_price;
        }
    }

    ?>

    <center>
        <p class="tPrice">Orders Total: $<?php echo $double_tprice; ?></p>
    </center>


</body>

</html>

<?php mysqli_close($connection); ?>