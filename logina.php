<?php
session_start();
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partialsa/_dbconnecta.php';

    $Username = mysqli_real_escape_string($conn_admin, $_POST["Username"]);
    $Password = mysqli_real_escape_string($conn_admin, $_POST["Password"]);

    $sql = "SELECT * FROM `admin` WHERE Username = '$Username'";
    $result = mysqli_query($conn_admin, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $dbPasswordHash = $row['Password'];

        if (password_verify($Password, $dbPasswordHash)) {
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['Username'] = $Username;
            $_SESSION['User_ID'] = $row['Sno'];
            header("Location: welcomea.php");
            exit;
        } else {
            $showError = "Invalid Credentials";
        }
    } else {
        $showError = "Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <body>
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe); /* Soft light blue gradient */
            color: #212529; /* Ensures text is visible */
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
<?php require 'partialsa/_nava.php'; ?>

<div class="container mt-4">
    <!-- Display success message -->
    <?php if ($login): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Display error message -->
    <?php if ($showError): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= $showError; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Login Form -->
<div class="container">
    <h1 class="text-center">ADMIN LOGIN</h1>
    <form action="/adminsys/logina.php" method="POST">
        <div class="form-group mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" class="form-control" id="Username" name="Username" required>
        </div>
        <div class="form-group mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

