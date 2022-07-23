<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}else{

    $orderTable = "<table border=\"1\" cellpadding=\"20\" cellspacing=\"0\">";

    $orderTable .= "<tr>
                    <th> Order ID </th>
                    <th> Customer ID </th>
                    <th> Customer User Name </th>
                    <th> Product ID </th>
                    <th> Product </th>
                    <th> Units Ordered </th>
                    <th> Total Price </th>
                    <th> Order Placed Date </th>
                    <th> Shipping Status </th>
                    </tr>";

    $query = "SELECT orders.*, customers.*, products.*
              FROM
              orders
              INNER JOIN products
              ON orders.product_id = products.product_id
              INNER JOIN customers
              ON orders.customer_id = customers.customer_id
              ORDER BY orders.order_id ASC";

        $result = mysqli_query($connection, $query);

        if ($result) {

            while ($record = mysqli_fetch_array($result)) {

                    $orderTable .= "<tr>";
                    $orderTable .= "<td>" . $record['order_id'] . "</td>";
                    $orderTable .= "<td>" . $record['customer_id'] . "</td>";
                    $orderTable .= "<td>" . "<a href=\"user_profile.php?user_id={$record['customer_id']}\"> " . $record['username'] . "</a>" . "</td>";
                    $orderTable .= "<td>" . $record['product_id'] . "</td>";
                    $orderTable .= "<td>" . $record['product_brand'] ." ". $record['product_name'] ."</td>";
                    $orderTable .= "<td>" . $record['order_qty'] . "</td>";
                    $orderTable .= "<td>" . "$". $record['order_price'] . "</td>";
                    $orderTable .= "<td>" . $record['created_time'] . "</td>";
                    $orderTable .= "</tr>";
        
            }

            $orderTable .= "</table>";

        }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>

<body>

    <center>

        <h1>Orders</h1>

        <?php echo $orderTable; ?>

    </center>

</body>

</html>

<?php mysqli_close($connection); ?>