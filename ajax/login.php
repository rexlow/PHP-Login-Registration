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
       * form data
       * note that 3rd parameter, true is passed in as well to retrieve data
       */
      $email = Filter::String($_POST['email']);
      $password = $_POST['password'];

      $user_found = findUser($con, $email, true);

      /*
       * PDO::FETCH_ASSOC returns an array that contains user object
       * cast variable properly
       * un-hash password, check if equal with form data
       * return session
       */
      if ($user_found) {
        $user_id = (int) $user_found['user_id'];
        $hash = (string) $user_found['password'];

        if (password_verify($password, $hash)) {
          $return['redirect'] = './dashboard.php';
          $_SESSION['user_id'] = $user_id;
        } else {
          $return['error'] = "Invalid user email/password combo";
        }

      } else {
        $return['error'] = "You do not have an account. <a href='./register.php'>Create one now?</a>";
      }

      echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
      exit('ERROR 404! Something went wrong!');
    }
?>