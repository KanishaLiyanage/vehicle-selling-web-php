<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$pro_id = " ";
$t_price = " ";
$p_dis = " ";
$t_disAdded = " ";
$avl_qty = " ";

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

if (!isset($_GET['item_id'])) {
    echo "Product ID not passed!";
    // header('Location: home.php');
}

?>

<?php

if (isset($_POST['buy'])) {

    $c_qty = mysqli_real_escape_string($connection, $_POST['qty']);
    $a_qty = mysqli_real_escape_string($connection, $_POST['available_quantity']);
    $p_price = mysqli_real_escape_string($connection, $_POST['prc']);
    $discount = mysqli_real_escape_string($connection, $_POST['discount']);
    $prd_id = mysqli_real_escape_string($connection, $_POST['pro_id']);

    if ($c_qty <= $a_qty) {
        if ($discount > 0) {
            $t_disAdded = $p_price * ($discount / 100);
            $t_price = ($p_price - $t_disAdded) * $c_qty; //total discounted price
            header("location: confirmPurchase.php?item_id={$prd_id}&total={$t_price}&discounted={$t_disAdded}&qty={$c_qty}");
        } else {
            $t_price = $p_price * $c_qty; //total price
            header("location: confirmPurchase.php?item_id={$prd_id}&total={$t_price}&qty={$c_qty}");
        }
    } else {
        echo "<script>
                      alert('You are exceeded the available quantity!');
                      window.location.href='item.php?item_id={$prd_id}';
                      </script>";
    }
}

if (isset($_POST['cart'])) {
    $prd_id = mysqli_real_escape_string($connection, $_POST['pro_id']);
    header("location: cartFunction.php?item_id={$prd_id}");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="css/item.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php
    echo "ID passed: " . $_GET['item_id'];

    $query = "SELECT * FROM products WHERE product_id = '{$_GET['item_id']}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) { ?>
        <?php while ($record = mysqli_fetch_array($result)) {

            $_GET['p_id'] = $record['product_id'];
            $pro_id = $_GET['p_id']; //product id
            $prd_id = $record['product_id']; //product id
            $_GET['p_price'] = $record['price'];
            $prc = $_GET['p_price']; //product one unit price
            $_GET['dis'] = $record['discount'];
            $p_dis = $_GET['dis'];
            $_GET['prd_u'] = $record['qty'];
            $avl_qty = $_GET['prd_u']; //available units

        ?>
            <!-- single product details -->
            <div class="small-container single-product">
                <div class="row">
                    <div class="col-2">
                        <img src="../assets/uploads/products/<?php echo $record['product_img']; ?>" alt="<?php echo $record['product_name']; ?>" width="100%" id="ProductImg" />
                    </div>

                    <div class="col-2">
                        <p>
                            <?php echo $record['product_brand'] ?>
                        </p>
                        <h1><?php echo $record['product_name'] ?></h1>
                        <h4>
                            $<?php echo $record['price'] ?>
                            <?php
                            if ($p_dis > 0) {
                            ?> <div class="discount">
                                    <strong><?php echo $p_dis ?>% OFF</strong>
                                </div>
                            <?php
                            }
                            ?>
                        </h4>
                        <p> <?php echo $record['qty'] ?> items available</p>

                        <form action="item.php" method="POST">
                            <input type="number" min="1" name="qty" size="2" maxlength="3" placeholder="Qty" value="1" required>
                            <input type="hidden" name="prc" value="<?php echo $prc; ?>">
                            <input type="hidden" name="discount" value="<?php echo $p_dis ?>">
                            <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
                            <input type="hidden" name="available_quantity" value="<?php echo $avl_qty ?>">
                            <button class="btn" type="submit" name="buy">Buy Now</button>
                        </form>

                        <h3>Product Details</h3>
                        <br />
                        <p><?php echo $record['product_description'] ?></p>
                    </div>
                </div>
            </div>

    <?php   }
    }

    ?>

    <script src="./js/header.js"></script>
    <?php require_once('./components/footer.php'); ?>

</body>

</html>

<?php mysqli_close($connection); ?>