<?php 
  if (!defined('__CONFIG__')) {
    exit('You do not have a config file');
  }

  class User {

    private $con;

    public $user_id;
    public $email;
    public $reg_time;

    public function __construct(int $user_id) {
      $this->con = DB::getConnection();
      $user_id = Filter::Int($user_id);

      $user = $this->con->prepare("SELECT user_id, email, reg_time FROM users WHERE user_id = :user_id LIMIT 1");
      $user->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $user->execute();
      
      /*
       * maybe some point in the time user is deleted by admin, but user still has session in his browser
       * he will be still able to access to data
       * so we need to check is user still exist to display data, otherwise force logout
       */
      if ($user->rowCount() == 1) {
        $user = $user->fetch(PDO::FETCH_OBJ);

        $this->email    = (string) $user->email;
        $this->user_id  = (int) $user->user_id;
        $this->reg_time = (string) $user->reg_time;
      } else {
        header("Location: ./logout.php");
      }
    }

    /*
     * sanitize password
     * make sure user does not exist and LOWERCASE the email returns
     * bind parameter to pull variable outside of SQL statements, also less chance of SQL injection
     */
    public static function Find($email, $return_assoc = false) {

      $con = DB::getConnection();

      $email = (string) Filter::String($email);
      $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
      $findUser->bindParam(':email', $email, PDO::PARAM_STR);
      $findUser->execute();

      /*
      * if 2nd parameter is true, return the user object instead
      */
      if ($return_assoc) {
        return $findUser->fetch(PDO::FETCH_ASSOC);
      }

      $user_found = (boolean) $findUser->rowCount();
      return $user_found;
    }
  }
?>