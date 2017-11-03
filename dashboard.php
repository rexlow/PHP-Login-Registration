<?php 
    define('__CONFIG__', true);  
    require_once "inc/config.php";
    
    Page::checkIfUserIsLoggedIn();

    $User = new User($_SESSION['user_id']);
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
        <p>Hello <?php echo $User->email; ?>, you registered at <?php echo $User->reg_time; ?></p>
        <p><a href="./logout.php">Logout</a></p>
    </div>
    <?php require_once "inc/footer.php" ?>
</body>

</html>