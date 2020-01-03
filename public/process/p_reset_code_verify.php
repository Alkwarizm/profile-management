<?php require '../../private/initialize.php'; ?>
<?php 
	if (isset($_GET['reset-code'])) {
		$errors = [];
		#sanitize
		$reset_code = trim(filter_input(INPUT_GET, 'reset-code', FILTER_SANITIZE_STRING));
		#validate
		#@todo redirect to 404 page for invalid requests
		if (is_blank($reset_code)) {
			$errors['reset_err'] = 'No reset code';
		} elseif (!checkUserByCode($reset_code)) {
			$errors['reset_err'] = 'Invalide reset code';
		}

		if (empty($errors)) {
			$_SESSION['reset-code'] = $reset_code;
			redirect_to(url_for('/reset_password.php'));
		} else {
			setMsg('msg_notify', 'Invalid Reset Code', 'danger');
		}

	}


 ?>