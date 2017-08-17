<?php
session_start();

require_once($rootPath . "controllers/Controller.php");
require_once($rootPath . "models/Model.php");

// Met la première lettre du contrôleur en majuscule
if (isset($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']);
} else {
	$controller = "Offers";
}

$controllerPath = $rootPath . "controllers/" . $controller . ".php";

if (file_exists($controllerPath)) {
	require_once($controllerPath);

	$controllerName = $controller . "Controller";
	$controller = new $controllerName($rootPath);
} else {
    header("Location:index.php?controller=error&action=error404");
    exit();
}

// Met la paramètre action en minuscule
if (isset($_GET['action'])) {
    $action = lcfirst($_GET['action']) . "Action";
} else {
	$action = "indexAction";
}

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    header("Location:index.php?controller=error&action=error404");
    exit();
}

$content = $controller->render();

include(__DIR__ . "/base.html.php");