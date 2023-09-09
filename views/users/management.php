    <div class="container" style="margin-top: 100px;">
      <h2>All users</h2>        
      <table class="table table-dark table-hover">
        <thead>
          <tr>
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
            <td><?=$user->nombre  ?></td>
            <td><?=$user->correo  ?></td>
            <td><?=$user->permisos?></td>
            <td><?=$user->fecha   ?></td>
            <td>
              <a href="#" class="btn btn-info"><i class="fa-solid fa-user-pen"></i></a>
              <a href="#" class="btn btn-danger"><i class="fa-solid fa-user-xmark"></i></a>
            </td>
          </tr>
         <?php endforeach; ?>
        </tbody>
      </table>
    </div>
