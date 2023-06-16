<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'abcdef');

require_once ROOT_PATH . 'src/DB.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once MODULES_PATH . 'user/models/User.php';

DB::connect('localhost', 'darwin_cms', 'root', '');

$dbh = DB::getInstance();
$dbc = $dbh->getConnection();

$user = new User($dbc);
$user->findBy('username', 'admin');

$auth = new Auth;
$auth->changeUserPassword($user, 'TopSecret');

var_dump($user);