<?php

function app_autoloader($controller){
    if(file_exists('app/controllers/'.$controller.'.php')){
        require 'app/controllers/'.$controller.'.php';
    }
}

spl_autoload_register('app_autoloader');