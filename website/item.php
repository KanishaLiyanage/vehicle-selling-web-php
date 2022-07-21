<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$pro_id = " ";
$t_price = " ";
$avl_qty = " ";

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

if (!isset($_GET['item_id'])) {
    echo "Product ID not passed!";
    // header('Location: home.php');
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
    echo "ID passed: ".$_GET['item_id'];

    $query = "SELECT * FROM products WHERE product_id = '{$_GET['item_id']}' LIMIT 1";

    $result = mysqli_query($connection, $query);

        if($result){ ?>
        <?php   while($record = mysqli_fetch_array($result)){ 

                $_GET['p_id'] = $record['product_id'];
                $pro_id = $_GET['p_id']; //product id
                $prd_id = $record['product_id']; //product id
                $_GET['p_price'] = $record['price'];
                $prc = $_GET['p_price']; //product one unit price
                $_GET['prd_u'] = $record['qty'];
                $avl_qty = $_GET['prd_u']; //available units

        ?>
                <div>
                <p style="font-size:35px"> 
                    <?php echo $record['product_brand']." ".$record['product_name']?>
                <a href="favFunction.php?productId=<?=$_GET['item_id']?>">
                    <i class="fa fa-heart" style="font-size:30px"> </i>
                </a>
                </p>
                </div>

                <div>
                <img class="itemImage" src="../assets/uploads/products/<?php echo $record['product_img'];?>" alt="<?php echo $record['product_name'];?>" >
                </div>

                <div class="itemInfo">
                    <p>Brand: <?php echo $record['product_brand'] ?></p>
                    <p>Name: <?php echo $record['product_name'] ?></p>
                    <p>Price: $<?php echo $record['price'] ?>
                    <?php
                        if($record['discount'] > 0){
                            ?>  <div class="discount">
                                <strong><?php echo $record['discount'] ?>% OFF</strong>
                                </div>
                            <?php
                        }
                    ?>
                    </p>
                    <p>Availability: <?php echo $record['qty'] ?> items available</p>
                </div>

                <div class="itemDesc">
                    <p>Description: <?php echo $record['product_description'] ?></p>
                </div>

        <?php   }
                
        }

?>

    <form action="item.php" method="POST"> 
        Quantity: <input type="number" min="1" name="qty" size="2" maxlength="3" placeholder="Qty" value="1" required>
        <input type="hidden" name="prc" value="<?php echo $prc; ?>">
        <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
        <input type="hidden" name="available_quantity" value="<?php echo $avl_qty ?>">
        <input type="submit" name="buy" value="Buy Now">
    </form>

    <form action="item.php" method="POST">
        <input type="hidden" name="pro_id" value="<?php echo $pro_id; ?>">
        <input type="submit" name="cart" value="Add to Cart">
    </form>

    <?php
        
        if(isset($_POST['buy'])){

            $c_qty = mysqli_real_escape_string($connection, $_POST['qty']);
            $a_qty = mysqli_real_escape_string($connection, $_POST['available_quantity']);
            $p_price = mysqli_real_escape_string($connection, $_POST['prc']);
            $prd_id = mysqli_real_escape_string($connection, $_POST['pro_id']);

            if($c_qty <= $a_qty){
                $t_price = $p_price * $c_qty;
                header("location: confirmPurchase.php?item_id={$prd_id}&total={$t_price}&qty={$c_qty}");
            }else{
                echo "<script>
                      alert('You are exceeded the available quantity!');
                      window.location.href='item.php?item_id={$prd_id}';
                      </script>";
            }

        }

        if(isset($_POST['cart'])){
            $prd_id = mysqli_real_escape_string($connection, $_POST['pro_id']);
            header("location: cartFunction.php?item_id={$prd_id}");
        }

    ?>

</body>

</html>

<?php mysqli_close($connection); ?>