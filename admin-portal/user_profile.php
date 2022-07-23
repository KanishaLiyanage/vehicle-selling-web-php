<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

if (!isset($_GET['user_id'])) {

    echo "user ID pass failed!";
}

?>

<?php

$orderTable = "<table border=\"1\" cellpadding=\"20\" cellspacing=\"0\">";

$orderTable .= "<tr>
                <th> Order ID </th>
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
          WHERE orders.customer_id = '{$_GET['user_id']}'
          ORDER BY orders.order_id ASC";

    $result = mysqli_query($connection, $query);

    if ($result) {

        while ($record = mysqli_fetch_array($result)) {

                $orderTable .= "<tr>";
                $orderTable .= "<td>" . $record['order_id'] . "</td>";
                $orderTable .= "<td>" . $record['product_id'] . "</td>";
                $orderTable .= "<td>" . $record['product_brand'] ." ". $record['product_name'] ."</td>";
                $orderTable .= "<td>" . $record['order_qty'] . "</td>";
                $orderTable .= "<td>" . "$". $record['order_price'] . "</td>";
                $orderTable .= "<td>" . $record['created_time'] . "</td>";
                $orderTable .= "</tr>";
    
        }

        $orderTable .= "</table>";

    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/user_profile.css">
</head>

<body>

<center>

    <?php

    $query = "SELECT customer_id, username, email, mobile_number, address, postal_code, city, province, country, image, last_login
              FROM customers WHERE customer_id = '{$_GET['user_id']}' LIMIT 1";

    $result = mysqli_query($connection, $query);

    if ($result) { ?>
        <?php while ($record = mysqli_fetch_array($result)) {

            $_GET['id'] = $record['customer_id'];

        ?>

            <h1><?php echo $record['username'] ?></h1>
            <div><img class="uImg" src="../assets/uploads/profile_pics/<?= $record['image'] ?>"></div>

            <div class="itemInfo">

                <p>Customer ID: <?php echo $record['customer_id'] ?></p>
                <p>User Name: <?php echo $record['username'] ?></p>
                <p>Email: <?php echo $record['email'] ?></p>
                <p>Mobile Number: <?php echo $record['mobile_number'] ?></p>
                <p>Address: <?php echo $record['address'] ?> </p>
                <p>Postal Code: <?php echo $record['postal_code'] ?> </p>
                <p>City: <?php echo $record['city'] ?> </p>
                <p>Province: <?php echo $record['province'] ?> </p>
                <p>Country: <?php echo $record['country'] ?> </p>
                <p>Last Login: <?php echo $record['last_login'] ?> </p>

                <?php echo $orderTable; ?>

                <?php

                if (isset($_POST['deleteButton'])) {
                    header("Location: ../e-commerce-web-admin-portal/components/delete_user.php?user_id={$_GET['id']}");
                }
                
                if (isset($_POST['editButton'])) {
                    header("Location: edit_user.php?user_id={$_GET['id']}");
                }

                ?>

                <form method="post">
                    <input type="submit" name="deleteButton" value="Delete User" class="button button3" />
                    <input type="submit" name="editButton" value="Edit User" class="button1 button2" />
                </form>
                </form>

            </div>

    <?php }
    }

    ?>

</center>

</body>

</html>

<?php mysqli_close($connection); ?>