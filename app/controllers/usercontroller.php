<?php

class UserController{

   public function register(){
      include 'views/users/register.php';
   }

   public function signUp(){
      $error = [];
      if(isset($_POST)){
         $name     = isset($_POST['register_name']) ? $_POST['register_name'] : false;
         $email    = isset($_POST['register_email']) ? $_POST['register_email'] : false;
         $password = isset($_POST['register_password']) ? $_POST['register_password'] : false;
         $picture  = isset($_FILES['register_image']) ? $_FILES['register_image'] : false;

         if(!$name || !preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',$name) ){
            $error['name'] = 'the name is required and can\'t contain invalid characters.';
         }
         if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL) ){
            $error['email'] = 'the email is required and must have a valid format.';
         }
         if(!$password && !preg_match('/^[a-zA-Z0-9]+$/',$password)){
            $error['password'] = 'The password es required and can\'t contain invalid characters.';
         }
         
         if( empty($error)){
            $name_file = 'avatar.png';
            if(is_dir('storage/images')){
               if($picture){
                  if(   $_FILES['register_image']['type'] == 'image/jpeg' 
                     || $_FILES['register_image']['type'] == 'image/jpg' 
                     || $_FILES['register_image']['type'] == 'image/png'){
                     
                     $name_file = $_FILES['register_image']['name'];
                     $tmp_name  = $_FILES['register_image']['tmp_name'];
                     move_uploaded_file($tmp_name,'storage/images/'.$name_file);
                  }
               }
            }
            $password_hash = password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);
            $user = new UserModel();
            $user->setUserName($name);
            $user->setEmail($email);
            $user->setPassword($password_hash);
            $user->setImage($name_file);
            $response = $user->saveUser();
            print_r($response);
           
            if(! is_array($response) && $response){
               $_SESSION['register_success'] = '¡The user has been created succesfully!';
               $search_user = UserModel::getUser('email',$email);
               if(!empty($search_user)){
                  $_SESSION['user_logged'] = $search_user[0];
                  RedirectRoute::redirect('user/management');
               }  
            }else{
               $_SESSION['register_error']= ['Register'=>'Something bad happened, try again please.'];
            }
         }else{
            $_SESSION['register_error'] =  $error;
         }
      }
      if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error'])){
         RedirectRoute::redirect('user/register');
      }
   }

   public function management(){
      $users = UserModel::getUsers();
      include 'views/users/management.php';
   }

}