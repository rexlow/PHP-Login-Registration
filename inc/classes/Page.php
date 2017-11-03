<?php 
  if (!defined('__CONFIG__')) {
    exit('You do not have a config file');
  }

  class Page {
    /*
     * if user is not logged in, direct user to login page
     */
    static function checkIfUserIsLoggedIn() {
      if (isset($_SESSION['user_id'])) {
        
      } else {
        header("Location: ./login.php"); exit;
      }
    }

    static function ifUserIsLoggedIn() {
      if (isset($_SESSION['user_id'])) {
        header("Location: ./dashboard.php");
      }
    }
  }
?>