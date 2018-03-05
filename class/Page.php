<?php 
class Page {
    function home($f3) {
        //echo 'I cannot object to an object';
        $f3->set('name','world! its working');
        echo \Template::instance()->render('templates/test.html');
        
        //$db = new \DB\SQL('mysql:host=localhost;dbname=test_db', 'root', 'root');
//         $user = new \DB\SQL\Mapper($db, 'users');
//         $auth = new \Auth($user, array('id'=>'user_id', 'pw'=>'password'));
//         $auth->basic(); // a network login prompt will display to authenticate the user
    }
}
