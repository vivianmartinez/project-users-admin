<?php

class CheckLoginStatus{

    static public function isLoggedIn(){
        if(isset($_SESSION['logged_user'])) return true;
        RedirectRoute::redirect('login');
        return false;
    }
}