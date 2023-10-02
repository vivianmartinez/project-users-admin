<?php
  $action = 'management';
  if(isset($_GET['method']) == 'search' && isset($_SESSION['search'])):
    $action = 'search';
  endif;
  $registered = false;
  $error_pages = false;
  print_r($error_pages);
  if(isset($_SESSION['register_success']) && !$_SESSION['register_success']['error'] ):
    //if user has recently registered show message 
    $registered = true;
    $message = $_SESSION['register_success']['message'];
    ResetSession::deleteSession('register_success');
  endif;
  $loggedIn = CheckLoginStatus::isLoggedIn();
  if($loggedIn):
    $is_admin = CheckCapabilities::isAdmin();
?>
<div class="container mb-5 h-auto content">
  <?php if($registered): ?>
    <div class="alert alert-success"><?=$message?></div>
  <?php endif; ?>
  <h2 class="mt-5">Users</h2>
  <?php if(isset($_SESSION['error_pagination'])):
    // if there is an empty search result error or no users don´t show users table
    if(isset($_SESSION['error_pagination']['empty']) || isset($_SESSION['error_pagination']['search']) 
        || isset($_SESSION['error_pagination']['users'])):
      $error_pages = true;
    endif;
    DisplayError::displayErrors('error_pagination'); // display errors
    ResetSession::deleteSession('error_pagination'); // delete errors session
  endif;?>
  <?php if(isset($error_pages) && !$error_pages):?>
  <table class="table table-dark table-hover align-middle overflow-scroll mb-4">
    <thead>
      <tr>
        <th id="table-header-pc"></th>
        <th id="table-header-nm">User name</th>
        <th id="table-header-em">Email</th>
        <th id="table-header-cp">Capabilities</th>
        <th id="table-header-cd">Date update</th>
        <th id="table-header-st">Settings</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users_paginate as $user): ?>
      <tr class="table-row-<?=$user->id?>">
        <td class="table-value-pc">
          <div>
            <img 
            src="<?=url_base?>storage/images/<?= !file_exists('storage/images/'.$user->image) || $user->image == ''? 'avatar.png' :$user->image?>" class="rounded img-fluid img-thumbnail" 
            alt="<?=$user->image != '' ? $user->image : 'avatar.png' ?>" width="50px">
          </div>
        </td>
        <td class="table-value-nm"><?=$user->user_name   ?></td>
        <td class="table-value-em"><?=$user->email       ?></td>
        <td class="table-value-cp"><?=$user->capabilities?></td>
        <td class="table-value-cd"><?=$user->created     ?></td>
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
  <div class="d-flex align-items-center justify-content-md-end col-sm-12">
    <div class="me-3 fw-bold">Total Records: <?=$records?></div>
    <div class="me-3 fw-bold">Total Pages: <?=$pages?></div>
    <div class="me-3 fw-bold">Page: <?=isset($_GET['page']) ? $_GET['page'] : 1?></div>
    <div>
      <a id="preview" href="<?=url_base?>user/<?=$action?>&page=1" class="btn btn-secondary me-2" data-bs-toggle="tooltip" title="first"><</a>
      <a id="preview" href="<?=url_base?>user/<?=$action?>&page=<?=$preview?>" class="btn btn-secondary me-2" data-bs-toggle="tooltip" title="preview"><<</a>
      <a id="next" href="<?=url_base?>user/<?=$action?>&page=<?=$next?>" class="btn btn-secondary me-2" data-bs-toggle="tooltip" title="next">>></a>
      <a id="next" href="<?=url_base?>user/<?=$action?>&page=<?=$pages?>" class="btn btn-secondary me-2" data-bs-toggle="tooltip" title="last">></a>
    </div>
  </div>
<?php endif; ?>
</div>

<?php 
else: 
  RedirectRoute::redirect('login');
endif; ?>
