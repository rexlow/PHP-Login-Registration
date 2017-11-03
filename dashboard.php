<?php 
    define('__CONFIG__', true);     // allow the configs
    require_once "inc/config.php";  // require the configs
    
    if (isset($_SESSION['user_id'])) {
      
    } else {
      header("Location: ./login.php"); exit;
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>

<body>
    <div class="uk-section uk-container uk-text-center">
        <?php echo "Hello world! Today is "; echo date("Y m d"); ?>
    </div>
    <?php require_once "inc/footer.php" ?>
</body>

</html>