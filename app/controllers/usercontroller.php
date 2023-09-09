<?php



class UserController{

   public function register(){
      include 'views/users/register.php';
   }

   public function management(){
      $users = UserModel::getUsers();
      include 'views/users/management.php';
   }

}