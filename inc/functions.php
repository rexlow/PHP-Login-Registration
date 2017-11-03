<?php
  /*
   * if user is not logged in, direct user to login page
   */
  function checkIfUserIsLoggedIn() {
    if (isset($_SESSION['user_id'])) {
      
    } else {
      header("Location: ./login.php"); exit;
    }
  }

  function ifUserIsLoggedIn() {
    if (isset($_SESSION['user_id'])) {
      header("Location: ./dashboard.php");
    }
  }

  /*
   * sanitize password
   * make sure user does not exist and LOWERCASE the email returns
   * bind parameter to pull variable outside of SQL statements, also less chance of SQL injection
   */
  function findUser($con, $email, $return_assoc = false) {
    $email = (string) Filter::String($email);
    $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
    $findUser->bindParam(':email', $email, PDO::PARAM_STR);
    $findUser->execute();

    if ($return_assoc) {
      return $findUser->fetch(PDO::FETCH_ASSOC);
    }

    $user_found = (boolean) $findUser->rowCount();
    return $user_found;
  }
?>