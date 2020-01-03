<?php require '../../private/initialize.php'; ?>

<?php 
	if (isset($_POST['reset_password'])) {
		$errors = [];
		# sanitize input
		$old_password = trim(filter_input(INPUT_POST, 'old_password', FILTER_SANITIZE_STRING));
		$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
		$confirm_password = trim(filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING));

		#validate input
		if (is_blank($old_password)) {
			$errors['old_password_err'] = 'Please enter old password';
		}elseif (!has_length($old_password, ['min' => 5, 'max' => 20])) {
			$errors['old_password_err'] = 'Password minimum limit is 5 and max is 20 characters';
		}elseif (!password_verify($old_password, $user->password)) {
			$errors['old_password_err'] = 'Old password incorrect';
		}

		if (is_blank($confirm_password)) {
			$errors['confirm_password_err'] = 'Please confirm new password. It cannot be blank';
		}

		if (is_blank($password)) {
			$errors['password_err'] = 'Please enter new password';
		}elseif (!has_length($password, ['min' => 5, 'max' => 20])) {
			$errors['password_err'] = 'Password minimum limit is 5 and max is 20 characters';
		}elseif ($password !== $confirm_password) {
			$errors['password_err'] = 'Password is not a match';
		}

		if (empty($errors)) {
			#run an update query ti update user password
			$result = update_user($user->id, ['password' => $password]);
			if ($result === true) {
				setMsg('msg_notify', 'Your account has been successfully updated');
				unset($_SESSION['user']);
				redirect_to(url_for('/login.php'));
			}
		} else {
			setMsg('errors', $errors);
			redirect_to(url_for('/change_password.php'));
		}

	}




 ?>