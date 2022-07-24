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
    <title>My Cart</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/itemCard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
        <h1>My Cart</h1>
    </center>

    <?php

    $cart_query = "SELECT
            cart.*,
            products.*
            FROM
            cart
            INNER JOIN products ON cart.product_id = products.product_id
            WHERE
            cart.customer_id = '{$_SESSION['cus_id']}' AND cart.is_deleted = 0";

    $result = mysqli_query($connection, $cart_query);

    if ($result) {
        echo mysqli_num_rows($result) . " Cars are in your cart";

        if (mysqli_num_rows($result) > 0) { ?>

            <div class="gridContainer">

                <?php while ($record = mysqli_fetch_array($result)) {

                    $_GET['p_id'] = $record['product_id'];

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
                                <div class="buyBtnBox"> <a class="buyBtn" href="purchase.php?item_id=<?= $_GET['p_id'] ?>"> Buy </a> </div>
                                <h4>
                                    <p><?php echo $record['product_brand'] . " " . $record['product_name'] ?></p>
                                </h4>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p> -->
                                <p><?php echo $record['qty'] ?> Items Available</p>
                                <div class="product-bottom-details">
                                    <div class="product-price">$<?php echo $record['price'] ?></div>
                                    <div class="product-links">
                                        <a href="favFunction.php?item_id=<?= $_GET['p_id'] ?>"><i class="fa fa-heart"></i></a>
                                        <a href="removeCart.php?item_id=<?= $_GET['p_id'] ?>"> <i class="fa fa-trash-o"></i> </a>
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
                        cart.*,
                        products.*
                        FROM
                        cart
                        INNER JOIN products ON cart.product_id = products.product_id
                        WHERE
                        cart.customer_id = '{$_SESSION['cus_id']}'
                        AND cart.is_deleted = 0";

    $total_check = mysqli_query($connection, $total_query);

    if ($total_check) {

        while ($price = mysqli_fetch_array($total_check)) {

            $u_price = $price['price'];

            $double_uprice = (float)$u_price;

            $double_tprice += $double_uprice;
        }
    }

    ?>

    <center>
        <p class="tPrice">Cart Total: $<?php echo $double_tprice; ?></p>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>