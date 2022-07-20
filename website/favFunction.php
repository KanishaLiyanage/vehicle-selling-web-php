<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

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

    $checkquery = "SELECT * FROM favorites
                   WHERE customer_id = '{$c_id}'
                   AND
                   product_id = '{$p_id}'
                   AND
                   favorites_count = 1
                   AND
                   is_deleted = 0";

    $checking_result = mysqli_query($connection, $checkquery);

    if (mysqli_num_rows($checking_result) > 0) {

        echo "<script>alert(\"Product is already exists in your favorites!\")</script>";
        echo "<script>window.location='home.php'</script>";

    } else {

        $query1 = "SELECT * FROM favorites
                   WHERE customer_id = '{$c_id}'
                   AND
                   product_id = '{$p_id}'
                   AND
                   favorites_count = 0
                   AND
                   is_deleted = 1";

        $result_query1 =  mysqli_query($connection, $query1);

        if(mysqli_num_rows($result_query1) > 0){

            $fav_query1 = "UPDATE favorites
                           SET favorites_count = 1, is_deleted = 0
                           WHERE
                           customer_id = '{$c_id}'
                           AND
                           product_id = '{$p_id}'
                           AND
                           favorites_count = 0
                           AND
                           is_deleted = 1
                           LIMIT 1";
            $fav_result1 = mysqli_query($connection, $fav_query1);
            
            if ($fav_result1) {
                header("location: home.php?added_to_favorites=successful!");
            }else{
                echo "Failed!";
            }

        }else{

            $fav_query2 = "INSERT INTO favorites (customer_id, product_id, favorites_count)
                           VALUES ('{$c_id}', '{$p_id}', 1)
                           LIMIT 1";
            
            $fav_result2 = mysqli_query($connection, $fav_query2);

            if ($fav_result2) {
                header("location: home.php?added_to_favorites=successful!");
            }else{
                echo "Failed!";
            }

        }

    }

} else {
    echo "Failed to passed ID!";
}

?>

<?php mysqli_close($connection); ?>
