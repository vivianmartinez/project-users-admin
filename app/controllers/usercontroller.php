<?php



class UserController{

   public function management(){
      include 'views/users/management.php';
      UserModel::getUsers();
   }

}