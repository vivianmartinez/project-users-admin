<?php

require_once 'app/helpers/validate-user.php';
require_once 'app/helpers/paginate-data.php';

class UserController{
   /* Register user */
   public function register(){
      include 'views/users/register.php';
   }
   /* Save new user */
   public function signUp(){
      if(isset($_POST)){
         $name     = isset($_POST['register_name']) ? $_POST['register_name'] : false;
         $email    = isset($_POST['register_email']) ? $_POST['register_email'] : false;
         $password = isset($_POST['register_password']) ? $_POST['register_password'] : false;
         $picture  = isset($_FILES['register_image']) ? $_FILES['register_image'] : false;
         print_r($picture);
         /* save old data */
         $_SESSION['old_data_register'] = ['name' => $name ? $name : '','email' => $email ? $email : ''];

         /* use helper validate user to validate name, email, password*/
         $validate_user = ValidateUser::validateRequiredFields($name,$email,$password);

         /* verify if user exists */
         $exists_email = UserModel::getUser('email',$email);
        
         if($exists_email){
            if(!isset($exists_email['error'])){
               $_SESSION['register_error']= ['Register'=>'The email already exists.'];
            }else{
               $_SESSION['register_error']= ['Register'=>'Something bad happend, please contact to support'];
            }
         }else{
            if(!$validate_user['error']){
               $name_file = 'avatar.png';
               if(is_dir('storage/images')){
                  if($picture['name']){
                     /* use helper validate image (validate size and type) */
                     $validate_image = ValidateUser::validateImage($picture);
                     if(!$validate_image['error']){
                        $name_file = $_FILES['register_image']['name'];
                        $tmp_name  = $_FILES['register_image']['tmp_name'];
                        move_uploaded_file($tmp_name,'storage/images/'.$name_file);
                     }else{
                        $_SESSION['register_error'] =  $validate_image['content'];
                     }
                  }
               }
               if(!isset($_SESSION['register_error']) && empty($_SESSION['register_error'])){
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
                     if(!empty($search_user) && !isset($search_user['error'])){
                        $_SESSION['user_logged'] = $search_user[0];
                        RedirectRoute::redirect('user/management');
                     }else{
                        $_SESSION['register_error']= ['Register'=>'Something bad happened, please contact to support.'];
                     }  
                  }else{
                     $_SESSION['register_error']= ['Register'=>'Something bad happened, please contact to support.'];
                  }
               }
            }else{
               $_SESSION['register_error'] =  $validate_user['content'];
            }
         }
      }
      if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error'])){
         RedirectRoute::redirect('user/register');
      }
   }

   /* show all users */
   public function management(){
      //delete search user if exists
      ResetSession::deleteSession('search');
      $all_users = UserModel::getUsers();
      //total records
      if(!isset($all_users['error'])){
         $records = ! empty($all_users) ? count($all_users) : 0;

         if($records > 0){
            // use helper paginate data (descending order)
            $paginate_data  = PaginateData::paginateDataDsc($records,10);
            $pages   = $paginate_data['pages'];
            $preview = $paginate_data['preview'];
            $next    = $paginate_data['next'];
            $users_paginate = UserModel::getUsers($paginate_data['limit'],$paginate_data['offset']);
            if(isset($users_paginate['error'])){
               $_SESSION['error_pagination'] = ['users'=>'Something bad happend. Please contact to support.'];
            }
         }else{
            $_SESSION['error_pagination'] = ['empty'=>'There aren\'t registered users.'];
         }
      }else{
         $_SESSION['error_pagination'] = ['users'=>'Something bad happend. Please contact to support.'];
      }
      include 'views/users/management.php';
   }

    /* User profile */
   public function profile(){
      if(isset($_GET['id'])){
         $profile_user = UserModel::getUser('id',$_GET['id']);
         if(isset($profile_user['error'])){
            $_SESSION['error_profile'] = ['profile' => 'Something bad happend, please contact to support.'];
         }
         include 'views/users/profile.php';
      }
   }

   /* Edit user */
   public function edit(){
      $id_user       = isset($_GET['id']) ? $_GET['id'] : false;
      $name          = isset($_POST['edit_name']) ? $_POST['edit_name'] : false;
      $email         = isset($_POST['edit_email']) ? $_POST['edit_email'] : false;
      $lastPassword  = isset($_POST['last_password']) ? $_POST['last_password'] : false;
      $newPassword   = isset($_POST['new_password']) ? $_POST['new_password'] : false;
      $capabilitie   = isset($_POST['edit_capabilitie']) ? $_POST['edit_capabilitie'] : false;
      $picture       = isset($_FILES['edit_image']) ? $_FILES['edit_image'] : false;
      
      $validate_user = ValidateUser::validateRequiredFields($name,$email);
      
      if(!$validate_user['error'] && $id_user){
         $user_edit = UserModel::getUser('id',$id_user);
         
         if(!empty($user_edit[0]) && !isset($user_edit['error'])){
            $user = new UserModel();
            $user->setUserName($name);
            $user->setEmail($email);
            $user->setCapabilities($capabilitie);

            $name_file = $user_edit[0]->image;

            if(is_dir('storage/images')){
               if($picture['name']){
                  $name_file = $_FILES['edit_image']['name'];
                  /* use helper validate image (validate size and type) */
                  $validate_image = ValidateUser::validateImage($picture);
                  if(!$validate_image['error']){
                     $tmp_name  = $_FILES['edit_image']['tmp_name'];
                     move_uploaded_file($tmp_name,'storage/images/'.$name_file);
                  }else{
                     $_SESSION['edit_error'] = $validate_image['content'];
                  }
               }
            }
            if(!isset( $_SESSION['edit_error'])){
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
               
               if(!isset( $_SESSION['edit_error'])){
                  $user->setPassword($password_hash);
                  $response = $user->updateUser($id_user);

                  if($response && is_object($response)){
                     $_SESSION['edit_success'] = ['error' => false, 'message' => '¡The user has been updated succesfully!'];
                  }
               }
            }
         }else{
            $_SESSION['edit_error'] = ['edit'=>'Something bad happend. please contact to support.'];
         }
      }else{
         $_SESSION['edit_error'] = $validate_user['content'];
      }
      RedirectRoute::redirect('user/profile&id='.$_GET['id']);
   }

   /** search users */
   public function search(){

      if(isset($_POST['search_user']) && $_POST['search_user'] != '' ){
         $_SESSION['search'] = [ 'pattern' => $_POST['search_user']];
      }

      if(isset($_SESSION['search'])){
         $users_result = UserModel::searchUserPattern($_SESSION['search']['pattern']);
         $records = $users_result ? count($users_result) : 0;
         if($records > 0){
            // use helper paginate data (descending order)
            $paginate_data  = PaginateData::paginateDataDsc($records,10);
            $pages   = $paginate_data['pages'];
            $preview = $paginate_data['preview'];
            $next    = $paginate_data['next'];
            $limit   = $paginate_data['limit'];
            $offset  = $paginate_data['offset'];
            $users_paginate = UserModel::searchUserPattern($_SESSION['search']['pattern'],$limit,$offset);
            if(isset($users_paginate['error'])){
               $_SESSION['error_pagination'] = ['search'=>'Something bad happend. Please contact to support.'];
            }
         }else{
            $_SESSION['error_pagination'] = ['search'=>'There isn\'t search result.'];
         }         
      }else{
         $_SESSION['error_pagination'] = ['search'=>'There isn\'t search result.'];
      }
      include 'views/users/management.php';
   }
}