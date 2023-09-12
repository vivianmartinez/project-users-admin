<?php 
	if(isset($_SESSION['login_data'])):
		$login_data = $_SESSION['login_data'];
	endif;
	$isLogged = CheckLoginStatus::isLoggedIn();
?>

<div class="container-fluid mt-5 py-5 col-sm-12 col-md-5 col-lg-3 col-xl-3">
<?php if(!$isLogged): ?>
	<form action="<?=url_base?>login/signin" method="POST" class="py-4 px-4 mb-4 bg-light">
		<div class="mb-3 mt-3">
			<label for="Email" class="form-label">Email:</label>
			<div class="input-group">
				<span class="input-group-text"><i class="fas fa-envelope"></i></span>
				<input type="email" class="form-control" id="Email" placeholder="Enter email" name="login_email" value="<?= isset($login_data) ? $login_data['email'] : '';?>">

			</div>
		</div>
		<div class="mb-3">
			<label for="Password" class="form-label">Password:</label>
			<div class="input-password">
				<div class="input-group">
					<span class="input-group-text"><i class="fas fa-lock"></i></span>
					<input type="password" class="form-control" id="Password" placeholder="Enter password" name="login_password">
				</div>
					<i id="eye_password" class="fa-regular fa-eye-slash eye-pword"></i>
					<!--<i class="fa-regular fa-eye"></i> replace with js-->
			</div>
		</div>
		<button type="submit" class="btn btn-custom mb-3">Sign In</button>
	</form>
<?php else: ?>
	<div class="text-info"><strong>You are already logged...</strong></div>
<?php endif; ?>

<?php if(isset($_SESSION['login_error'])):
	DisplayError::displayErrors('login_error');
	ResetSession::deleteSession('login_error');
endif;?>
</div>


