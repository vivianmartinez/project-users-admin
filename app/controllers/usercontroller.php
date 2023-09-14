<?php

require_once 'app/helpers/validate-user.php';

class UserController{

   public function register(){
      include 'views/users/register.php';
   }

   public function signUp(){
      
      if(isset($_POST)){
         $name     = isset($_POST['register_name']) ? $_POST['register_name'] : false;
         $email    = isset($_POST['register_email']) ? $_POST['register_email'] : false;
         $password = isset($_POST['register_password']) ? $_POST['register_password'] : false;
         $picture  = isset($_FILES['register_image']) ? $_FILES['register_image'] : false;

         $validate_user = ValidateUser::validateFields($name,$email,$password);
         
         if(!$validate_user['error']){
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
           
            if(! is_array($response) && $response){
               $_SESSION['register_success'] = ['error' => false, 'message' =>'¡The user has been created succesfully!'];
               $search_user = UserModel::getUser('email',$email);
               if(!empty($search_user)){
                  $_SESSION['user_logged'] = $search_user[0];
                  RedirectRoute::redirect('user/management');
               }  
            }else{
               $_SESSION['register_error']= ['Register'=>'Something bad happened, try again please.'];
            }
         }else{
            $_SESSION['register_error'] =  $validate_user['content'];
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
   public function profile(){
      if(isset($_GET['id'])){
         $profile_user = UserModel::getUser('id',$_GET['id']);
         include 'views/users/profile.php';
      }
   }

   public function edit(){
      $id_user  = isset($_GET['id']) ? $_GET['id'] : false;
      $name     = isset($_POST['edit_name']) ? $_POST['edit_name'] : false;
      $email    = isset($_POST['edit_email']) ? $_POST['edit_email'] : false;
      $lastPassword = isset($_POST['last_password']) ? $_POST['last_password'] : false;
      $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : false;
      $capabilitie  = isset($_POST['edit_capabilitie']) ? $_POST['edit_capabilitie'] : false;
      $picture  = isset($_FILES['edit_image']) ? $_FILES['edit_image'] : false;
      
      $validate_user = ValidateUser::validateFields($name,$email);
      
      if(!$validate_user['error'] && $id_user){
         $user_edit = UserModel::getUser('id',$id_user);
         if(!empty($user_edit[0])){
            $user = new UserModel();
            $user->setUserName($name);
            $user->setEmail($email);
            $user->setCapabilities($capabilitie);

            $name_file = $user_edit[0]->image;

            if(is_dir('storage/images')){
               if($picture['name']){
                  print_r($picture);
                  $name_file = $_FILES['edit_image']['name'];
                  if( $name_file != $user_edit[0]->image &&  $_FILES['edit_image']['type'] == 'image/jpeg' 
                     || $_FILES['edit_image']['type'] == 'image/jpg' 
                     || $_FILES['edit_image']['type'] == 'image/png'){
                     $tmp_name  = $_FILES['edit_image']['tmp_name'];
                     move_uploaded_file($tmp_name,'storage/images/'.$name_file);   
                  }
               }
            } 
            $user->setImage($name_file);
            $password_hash = $user_edit[0]->password;
            
            if(isset($_POST['change_password']) && $_POST['change_password'] == 'true'){
               $verify_password = password_verify($lastPassword,$user_edit[0]->password);
               if($verify_password){
                  if(!$newPassword && !preg_match('/^[a-zA-Z0-9]+$/',$newPassword)){
                     $_SESSION['edit_error'] = ['password'=>'The new password is required and can\'t contain invalid characters.'];
                  }else{
                     $password_hash = password_hash($newPassword,PASSWORD_BCRYPT,['cost'=>4]);
                  } 
               }else{
                  $_SESSION['edit_error'] = ['password'=>'Wrong last password. Try again, please.'];
               }
            }
            $user->setPassword($password_hash);
            if(!isset( $_SESSION['edit_error'])){
               $response = $user->updateUser($id_user);

               if($response && is_object($response)){
                  $_SESSION['edit_success'] = ['error' => false, 'message' => '¡The user has been updated succesfully!'];
               }
            }
         }
      }else{
         $_SESSION['edit_error'] = $validate_user['content'];
      }
      RedirectRoute::redirect('user/profile&id='.$_GET['id']);
   }

}