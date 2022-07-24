<?php session_start(); ?>
<?php require_once('../connection/dbconnection.php'); ?>

<?php

if (isset($_POST['signup']) && isset($_FILES['image'])) {

    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $errors = $_FILES['image']['error'];

    if ($errors === 0) {

        if ($image_size > 12500000) {

            echo "File is too large!";
        } else {

            $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_extension);

            $allowed_extensions = array("jpg", "jpeg");

            if (in_array($img_ex_lc, $allowed_extensions)) {

                $new_img_name = uniqid("CUSTOMER_IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = '../assets/uploads/profile_pics/' . $new_img_name;

                move_uploaded_file($tmp_name, $img_upload_path);

                $uname = mysqli_real_escape_string($connection, $_POST['username']);
                $umail = mysqli_real_escape_string($connection, $_POST['email']);
                $upw = mysqli_real_escape_string($connection, $_POST['pw']);
                $uno = mysqli_real_escape_string($connection, $_POST['number']);
                $uadr = mysqli_real_escape_string($connection, $_POST['address']);
                $upost = mysqli_real_escape_string($connection, $_POST['postalcode']);
                $ucity = mysqli_real_escape_string($connection, $_POST['city']);
                $uprov = mysqli_real_escape_string($connection, $_POST['province']);
                $ucountry = mysqli_real_escape_string($connection, $_POST['country']);

                //$encrypted_password = sha1($upw);

                $query = "INSERT INTO customers(username, email, password, mobile_number, address, postal_code, city, province, country, image)
                    VALUES ('{$uname}','{$umail}','{$upw}','{$uno}','{$uadr}','{$upost}','{$ucity}','{$uprov}','{$ucountry}','{$new_img_name}')";

                $result = mysqli_query($connection, $query);

                if ($result) {
                    $customer = mysqli_fetch_assoc($result);
                    $_SESSION['cus_id'] = $customer['customer_id'];
                    $_SESSION['cus_username'] = $customer['username'];
                    header("Location: ./home.php");
                }
            } else {
                echo "File extension can not be allowed! Please upload jpg files only.";
            }
        }
    } else {
        echo "Error in Image file!";
    }
} else {
    echo "There is an error in your inputs!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>

    <a href="signin.php"> back </a>

    <form action="signup.php" method="POST" enctype="multipart/form-data">

        <h1>Sign Up</h1>

        <fieldset>
            <legend><span class="number">1</span>Your basic info</legend>
            <label for="no">Mobile:</label>
            <input type="text" name="number" required>
            <label for="address">Address:</label>
            <textarea id="bio" name="address" required></textarea>
            <label for="pcode">Postal Code:</label>
            <input type="text" name="postalcode" required>
            <label for="city">City:</label>
            <input type="text" name="city" required>
            <label for="province">Province:</label>
            <input type="text" name="province" required>
            <label for="country">Country:</label>
            <input type="text" name="country" required>
            <label for="image">Upload your Image (only jpg accepted):</label>
            <input type="file" name="image" required>
        </fieldset>

        <fieldset>
            <label for="name">User Name:</label>
            <input type="text" id="name" name="username" required>
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="email" required>
            <legend><span class="number">2</span>Your profile</legend>
            <label for="password">Password:</label>
            <input type="password" id="password" name="pw" required>
        </fieldset>

        <button type="submit" name="signup">Sign Up</button>

    </form>

</body>

</html>

<?php mysqli_close($connection); ?>