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
<li>Use the code found in project-users-admin/design-database-sql/sql-database.sql to create a simple database and an user with admin capabilities.</li>
<li>You have to create a php file in models/database directory and call it info-dbase.php, this will contain a class with its constructor, then define there the database connection information. Like this:
  
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


