<?php

require_once '../models/usermodel.php';


class UserAjax{

    public $id_user;

    public function deleteUser(){
        $id = $this->id_user;
        $response = UserModel::getUser('id',$id);
        echo json_encode($response);
    }
}

if(isset($_POST['id_user_delete'])){
    $delete = new UserAjax();
    $delete->id_user = $_POST['id_user_delete'];
    $delete->deleteUser();
}