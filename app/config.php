<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'wally');
define('DB_NAME', 'invoice');
define('DB_PASS', 'Obinabo1995');

$con = @mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$con){
    echo "Error connecting to database";
}else{
    mysqli_select_db($con, DB_NAME);
}
if(phpversion() < 8.0){
    exit('PHP Version 8 Required');
}
?>