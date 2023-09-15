<?php
	$old_data['email'] = '';
	if(isset($_SESSION['old_data_login'])):
		$old_data = $_SESSION['old_data_login'];
	endif;
	$isLogged = CheckLoginStatus::isLoggedIn();
?>

<?php if(!$isLogged): ?>
<div class="container-fluid mt-5 py-5 col-sm-12 col-md-5 col-lg-3 col-xl-3 h-auto">
	<form action="<?=url_base?>login/signin" method="POST" class="py-4 px-4 mb-4 bg-light mt-5">
		<div class="mb-3 mt-3">
			<label for="Email" class="form-label">Email:</label>
			<div class="input-group">
				<span class="input-group-text"><i class="fas fa-envelope"></i></span>
				<input type="email" class="form-control" id="Email" placeholder="Enter email" name="login_email" value="<?= $old_data['email']?>">
			</div>
		</div>
		<div class="mb-3">
			<label for="Password" class="form-label">Password:</label>
			<div class="input-password">
				<div class="input-group">
					<span class="input-group-text"><i class="fas fa-lock"></i></span>
					<input id="login_password" type="password" class="form-control" id="Password" placeholder="Enter password" name="login_password">
				</div>
				<div id="eye_password" class="eye-pword">
					<i class="fa-regular fa-eye-slash"></i>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-custom mb-3">Sign In</button>
	</form>
	<?php if(isset($_SESSION['login_error'])):
		DisplayError::displayErrors('login_error');
		ResetSession::deleteSession('login_error');
	endif;?>
</div>
<?php else: ?>
<div class="container-fluid" style="height: 100vh;">
    <div class="text-info container col-md-4 py-5">
		<strong>You are already logged...</strong>
	</div>
</div>
<?php endif; ?>




