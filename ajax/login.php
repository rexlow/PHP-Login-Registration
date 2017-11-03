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
       */
      $email = Filter::String($_POST['email']);
      $password = $_POST['password'];

      /*
       * sanitize password
       * make sure user does not exist and LOWERCASE the email returns
       * bind parameter to pull variable outside of SQL statements, also less chance of SQL injection
       */
      $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
      $findUser->bindParam(':email', $email, PDO::PARAM_STR);
      $findUser->execute();

      /*
       * check whether user exists
       * PDO::FETCH_ASSOC returns an array that contains user object
       * cast variable properly
       * un-hash password, check if equal with form data
       * return session
       */
      if ($findUser->rowCount() == 1) {
        $User = $findUser->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $User['user_id'];
        $hash = (string) $User['password'];

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