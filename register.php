<?php 
$title = 'Register';
include_once 'app/config.php';
$success_msg = '';
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
    $activation_code = md5(uniqid(rand(), true));
    $oldQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $oldQuery);
        if(mysqli_num_rows($result) == 1){
            $msg[] = '<div class="error">Email is already in use</div>';
        }   
            if(empty($msg)){
                $q = "INSERT INTO users (name, email, password, date, active) VALUES (?,?,?,?,?)";
                $stmt = mysqli_prepare($con, $q);
                mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $hashed_pass, $date, $activation_code);
                mysqli_stmt_execute($stmt);
                
                if(mysqli_stmt_affected_rows($stmt)== 1){
                    $activation_link = 'https://melksreality.com/invoice/activation.php?x='.urlencode($email) . "&y=$activation_code";
                    $subject = "Activate Your Email";
                    $mail = '

                    <html>
                    <head>
                        <meta charset="utf-8">
                       
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <meta http-equiv="x-ua-compatible" content="ie=edge">
                        <style>
                            html {background-color: rgb(206, 202, 202);}
                            body{font-family: Arial, Helvetica, sans-serif; font-size: 1em; background-color: rgb(252, 252, 252); line-height: 1.5; margin: 0 auto 0 auto; width: 100%;}
                            .header{background-color: #000000; padding-top: 20px; padding: 20px; text-align:center; display:flex;}
                            .container{padding: 10px; border-color: rgb(8, 102, 165); width: 100%; align-items: center;}
                            .footer{background-color: #000; margin: 30px auto 0px auto; padding: 5px; -moz-box-align: center; -webkit-box-align: center; color: rgb(243, 146, 0); }
                            p {text-align: center; font-size: 1em}
                            h1{font-size: 2em; color:rgb(243, 146, 0); font-weight: bolder;}
                            h2{font-size: 1.5em; color:rgb(243, 146, 0); font-weight: bolder;}
                            .footer>.list{text-align: center; font-size: 0.7em; margin-top: 20px; padding: 20px; border-top: 1px solid rgb(201, 199, 199);}
                            .box1{margin-right: 20%;}
                            .box{width: 100%; flex-direction: column;}
                            #logo{width: 30%;}
                            a{color: #fff; text-decoration: none;}
                            a:visited{color:rgb(243, 146, 0);}
                            a:active{color:rgb(243, 146, 0)}
                            a:hover{color: #f39200;}
                            .button{
                                padding: 10px;
                                background-color: #f39200;
                                color:rgb(255, 255, 255);
                                width:fit-content;
                                margin: 20px auto;
                                transition: 1s;
                            }
                            .button:hover{
                                background-color: transparent;
                                color:#f39200;
                                margin: 20px auto;
                                border: 1px solid #f39200;
                            }
                            img{padding: 10px; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); margin: 5px;}
                            .text-black{color: rgb(27, 27, 27)}
                            .text-white{color: rgb(253, 252, 252)}
                            .text-bold{font-weight: bold;}
                           .footer>p{font-size: 0.8em;}
                            .welcome{padding: auto; margin: auto; box-shadow: -5px 5px 10px rgba(71, 71, 71, 0); width: 80%;}
                        </style>
                    </head>
                    <body>
                    <header>
                        <div class="header">
                            <div class="box"><a href="https://melksreality.com/invoice">Home</a></div>
                            <!--<div class="box"> <a href="https://melksreality.com/invoice">Home</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=about">About</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=login">Login</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=signup">Sign Up</a></div>
                            <div class="box"><a href="https://melksreality.com/invoice/?a=account">Dashboard</a></div>-->
                        </div>
                    </header>
                         <center>
                    <div id="logo"><a href="https://melksreality.com/invoice"><img src="https://melksreality.com/invoice/assets/img/Melks.png" width="110px" height="50px" alt="logo" /></a></div>          
                    <h1> Confirm Email Address</h1>
                    <p>You just created an account on MelksReality Invoice, please confirm your email address to continue.</p>
                    <p>Click on the button below to activate your account.</p>
                    
                    <a class="button" href="'.$activation_link.'">Confirm Email Address</a><br/>
                    <p>Or copy the link below and paste directly into your browser address bar:</p><br/>

                    <a href="'.$activation_link.'">'.$activation_link.'</a>
                    </div>
                </center>
            <footer>
                <div class="footer text-white">
                <p class="text-bold">Address: Suite 2, Gelly\'s House, Aroma Awka, Anambra State.</p>
                <!--<p class="text-bold">Phone: </p>-->
                <p class="text-bold">Support Email: support@melksreality.com</p>
               
                <p>Kind Regards, MelksReality INC</p>
                    <div class="list ">
                        <p>MelksReality Copyriight &#169; 2023</p>
                    </div>
                </div>
            </footer>
            </body>
            </html>';
            include 'mail.php';
            sendEmail($email, $subject, $mail);
                    $success_msg = '<div class="success">
                    <div class="close">x</div>
                    Registration Complete!<br> An activation mail has been sent to '.$email.' </div>';
                    
        }else{
                    $msg[] = '<div class="error">Registration Failed! Try Again</div>';
                }
            }else {
                foreach ($msg as $new_msg) {
                    
                }
            }
        
}

include('include/head.php');
?>
<body>
    <div class="main-container">
        <div class="login-container-1"> 
        
            <img id="logo" src="assets/img/Melks.png" alt="MelksReality Logo"/>
            <h1>Register</h1>
            <?php // Output the error messages 
            if (!empty($new_msg)) {
                echo  $new_msg;
                } else {
                    echo $success_msg;
                }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <input type="submit" value="Register">
            </form>
            <p>Already have an account?</p>
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
<?php include 'include/foot.php'; ?>