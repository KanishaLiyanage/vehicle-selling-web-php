<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}else{

    $orderTable = "<table class=\"table-fill\">";

    $orderTable .= "<tr>
                    <th class=\"text-left\"> Order ID </th>
                    <th class=\"text-left\"> Customer ID </th>
                    <th class=\"text-left\"> Customer User Name </th>
                    <th class=\"text-left\"> Product ID </th>
                    <th class=\"text-left\"> Product </th>
                    <th class=\"text-left\"> Units Ordered </th>
                    <th class=\"text-left\"> Total Price </th>
                    <th class=\"text-left\"> Order Placed Date </th>
                    <th class=\"text-left\"> Shipping Status </th>
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

                    $orderTable .= "<tbody class=\"table-hover\">";
                    $orderTable .= "<tr>";
                    $orderTable .= "<td class=\"text-left\">" . $record['order_id'] . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . $record['customer_id'] . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . "<a href=\"user_profile.php?user_id={$record['customer_id']}\"> " . $record['username'] . "</a>" . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . $record['product_id'] . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . $record['product_brand'] ." ". $record['product_name'] ."</td>";
                    $orderTable .= "<td class=\"text-left\">" . $record['order_qty'] . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . "$". $record['order_price'] . "</td>";
                    $orderTable .= "<td class=\"text-left\">" . $record['created_time'] . "</td>";
                    $orderTable .= "</tr>";
                    $orderTable .= "</tbody>";
        
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
    <link rel="stylesheet" href="css/tables.css">
</head>

<body>

        <div class="table-title">
            <h3>Orders</h3>
        </div>

        <?php echo $orderTable; ?>

</body>

</html>

<?php mysqli_close($connection); ?>