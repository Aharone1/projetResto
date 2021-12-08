<?php require '../views/guest/comon/header.php'; ?>

<?php

if(session_status() == PHP_SESSION_NONE){
session_start();
}
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';
$controller = $page . 'Controller';
require '../controllers/' . $controller . '.php';

$controller = new $controller;
$controller->$action();
?>
<?php require '../views/guest/comon/footer.php'; ?>
