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
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="contact-container">
        
        <div class="left-col">
            <img class="logo" src="#" />
        </div>

        <div class="right-col">
            <!-- <div class="theme-switch-wrapper">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <div class="slider round"></div>
                </label>
                <div class="description">Dark Mode</div>
            </div> -->

            <h1>Contact us</h1>
            <p>If you willing to contact us, send us an email.</p>

            <form id="contact-form" method="post">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Your Subject" required>
                <label for="message">Message</label>
                <textarea rows="6" placeholder="Your Message" id="message" name="message" required></textarea>
                <button type="submit" id="submit" name="submit">Send</button>

            </form>
            <div id="error"></div>
            <div id="success-msg"></div>
        </div>
    </div>

</body>

</html>

<?php mysqli_close($connection); ?>