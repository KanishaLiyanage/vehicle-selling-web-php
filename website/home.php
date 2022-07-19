<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

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
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="homeHeader">
        <p><a href="profile.php"> Go to Profile </a></p>
        <p><a href="myOrders.php"> My Orders </a></p>
        <p><a href="myCart.php"> Cart </a></p>
        <p><a href="myFavorites.php"> Favorites </a></p>
    </div>

    <center> <h1>Home Page</h1> </center>
   
    <?php

    $query = "SELECT* FROM products
              WHERE is_deleted = 0  AND qty > 0";

    $result = mysqli_query($connection, $query);

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
                            
                                <img class="itemImage" src="../assets/uploads/products/<?php echo $record['product_img'];?>" alt="<?php echo $record['product_name'];?>" >

                                <p class="itemName"><?php echo $record['product_brand']." ".$record['product_name'] ?></p>
                                <p class="itemPrice"><strong> $<?php echo $record['price'] ?> </strong></p>
                                <p class="itemQty"><?php echo $record['qty'] ?> Items Available</p>

                            </div>

                        </a>

                        <div class="buyBtnBox"> <a class="buyBtn" href="purchase.php?item_id=<?=$_GET['p_id']?>"> Buy </a> </div>
                        <a class="cartBtn" href="cartFunction.php?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-shopping-cart" style="font-size:25px"></i> </a>
                        <a class="favBtn" href="favFunction.php?item_id=<?=$_GET['p_id']?>"> <i class="fa fa-heart" style="font-size:25px"> </i></i> </a>

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
