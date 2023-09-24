# Project users admin

This is a simple CRUD project made implementing MVC pattern. This allows you:

<ul>
<li>Login user</li>
<li>Sign up user</li>
<li>List all users</li>
<li>Search for users by name or email</li>
<li>View user profiles</li>
<li>Update users</li>
<li>Delete users</li>
</ul>

### Specifications

<ul>
<li>Use the code found in <strong>project-users-admin/design-database-sql/sql-database.sql</strong> to create a simple database and an user with admin capabilities (password: "administrador").</li>
<li>Create a php file in <strong>models/database</strong> directory and call it <strong>info-dbase.php</strong>, this will contain a class with its constructor, then define there the database connection information. Like this:
  
                <?php
                  class InfoDbase{
                      public $infoDB;
                      public function __construct()
                      {
                          $this->infoDB = array(
                              "host"      => "name_host",
                              "dbname"    => "admin_users", // or the name you choose
                              "dbuser"    => "name_user",
                              "dbpassword"=> "your_password"
                          );
                      }
                  }
                ?>
                
</li>
</ul>


