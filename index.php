<?php 
    define('__CONFIG__', true);     // allow the configs
    require_once "inc/config.php";  // require the configs
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Registration</title>
</head>

<body>
    <div class="uk-section uk-container uk-text-center">
        <!-- <?php echo "Hello world! Today is "; echo date("Y m d"); ?> -->
        <div class="uk-margin">
            <a class="uk-button uk-button-primary" href="./login.php">Login</a>
            <a class="uk-button uk-button-secondary" href="./register.php">Register</a>
        </div>
    </div>
    <?php require_once "inc/footer.php" ?>
</body>

</html>