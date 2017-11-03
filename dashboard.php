<?php 
    define('__CONFIG__', true);  
    require_once "inc/config.php";
    
    checkIfUserIsLoggedIn();

    $user_id = $_SESSION['user_id'];

    $getUserInfo = $con->prepare("SELECT email, reg_time FROM users WHERE user_id = :user_id LIMIT 1");
    $getUserInfo->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $getUserInfo->execute();

    /*
     * maybe some point in the time user is deleted by admin, but user still has session in his browser
     * he will be still able to access to data
     * so we need to check is user still exist to display data, otherwise force logout
     */
    if ($getUserInfo->rowCount() == 1) {
        // user was found
        $User = $getUserInfo->fetch(PDO::FETCH_ASSOC);
    } else {
        // user is not signed in
        header("Location: ./logout.php"); exit;
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
        <p>Hello <?php echo $User['email']; ?>, you registered at <?php echo $User['reg_time']; ?></p>
        <p><a href="./logout.php">Logout</a></p>
    </div>
    <?php require_once "inc/footer.php" ?>
</body>

</html>