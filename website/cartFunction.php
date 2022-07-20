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


    $checkquery = "SELECT * FROM cart
                   WHERE
                   customer_id = '{$c_id}'
                   AND
                   product_id = '{$p_id}'
                   AND
                   count_item = 1
                   AND
                   is_deleted = 0";

    $checking_result = mysqli_query($connection, $checkquery);

    if (mysqli_num_rows($checking_result) > 0) {

        echo "<script>alert(\"Product is already exists in your cart!\")</script>";
        echo "<script>window.location='home.php'</script>";

    } else {

        $query1 = "SELECT * FROM cart
                       WHERE
                       customer_id = '{$c_id}'
                       AND
                       product_id = '{$p_id}'
                       AND
                       count_item = 0
                       AND
                       is_deleted = 1";
        
        $result1 = mysqli_query($connection, $query1);

        if(mysqli_num_rows($result1) > 0){

            $update_query = "UPDATE cart
                             SET count_item = 1, is_deleted = 0
                             WHERE customer_id = '{$c_id}'
                             AND
                             product_id = '{$p_id}'
                             AND
                             count_item = 0
                             LIMIT 1";
    
            $result = mysqli_query($connection, $update_query);
    
            if ($result) {
                header("location: ./home.php?added_to_cart=successful!");
            }

        }else{

            $query2 = "INSERT INTO cart (customer_id, product_id, count_item)
                      VALUES ('{$c_id}', '{$p_id}', '1')
                      LIMIT 1";
    
            $result2 = mysqli_query($connection, $query2);
    
            if ($result2) {
                header("location: ./home.php?added_to_cart=successful!");
            }

        }
        
    }

} else {
    echo "Failed to passed ID!";
}

?>

<?php mysqli_close($connection); ?>
