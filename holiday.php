<?php
$conn = new mysqli("localhost", "root", "", "users");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {

    header("location: logina.php");
    exit;
}

$showSuccess = "";
$showError = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $holiday_date = $_POST['holiday_date'];
        $holiday_name = $_POST['holiday_name'];

        $sql = "INSERT INTO holidays (holiday_date, holiday_name, published) VALUES (?, ?, TRUE)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $holiday_date, $holiday_name);
        if ($stmt->execute()) {
            $showSuccess = "Holiday added successfully.";
        } else {
            $showError = "Error adding holiday: " . $conn->error;
        }
    }
   
    elseif ($action == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM holidays WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $showSuccess = "Holiday deleted successfully.";
        } else {
            $showError = "Error deleting holiday: " . $conn->error;
        }
    }
  
    elseif ($action == 'edit') {
        $id = $_POST['id'];
        $new_holiday_date = $_POST['holiday_date'];
        
        $sql = "UPDATE holidays SET holiday_date = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $new_holiday_date, $id);
        if ($stmt->execute()) {
            $showSuccess = "Holiday date updated successfully.";
        } else {
            $showError = "Error updating holiday date: " . $conn->error;
        }
    }
}


$sql = "SELECT * FROM holidays ORDER BY holiday_date";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Holiday Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5rem; /* Increased font size */
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 1.5rem;
        }
        table {
            width: 70%;
            margin-top: 20px;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            font-size: 0.9rem;
        }
        th, td {
            padding: 6px 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        form {
            margin: 0 auto;
            width: 50%;
            text-align: center;
        }
        label {
            font-size: 1.1em;
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], button {
            padding: 8px;
            margin: 8px 0;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #45a049;
        }
        .action-btns button {
            margin-right: 5px;
        }
        .modify-date {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .modify-date button {
            width: auto;
        }
        
    </style>
    
</head>
<body>
<style>
    body {
        background-image: url('stock-photo-abstract-modern-colorful-mesh-gradient-latest-trend.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-attachment: fixed; 
        background-repeat: no-repeat; 
    }
    
</style>
    <div class="container">
        <h1>HOLIDAY MANAGEMENT</h1>

        <!-- Display Success/Error Alerts -->
        <?php if ($showSuccess): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= $showSuccess; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?= $showError; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Add holiday form -->
        <h2>ADD NEW HOLIDAY</h2>
        <form method="POST" action="holiday.php">
            <input type="hidden" name="action" value="add">
            <label for="holiday_date">Holiday Date:</label>
            <input type="date" name="holiday_date" required><br>

            <label for="holiday_name">Holiday Name:</label>
            <input type="text" name="holiday_name" required><br>

            <button type="submit">Add Holiday</button>
        </form>

        <!-- Display holidays -->
        <h2>LIST OF DECLARED HOLIDAYS</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['holiday_date'] ?></td>
                        <td><?= $row['holiday_name'] ?></td>
                        <td class="action-btns">
                            <!-- Delete holiday -->
                            <form method="POST" action="holiday.php" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>

                            <!-- Edit holiday -->
                            <form method="POST" action="holiday.php" style="display:inline;">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="date" name="holiday_date" value="<?= $row['holiday_date'] ?>" required style="width: 120px;">
                                <button type="submit" class="btn btn-warning btn-sm">Modify Date</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>


<?php
// Close database connection
$conn->close();
?>
