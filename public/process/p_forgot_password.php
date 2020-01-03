<?php require '../../private/initialize.php'; ?>
<?php 
	if (isset($_POST['reset-password'])) {
		$errors = [];
		// print_r($_POST);exit;
		#sanitize input
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		// validate(blank, valid format, exists)
		if (is_blank($email)) {
			$errors['email_err'] = 'Please enter email';
		} elseif (!has_valid_email_format($email)) {
			$errors['email_err'] = 'Invalid email format';
		} elseif (checkUserByEmail($email) == 0) {
			$errors['email_err'] = "Email not found";
		}

		if (empty($errors)) {
			# generate reset code
			$code = md5(crypt(rand(),'aa'));
			#set reset code for user
			$result = reset_user_code($email, $code);
			if ($result === true) {
				setMsg('msg', 'Check your email for the password reset link', 'warning');
				$message = 'Hi '.$email.', \n\nYou requested for a password reset. Click <a href="'.url_for('/process/p_reset_code_verify.php?reset-code='.$code).'"> here to reset password</a>.';
				send_email([
			 			'to' => $email,
			 			'from' => 'info@cauth.com',
			 			'subject' => 'Password Reset',
			 			'msg' => $message
			 		]);
			}
		} else {
			setMsg('errors', $errors);
			setMsg('form-data', ['email' => $email]);
			redirect_to(url_for('/forgot_password.php'));
		}
		redirect_to(url_for('/forgot_password.php'));
	}

 ?>