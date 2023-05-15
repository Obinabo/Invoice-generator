<?php
session_start();
$title = "MelksReality Invoice Generator";
include 'app/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $msg = array();

    if (empty($_POST['email'])) {
        $msg[] = '<div class="error">Please Enter Your Email</div>';
    } else {
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
    }

    if (empty($_POST['password'])) {
        $msg[] = '<div class="error">Please Enter Password</div>';
    } else {
        $pass = mysqli_real_escape_string($con, trim($_POST['password']));
    }
    
    if (empty($msg)) {
        $q = "SELECT * FROM users WHERE email = '$email'";
        $r = mysqli_query($con, $q);

        if (mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_assoc($r);

            if (password_verify($pass, $row['password'])) {
                //echo '<div class="success">Welcome! '. $row['name'] .'</div>';
                $_SESSION['id'] = $row['user_id'];
                header("location: user.php");
                exit();
            } else {
                $msg[] = '<div class="error">Incorrect Password</div>';
            }
        } else {
            $msg[] = '<div class="error">Incorrect Email</div>';
        }
    }
    // Output the error messages 
    foreach ($msg as $new_msg) {
       
    }
}
include 'include/head.php';
?>

<body>
    <div class="main-container">
        <div class="login-container">
            <img id="logo" src="assets/img/Melks.png" alt="MelksReality Logo"/>
            <h1>Sign In</h1>
            <?php // Output the error messages 
            if (!empty($new_msg)) {
                echo  $new_msg;
                }
            ?>
            <form action="index.php" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
            <a href="register.php">Create Account</a>
        </div>
    </div>
<script src="assets/js/index.js"></script>
</body>
</html>