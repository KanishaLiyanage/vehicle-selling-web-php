<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>

<?php

if (isset($_POST['submit']) && isset($_FILES['image'])) {

    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $errors = $_FILES['image']['error'];

    if($errors === 0){

        if($image_size > 12500000){

            echo "File is too large!";

        }else{

            $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_extension);

            $allowed_extensions = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_extensions)){

                $new_img_name = uniqid("PRODUCT_IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = '../assets/uploads/products/' . $new_img_name;

                move_uploaded_file($tmp_name, $img_upload_path);

                $pbrand = mysqli_real_escape_string($connection, $_POST['product_brand']);
                $pname = mysqli_real_escape_string($connection, $_POST['product_name']);
                $price = mysqli_real_escape_string($connection, $_POST['product_price']);
                $pdesc = mysqli_real_escape_string($connection, $_POST['product_description']);
                $pqty = mysqli_real_escape_string($connection, $_POST['product_qty']);
            
                $query = "INSERT INTO products(product_brand, product_name, price, product_description, qty, product_img) VALUES ('{$pbrand}', '{$pname}','{$price}','{$pdesc}','{$pqty}','{$new_img_name}')";
            
                $result = mysqli_query($connection, $query);
            
                if($result){
                    echo "Item Added!";
                }

            }

        }

    }else{
        echo "Error occured!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
</head>

<body>
    <center>

    <h1>Add Items</h1>

    <form action="add_items.php" method="POST" enctype="multipart/form-data">

        Product Brand: <input type="text" name="product_brand" maxlength="50" required>
        <br>
        Product Name: <input type="text" name="product_name" maxlength="50" required>
        <br>
        Product Price: <input type="text" name="product_price" required>
        <br>
        Product Description: <textarea name="product_description" rows="4" cols="50" required></textarea>
        <br>
        Product Quantity: <input type="text" name="product_qty" required>
        <br>
        Product Image: <input type="file" name="image" required>
        <br>

        <input type="submit" name="submit" value="Add Product">

    </form>

    </center>

</body>

</html>

<?php mysqli_close($connection); ?>