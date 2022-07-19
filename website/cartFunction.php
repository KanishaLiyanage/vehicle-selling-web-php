<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

$p_id = "";
$c_id = "";

if (isset($_GET['item_id'])) {

    $p_id = $_GET['item_id'];
    $c_id = $_SESSION['cus_id'];

    echo "ID passed: " . $p_id . " of customer ID: " . $c_id . "<br>";


    $checkquery = "SELECT * FROM cart WHERE customer_id = '{$c_id}' AND product_id = '{$p_id}'";
    $checking_result = mysqli_query($connection, $checkquery);

    if (mysqli_num_rows($checking_result) > 0) {
        echo "<script>alert(\"Product is already exists in your cart!\")</script>";
        echo "<script>window.location='home.php'</script>";
    } else {
        
        echo $count_items . " item added to cart";

        $query = "INSERT INTO cart (customer_id, product_id, count_item)
              VALUES ('{$c_id}', '{$p_id}', '1') LIMIT 1";

        $result = mysqli_query($connection, $query);

        if ($result) {
            header("location: ./home.php?added_to_cart=successful!");
        }
    }


} else {
    echo "Failed to passed ID!";
}

?>

<?php mysqli_close($connection); ?>
