<?php



class UserModel{

    private $user_name;
    private $email;
    private $password;
    private $capabilities;

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

    static public function getUsers(){
        $connection = Connection::connect();
        $sql = "SELECT * FROM users";
        $stmt = $connection->prepare($sql);
        var_dump($stmt->execute());
    }
}