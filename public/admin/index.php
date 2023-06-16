<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DB.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once MODULES_PATH . 'page/models/Page.php';
require_once MODULES_PATH . 'user/models/User.php';

DB::connect('localhost', 'darwin_cms', 'root', '');

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';

if ($module == 'dashboard') {

    include MODULES_PATH . 'dashboard/admin/controllers/DashboardController.php';

    $controller = new DashboardController();

} 
$controller->runAction($action);