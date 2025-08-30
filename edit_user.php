<?php

include 'partialsa/_dbconnecta.php';

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    $sql = "SELECT * FROM user WHERE Sno = $userId";
    $result = mysqli_query($conn_users, $sql);
    $user = mysqli_fetch_assoc($result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $mobileNo = $_POST['mobile_no'];
    $email = $_POST['email_address'];
    $designation = $_POST['designation'];
    $sanctioningAuthority = $_POST['Sanctioning_Authority'];
    $dob = $_POST['dob'];
    $status = $_POST['status'];
    $dateOfJoining = $_POST['date'];

    $updateSql = "UPDATE user SET 
        Full_Name = '$fullName', 
        Username = '$username', 
        Gender = '$gender', 
        Mobile_No = '$mobileNo', 
        email_address = '$email', 
        Designation = '$designation', 
        Date_Of_Birth = '$dob', 
        status = '$status' ,
        Sanctioning_Authority = '$sanctioningAuthority', 
        Date = '$dateOfJoining'
        WHERE Sno = $userId";

    if (mysqli_query($conn_users, $updateSql)) {
        header("Location:report.php"); 
        exit;
    } else {
        echo "<p class='text-danger'>Failed to update user details.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
<div class="container mt-5">
<h2 class="text-center">EDIT EMPLOYEE DETAILS</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($user['Full_Name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['Username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="Male" <?= $user['Gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $user['Gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="mobile_no" class="form-label">Mobile No</label>
            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?= htmlspecialchars($user['Mobile_No']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email_address" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email_address" name="email_address" value="<?= htmlspecialchars($user['email_address']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">Designation</label>
            <input type="text" class="form-control" id="designation" name="designation" value="<?= htmlspecialchars($user['Designation']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($user['Date_Of_Birth']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_of_joining" class="form-label">Date of Joining</label>
            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($user['Date']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="Sanctioning_authority" class="form-label">Sanctioning Authority</label>
            <select class="form-select" id="Sanctioning_Authority" name="Sanctioning_Authority" required>
                <option value="Vrinda Ahluja" <?= $user['Sanctioning_Authority'] === 'Vrinda Ahluja' ? 'selected' : '' ?>>Vrinda Ahluja</option>
                <option value="Kalpana Das" <?= $user['Sanctioning_Authority'] === 'Kalpana Das' ? 'selected' : '' ?>>Kalpana Das</option>
                <option value="Jalaj Kumar Das" <?= $user['Sanctioning_Authority'] === 'Jalaj Kumar Das' ? 'selected' : '' ?>>Jalaj Kumar Das</option>
                <option value="Bipula Kishore Kanungo" <?= $user['Sanctioning_Authority'] === 'Bipula Kishore Kanungo' ? 'selected' : '' ?>>Bipula Kishore Kanungo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($user['status']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="report.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
