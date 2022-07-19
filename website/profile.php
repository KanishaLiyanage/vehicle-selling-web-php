<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('./components/header.php'); ?>

<?php

if (!isset($_SESSION['cus_id'])) {
    header('Location: landing_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
        <div class="headerBtns">
        <a class="cartBtn" href="myCart.php"> Cart </a>
        <a class="favBtn" href="myFavorites.php"> Favorites </a>
        <a class="ordersBtn" href="myOrders.php"> Purchased Products </a>
        <a class="editBtn" href="editProfile.php"> Edit Profile </a>
        </div>

    <center>

        <h1 class="h1">My Profile</h1>

        <?php

        $user_query = "SELECT * FROM customers WHERE customer_id = '{$_SESSION['cus_id']}' LIMIT 1";

        $result = mysqli_query($connection, $user_query);

        if ($result) {

            while ($record = mysqli_fetch_array($result)) {

        ?>

                <div class="profileCard">

                    <img class="uImg" src="../assets/uploads/profile_pics/<?php echo $record['image'];?>" alt="<?php echo $record['image'];?>">
                    <p>ID: <?php echo $record['customer_id']; ?> </p>
                    <p>User Name: <?php echo $record['username']; ?> </p>
                    <p>Email: <?php echo $record['email']; ?> </p>
                    <p>Mobile Number: <?php echo $record['mobile_number']; ?> </p>
                    <p>Address: <?php echo $record['address']; ?> </p>
                    <p>Postal Code: <?php echo $record['postal_code']; ?> </p>
                    <p>City: <?php echo $record['city']; ?> </p>
                    <p>Province: <?php echo $record['province']; ?> </p>
                    <p>Country: <?php echo $record['country']; ?> </p>

                </div>

        <?php

            }
        }

        ?>

        <a class="logoutBtn" href="components/logout.php"> Logout </a>

    </center>

</body>

</html>

<?php mysqli_close($connection); ?>