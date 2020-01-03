<?php require '../../private/initialize.php'; ?>
<?php 

	$errors = [];
	$user = [];
	if (is_post_request()) {
		if (isset($_POST['register'])) {
		//sanitize inputs
			$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
			$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
			$website = trim(filter_input(INPUT_POST, 'website', FILTER_SANITIZE_STRING));
			$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
			$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
			$confirm_password = trim(filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING));
			// checkUserByUsername($username);exit();
		//perform validation
			if (is_blank($name)) {
				$errors['name_err'] = 'Name cannot be blank';
			} elseif (!has_length($name, ['min' => 6, 'max' => 50])) {
				$errors['name_err'] = 'Name minimum limit is 6 and max is 50 characters';
			}
			if (!has_length($username, ['min' => 5, 'max' => 15])) {
			 	$errors['username_err'] = 'Username minimun limit is 5 and max is 15 characters';
			 } elseif (!has_unique_username($username)) {
			 	$errors['username_err'] = 'Username already exists';
			 }

			 if (!has_valid_email_format($email)) {
			 	$errors['email_err'] = 'Invalid email format';
			 } elseif (!has_unique_email($email)) {
			 	$errors['email_err'] = 'Email already exists';
			 }
			 // @todo valid website format
			 if (is_blank($website)) {
			 	$errors['website_err'] = 'Website cannot be blank';
			 }

			 if (!has_length($password, ['min' => 5, 'max' => 20])) {
			 	$errors['password_err'] = 'Password minimum limit is 5 and max is 20 characters';
			 } elseif ($password != $confirm_password) {
			 	$errors['password_err'] = 'Password does not match';
			 }
			 if (empty($errors)) {
			 	$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			 	$code = md5(crypt(rand(), 'aa'));
			 	// run insert query
			 	$user['name'] = $name;
			 	$user['username'] = $username;
			 	$user['email'] = $email;
			 	$user['password'] = $hashed_password;
			 	$user['website'] = $website;
			 	$user['image'] = '';
			 	$user['reset_code'] = $code;
			 	$result = insert_user($user);
			 	if ($result === true) {
			 		$message = "Hi " . $username . ", \r" . "You requested an account on our website, in order to use this account, you need to <a href=\"".url_for('/process/p_account_verify.php?code='.$code)."\">click here to verify</a> it. ";
			 		setMsg('msg', 'Your account has been created successfully. Please check your email to verify', 'warning');
			 		send_email([
			 			'to' => $email,
			 			'from' => 'info@cauth.com',
			 			'subject' => 'Account Activation',
			 			'msg' => $message
			 		]);
			 		// print_r($user);exit;
			 	}

			 } else {
			 	$data = [
			 		'name' => $name,
			 		'username' => $username,
			 		'email' => $email,
			 		'website' => $website,
			 		'password' => $password,
			 		'confirm_password' => $confirm_password
			 	];
			 	setMsg('form_data', $data);
			 	setMsg('errors', $errors);
			 }
			 redirect_to(url_for('/register.php'));
			 // print_r($errors);
		}
		
	} else {
		//return form values
		
	}

 ?>