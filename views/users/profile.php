<?php
    if(!isset($profile_user) || empty($profile_user)):     
?>
<div class="container-fluid" style="height: 100vh;">
    <div class=" text-danger container col-md-4 py-5">
        <strong>Error: The user doesn't exist... Make sure the Id is correct.</strong>
    </div>
</div>
<?php elseif($_SESSION['user_logged']->id != $_GET['id'] && $_SESSION['user_logged']->capabilities != 'admin' ): ?>
<div class="container-fluid" style="height: 100vh;">
    <div class=" text-danger container col-md-4 py-5">
        <strong>Error: This action is not allowed. You only can edit your user profile.</strong>
    </div>
</div>
<?php else: ?>
<div class="container-fluid h-auto">
    <div class="container py-5 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="min-height: 100vh;">
        <form class="mt-5 mb-4" action="<?=url_base?>user/edit&id=<?=$profile_user[0]->id?>" method="POST" enctype="multipart/form-data">
            <div class="d-md-flex">
                <div class="d-block pt-4 text-center">
                    <img src="<?=url_base?>storage/images/<?=$profile_user[0]->image?>" class="rounded-circle" alt="avatar" width="180px">
                    <label for="edit_image" class="form-label align-bottom"><span class="btn btn-light mt-3"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                    <input type="file" class="d-none" id="edit_image" name="edit_image">
                </div>
                <div class="container">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" value="<?= $profile_user[0]->user_name?>"> 
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email" value="<?= $profile_user[0]->email?>">
                    </div>
                    <?php if($_SESSION['user_logged']->capabilities == 'admin'):?>
                    <div class="mb-3">
                        <label for="edit_capabilitie" class="form-label">Capabilities</label>
                        <select name="edit_capabilitie" class="form-select">
                            <option value="admin" <?php echo $profile_user[0]->capabilities == 'admin' ? 'selected':''; ?>>
                            Admin</option>
                            <option value="subscriber" <?php echo $profile_user[0]->capabilities == 'subscriber' ? 'selected':''; ?>>
                            Subscriber</option>
                        </select>
                    </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label class="form-label">¿Do you want to change the password?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="change_password" id="flexRadio1" value="true">
                            <label class="form-check-label" for="flexRadio1">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="change_password" id="flexRadio2" checked value="false">
                            <label class="form-check-label" for="flexRadio2">No</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="last_password" class="form-label">Last Password</label>
                        <input type="password" class="form-control" id="last_password" name="last_password" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" disabled>
                    </div>
                    <button type="submit" class="btn btn-custom mb-4">Update Profile</button>
                    <?php
                        if(isset($_SESSION['edit_error'])):
                            DisplayError::displayErrors('edit_error');
                            ResetSession::deleteSession('edit_error');
                        endif;
                    ?>
                    <?php if(isset($_SESSION['edit_success']) && ! $_SESSION['edit_success']['error'] ): ?>
                        <div class="alert alert-success"><?=$_SESSION['edit_success']['message']?></div>
                    <?php 
                        ResetSession::deleteSession('edit_success');
                        endif; 
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

