<?php

require_once 'app/models/usermodel.php';
require_once 'app/database/connection.php';
require_once 'views/layout/header.php';

$controller_name    = 'logincontroller';
$parameter_method   = 'index';
$controller         =  new $controller_name();

if(isset($_GET['controller'])){
    $class_controller = $_GET['controller'].'Controller';
    if(class_exists($class_controller)){
        $controller = new $class_controller();
        if(isset($_GET['method']) && method_exists($controller,$_GET['method'])){
            $parameter_method = $_GET['method'];
        }
    }
}

$controller->$parameter_method();

require_once 'views/layout/footer.php';


