<?php

class DisplayError{
    static public function displayErrors($error_session){
        foreach($_SESSION[$error_session] as $error => $message){
            echo  '<div class="alert alert-danger"><strong>¡Error '.$error.'!</strong> '.$message.'</div>';
        }
    }
}