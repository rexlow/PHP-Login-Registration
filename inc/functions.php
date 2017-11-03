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
?>