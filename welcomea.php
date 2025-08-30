<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: logina.php");
    exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
  <style>
   body {
        background-image: url('stock-photo-abstract-modern-colorful-mesh-gradient-latest-trend.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-attachment: fixed; 
        background-repeat: no-repeat; 
    }
</style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>WELCOME - <?php echo $_SESSION['Username']; ?></title>
  </head>
  <body>
   
    
    <style>
       
        body, html {
            height: 100%; 
            margin: 0;
        }

        .centered-card-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100%;
            padding-top: 50px;
        }

        .alert-bg-dark {
            background-color: #343a40; 
            color: white; 
        }
    </style>
    
</head>
<body class="bg-light">

    <div class="centered-card-container">
        <div class="card" style="width: 80%; max-width: 600px;">
            <div class="card-body">
                <div class="alert alert-bg-dark" role="alert">
                    <h4 class="alert-heading">WELCOME - <?php echo $_SESSION['Username']; ?></h4>
                    <p>Hey! You're logged in successfully as <?php echo $_SESSION['Username']; ?></p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to logout using this <a href="/adminsys/logouta.php" class="text-light">link</a>.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
