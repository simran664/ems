<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logina.php");
    exit;
}


include 'partialsa/_dbconnecta.php';
if (!$conn_users) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = mysqli_real_escape_string($conn_users, $_POST['Full_Name']);
    $username = mysqli_real_escape_string($conn_users, $_POST['Username']);
    $gender = mysqli_real_escape_string($conn_users, $_POST['Gender']);
    $mobileNo = mysqli_real_escape_string($conn_users, $_POST['Mobile_No']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $dob = mysqli_real_escape_string($conn_users, $_POST['Date_Of_Birth']);
    $date = mysqli_real_escape_string($conn_users, $_POST['Date']);
    $email = mysqli_real_escape_string($conn_users, $_POST['email_address']);
    $designation = mysqli_real_escape_string($conn_users, $_POST['Designation']);
    $sanctioningAuthority = mysqli_real_escape_string($conn_users, $_POST['Sanctioning_Authority']);
    $role = 'employee';

   
    if (empty($fullName) || empty($username) || empty($mobileNo) || empty($password) || empty($email)) {
        $error = "Please fill in all mandatory fields.";
    } else {
        
        $sql = "
            INSERT INTO user (Full_Name, Username, Gender, Mobile_No, Password, Date_Of_Birth, Date, email_address, role, Designation, Sanctioning_Authority, last_activity)
            VALUES ('$fullName', '$username', '$gender', '$mobileNo', '$password', '$dob', '$date', '$email', '$role', '$designation', '$sanctioningAuthority', NULL)
        ";

        if (mysqli_query($conn_users, $sql)) {
            $success = "User created successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn_users);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .form-container {
            background-color: #ffffff; /* White form container */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        .form-title {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<style>
        body {
            background-image: url('modern-soft-green-watercolor-texture-background-design_1055-17987.jpg'); /* Replace with your image URL */
            background-size: cover; /* Ensures the image covers the entire viewport */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Makes the background static while content scrolls */
            background-repeat: no-repeat; /* Avoids image repetition */
        }
    </style>
<?php require 'partialsa/_nava.php'; ?>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="form-title">CREATE USER</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Full_Name" class="form-label">Full Name</label>
                    <input type="text" class="form-control shadow-sm" id="Full_Name" name="Full_Name" required>
                </div>
                <div class="col-md-6">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control shadow-sm" id="Username" name="Username" required>
                </div>
                <div class="col-md-6">
                    <label for="Gender" class="form-label">Gender</label>
                    <select class="form-select shadow-sm" id="Gender" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="Mobile_No" class="form-label">Mobile No</label>
                    <input type="text" class="form-control shadow-sm" id="Mobile_No" name="Mobile_No" required>
                </div>
                <div class="col-md-6">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control shadow-sm" id="Password" name="Password" required>
                </div>
                <div class="col-md-6">
                    <label for="Date_Of_Birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control shadow-sm" id="Date_Of_Birth" name="Date_Of_Birth">
                </div>
                <div class="col-md-6">
                    <label for="Date" class="form-label">Joining Date</label>
                    <input type="date" class="form-control shadow-sm" id="Date" name="Date">
                </div>
                <div class="col-md-6">
                    <label for="email_address" class="form-label">Email Address</label>
                    <input type="email" class="form-control shadow-sm" id="email_address" name="email_address" required>
                </div>
                <div class="col-md-6">
                    <label for="Designation" class="form-label">Designation</label>
                    <input type="text" class="form-control shadow-sm" id="Designation" name="Designation">
                </div>
                <div class="col-md-6">
                    <label for="Sanctioning_Authority" class="form-label">Sanctioning Authority</label>
                    <select class="form-select shadow-sm" id="Sanctioning_Authority" name="Sanctioning_Authority">
                        <option value="Vrinda Ahluwalia">Vrinda Ahuja</option>
                        <option value="Jalaj Kumar Das">Jalaj Kumar Das</option>
                        <option value="Bipula Kishore Kanungo">Bipula Kishore Kanungo</option>
                        <option value="Kalpana Das">Kalpana Das</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg shadow mt-4">CREATE</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
