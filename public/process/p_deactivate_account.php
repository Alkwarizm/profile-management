<?php require '../../private/initialize.php'; ?>

<?php 
	if (isset($_POST['deactivate'])) {
		$deactivate = $_POST['deactivate'] ?? '';
		if ($deactivate == 'Yes') {
			//run query to deactivate account
			$result = update_user($user->id, ['is_active' => 0]);
			if ($result === true) {
				setMsg('msg_notify', 'Account deactivated successfully');
				unset($_SESSION['user']);
				redirect_to(url_for('/login.php'));
			}
		}
	}


 ?>