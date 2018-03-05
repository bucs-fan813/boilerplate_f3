<?php
//Show php debug errors
ini_set('display_errors', 1);

//Require composer libraries
require 'vendor/autoload.php';

//Initialize F3
$f3 = \Base::instance();

//Load F3 Config
$f3->config('config.ini');

//Check to see if there is a database name already set in the F3 config or use the (cleaned) SERVER_NAME
if (!($schema = $f3->get('schema.name')))
    $schema = str_replace('.','_',str_replace('-','_',$_SERVER['SERVER_NAME']));

//Use PDO to check to see if the specified $schema is exists. Creates the schema if not
//If PDO doesn't have any issues then the F3 PDO wrapper shouldn't have any issues 
if (\Site::databaseReady($schema)) {
    $f3->set('DB', new DB\SQL("mysql:host=localhost;port=3306;dbname={$schema}", 'root', ''));
}

if ($tables = $f3->get('schema.tables'))
    if (\Site::schemaReady($f3)) {
        
}

//$user = new \DB\SQL\Mapper($db, 'users');
//$auth = new \Auth($user, array('id'=>'user_id', 'pw'=>'password'));
//$auth->basic(); // a network login prompt will display to authenticate the user
//$db = $f3->get('DB');
//Site::installSchema($db);
//$user = new User();

$f3->run();