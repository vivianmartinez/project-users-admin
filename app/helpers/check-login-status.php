<?php

class CheckLoginStatus{
    //check if user is logged in
    static public function isLoggedIn(){
        if(isset($_SESSION['user_logged'])){
            return true;
        }
        return false;
    }
}