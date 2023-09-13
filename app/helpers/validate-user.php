<?php

class ValidateUser{

    static public function validateFields($name,$email,$password = null){
        $error =[];
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
}