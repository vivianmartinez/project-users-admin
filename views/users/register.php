<?php 
    $old_data= ['name'=> '','email'=> ''];
    if(isset($_SESSION['old_data_register'])):
        $old_data = $_SESSION['old_data_register'];
    endif;
?>

<?php $isLogged = CheckLoginStatus::isLoggedIn(); ?>
<?php if(!$isLogged): ?>
<div class="container-fluid">
    <div class=" container mt-5 py-5 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-auto content">
        <form id="form-register" class="mt-5 mb-4" action="<?=url_base?>user/signup" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="register_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="register_name" name="register_name" value="<?=$old_data['name']?>" required>
            </div>
            <div class="mb-3">
                <label for="register_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="register_email" name="register_email" value="<?=$old_data['email']?>" required>
            </div>
            <div class="input-password">
                <div class="mb-3">
                    <label for="register_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="register_password" name="register_password" required>
                </div>
                <div class="eye-password eye-top">
					<i class="fa-regular fa-eye-slash"></i>
				</div>
            </div>
            <div class="mb-3 d-flex align-items-center">
                <img src="<?=url_base?>storage/images/avatar.png" class="rounded img-fluid img-thumbnail preview me-3" alt="avatar" width="100px">
                <div class="text-center">
                    <div class="small text-muted pt-3">JPG, JPEG or PNG</div>
                    <div class="small text-muted mb-2">No longer than 1MG</div>
                    <label for="register_image" class="form-label align-bottom"><span class="btn btn-light"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                    <input type="file" class="d-none" id="register_image" name="register_image">                   
                </div>
            </div>
            <button id="submit-register" type="submit" class="btn btn-custom mb-4">Sign Up</button>
        </form>
        <?php
        if(isset($_SESSION['register_error'])):
            DisplayError::displayErrors('register_error');
            ResetSession::deleteSession('register_error');
        endif;
        ?>
    </div>
</div>
<?php else: ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="text-info container col-md-4 py-5">
        <strong>You are already registered...</strong>
    </div>
</div>
<?php endif; ?>