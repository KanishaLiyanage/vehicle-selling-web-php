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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <center>

        <h1 class="h1">Edit Profile</h1>

        <form class="editForm" action="editProfile.php" method="POST" autocomplete="off">

            User Name: <input type="text" name="uName">
            <br>
            Password: <input type="password" name="password">
            <br>
            Mobile Number: <input type="text" name="mobile">
            <br>
            Address: <input type="text" name="address">
            <br>
            Postal Code: <input type="text" name="postal">
            <br>
            City: <input type="text" name="city">
            <br>
            Province: <input type="text" name="province">
            <br>
            Country: <input type="text" name="country">
            <br>
            Image: <input type="file" name="image">
            <br>

            <input type="submit" name="edit" value="Save Changes">

        </form>

        <?php

            if(isset($_POST['edit'])){

                $userName = mysqli_real_escape_string($connection, $_POST['uName']);
                $pw = mysqli_real_escape_string($connection, $_POST['password']);
                $uNo = mysqli_real_escape_string($connection, $_POST['mobile']);
                $addr = mysqli_real_escape_string($connection, $_POST['address']);
                $pCode = mysqli_real_escape_string($connection, $_POST['postal']);
                $city = mysqli_real_escape_string($connection, $_POST['city']);
                $prv = mysqli_real_escape_string($connection, $_POST['province']);
                $country = mysqli_real_escape_string($connection, $_POST['country']);
                $uImg = mysqli_real_escape_string($connection, $_POST['image']);

                $edit_query = "UPDATE customers
                               SET
                               username = '{$userName}', password = '{$pw}', mobile_number = '{$uNo}',address = '{$addr}', postal_code = '{$pCode}', city = '{$city}', province = '{$prv}', country = '{$country}', image = '{$uImg}'
                               WHERE customer_id = '{$_SESSION['cus_id']}' LIMIT 1";

                $result = mysqli_query($connection, $edit_query);

                if($result){
                    header("location: profile.php");
                }

            }

        ?>

    </center>

</body>

</html>

<?php mysqli_close($connection); ?>