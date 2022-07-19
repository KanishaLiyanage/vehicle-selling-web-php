<?php session_start(); ?>
<?php require_once('../../connection/dbconnection.php'); ?>
<?php require_once('../components/header.php'); ?>

<?php

$id = "";

if (!isset($_SESSION['id'])) {
    header('Location: login.php?error=session_id_passing_failed!');
} else {
    if (isset($_GET['item_id'])) {
        echo "Item ID Passed! " . $_GET['item_id'];
        $id = $_GET['item_id'];
    } else {
        echo "Error occured in passing item id!";
    }
}

?>

<?php

if (isset($_POST['update'])) {

    $p_id = mysqli_real_escape_string($connection, $_POST['id']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $brand = mysqli_real_escape_string($connection, $_POST['brand']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $desc = mysqli_real_escape_string($connection, $_POST['desc']);
    $qty = mysqli_real_escape_string($connection, $_POST['qty']);
    $img = mysqli_real_escape_string($connection, $_POST['img']);

    $query = "UPDATE products SET product_brand = '{$brand}', product_name = '{$name}', price = '{$price}', product_description = '{$desc}', qty = '{$qty}', product_img = '{$img}'
              WHERE product_id = '{$p_id}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        header("location: ../items_list.php?item_updated=true");
        echo "Item ID: " . $p_id;
    } else {
        echo "Failed to update records!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/user_profile.css">
</head>

<body>

    <form action="edit_item.php" method="POST">
        Brand: <input type="text" name="brand" required>
        <br>
        Name: <input type="text" name="name" required>
        <br>
        Price: <input type="text" name="price" required>
        <br>
        Description: <input type="text" name="desc" required>
        <br>
        Quantity: <input type="text" name="qty">
        <br>
        Images: <input type="file" name="img">
        <br>
        <input type="submit" name="update" value="Update Product">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>

</body>

</html>

<?php mysqli_close($connection); ?>