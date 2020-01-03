<?php require '../../private/initialize.php'; ?>

<?php 
	if(is_get_request()) {
		if (isset($_GET['code']) && $_GET['code'] != '') {
			$code = trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING));
			// verifyUserAccount($code);exit;
			if (checkUserByCode($code) === true) {
				$result = verifyUserAccount($code);
				if ($result === true) {
					setMsg('msg_notify', 'Your Account has been activated. You can login to your account.');
					redirect_to(url_for('/login.php'));
				}
			} else {
				setMsg('msg', 'Invalid activation code.', 'warning');
			}
		} else {
			// Error
		}

	} else {
		redirect_to(url_for('/register.php'));
	}

	redirect_to(url_for('/register.php'));

 ?>