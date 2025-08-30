<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    
    header("location: profilea.php");
    exit;
}

include 'partialsa/_dbconnecta.php'; 


$username = $_SESSION['Username'];
$sql = "SELECT * FROM admin.admin WHERE Username = '$username'";
$result = mysqli_query($conn_admin, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

  
    $fullName = $user['Full_Name'];
    $username = $user['Username'];
    $dob = $user['Date_Of_Birth'];
    $gender = $user['Gender'];
    $mobileNo = $user['Mobile_No'];
    $email = $user['email_address'];


    $dobTimestamp = strtotime($dob);
    $age = date("Y") - date("Y", $dobTimestamp);
    if (date("md", $dobTimestamp) > date("md")) {
        $age--; 
    }
} else {
    
    header("location: logouta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
   body {
        background-image: url('stock-photo-abstract-modern-colorful-mesh-gradient-latest-trend.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-attachment: fixed; 
        background-repeat: no-repeat; 
    }
    </style>
</head>
<body>

<?php require 'partialsa/_nava.php'; ?>

<div class="container mt-4">
    <h1 class="text-center">ADMIN PROFILE</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">PERSONAL INFORMATION</h5>
            <hr class="mb-4">
            <p><strong>Full Name: </strong> <?= htmlspecialchars($fullName) ?></p>
            <p><strong>Username: </strong> <?= htmlspecialchars($username) ?></p>
            <p><strong>Age: </strong> <?= $age ?> years</p>
            <p><strong>Date of Birth: </strong> <?= htmlspecialchars($dob) ?></p>
            <p><strong>Gender: </strong> <?= htmlspecialchars($gender) ?></p>
            <p><strong>Mobile No: </strong> <?= htmlspecialchars($mobileNo) ?></p>
            <p><strong>Email Address: </strong> <?= htmlspecialchars($email) ?></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
