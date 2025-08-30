<?php
session_start();
session_unset();
session_destroy();

header("location:logina.php");
exit;
?>

<!DOCTYPE html>
<html lang="en">
<head> <style>
    body {
        background-image: url('stock-photo-abstract-modern-colorful-mesh-gradient-latest-trend.jpg'); /* Replace with your image URL */
        background-size: cover; /* Ensures the image covers the entire viewport */
        background-position: center; /* Centers the image */
        background-attachment: fixed; /* Makes the background static while content scrolls */
        background-repeat: no-repeat; /* Avoids image repetition */
    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>