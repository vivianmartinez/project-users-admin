<?php $isLogged = CheckLoginStatus::isLoggedIn(); ?>
<?php if(!$isLogged): ?>
<div class="container-fluid mt-5 py-5 mb-5" style="height: 100vh;">
    <div class="container py-5 col-4">
        <form action="<?=url_base?>user/signup" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="register_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="register_name" name="register_name">
            </div>
            <div class="mb-3">
                <label for="register_email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="register_email" name="register_email">
            </div>
            <div class="mb-3">
                <label for="register_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="register_password" name="register_password">
            </div>
            <div class="mb-3">
                <img src="<?=url_base?>storage/images/avatar.png" class="rounded img-fluid img-thumbnail" alt="avatar" width="100px">
                <label for="register_image" class="form-label align-bottom"><span class="btn btn-light"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                <input type="file" class="d-none" id="register_image" name="register_image">
            </div>
            <button type="submit" class="btn btn-custom">Sign Up</button>
        </form>
    </div>
    <?php
    if(isset($_SESSION['register_error'])):
        DisplayError::displayErrors('register_error');
        ResetSession::deleteSession('register_error');
    endif;
    ?>
</div>
<?php else: ?>
    <div class="text-info d-flex justify-content-center align-items-center" style="height: 600px;">
        <strong>You are already registered...</strong>
    </div>
<?php endif; ?>