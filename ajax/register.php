<?php 
    define('__CONFIG__', true);
    require_once "../inc/config.php";  
    header('Content-Type: application/json'); 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      /*
       * return an array that contains data
       */
      $return = [];

      /*
       * sanitize password
       * make sure user does not exist and LOWERCASE the email returns
       * bind parameter to pull variable outside of SQL statements, also less chance of SQL injection
       */
      $email = Filter::String($_POST['email']);
      $findUser = $con->prepare("SELECT user_id FROM users WHERE email = LOWER(:email) LIMIT 1");
      $findUser->bindParam(':email', $email, PDO::PARAM_STR);
      $findUser->execute();

      /*
       * check whether user exists
       * hash password
       * insert user into database
       * return session
       */
      if ($findUser->rowCount() == 1) {
        $return['error'] = "You already have an account";
        $return['is_logged_in'] = false;
      } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $addUser = $con->prepare("INSERT INTO users(email, password) VALUES(LOWER(:email), :password)");
        $addUser->bindParam(':email', $email, PDO::PARAM_STR);
        $addUser->bindParam(':password', $password, PDO::PARAM_STR);
        $addUser->execute();

        $user_id = $con->lastInsertId();

        $_SESSION['user_id'] = (int) $user_id;
        $return['redirect'] = './dashboard.php?message=welcome';
        $return['is_logged_in'] = true;
      }

      echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
      exit('ERROR 404! Something went wrong!');
    }
?>