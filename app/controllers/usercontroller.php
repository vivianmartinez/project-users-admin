<?php



class UserController{

   public function management(){
      $users = UserModel::getUsers();
      include 'views/users/management.php';
   }

}