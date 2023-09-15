<?php 
    $old_data= ['name'=> '','email'=> ''];
    if(isset($_SESSION['old_data_register'])):
        $old_data = $_SESSION['old_data_register'];
    endif;
?>

<?php $isLogged = CheckLoginStatus::isLoggedIn(); ?>
<?php if(!$isLogged): ?>
<div class="container-fluid">
    <div class=" container mt-5 py-5 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-auto">
        <form id="form-register" class="mt-5 mb-4" action="<?=url_base?>user/signup" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="register_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="register_name" name="register_name" value="<?=$old_data['name']?>">
            </div>
            <div class="mb-3">
                <label for="register_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="register_email" name="register_email" value="<?=$old_data['email']?>">
            </div>
            <div class="mb-3">
                <label for="register_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="register_password" name="register_password">
            </div>
            <div class="mb-3">
                <img src="<?=url_base?>storage/images/avatar.png" class="rounded img-fluid img-thumbnail preview" alt="avatar" width="100px">
                <label for="register_image" class="form-label align-bottom"><span class="btn btn-light"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                <input type="file" class="d-none" id="register_image" name="register_image">
            </div>
            <button id="submit-register" type="submit" class="btn btn-custom mb-4">Sign Up</button>
        </form>
    <div>
        <?php
        if(isset($_SESSION['register_error'])):
            DisplayError::displayErrors('register_error');
            ResetSession::deleteSession('register_error');
        endif;
        ?>
        </div>
    </div>
</div>
<?php else: ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="text-info container col-md-4 py-5">
        <strong>You are already registered...</strong>
    </div>
</div>
<?php endif; ?>