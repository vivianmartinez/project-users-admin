<?php 
	if(isset($_SESSION['login_data'])):
		$login_data = $_SESSION['login_data'];
	endif;
	$isLogged = CheckLoginStatus::isLoggedIn();
?>
<div class="d-flex justify-content-center align-items-center" style="height: 600px;">
<?php if(!$isLogged): ?>
	<form action="<?=url_base?>login/signin" method="POST" class="p-5 bg-light">
		<div class="mb-3 mt-3">
			<label for="Email" class="form-label">Email:</label>
			<div class="input-group">
				<span class="input-group-text"><i class="fas fa-envelope"></i></span>
				<input type="email" class="form-control" id="Email" placeholder="Enter email" name="login_email" value="<?= isset($login_data) ? $login_data['email'] : '';?>">

			</div>
		</div>
		<div class="mb-3">
			<label for="Password" class="form-label">Password:</label>
			<div class="input-group">
				<span class="input-group-text"><i class="fas fa-lock"></i></span>
				<input type="password" class="form-control" id="Password" placeholder="Enter password" name="login_password">
			</div>
		</div>
		<button type="submit" class="btn btn-custom">Sign In</button>
	</form>
<?php else: ?>
	<div class="text-info"><strong>You are already logged...</strong></div>
<?php endif; ?>
</div>
<?php if(isset($_SESSION['login_error'])):
	DisplayError::displayErrors('login_error');
	ResetSession::deleteSession('login_error');
endif;?>
