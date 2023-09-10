<?php


class UserModel{

    private $user_name;
    private $email;
    private $password;
    private $image;
    private $capabilities;
    private $created_at;

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

    static public function getUsers(){
        $connection = Connection::connect();
        $sql = "SELECT * FROM users";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
    }

    public function saveUser(){

        try{

            $sql = 'INSERT INTO users (user_name,email,password,image,created_at) VALUES(:user_name,:email,:password,:image,CURDATE())';
            $connection = Connection::connect();
            $stmt = $connection->prepare($sql);
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
            return $er->getMessage();
        }
        return $stmt;
    }

}