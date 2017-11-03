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

      $return['redirect'] = './dashboard.php'; 
      $return['name'] = 'rex';

      echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
      exit('ERROR 404! Something went wrong!');
    }
?>