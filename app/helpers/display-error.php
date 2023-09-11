<?php


class DisplayError{

    static public function displayErrors($error_session){
        echo '<div class="container col-4">';
        foreach($_SESSION[$error_session] as $error => $message){
            echo  '<div class="alert alert-danger"><strong>¡Error '.$error.'!</strong> '.$message.'</div>';
        }
        echo '</div>';
    }
}