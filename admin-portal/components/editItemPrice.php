<?php session_start(); ?>

<?php require_once('../../connection/dbconnection.php'); ?>

<link rel="stylesheet" href="../css/header.css">
<header class="header">
    <div class="home"><a href="../dashboard.php">Home</a> </div>
    <div class="headertopic">Home Page</div>
    <div class="logout">Welcome <?php echo $_SESSION['username']?>! <a href="logout.php"> logout</a> </div>
</header>

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
    $price = mysqli_real_escape_string($connection, $_POST['price']);

    $query = "UPDATE products
              SET price = '{$price}'
              WHERE product_id = '{$p_id}'
              LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) {
        header("location: ../item.php?item_id={$p_id}");
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
    <title>Edit Price</title>
    <link rel="stylesheet" href="../css/user_profile.css">
</head>

<body>

    <form action="editItemPrice.php" method="POST">
        New Price: <input type="text" name="price" required>
        <br>
        <input type="submit" name="update" value="Update Price">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>

</body>

</html>

<?php mysqli_close($connection); ?>
