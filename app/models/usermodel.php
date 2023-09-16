<?php

require_once ('database/connection.php');

class UserModel{

    private $user_name;
    private $email;
    private $password;
    private $image;
    private $capabilities;
    private $created_at;
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connect();
    }

    /**
        * Get the value of user_name
        */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
        * Set the value of user_name
        */
    public function setUserName($user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
        * Get the value of email
        */
    public function getEmail()
    {
        return $this->email;
    }

    /**
        * Set the value of email
        */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
        * Get the value of password
        */
    public function getPassword()
    {
        return $this->password;
    }

    /**
        * Set the value of password
        */
    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
        * Get the value of capabilities
        */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
        * Set the value of capabilities
        */
    public function setCapabilities($capabilities): self
    {
        $this->capabilities = $capabilities;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
    /** Get single user */
    static public function getUser($column,$value){
        try{
            $connectDb = new self();
            $sql = "SELECT *, DATE_FORMAT(created_at,'%d/%m/%Y') AS created_at FROM users WHERE $column = :$column";
            $stmt = $connectDb->connection->prepare($sql);
            if(is_int($value)){
                $stmt->bindParam(':'.$column,$value,PDO::PARAM_INT);
            }else{
                $stmt->bindParam(':'.$column,$value,PDO::PARAM_STR);
            }
            $stmt->execute();
            $response = $stmt->fetchAll(PDO::FETCH_CLASS);
        }catch(Exception $er){
            return ['error' => true, 'message' => $er->getMessage()];
        }
        
        $stmt = null;
        return $response;
    }
    /** Get all users */
    static public function getUsers(){
        $connectDb = new self();
        $sql = "SELECT *, DATE_FORMAT(created_at,'%d/%m/%Y') AS created_at FROM users ORDER BY id DESC";
        $stmt = $connectDb->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        
        $stmt = null;
    }
    /** Save user */
    public function saveUser(){
        try{
            $sql = 'INSERT INTO users (user_name,email,password,image) VALUES(:user_name,:email,:password,:image)';
            $stmt = $this->connection->prepare($sql);
            $param_name   = $this->getUserName();
            $param_email  = $this->getEmail();
            $param_psword = $this->getPassword();
            $param_img    = $this->getImage();
            $stmt->bindParam(':user_name',$param_name,PDO::PARAM_STR);
            $stmt->bindParam(':email',$param_email,PDO::PARAM_STR);
            $stmt->bindParam(':password',$param_psword,PDO::PARAM_STR);
            $stmt->bindParam(':image',$param_img,PDO::PARAM_STR);
            $stmt->execute();

        }catch(exception $er){
            return ['error' => true, 'message' => $er->getMessage()];
        }
        return $stmt;
        
        $stmt = null;
    }
    /** Update user */
    public function updateUser($id){
        try{
            $add_sql = '';
            if($this->getCapabilities() =='subscriber' || $this->getCapabilities() == 'admin' ){
                $add_sql = ',capabilities = :capabilities';
            }
            $sql = "UPDATE users SET user_name = :user_name, email = :email, image = :image, password = :password {$add_sql} WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $param_name   = $this->getUserName();
            $param_email  = $this->getEmail();
            $param_psword = $this->getPassword();
            $param_img    = $this->getImage(); 
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':user_name',$param_name,PDO::PARAM_STR);
            $stmt->bindParam(':email',$param_email,PDO::PARAM_STR);
            $stmt->bindParam(':password',$param_psword,PDO::PARAM_STR);
            $stmt->bindParam(':image',$param_img,PDO::PARAM_STR);
            if($add_sql != ''){
                $param_cap = $this->getCapabilities();
                $stmt->bindParam(':capabilities',$param_cap,PDO::PARAM_STR);
            }
            $stmt->execute();
        }catch(exception $er){
            return ['error' => true, 'message' => $er->getMessage()];
        }
        return $stmt;
        $stmt = null;
    }

    /** Delete user */
    static public function deleteUser($id){
        try{     
            $connectDb = new self();     
            $sql = 'DELETE FROM users WHERE id = :id';
            $stmt = $connectDb->connection->prepare($sql);
            $stmt->bindParam("id",$id,PDO::PARAM_INT);
            $stmt->execute();

        }catch(Exception $er){
            return ['error' => true, 'message' => $er->getMessage()];
        }

    }
}