<?php 
  /*
   * if there is no constant defined called __CONFIG__, do not load this file
   */
  if (!defined('__CONFIG__')) {
    exit('You do not have a config file');
  }

  /*
   * Always start session
   */
  if (!isset($_SESSION)) {
    session_start();
  }

  /*
   * allow error reporting
   */
  error_reporting(-1);
  ini_set('display_errors', 'On');

  /*
   * include relevant configs
   */
  include_once "classes/DB.php";
  include_once "classes/Filter.php";

  $con = DB::getConnection();
?>