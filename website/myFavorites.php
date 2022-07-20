<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$p_id = " ";
$c_id = " ";
$t_price = " ";
$o_qty = " ";

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
    <title>My Favorites</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>
    <h1>My Favorites</h1>
    </center>

    <?php

        $fav_query = "SELECT
        favorites.*,
        products.*
        FROM
        favorites
        INNER JOIN products ON favorites.product_id = products.product_id
        WHERE
        favorites.customer_id = '{$_SESSION['cus_id']}'
        AND
        favorites.is_deleted = 0";

    $result = mysqli_query($connection, $fav_query);

    if ($result) {
        echo mysqli_num_rows($result) . " Records found!";

        if (mysqli_num_rows($result) > 0) { ?>

            <div class="gridContainer">

                <?php while ($record = mysqli_fetch_array($result)) {

                    $_GET['p_id'] = $record['product_id'];

                ?>
                    <div>

                        <a class="linkedPage" href="item.php?item_id=<?= $_GET['p_id'] ?>">

                            <div class="itemCard">

                                <img class="itemImage" src="../assets/uploads/products/<?= $record['product_img'] ?>" alt="<?php $record['product_img'] ?>">

                                <p class="itemName"><?php echo $record['product_brand']." ".$record['product_name'] ?></p>
                                <p class="itemPrice"><strong> $<?php echo $record['price'] ?> </strong></p>
                                <p class="itemQty"><?php echo $record['qty'] ?> Units Available</p>

                            </div>

                        </a>

                        <div class="buyBtnBox"> <a class="buyBtn" href="purchase.php?item_id=<?=$_GET['p_id']?>"> Buy </a> </div>
                        <a class="cartBtn" href="cartFunction.php?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-shopping-cart" style="font-size:25px"></i> </a>
                        <a class="favBtn" href="removeFav.php?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-heart" style="font-size:25px"> </i></i> </a>

                    </div>

                <?php } ?>

        </div>

    <?php }
    } else {
        echo "DB failed!";
    }

?>

</body>

</html>

<?php mysqli_close($connection); ?>