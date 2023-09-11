<?php

class CheckLoginStatus{

    static public function isLoggedIn(){
        if(isset($_SESSION['user_logged'])){
            return true;
        }
        return false;
    }
}