<?php
if (!defined('__CONFIG__')) {
  exit('You do not have a config file, go away');
}

class DB {
  protected static $con; // static means we can call this variable with keyword self

  /*
   * as soon as new DB(); is called, this construct function will be invoked
   */
  private function __construct() {
    try {
      self::$con = new PDO("mysql:charset=utf8mb4;host=localhost;port=3306;dbname=login_course", "root", "");
      self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$con->setAttribute(PDO::ATTR_PERSISTENT, false);
    } catch (PDOException $e) {
      echo "Could could not connect to database.\r\n";
      exit;
    }
  }

  public static function getConnection() {
    
    /*
     * if this instance was not been started, start it
     */
    if (!self::$con) {
      new DB();
    }

    /*
     * return the writeable db connection
     */
    return self::$con;
  }
}

?>