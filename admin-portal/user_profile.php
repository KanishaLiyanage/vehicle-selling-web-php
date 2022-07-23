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

$userTable = "<table class=\"table-fill1\">";

$userTable .= "<tr>
                <th class=\"text-left\"> Order ID </th>
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
          WHERE orders.customer_id = '{$_GET['user_id']}'
          ORDER BY orders.order_id ASC";

    $result = mysqli_query($connection, $query);

    if ($result) {

        while ($record = mysqli_fetch_array($result)) {

                $userTable .= "<tbody class=\"table-hover\">";
                $userTable .= "<tr>";
                $userTable .= "<td class=\"text-left\">" . $record['order_id'] . "</td>";
                $userTable .= "<td class=\"text-left\">" . $record['product_id'] . "</td>";
                $userTable .= "<td class=\"text-left\">" . $record['product_brand'] ." ". $record['product_name'] ."</td>";
                $userTable .= "<td class=\"text-left\">" . $record['order_qty'] . "</td>";
                $userTable .= "<td class=\"text-left\">" . "$". $record['order_price'] . "</td>";
                $userTable .= "<td class=\"text-left\">" . $record['created_time'] . "</td>";
                $userTable .= "</tr>";
                $userTable .= "</tbody>";
    
        }

        $userTable .= "</table>";

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
    <link rel="stylesheet" href="css/tables.css">
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

                <?php echo $userTable; ?>

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