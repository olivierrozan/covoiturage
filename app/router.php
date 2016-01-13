<?php
session_start();

require_once($rootPath . "controllers/Controller.php");
require_once($rootPath . "models/model.php");

$controller = "Offers";
$action = "indexAction";

if (isset($_REQUEST['controller'])) {
    $controller = ucfirst($_REQUEST['controller']);
}

if (isset($_REQUEST['action'])) {
    $action = strtolower($_REQUEST['action']) . "Action";
}

$controllerPath = $rootPath . "controllers/" . $controller . ".php";

require_once($controllerPath);

$controllerName = $controller . "Controller";
$controller = new $controllerName($rootPath);
$controller->$action();

$content = $controller->render();

include(__DIR__ . "/base.html.php");