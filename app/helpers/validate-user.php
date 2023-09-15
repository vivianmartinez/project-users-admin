<?php

class ValidateUser{

    /*** validate required fields */
    static public function validateRequiredFields($name,$email,$password = null){
        $error = [];
        if(!$name || !preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',$name) ){
            $error['name'] = 'the name is required and can\'t contain invalid characters.';
        }
        if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL) ){
            $error['email'] = 'the email is required and must have a valid format.';
        }
        if($password !== null){
            if(!$password && !preg_match('/^[a-zA-Z0-9]+$/',$password)){
                $error['password'] = 'The password is required and can\'t contain invalid characters.';
            }
        }
        if(!empty($error)){
            return ['error'=> true,'content'=>$error];
        }
        return ['error'=> false];
    }

    /**validate image */
    static public function validateImage($image){
        $error = [];
        if(   $image['type'] == 'image/jpeg' 
        || $image['type'] == 'image/jpg' 
        || $image['type'] == 'image/png'){

            if($image['size'] > 1000000){
                $error['size'] = 'Image no larger than 1MB';
            }
        }else{
            $error['type'] = 'Image type only JPG, JPEG or PNG.';
        }
        if(!empty($error)){
            return ['error'=> true,'content'=>$error];
        }
        return ['error'=> false];
    }
}