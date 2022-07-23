<?php session_start(); ?>

<?php require_once('../../connection/dbconnection.php'); ?>

<link rel="stylesheet" href="../css/header.css">
<header class="header">
    <div class="home"><a href="../dashboard.php">Home</a> </div>
    <div class="headertopic">Home Page</div>
    <div class="logout">Welcome <?php echo $_SESSION['username']?>! <a href="logout.php"> logout</a> </div>
</header>

<?php

$id = "";

if (!isset($_SESSION['id'])) {
    header('Location: login.php?error=session_id_passing_failed!');
} else {
    if (isset($_GET['item_id'])) {
        $id = $_GET['item_id'];
        echo "Item ID Passed!: ".$id;
    } else {
        echo "Error occured in passing item id! <br>";
    }
}

?>

<?php

if (isset($_POST['update']) && isset($_FILES['image'])) {

    $itmID = $_POST['itemID'];

    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $errors = $_FILES['image']['error'];

    if($errors === 0){

        if($image_size > 12500000){

            echo "File is too large!";

        }else{

            $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_extension);

            $allowed_extensions = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_extensions)){

                $new_img_name = uniqid("PRODUCT_IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = 'assets/uploads/' . $new_img_name;

                echo $img_upload_path." "."<br>ID: ".$itmID;

                move_uploaded_file($tmp_name, $img_upload_path);
            
                $query = "UPDATE products SET product_img = '{$new_img_name}'
                          WHERE product_id = '{$itmID}' LIMIT 1";
            
                $result = mysqli_query($connection, $query);
            
                if($result){
                    header("location: items_list.php?item_updated=true");
                    echo "Item Updated!";
                }

            }else{
                echo "File extension cannot be accepted!";
            }

        }

    }else{
        echo "Error in your file!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Image</title>
    <link rel="stylesheet" href="../css/user_profile.css">
</head>

<body>

    <form action="editItemImage.php" method="POST" enctype="multipart/form-data">
        Images: <input type="file" name="image" required>
        <br>
        <input type="hidden" name="itemID" value="<?php echo $id ?>">
        <input type="submit" name="update" value="Update Image">
    </form>

</body>

</html>

<?php mysqli_close($connection); ?>
