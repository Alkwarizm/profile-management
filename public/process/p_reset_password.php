<?php require '../../private/initialize.php'; ?>
<?php 
	if (isset($_POST['reset_password'])) {
		$errors = [];
		#sanitize data
		$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
		$confirm_password = trim(filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING));
		$code = $_SESSION['reset-code'];
		#validate
		if (!has_length($password, ['min' => 5, 'max'=>20])) {
			$errors['password_err'] = 'Password minimum limit is 5 and maximum is 20 characters';
		} elseif ($password != $confirm_password) {
			$errors['conf_password_err'] = 'Password is not a match';
		}

		if (empty($errors)) {
			#change password
			$result = reset_password($code, $password);
			if ($result === true) {
				setMsg('msg_notify', 'Password changed successfully. You can login with new password');
				unset($_SESSION['reset-code']);
				redirect_to(url_for('/login.php'));
			}
		} else {
			setMsg('errors', $errors);
			setMsg('form-data', ['password'=>$password]);
			redirect_to(url_for('/reset_password.php'));
		}
	}


 ?>