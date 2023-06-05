<?php
    session_start();
    if(!isset($_SESSION['id'])){
     header("location: index.php");
    }
    include 'include/head.php';
    $title = 'Delete Invoice';
     if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else if(isset($_POST['id'])){
        $id = $_POST['id'];
    }else{
        echo '<div class="error">You have accessed this page in error!</div>';
        header("location: index.php");
    }
    require_once 'app/config.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if($_POST['sure'] == 'Yes'){
            $stmt = mysqli_prepare($con, "DELETE FROM invoice_items WHERE invoice_id = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);

            $stmt = mysqli_prepare($con, "DELETE FROM invoice WHERE invoice_id = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) == 1){
                echo '
                <div class="main-container">
                    <div class="login-container">
                        <div class="success">Record has been deleted!</div><br><br>
                        <a href="user.php" class="return-button">Return Home</a>
                    </div>   
                </div>';
            }else{
                echo '
                <div class="main-container">
                    <div class="login-container">
                        <div class="error">Record wasn\'t deleted due to a system error.</div><br><br>
                        <a href="user.php" class="return-button">Return Home</a>
                    </div>   
                </div>';
            }
        }else{
            header("location: user.php");
        }
    }else{
        $stmt = mysqli_prepare($con, "SELECT * FROM invoice WHERE invoice_id = ? LIMIT 1");
            mysqli_stmt_bind_param($stmt, 's', $id);
            mysqli_stmt_execute($stmt);
            $r = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($r) == 1){

                $row = mysqli_fetch_assoc($r);
                 
                echo '
                <div class="main-container">
                    <div class="login-container">
                        <h2>Client Name: '. $row['cname'].' </h2><br>
                        <h2>Order No: '. $row['order_no'].'</h2>
                        <p>Are you sure you want to delete this Invoice?</p>
            

                        <form action="delete.php" method="post">
                            <input type="radio" name="sure" value="Yes"/> Yes
                            <input type="radio" name="sure" value="No" checked="checked" /> No
                            <input type="submit" name="submit" value="Submit" />
                            <input type="hidden" name="id" value="' . $id . '" />
                        </form>
                    </div>    
                </div>';
            }else{
                header("location: user.php");
            }
           
    }
  
    include 'include/foot.php';
?>
