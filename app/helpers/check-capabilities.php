<?php

class CheckCapabilities{
    static public function isAdmin(){
        if($_SESSION['user_logged']->capabilities == 'admin'){
            return true;
        }
        return false;
    }
}