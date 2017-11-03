<?php 
    // allow the configs
    define('__CONFIG__', true);     

    // require the configs
    require_once "../inc/config.php";  

    // always return in json
    header('Content-Type: application/json'); 

    $array = ['test', 'test2'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // return an array that contains data
      $return = [];

      // sanitize password
      $email = Filter::String($_POST['email']);

      // make sure user does not exist and LOWERCASE the email returns
      $findUser = $con->prepare("SELECT user_id FROM users WHERE email = LOWER(:email) LIMIT 1");

      // bind parameter to pull variable outside of SQL statements, also less chance of SQL injection
      $findUser->bindParam(':email', $email, PDO::PARAM_STR);

      // execute query
      $findUser->execute();
      
      if ($findUser->rowCount() == 1) {
        $return['error'] = "You already have an account";
      } else {
        // insert user into database
        $addUser = $con->prepare("INSERT INTO users(email, password) VALUES(:email, :password)");
        $addUser->bindParam(':email', $email, PDO::PARAM_STR);
        $addUser->bindParam(':password', $password, PDO::PARAM_STR);
        $addUser->execute();
      }

      $return['redirect'] = './dashboard.php'; 
      $return['name'] = 'rex';

      echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
      exit('ERROR 404! Something went wrong!');
    }
?>