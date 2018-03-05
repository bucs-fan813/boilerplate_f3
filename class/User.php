<?php 

class User extends \DB\SQL\Mapper {
    private $uid;
    private $name;
    private $mail;
    private $pass;
    public function __construct() {
       
        parent::__construct( \Base::instance()->get('DB'), 'user' );
    }
    static function create_password($password) {
        // Prevent DoS attacks by refusing to hash large passwords.
        if (strlen($password) > 512) {
            return FALSE;
        }
        
        // We rely on the password_hash() function being available in PHP 5.5+.
        return password_hash($password, PASSWORD_DEFAULT);
        
    }
}
function login($username, $password=null) {
    // F3 sync the 'POST' hive array variable with the $_POST array
    $f3->get('user')->copyfrom('POST');
    k($f3);
    $user = self::load("name = $username");
    k($user);
}
// $user = new User();
// $user->load("name = $username");
// k($user);
// etc.