<?php 

    $connection = mysqli_connect('localhost','root','','ecommerce_website');

    if(mysqli_connect_errno()){
        die('Database failed to connect! '.mysqli_connect_error().'<br>');
    }else{
        // echo "Database succussfuly connected! <br>";
    }

?>