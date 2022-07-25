<div class="top-container">
  <h1>Scroll Down</h1>
  <p>Scroll down to see the sticky effect.</p>
</div>

<div id="navbar">
  <a class="active" href="home.php">Home</a>
  <a href="profile.php">Profile</a>
  <a href="myOrders.php">Purchases</a>
  <a href="myCart.php">Cart</a>
  <a href="myFavorites.php">Favorites</a>
  <a href="contact.php">Contact Us</a>
</div>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>




<!-- <link rel="stylesheet" href="css/header.css">
<header class="header">
    <div class="home"><a href="home.php">Home</a> </div>
    <div class="headertopic">Home Page</div>
    <div class="logout">Welcome <?php echo $_SESSION['cus_username']?>! <a href="components/logout.php">logout</a> </div>
</header>

echo $_SESSION['username'] -->