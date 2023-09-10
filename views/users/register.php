
<div class="container-fluid mt-5 py-5 mb-5" style="height: 100vh;">

    <div class="container py-5 col-4">
        <form action="<?=url_base?>user/save" method="POST" enctype="multipart/form-data">
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
            <button type="submit" class="btn btn-custom">Submit</button>
        </form>
    </div>
    <?php
    if(isset($_SESSION['error'])): ?>
    <div class="container col-4">
    <?php foreach($_SESSION['error'] as $error => $message): ?>
            <div class="alert alert-danger"><strong>¡Error <?=$error?>!</strong> <?=$message?></div>
    <?php endforeach; ?>
    </div>
    <?php
        ResetSession::deleteSession('error');
    endif;
    ?>
</div>
