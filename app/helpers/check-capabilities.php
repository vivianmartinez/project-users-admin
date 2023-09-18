<?php

class CheckCapabilities{
    static public function isAdmin(){
        if(isset($_SESSION['user_logged']) && $_SESSION['user_logged']->capabilities == 'admin'){
            return true;
        }
        return false;
    }
}