<?php require '../../private/initialize.php'; ?>
<?php 
	// Logout user
	userLogOut();
	unset($user);
	setMsg('msg_notify', 'You are successfully logged out');
	redirect_to(url_for('/login.php'));
 ?>