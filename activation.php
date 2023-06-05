<?php 
include_once 'app/config.php';
include 'include/head.php';

if (isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'], FILTER_VALIDATE_EMAIL) && (strlen($_GET['y'])) == 32 ){

	$email = mysqli_real_escape_string($con, $_GET['x']);
	$activation_code = mysqli_real_escape_string($con, $_GET['y']);

	$stmt = $con->prepare("UPDATE users SET active = NULL WHERE email= ? AND active= ? LIMIT 1");
	$stmt->bind_param("ss", $email, $activation_code);
	$stmt->execute();

	if ($stmt->affected_rows == 1) {
		echo 	'<div class="main-container">
                    <div class="login-container">
                        <div class="success">Your account is now active.</div><br><br>
                        <a href="user.php" class="return-button">Proceed to Dashboard</a>
                    </div>   
        		</div>';
	} else {
		echo '<div class="error">Activation failed.</div>';
	}

	$stmt->close();
} else {
	echo '<div class="error">Invalid activation parameters.</div>';
}

include 'include/foot.php';
?>
