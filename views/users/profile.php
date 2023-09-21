<?php
    $loggedIn = CheckLoginStatus::isLoggedIn();
    $is_admin = CheckCapabilities::isAdmin();
    if(!$loggedIn):
        // if is not logged in
        RedirectRoute::redirect('login');
        // if not exists id user
    elseif(isset($_SESSION['error_profile'])): ?>
        <div class="container-fluid" style="height: 100vh;">
            <div class=" text-danger container col-md-4 py-5">
    <?php
            DisplayError::displayErrors('error_profile');
            ResetSession::deleteSession('error_profile');
    ?>
            </div>
        </div>
<?php elseif(!isset($profile_user) || empty($profile_user)): ?>
    <div class="container-fluid" style="height: 100vh;">
        <div class=" text-danger container col-md-4 py-5">
            <div class="mb-4"><strong>Error: The user doesn't exist... Make sure the Id is correct.</strong></div>
            <a href="<?=url_base?>user/profile&id=<?=$_SESSION['user_logged']->id?>" class="btn btn-warning">Back</a>
        </div>
    </div>
<?php elseif($_SESSION['user_logged']->id != $_GET['id'] && !$is_admin ): ?>
    <div class="container-fluid" style="height: 100vh;">
        <div class="d-block text-danger container col-md-4 py-5">
            <div class="mb-4"><strong>Error: This action is not allowed. You only can edit your user profile.</strong></div>
            <a href="<?=url_base?>user/profile&id=<?=$_SESSION['user_logged']->id?>" class="btn btn-warning">Back</a>
        </div>
    </div>
<?php else: ?>
    <div class="container-fluid h-auto mt-5 pt-3">
        <div class="container py-5 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="min-height: 100vh;">
            <form id="form-profile" class="mt-5 mb-4" action="<?=url_base?>user/edit&id=<?=$profile_user[0]->id?>" method="POST" enctype="multipart/form-data">
                <div class="d-md-flex">
                    <div class="d-block text-center me-4">
                        <img src="<?=url_base?>storage/images/<?=$profile_user[0]->image?>" class="rounded-circle mb-2 preview" alt="avatar" width="180px">
                        <div class="small text-muted">JPG, JPEG or PNG</div>
                        <div class="small text-muted">No longer than 1MG</div>
                        <label for="profile_image" class="form-label align-bottom"><span class="btn btn-light mt-3"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                        <input type="file" class="d-none" id="profile_image" name="edit_image">
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
                        <?php if($is_admin):?>
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
                            <?php if($is_admin): ?>
                            <label class="form-label">¿Do you want to reset the password?</label>
                            <?php else: ?>
                            <label class="form-label">¿Do you want to change the password?</label>
                            <?php endif; ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="change_password" id="flexRadio1" value="yes">
                                <label class="form-check-label" for="flexRadio1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="change_password" id="flexRadio2" checked value="no">
                                <label class="form-check-label" for="flexRadio2">No</label>
                            </div>
                        </div>
                        <?php if(! $is_admin): ?>
                        <div class="input-password"> 
                            <div class="mb-3">
                                <label for="last_password" class="form-label">Last Password</label>
                                <input type="password" class="form-control" id="last_password" name="last_password" disabled required>
                            </div>
                            <div id="eye-last-password" class="eye-password eye-top disabled-eye">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div> 
                        </div>
                        <?php endif; ?>
                        <div class="input-password">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" disabled required>
                            </div>
                            <div id="eye-new-password" class="eye-password eye-top disabled-eye">
                                <i class="fa-regular fa-eye-slash"></i>
                            </div>
                        </div>
                        <button id="submit-profile" type="submit" class="btn btn-custom mb-4">Update Profile</button>
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

