<?php
session_start();
include "app/config.php";
$title = 'Preview Invoice';
include 'include/head.php';
if (isset($_GET['id']) ) { // From view_users.php
 	 $invoice_id = $_GET['id'];
 }elseif(isset($_SESSION['invoice_id'])){
    $invoice_id = $_SESSION['invoice_id'];
   }else{
    header("location: index.php");
   }

   $stmtq = "SELECT * FROM invoice WHERE invoice_id = ?";
   $stmt = mysqli_prepare($con, $stmtq);
   mysqli_stmt_bind_param($stmt, 'i', $invoice_id);
   mysqli_stmt_execute($stmt);

   $r = mysqli_stmt_get_result($stmt);
   
   if($row = mysqli_fetch_assoc($r)){ 
        $itemId = $row['invoice_id'];
   }
   $q = "SELECT * FROM invoice_items WHERE invoice_id = ?";
   $stmt = mysqli_prepare($con, $q);
   mysqli_stmt_bind_param($stmt, 'i', $itemId);
   mysqli_stmt_execute($stmt);

   $result = mysqli_stmt_get_result($stmt);
   
?>
      
 
<body id="body">
    <header>
        <div class="logo"><a href="user.php"><img src="assets/img/Melks.png" alt="Melks Logo" width="200px" height="60px"></a></div>
        <div class="address">
            <p><span class="yellow">Address:</span> Suite 2 Gelly's House, Secrrtariat Road Aroma, Awka.</p>
            <p><span class="yellow">Mobile:</span> 07034719349</p>
            <p><span class="yellow">Email:</span> melksreality@gmail.com</p>
        </div>
    </header>
    <div class="create-container">
        <div class="left">
            <h1>Name: <?php echo $row['cname'] ?></h1>
            <h1>Phone Number: <?php echo $row['phone'] ?></h1>
        </div>
        <div class="right">
            <h1>Order No.: <?php echo $row['order_no'] ?> </h1>
            <h1>Date: <?php echo date('Y-m-d', strtotime($row['date'])) ?></h1>
        </div>
    </div>
    <div class="table-container">
        <table>
            <tr>
            <th>S/N</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Total Amount</th>
            </tr>
            <?php 
            $totalSum = 0;
            $sn = 1;
            while($items = mysqli_fetch_array($result)){
            echo'<tr>
                <td> '. $sn. ' </td>
                <td> '. $items['item'].' </td>
                <td> '. $items['quantity'].' </td>
                <td> '. $items['amount'].' </td>
                <td> '. $items['tamount'].' </td>
            </tr>';
            $totalSum += $items['tamount'];
            $sn++;
            }
            ?>
            <tr>
                <td></td>
                <td> </td>
                <td> </td>
                <td></td>
                <td class="yellow-bg"><?php         
                echo '₦ '.number_format($totalSum); ?></td>
            </tr>
        </table>

        
    </div>
    <div class="company-details">
        <div class="left">
            <h1>Payment Instructions</h1>
            <p>Pay check to</p>
            <p>MelksReality Enterprises</p>
            <p class="yellow">1020740653</p>
            <p>UBA</p>
        </div>
    </div>
    <a href="" onclick="window.print()" class="button"><i class="fa-solid fa-print"></i>  Print Invoice</a>
<script src="assets/js/index.js"></script>
</body>
</html>