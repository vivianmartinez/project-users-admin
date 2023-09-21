<?php

class RedirectRoute{
    static public function redirect($route){
        header("location:".url_base.$route);
    }
}