<link rel="stylesheet" href="css/header.css">
<header class="header">
    <div class="home"><a href="dashboard.php">Home</a> </div>
    <div class="headertopic">Home Page</div>
    <div class="logout">Welcome <?php echo $_SESSION['username']?>! <a href="logout.php"> logout</a> </div>
</header>