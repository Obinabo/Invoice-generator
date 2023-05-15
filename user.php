
<?php 
session_start();
if(!isset($_SESSION['id'])){
 header("location: index.php");
}else{
    $id = $_SESSION['id'];
}
$title = "Dashboard";
include 'app/config.php';
include 'include/head.php';
include 'include/nav.php';

    $q = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($r)==1) {
                $row = mysqli_fetch_array($r);
        }
        $inv_result = mysqli_query($con, "SELECT * FROM invoice WHERE user_id = $id ORDER BY date desc");
        if (mysqli_num_rows($inv_result) > 0) {
           

 //$_SESSION['order_no'] = $row['order_no'];
                echo

                    '<div class="table-container">
                        <table>
                            <tr>
                            <th>Name of Client</th>
                            <th>Purchased Item</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                            </tr>';
                        while ($row = mysqli_fetch_array($inv_result)) {
                                echo'<tr><td>'. $row['cname']. '</td>
                                <td>'.$row['item']. '</td>
                                <td>'.$row['amount']. '</td>
                                <td>'.$row['date']. '</td>
                                <td><a href="invoice.php?id='.$row['order_no'].'">View</a></td></tr>';
                        } 
                    echo  '</table>
                        
                        <a href="create.php" class="table-button">Create New Invoice</a>
                    </div>';
            
        } else{
            echo '<div class="table-container"><h1>No Records Yet...</h1>
            <a href="create.php" class="table-button">Create New Invoice</a>
            </div>';
        }
    
    ?>
                <script src="assets/js/index.js"></script>
                </body>
                </html>
               
            