<?php require '../../private/initialize.php'; ?>
<?php 
	if (isset($_POST['request-activate-account'])) {
		$errors = [];
		// sanitize input
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		// validate input
		$user = findUserByEmail($email);
		if (!has_valid_email_format($email)) {
			$errors['email_err'] = 'Invalid email format';
		}elseif (!checkUserByEmail($email)) {
			$errors['email_err'] = 'Email not found';
		}elseif ($user !==false && $user->is_active =='1' ) {
			$errors['email_err'] = 'Account is activated';
		}


		if (empty($errors)) {
			$code = md5(crypt(rand(), 'aa'));
			$result = set_code($email, $code);
			if ($result === true) {
				setMsg('msg', 'Please check your email to verify your account', 'warning');
				$message = 'Hi, '.$email. ' you request an account verification. Click <a href="'.url_for('/process/p_account_verify.php?code='.$code).'">here</a> to verify it.';
				send_email([
					'to' => $email,
					'from' => 'support@cauth.com',
					'subject' => 'Account Activation',
					'msg' => $message
				]);
				redirect_to(url_for('/request_account_activate.php'));
			}
		} else {
			setMsg('errors', $errors);
			setMsg('form-data',['email' => $email]);
			redirect_to(url_for('/request_account_activate.php'));
		}
	}


 ?>