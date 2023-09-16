<?php
  $registered = false;
  if(isset($_SESSION['register_success']) && !$_SESSION['register_success']['error'] ){
    $registered = true;
    $message = $_SESSION['register_success']['message'];
    ResetSession::deleteSession('register_success');
  }
  $logged_in = CheckLoginStatus::isLoggedIn();
  if($logged_in):
    $is_admin = CheckCapabilities::isAdmin();
?>
<div class="container mb-5 py-5 h-auto content">
  <?php if($registered): ?>
    <div class="alert alert-success"><?=$message?></div>
  <?php endif; ?>
  <h2>All users</h2>        
  <table class="table table-dark table-hover align-middle overflow-scroll">
    <thead>
      <tr>
        <th id="table-header-pc"></th>
        <th id="table-header-nm">User name</th>
        <th id="table-header-em">Email</th>
        <th id="table-header-cp">Capabilities</th>
        <th id="table-header-cd">Create Date</th>
        <th id="table-header-st">Settings</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $user): ?>
      <tr class="table-row-<?=$user->id?>">
        <td class="table-value-pc">
          <div>
            <img src="<?=url_base?>storage/images/<?=$user->image?>" class="rounded img-fluid img-thumbnail" 
            alt="<?=$user->image?>" width="50px">
          </div>
        </td>
        <td class="table-value-nm"><?=$user->user_name   ?></td>
        <td class="table-value-em"><?=$user->email       ?></td>
        <td class="table-value-cp"><?=$user->capabilities?></td>
        <td class="table-value-cd"><?=$user->created_at  ?></td>
        <td class="table-value-st">
          <div class="btn-group">
            <a href="<?=url_base?>user/profile&id=<?=$user->id?>" <?= $is_admin || $_SESSION['user_logged']->id == $user->id ? 'class="btn btn-info"' : 'class="btn btn-secondary disabled"' ?>>
              <i class="fa-solid fa-user-pen white"></i>
            </a>
            <?php if($is_admin): ?>
            <input class="user-id" type="hidden" name="delete" value="<?=$user->id?>">
            <button class="btn btn-danger delete-user"><i class="fa-solid fa-user-xmark white"></i></button>
            <?php endif; ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php 
else: 
  RedirectRoute::redirect('login');
endif; ?>
