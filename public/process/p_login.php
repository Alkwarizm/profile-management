<?php require '../../private/initialize.php'; ?>

<?php 
	$errors = array();
	// only post requests from login
	if (!is_post_request() || !isset($_POST['login'])) {
		redirect_to(url_for('/login.php'));
	} 
	// echo '<pre>';
	// print_r($_POST);
	// echo '</pre>';exit;
	// sanitize inputs
	$username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
	$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
	$remember_me = isset($_POST['rememberme']) ? 'Yes' : '';

	// validate inputs
	if (is_blank($username)) {
		$errors['username_err'] = 'Please enter your username';
	} elseif (!has_length($username, ['min' => 5, 'max' => 15])) {
		$errors['username_err'] = 'Username minimum limit is 5 and max is 15 characters';
	}
	if (is_blank($password)) {
		$errors['password_err'] = 'Please enter your password';
	} elseif (!has_length($password, ['min' => 5, 'max' => 20])) {
		$errors['password_err'] = 'Password minimum limit is 5 and max is 20 characters';
	}
	if (empty($errors)) {
		// check username exists
		if (checkUserByUsername($username)) {
			// get user
			$user = findUserByUsername($username);
			// verify user and password
			if ($user !== false && password_verify($password, $user->password)) {
				// check user is activated
				if (checkUserActivation($username)) {
					if($remember_me == 'Yes') { setcookie('user', serialize($user), time() + 86400*30, '/'); }
					$_SESSION['user'] = $user;
					// print_r($_COOKIE);
					// print_r($_SESSION['user']);exit;
					redirect_to(url_for('/profile.php'));
				} else {
					$errors['login_err'] = 'Account is not activated. Click <a href="'.url_for('/request_account_activate.php'). '">here</a> to verify account';
				}
			} else {
				$errors['login_err'] = 'Wrong username or password';
			}
		} else {
			$errors['username_err'] = 'Username does not exist';
		}
	} 

		$data = [
			'username' => $username
		];
		setMsg('form-data', $data);
		setMsg('errors', $errors);
		redirect_to(url_for('/login.php'));

 ?>