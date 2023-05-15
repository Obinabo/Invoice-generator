<?php
session_start();
include "app/config.php";
$title = 'Preview Invoice';
include 'include/head.php';
if (isset($_GET['id']) ) { // From view_users.php
 	 $order_no = $_GET['id'];
 }elseif(isset($_SESSION['order_no'])){
    $order_no = $_SESSION['order_no'];
   }else{
    header("location: index.php");
   }

   $stmtq = "SELECT cname, phone, item, quantity, amount, tamount, order_no, date FROM invoice WHERE order_no = ?";
   $stmt = mysqli_prepare($con, $stmtq);
   mysqli_stmt_bind_param($stmt, 's', $order_no);
   mysqli_stmt_execute($stmt);

   $r = mysqli_stmt_get_result($stmt);
   
   if($row = mysqli_fetch_assoc($r)){ ?>
      
 


<body id="body">
    <header>
        <div class="logo"><img src="assets/img/Melks.png" alt="Melks Logo" width="200px" height="60px"></div>
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
            <tr>
                <td>1</td>
                <td><?php echo $row['item'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php echo $row['amount'] ?></td>
                <td><?php echo $row['tamount'] ?></td>
            </tr>
            <tr>
                <td></td>
                <td> </td>
                <td> </td>
                <td></td>
                <td class="yellow-bg"><?php echo $row['tamount'] ?></td>
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
    <a href="" onclick="printPage()" class="button">Print Invoice</a>
<script src="assets/js/index.js"></script>
</body>
</html>
<?php   } ?>