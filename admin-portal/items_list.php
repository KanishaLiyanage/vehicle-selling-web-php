<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>

<?php

$product_list = "";

$query = "SELECT * FROM products WHERE is_deleted = 0 ORDER BY product_id";

$products = mysqli_query($connection, $query);

if ($products) {
    while ($product = mysqli_fetch_assoc($products)) {
        $_GET['product_id'] = $product['product_id'];
        $_GET['product_brand'] = $product['product_brand'];
        $_GET['product_name'] = $product['product_name'];
        $product_list .= "<tr>";
        $product_list .= "<td> {$product['product_id']} </td>";
        $product_list .= "<td> {$product['product_brand']} </td>";
        $product_list .= "<td> {$product['product_name']} </td>";
        $product_list .= "<td> {$product['price']} </td>";
        $product_list .= "<td> {$product['qty']} </td>";
        $product_list .= "<td> {$product['purchases']} </td>";
        $product_list .= "<td> {$product['ratings']} </td>";
        $product_list .= "<td> <a href=\"item.php?item_id={$_GET['product_id']}&item_brand={$_GET['product_brand']}&item_name={$_GET['product_name']}\"> go to this product </a> </td>";
        $product_list .= "<td> <a href=\"components/delete_item.php?item_id={$product['product_id']}\" onclick = \"return confirm('Are you sure to delete?');\"> Delete </a> </td>";
        //item_id is the parameter passing linked page
        $product_list .= "</tr>";
    }
} else {
    echo "DB Failed!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item List</title>
</head>

<body>
    <h1>Item List</h1>
    <a href="add_items.php" style="text-decoration: none; font-size: 20px;">add items+</a>

    <hr>
    <center>
    <table border="1" cellpadding="20" cellspacing="0">
        <tr>
            <th>Product ID</th>
            <th>Product Brand</th>
            <th>Product Name</th>
            <th>Price</th>
            <!-- <th>Description</th> -->
            <th>Quantity</th>
            <!-- <th>Image</th> -->
            <th>Purchases</th>
            <th>Ratings</th>
            <th>Modify Product</th>
            <th>Remove</th>
        </tr>
        <tr>
            <?php echo $product_list; ?>
        </tr>
    </table>
    </center>

</body>

</html>

<?php mysqli_close($connection); ?>