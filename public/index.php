<?php
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . 'view' . DIRECTORY_SEPARATOR);
define('MODULES_PATH', ROOT_PATH . 'modules' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DB.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once MODULES_PATH . 'page/models/Page.php';

DB::connect('localhost', 'darwin_cms', 'root', '');

$action = $_GET['seo_name'] ?? 'home';

$dbh = DB::getInstance();
$router = new Router($dbh->getConnection());
$router->findBy('pretty_url', $action);
$action = $router->action == '' ? 'default' : $router->action;

$moduleName = ucfirst($router->module) . 'Controller';

$controllerFile = MODULES_PATH . $router->module ."/controllers/$moduleName.php";

if (file_exists($controllerFile)) {
    include $controllerFile;
    $controller = new $moduleName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}
