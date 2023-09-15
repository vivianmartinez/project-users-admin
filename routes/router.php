<?php
session_start();


require_once 'app/config/config-url.php';
require_once 'app/models/usermodel.php';
require_once 'views/layouts/header.php';
require_once 'app/helpers/reset-session.php';
require_once 'app/helpers/display-error.php';
require_once 'app/helpers/redirect-route.php';
require_once 'app/helpers/check-login-status.php';
require_once 'app/helpers/check-capabilities.php';



$controller         =  new LoginController();
$parameter_method   = 'index';

if(isset($_GET['controller']) && !empty($_GET['controller'])){
    $class_controller = $_GET['controller'].'Controller';
    if(class_exists($class_controller)){
        $controller = new $class_controller();
        if(isset($_GET['method']) && method_exists($controller,$_GET['method'])){
            $parameter_method = $_GET['method'];
        }elseif($_GET['controller'] != 'login'){
            $controller = new PageNotFoundController();
        }
    }else{
        $controller = new PageNotFoundController();
    }
}
//print_r($_GET);
$controller->$parameter_method();

require_once 'views/layouts/footer.php';


