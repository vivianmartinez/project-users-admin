<?php

class LoginController{

    public function index(){
        include 'views/users/login.php';
    }
    /** Login users */
    public function signIn(){
        $error = [];
        if(isset($_POST)){
           $email    = isset($_POST['login_email']) ? $_POST['login_email'] : false;
           $password = isset($_POST['login_password']) ? $_POST['login_password'] : false;
           
           if(!$email){
            $error['email'] = 'Enter email address, please.';
           } 
           if(!$password){
            $error['password'] = 'Enter password, please';
           }
           $_SESSION['old_data_login'] = ['email' => $email ? $email : ''];
           if(empty($error)){
            $search_user = UserModel::getUser('email',$email);
            if($search_user){
                if(property_exists($search_user[0],'email')){
                    //verify user password
                    $verify_password = password_verify($password,$search_user[0]->password);
                    if($verify_password){
                        $_SESSION['user_logged'] = $search_user[0];
                        RedirectRoute::redirect('user/management');
                    }else{
                        $_SESSION['login_error'] = ['password'=>'Wrong password.'];
                    }
                }else{
                    $_SESSION['login_error'] = ['System'=>'Something bad happend. Please try later.'];
                }
            }else{
                $_SESSION['login_error'] = ['email'=>'The user dosen\'t exist.'];
            }
           }else{
                $_SESSION['login_error'] = $error;  
           }
        }
        if(isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])){
            RedirectRoute::redirect('login');
        } 
    }
    /**Logout */
    public function signOut(){
        if(isset($_SESSION['user_logged'])){
            ResetSession::deleteSession('user_logged');
            session_destroy();
            RedirectRoute::redirect('login');
        }   
    }
}