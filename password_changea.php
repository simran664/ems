<?php
session_start();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logina.php");
    exit;
}

include 'partialsa/_dbconnecta.php';


$showSuccess = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $Username = mysqli_real_escape_string($conn_admin, $_POST['Username']); 
    $currentPassword = mysqli_real_escape_string($conn_admin, $_POST['currentPassword']); 
    $newPassword = mysqli_real_escape_string($conn_admin, $_POST['newPassword']); 

    $sql = "SELECT Password FROM `admin` WHERE Username = '$Username'";
    $result = mysqli_query($conn_admin, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $dbPasswordHash = $row['Password'];

        if (password_verify($currentPassword, $dbPasswordHash)) {
            
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateSql = "UPDATE `admin` SET Password = '$hashedNewPassword' WHERE Username = '$Username'";
            if (mysqli_query($conn_admin, $updateSql)) {
                
                $_SESSION = array();
                session_destroy();    
                $showSuccess = "Password successfully updated! Please login again."; 
                
                header("Location: logina.php");
                exit; 
            } else {
                $showError = "Failed to update the password. Please try again.";
            }
        } else {
            $showError = "The current password is incorrect."; 
        }
    } else {
        $showError = "User not found."; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require 'partialsa/_nava.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Change Password</h1>

    <!-- Success Message -->
    <?php if ($showSuccess): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?= $showSuccess; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if ($showError): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?= $showError; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <!-- Password Change Form -->
    <form action="password_changea.php" method="POST">
        <div class="form-group mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" class="form-control" id="Username" name="Username" value="<?= $_SESSION['Username']; ?>" required readonly>
        </div>
        <div class="form-group mb-3">
            <label for="currentPassword" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
        </div>
        <div class="form-group mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>