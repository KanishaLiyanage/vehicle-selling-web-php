<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

$p_id = " ";
$c_id = " ";
$t_price = " ";
$c_qty = " ";
$a_qty = " ";

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

if (isset($_GET['item_id'])) {
    echo "ID passed!";
} else {
    echo "ID pass failed!";
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

    <h1>Purchase Page</h1>

    <?php

    $p_id = $_GET['item_id'];
    $c_id = $_SESSION['cus_id'];

    $query = "SELECT * FROM products WHERE product_id = '{$p_id}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {

        while ($record = mysqli_fetch_array($result)) {

            $p_brand = $record['product_brand'];
            $p_name = $record['product_name'];
            $p_price = $record['price'];

            $_GET['p_price'] = $record['price'];
            $prc = $_GET['p_price']; //unit price
            $_GET['prd_id'] = $record['product_id'];
            $prd_id = $_GET['prd_id']; //product id
            $_GET['prd_u'] = $record['qty'];
            $avl_qty = $_GET['prd_u']; //available units

    ?>
            <p>Product ID: <?php echo $prd_id; ?></p>
            <p>Product: <?php echo $p_brand." - ".$p_name; ?></p>
            <p>Availability: <?php echo $avl_qty; ?> Items Available</p>
            <p>Unit Price: $<?php echo $p_price; ?></p>

    <?php
        }
    }

    ?>

    <form action="purchase.php" method="POST">
    Quantity: <input type="number" min="1" name="qty" size="2" maxlength="3" placeholder="Qty" value="1" required>
        <input type="hidden" name="prc" value="<?php echo $prc; ?>">
        <input type="hidden" name="prd_id" value="<?php echo $prd_id; ?>">
        <input type="hidden" name="available_qty" value="<?php echo $avl_qty; ?>">
        <input type="submit" name="buy" value="Buy Now">
    </form>

    <?php
        
        if(isset($_POST['buy'])){

            $c_qty = mysqli_real_escape_string($connection, $_POST['qty']);
            $a_qty = mysqli_real_escape_string($connection, $_POST['available_qty']); //available units
            $p_price = mysqli_real_escape_string($connection, $_POST['prc']); //unit price
            $prd_id = mysqli_real_escape_string($connection, $_POST['prd_id']); //product id

            if($c_qty <= $a_qty){
                $t_price = $p_price * $c_qty; //total price
                header("location: confirmPurchase.php?item_id={$prd_id}&total={$t_price}&qty={$c_qty}");
            }else{
                echo "<script>
                      alert('You are exceeded the available quantity!');
                      window.location.href='purchase.php?item_id={$prd_id}';
                      </script>";
            }

        }else{
            echo "post failed!";
        }

    ?>

</body>

</html>

<?php mysqli_close($connection); ?>