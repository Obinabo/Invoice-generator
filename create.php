<?php
session_start();
if(!isset($_SESSION['id'])){
 header("location: index.php");
}
$title = 'Create Invoice';
include_once 'app/config.php';
$id = $_SESSION['id'];
$q = "SELECT * FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($con, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$r = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($r)==1) {
            $user = mysqli_fetch_assoc($r);
    }
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
        $items = $_POST['item'];
    }

    if ((empty($_POST['quantity'])) || (!isset($_POST['quantity']))){
        $errors[] = '<div class="error">Please enter quantity</div>';
    }else{
        $quantities = $_POST['quantity'];
    }
    if ((empty($_POST['amount'])) || (!isset($_POST['amount']))){
        $errors[] = '<div class="error">Please enter amount</div>';
    }else{
        $amounts = $_POST['amount'];
    }
    if ((empty($_POST['tamount'])) || (!isset($_POST['tamount']))){
        $errors[] = '<div class="error">Please enter total amount</div>';
    }else{
        $tamounts = $_POST['tamount'];
    }
    $date = date('Y-m-d H:i:s');
    $order_no = 'MELKS-'.substr(rand(450, 500)* 300, 0, 6);
    if(empty($errors)){
        $q = "INSERT INTO invoice (user_id, cname, phone, order_no, date) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $q);
        mysqli_stmt_bind_param($stmt, 'issss', $id, $cname, $phone, $order_no, $date);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) == 1) {
           
            $stmtq = "SELECT * FROM invoice WHERE order_no = ?";
            $stmt = mysqli_prepare($con, $stmtq);
            mysqli_stmt_bind_param($stmt, 's', $order_no);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['invoice_id'] = $row['invoice_id'];
                $invoice_id = $row['invoice_id'];
            }
            for ($i = 0; $i < count($items); $i++) {
                $item = $items[$i];
                $quantity = $quantities[$i];
                $amount = $amounts[$i];
                $tamount = $tamounts[$i];
            
                $item_desc = "INSERT INTO invoice_items (invoice_id, item, quantity, amount, tamount) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $item_desc);
                mysqli_stmt_bind_param($stmt, 'isiii', $invoice_id, $item, $quantity, $amount, $tamount);
                mysqli_stmt_execute($stmt);
                
                if(mysqli_stmt_affected_rows($stmt) != 1){
                    $errors[] = '<div class="error">Unable to insert items</div>';
                }else{
                    $success_msg = '<div class="success">Invoice Created</div>';
                    header("refresh:3; url=invoice.php");
                }
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
                <div class="item-outline">
                    <input type="text" name="item[]" placeholder="Item Description" required>
                    <input type="number" name="quantity[]" placeholder="Quantity" required>
                    <input type="number" name="amount[]" placeholder="Amount" required>
                    <input type="number" name="tamount[]" placeholder="Total Amount" required>
                </div>
                <!--<div id="item"></div>
                <div id="quantity"></div>
                <div id="amount"></div>
                <div id="tamount"></div>-->
                <a href="#" id="add-items"><i class="fa-regular fa-add"></i> Add More Items</a>
                <input type="submit" value="Continue">
            </form>
        </div>
    </div>
<?php include 'include/foot.php';?>
          