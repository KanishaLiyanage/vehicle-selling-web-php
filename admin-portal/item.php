<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

$id = " ";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
} else {
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];
        echo "Item ID Passed!: ".$id."<br>";
    } else {
        echo "Error!";
    }
}

?>

<?php
    if (isset($_POST['editImage'])) {
        $itmID = $_POST['itemID'];
        header("Location: components/editItemImage.php?item_id={$itmID}");
    }else{
        echo "passing failed!";
    }
?>

<?php
    if (isset($_POST['editPrice'])) {
        $itmID = $_POST['itemID'];
        header("Location: components/editItemPrice.php?item_id={$itmID}");
    }else{
        echo "passing failed!";
    }
?>

<?php
    if (isset($_POST['editDiscount'])) {
        $itmID = $_POST['itemID'];
        header("Location: components/editItemDis.php?item_id={$itmID}");
    }else{
        echo "passing failed!";
    }
?>

<?php
    if (isset($_POST['editUnits'])) {
        $itmID = $_POST['itemID'];
        header("Location: components/editItemUnits.php?item_id={$itmID}");
    }else{
        echo "passing failed!";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
    <link rel="stylesheet" href="css/item.css">
</head> 

<body>

    <?php

    $query = "SELECT * FROM products WHERE product_id = '{$_GET['item_id']}'";

    $result = mysqli_query($connection, $query);

    if ($result) { ?>

        <?php

        while ($record = mysqli_fetch_array($result)) { 
            
            $p_id = $record['product_id'];
            
            ?>
            <h1><?php echo $record['product_brand'] . " " . $record['product_name'] ?></h1>
            <?php echo "Item ID Passed!: ".$p_id; ?>
            <img class="itemImage" src="../assets/uploads/products/<?=$record['product_img']?>">
            <form action="item.php" method="post">
                <input type="submit" name="editImage" value="Edit Image" class="button1 button2"/>
                <input type="hidden" name="itemID" value="<?php echo $id ?>">
            </form>
            <p>Product ID: <?php echo $record['product_id'] ?></p>
            <p>Product Brand: <?php echo $record['product_brand'] ?></p>
            <p>Product Name: <?php echo $record['product_name'] ?></p>
            <p>
                Product Price: $<?php echo $record['price'] ?>
                <form action="item.php" method="post">
                <input type="submit" name="editPrice" value="Edit Price" class="button1 button2"/>
                <input type="hidden" name="itemID" value="<?php echo $id ?>">
                </form>
            </p>

            <?php

            if($record['discount'] > 0){ ?>
                <p>
                    Discount: <?php echo $record['discount'] ?>%
                    <form action="item.php" method="post">
                    <input type="submit" name="editDiscount" value="Edit Discount" class="button1 button2"/>
                    <input type="hidden" name="itemID" value="<?php echo $id ?>">
                    </form>
                </p>
                <?php
            }
            else{ ?>
                <p>
                    Discount: No Discounts set in this product
                    <form action="item.php" method="post">
                    <input type="submit" name="editDiscount" value="Add Discount" class="button1 button2"/>
                    <input type="hidden" name="itemID" value="<?php echo $id ?>">
                    </form>
                </p>
                <?php
            }

            ?>

            <p>Description: <?php echo $record['product_description'] ?></p>
            <p>
                Availability: <?php echo $record['qty'] ?> Units available.
                <form action="item.php" method="post">
                <input type="submit" name="editUnits" value="Edit Availability" class="button1 button2"/>
                <input type="hidden" name="itemID" value="<?php echo $id ?>">
                </form>
            </p>
            <p>Purchases: <?php echo $record['purchases'] ?> Purchases.</p>
            <p>Ratings: <?php echo $record['ratings'] ?></p>

            <?php if (isset($_POST['deleteButton'])) {
                header("Location: components/delete_item.php?item_id={$_GET['item_id']}");
            }
            ?>

            <form method="post">
                <input type="submit" name="deleteButton" value="Delete Product" class="button button3"/>
            </form>

    <?php

        }
    }

    ?>

</body>

</html>

<?php mysqli_close($connection); ?>