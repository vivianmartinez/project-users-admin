<?php

require_once '../models/usermodel.php';

class UserAjax{

    public $id_user;

    public function deleteUser(){
        $id = $this->id_user;
        //search user - if exists delete
        $search = UserModel::getUser('id',$id);
        if(count($search) > 0 && !empty($search[0])){
            $delete_user = UserModel::deleteUser($search[0]->id);
            if($delete_user){
                $response = ['error'=>false,'deleted'=> $delete_user];
            }else{
                $response = ['error' => true];
            }  
        }else{
            $response = ['error' => true];
        }
        echo json_encode($response);
    }
}
/** data delete user */
if(isset($_POST['id_user_delete'])){
    $delete = new UserAjax();
    $delete->id_user = $_POST['id_user_delete'];
    $delete->deleteUser();
}