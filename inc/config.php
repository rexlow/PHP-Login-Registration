<?php 
  // if there is no constant defined called __CONFIG__, do not load this file
  if (!defined('__CONFIG__')) {
    exit('You do not have a config file');
  }

  // include DB
  include_once "classes/DB.php";

  $con = DB::getConnection();
?>