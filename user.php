
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
    $q = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($r)==1) {
                $user = mysqli_fetch_assoc($r);
        }
        $inv_result = mysqli_query($con, "SELECT * FROM invoice WHERE user_id = $id ORDER BY date desc");
        if (mysqli_num_rows($inv_result) > 0) {
           
            include 'include/nav.php';
 //$_SESSION['order_no'] = $row['order_no'];
                echo

                    '<div class="table-container">
                        <table>
                            <tr>
                            <th>Name of Client</th>
                            <th>Order No.</th>
                            <th>Date</th>
                            <th>Actions</th>
                            </tr>';
                        while ($row = mysqli_fetch_array($inv_result)) {
                                echo'<tr><td>'. $row['cname']. '</td>
                                <td>'.$row['order_no']. '</td>
                                <td>'.$row['date']. '</td>
                                <td>
                                    <a href="" class="action-button">Actions</a>
                                        <div class="dropdown-content">
                                            <p><a href="invoice.php?id='.$row['invoice_id'].'"><i class="fa-regular fa-eye"></i>  View</a></p>
                                            <!--<p><a href="edit.php?id='.$row['order_no'].'"><i class="fa-regular fa-pen-to-square"></i>  Edit</a></p>-->
                                            <p><a href="delete.php?id='.$row['invoice_id'].'"><i class="fa-regular fa-trash-can"></i>  Delete</a></p>
                                        </div>
                                </td></tr>';
                        } 
                    echo  '</table>
                        
                        <a href="create.php" class="table-button">Create New Invoice</a>
                    </div>';
            
        } else{
            include 'include/nav.php';
            echo '<div class="table-container"><h1>No Records Yet...</h1>
            <a href="create.php" class="table-button">Create New Invoice</a>
            </div>';
        }
        include 'include/foot.php';
?>

            