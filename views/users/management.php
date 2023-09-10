    <?php
      if(isset($_SESSION['register_success'])){
        echo '<div class="alert alert-success">'.$_SESSION['register_success'].'</div>';
        print_r($_SESSION['user']);
      }
    ?>
    <div class="container" style="margin-top: 100px;">
      <h2>All users</h2>        
      <table class="table table-dark table-hover align-middle">
        <thead>
          <tr>
            <th>User</th>
            <th>User</th>
            <th>Email</th>
            <th>Capabilities</th>
            <th>Create Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>
          <tr>
            <td>
              <div>
                <img src="<?=url_base?>storage/images/<?=$user->image?>" class="rounded img-fluid img-thumbnail" 
                alt="<?=$user->image?>" width="50px">
              </div>
            </td>
            <td><?=$user->user_name   ?></td>
            <td><?=$user->email       ?></td>
            <td><?=$user->capabilities?></td>
            <td><?=$user->created_at  ?></td>
            <td>
              <a href="#" class="btn btn-info"><i class="fa-solid fa-user-pen white"></i></a>
              <a href="#" class="btn btn-danger"><i class="fa-solid fa-user-xmark white"></i></a>
            </td>
          </tr>
         <?php endforeach; ?>
        </tbody>
      </table>
    </div>
