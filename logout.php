<?php
session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
    }else{
        $_SESSION = array(); 
        session_destroy();
    }
    $title = "Logout";
    include 'include/head.php';
    echo '<div class="center"><h1> You Have Succesfully Logged Out!</h1>
        <p>Redirecting...</p></div>
    ';
    header('refresh:3; url=index.php');
    include 'include/foot.php';
?>