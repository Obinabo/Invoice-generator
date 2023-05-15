<?php
session_start();
if(!isset($_SESSION['id'])){
 header("location: index.php");
}
$title = 'Create Invoice';
include_once 'app/config.php';
$id = $_SESSION['id'];
//$query = "SELECT * FROM users WHERE user_id = $id";
//$result = mysqli_query($con, $query);
//get_user($id, $con);
$success_msg = '';
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors = array();
    if ((empty($_POST['cname'])) || (!isset($_POST['cname']))){
        $errors[] = '<div class="error">Please enter client\'s name</div>';
    }else{
        $cname = mysqli_real_escape_string($con, trim($_POST['cname']));
    }

    if ((empty($_POST['phone'])) || (!isset($_POST['phone']))){
        $errors[] = '<div class="error">Please enter client\'s phone number</div>';
    }else{
        $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
    }

    if ((empty($_POST['item'])) || (!isset($_POST['item']))){
        $errors[] = '<div class="error">Please enter item description</div>';
    }else{
        $item = mysqli_real_escape_string($con, trim($_POST['item']));
    }

    if ((empty($_POST['quantity'])) || (!isset($_POST['quantity']))){
        $errors[] = '<div class="error">Please enter quantity</div>';
    }else{
        $quantity = mysqli_real_escape_string($con, trim($_POST['quantity']));
    }
    if ((empty($_POST['amount'])) || (!isset($_POST['amount']))){
        $errors[] = '<div class="error">Please enter amount</div>';
    }else{
        $amount = mysqli_real_escape_string($con, trim($_POST['amount']));
    }
    if ((empty($_POST['tamount'])) || (!isset($_POST['tamount']))){
        echo '<div class="error">Please enter total amount</div>';
    }else{
        $tamount = mysqli_real_escape_string($con, trim($_POST['tamount']));
    }
    $date = date('Y-m-d H:i:s');
    $order_no = 'MELKS-'.substr(rand(450, 500)* 300, 0, 6);
    if(empty($errors)){
        $q = "INSERT INTO invoice (user_id, cname, phone, item, quantity, amount, tamount, order_no, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($stmt, 'issssssss', $id, $cname, $phone, $item, $quantity, $amount, $tamount, $order_no, $date);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) == 1) {
            $success_msg = '<div class="success">Invoice Created</div>';
            $stmtq = "SELECT * FROM invoice WHERE order_no = ?";
    $stmt = mysqli_prepare($con, $stmtq);
    mysqli_stmt_bind_param($stmt, 's', $order_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['order_no'] = $row['order_no'];
        header("location: invoice.php");
            }
        }else{
            echo '<div class="error">Error!<br>Failed to Create Invoice</div>';
        }
    }else{
        foreach ($errors as $msg) {
            # code...
        };
    }

 }
include 'include/head.php';
include 'include/nav.php';

?>

    <div class="main-container"> 
        <div class="login-container">
            <h1>Create Invoice</h1>
            <?php // Output the error messages 
            if (!empty($msg)) {
                echo  $msg;
                } else{
                    echo $success_msg;
                }
            ?>
            <form action="create.php" method="POST">
                <input type="text" name="cname" placeholder="Client Name" value="<?php if(isset($_POST['cname'])){echo $_POST['cname']; } ?>" required>
                <input type="number" name="phone" placeholder="Client Tel.." value="<?php if(isset($_POST['phone'])){echo $_POST['phone']; } ?>" required>
                <input type="text" name="item" placeholder="Item Description" value="<?php if(isset($_POST['item'])){echo $_POST['item']; } ?>" required>
                <input type="number" name="quantity" placeholder="Quantity" value="<?php if(isset($_POST['quantity'])){echo $_POST['quantity']; } ?>" required>
                <input type="text" name="amount" placeholder="Amount" value="<?php if(isset($_POST['amount'])){echo $_POST['amount']; } ?>" required>
                <input type="text" name="tamount" placeholder="Total Amount" value="<?php if(isset($_POST['tamount'])){echo $_POST['tamount']; } ?>" required>
                <input type="submit" value="Continue">
            </form>
        </div>
    </div>
<script src="assets/js/index.js"></script>
</body>
</html>