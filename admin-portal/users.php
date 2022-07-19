<?php session_start(); ?>

<?php require_once('../connection/dbconnection.php'); ?>
<?php require_once('components/header.php'); ?>

<?php

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
} 

$user_list = "";
$query = "SELECT customer_id, username,email,last_login FROM customers WHERE is_deleted = 0 ORDER BY customer_id";
$users = mysqli_query($connection, $query);

if ($users) {
    while ($user = mysqli_fetch_assoc(($users))) {
        $_GET['u_id'] = $user['customer_id'];
        $user_list .= "<tr>";
        $user_list .= "<td> {$user['customer_id']} </td>";
        $user_list .= "<td> {$user['username']} </td>";
        $user_list .= "<td> {$user['email']} </td>";
        $user_list .= "<td> {$user['last_login']} </td>";
        $user_list .= "<td> <a href=\"user_profile.php?user_id={$_GET['u_id']}\"> Go to profile </a> </td>";
        $user_list .= "<td> <a href=\"components/delete_user.php?user_id={$user['customer_id']}\"onclick = \"return confirm('Are you sure to delete?');\"> Delete </a> </td>";
        $user_list .= "</tr>";
    }
} else {
    echo "Datbase failed!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
</head>

<body>
    <main>
        <center>
        <h1>Users List</h1>
        <table class="usersTable" border="1" cellpadding="20" cellspacing="0">
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Last Login</th>
                <th>Profile</th>
                <th>Remove</th>
            </tr>
            <?php echo $user_list; ?>
        </table>
        </center>
    </main>
</body>

</html>

<?php mysqli_close($connection); ?>