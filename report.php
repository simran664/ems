
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: logina.php");
    exit;
}

include 'partialsa/_dbconnecta.php';


$reportType = isset($_GET['report']) ? $_GET['report'] : 'all_employees'; 
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unified Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            color: #fff;
        }
        .report-details {
            width: 100%;
            margin-top: 20px;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .table-responsive {
            overflow-x: auto;
            max-height: 80vh; /* For vertical scrolling if content exceeds viewport height */
        }
        table {
            width: 100%; /* Full-width table */
            border: 1px solid #dee2e6;
            margin-top: 15px;
            font-size: 14px;
        }
        th, td {
            text-align: center;
            padding: 10px;
            white-space: nowrap; /* Prevent wrapping of content */
        }
        th {
            background-color: #495057;
            color: #fff;
        }
        .dropdown, .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input, .filter-form button {
            height: 40px;
        }
    </style>
</head>
<body>
<?php require 'partialsa/_nava.php'; ?>

<div class="container-fluid mt-4">
    <h1 class="text-center mb-4">UNIFIED REPORTS</h1>

    
    <div class="dropdown text-center mb-3">
        <div class="card-header">SELECT TYPE OF REPORT</div>
        
                <button class="btn btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Choose Report
                </button>
                <ul class="dropdown-menu w-100">
                    <li><a class="dropdown-item" href="report.php?report=all_employees">All Employees</a></li>
                    <li><a class="dropdown-item" href="report.php?report=current_employees">Current Employees</a></li>
                    <li><a class="dropdown-item" href="report.php?report=joining">Joining List</a></li>
                    <li><a class="dropdown-item" href="report.php?report=retirement">Retirement List</a></li>
                    <li><a class="dropdown-item" href="report.php?report=out_of_service">Out of Service List</a></li>
                </ul>
            </div>
        </div>
    </div>


    <form method="POST" class="filter-form row g-3">
        <div class="col-md-5">
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= htmlspecialchars($startDate) ?>" placeholder="Start Date">
        </div>
        <div class="col-md-5">
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= htmlspecialchars($endDate) ?>" placeholder="End Date">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">FILTER</button>
        </div>
    </form>

    <div class="report-details">
        <h2 class="text-center mb-4">Report Details</h2>
        <div class="table-responsive">
            <?php
            if (in_array($reportType, ['all_employees', 'current_employees', 'joining', 'retirement', 'out_of_service'])) {
                include "report/{$reportType}.php";
            } else {
                echo "<p class='text-center text-warning'>Please select a report type from the dropdown above to view details.</p>";
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

