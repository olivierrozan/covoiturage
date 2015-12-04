<?php

$rootPath = __DIR__ . "/src/";

$config = array();
$config['db_host'] = "localhost";
$config['db_login'] = "root";
$config['db_password'] = "";
$config['db_name'] = "covoiturage";

include($rootPath . "controllers/Controller.php");
include($rootPath . "models/model.php");

include("app/router.php");