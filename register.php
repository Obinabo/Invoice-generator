<?php 
$title = 'Register';
include_once 'app/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $msg = array();

    if(empty($_POST['name'])){
        $msg[] = '<div class="error">Please enter your full name</div>';
    }else{$name = mysqli_real_escape_string($con, trim($_POST['name']));}

    if(!empty($_POST['email'])){
        $email = mysqli_real_escape_string($con, trim($_POST['email']));
    }else{ $msg[] = '<div class="error">Please enter your correct email address</div>';}

    /* if(!empty($_POST['username'])){
        $username = mysqli_real_escape_string($con, trim($_POST['username']));
    }else{ $msg[] = 'Please enter your username';}
    */
    if(!empty($_POST['password'])){
        if ($_POST['password'] !== $_POST['password2']) {
            $msg[] = '<div class="error">Please enter a matching password</div>';
        }
        $pass = mysqli_real_escape_string($con, trim($_POST['password']));
    }else{ $msg[] = '<div class="error">Please enter your password</div>';}
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
    $oldQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $oldQuery);
        if(mysqli_num_rows($result) == 1){
            $msg[] = '<div class="error">Email is already in use</div>';
        }   
            if(empty($msg)){
                $q = "INSERT INTO users (name, email, password, date) VALUES ('$name', '$email', '$hashed_pass', '$date')";
                $r = mysqli_query($con, $q);
                if($r){
                    echo '<div class="success">Registration Complete!<br>Redirecting..</div>';
                    header("refresh:5; url=index.php");
                }else{
                    echo '<div class="error">Registration Failed! Try Again</div>';
                }
            }else {
                foreach ($msg as $new_msg) {
                    
                }
            }
        
}

include('include/head.php')?>
<body>
    <div class="main-container">
        <div class="login-container"> 
        
            <img id="logo" src="assets/img/Melks.png" alt="MelksReality Logo"/>
            <h1>Register</h1>
            <?php // Output the error messages 
            if (!empty($new_msg)) {
                echo  $new_msg;
                } 
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <input type="submit" value="Register">
            </form>
            <a href="index.php">Login</a>
        </div>
        <div class="login-container-2">
            <h1>Simple and user-friendly interface</h1>
            <p>Our invoice generator is designed to be easy to use, even for those who are not tech-savvy. With a simple and intuitive interface, you can create and send professional-looking invoices in no time.</p>

            <h1>Customizable invoice templates</h1> 
            <p>We understand that every business is unique, which is why we offer a range of customizable invoice templates. Choose from a variety of styles and add your own logo and branding to create a professional look that reflects your business.</p>
            <!--
            <h1>Automated payment reminders</h1> 
            <p>Tired of chasing down late payments? Our invoice generator can automatically send payment reminders to your clients, helping you get paid faster and more efficiently.</p>
            -->
            <h1>Secure and reliable</h1> 
            <p>We take your data security seriously, which is why our invoice generator is built with industry-leading security measures to keep your information safe. Plus, our platform is reliable and always available, so you can create and send invoices whenever you need to.</p>
        </div>
    </div>
<script src="assets/js/index.js"></script>
</body>
</html>