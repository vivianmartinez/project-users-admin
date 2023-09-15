<?php

require_once 'app/helpers/validate-user.php';

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
            $_SESSION['register_error']= ['Register'=>'The email already exists.'];
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
                     if(!empty($search_user)){
                        $_SESSION['user_logged'] = $search_user[0];
                        RedirectRoute::redirect('user/management');
                     }  
                  }else{
                     $_SESSION['register_error']= ['Register'=>'Something bad happened, try again please.'];
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
      $users = UserModel::getUsers();
      include 'views/users/management.php';
   }

    /* User profile */
   public function profile(){
      if(isset($_GET['id'])){
         $profile_user = UserModel::getUser('id',$_GET['id']);
         include 'views/users/profile.php';
      }
   }

   /* Edit user */
   public function edit(){
      $id_user  = isset($_GET['id']) ? $_GET['id'] : false;
      $name     = isset($_POST['edit_name']) ? $_POST['edit_name'] : false;
      $email    = isset($_POST['edit_email']) ? $_POST['edit_email'] : false;
      $lastPassword = isset($_POST['last_password']) ? $_POST['last_password'] : false;
      $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : false;
      $capabilitie  = isset($_POST['edit_capabilitie']) ? $_POST['edit_capabilitie'] : false;
      $picture  = isset($_FILES['edit_image']) ? $_FILES['edit_image'] : false;
      
      $validate_user = ValidateUser::validateRequiredFields($name,$email);
      
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
         }
      }else{
         $_SESSION['edit_error'] = $validate_user['content'];
      }
      RedirectRoute::redirect('user/profile&id='.$_GET['id']);
   }

    /* Delete user */

    public function delete(){
      if(isset($_POST['delete'])){
         print_r($_POST['delete']);
      }
    }

}