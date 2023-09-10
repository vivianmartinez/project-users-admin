<?php

class ResetSession{

    static public function deleteSession($session){
        if(isset($_SESSION[$session])){
            $_SESSION[$session] = null;
            unset($_SESSION[$session]);
        }
    }
}