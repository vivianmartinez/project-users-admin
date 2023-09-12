<?php 
    if(isset($profile_user)):
        print_r($profile_user);
?>
<div class="container-fluid">
    <div class=" container mt-5 py-5 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="height: 100vh;">
        <div class="d-flex">
            <div class="d-block pt-4 text-center">
                <img src="<?=url_base?>storage/images/<?=$profile_user[0]->image?>" class="rounded-circle" alt="avatar" width="180px">
                <label for="update_image" class="form-label align-bottom"><span class="btn btn-light mt-3"><i class="fa-solid fa-upload"></i> Upload image</span></label>
                <input type="file" class="d-none" id="update_image" name="update_image">
            </div>
            <div class="container">
                <form class="mt-5 mb-4" action="<?=url_base?>user/signup" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="update_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="update_name" name="update_name" value="<?= $profile_user[0]->user_name?>"> 
                </div>
                <div class="mb-3">
                    <label for="update_email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="update_email" name="update_email" value="<?= $profile_user[0]->email?>">
                </div>
                <div class="mb-3">
                    <label for="update_lpassword" class="form-label">Last Password</label>
                    <input type="password" class="form-control" id="update_lpassword" name="update_lpassword">
                </div>
                <div class="mb-3">
                    <label for="update_npassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="update_npassword" name="update_npassword">
                </div>
                <button type="submit" class="btn btn-custom">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>