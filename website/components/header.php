<link rel="stylesheet" href="css/header.css">
<header class="header">
    <div class="home"><a href="home.php">Home</a> </div>
    <div class="headertopic">Home Page</div>
    <div class="logout">Welcome <?php echo $_SESSION['cus_username']?>! <a href="components/logout.php">logout</a> </div>
</header>

<!-- echo $_SESSION['username'] -->