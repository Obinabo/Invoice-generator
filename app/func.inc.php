<?php
function get_user($con, $user_id){
    $q = "SELECT * FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $r = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($r)==1) {
            $user = mysqli_fetch_assoc($r);
    }
}
function get_invoice($con, $order_no){
    $q = "SELECT * FROM invoice WHERE order_no = ?";
    $stmt = mysqli_prepare($con, $q);
    mysqli_stmt_bind_param($stmt, 'i', $order_no);
    mysqli_stmt_execute($stmt);
}
?>