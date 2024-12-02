<?php
session_start();

require_once 'Entity/UserEntity.php';
require_once 'Controller/UserController.php';
require_once 'Entity/Connection.php';

// Créer la connexion à la base de données
$connection = new Connection();
$db = $connection->getDb();
$userController = new UserController($db);

include('View/header.php');

if (( isset($_GET['ctrl']) && !empty($_GET['ctrl']) ) && ( isset($_GET['action']) && !empty($_GET['action']) )) {
    $ctrl = $_GET['ctrl'];
    $action = $_GET['action'];
}
else {
    $ctrl = 'home';
    $action = 'index';
}
if ($ctrl != 'user') {
    require_once('./Controller/' . $ctrl . 'Controller.php');
}
$ctrl = ucfirst($ctrl) . 'Controller';
$controller = new $ctrl($db);
if (isset($action)) {
    $controller->$action();
}




