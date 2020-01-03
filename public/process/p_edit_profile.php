<?php require '../../private/initialize.php'; ?>
<?php  

$errors = [];
if (isset($_POST['edit'])) {
	// Sanitize input
	$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
	$image = $_FILES['image'];
	$website = trim(filter_input(INPUT_POST, 'website', FILTER_SANITIZE_STRING));
	$current_user = [];

	// validate input
	
	if ($image['error'] !=4) {
		if ($image['error'] == 4) {
			$errors['image_err'] = 'Image upload error';
		}

		$image_info = pathinfo($image['name']);
		if (!in_array($image_info['extension'], ['jpeg','png', 'jpg'])) {
			$errors['image_err'] = 'Only jpeg, png and jpg files are allowed';
		}
		extract($image_info);
		$image_convention = $filename.time().'.'.$extension;
		if(!is_dir('../assets/image_uploads')) {
			$oldmask = umask(0);
			mkdir('../assets/image_uploads');
			umask($oldmask);
		}
		move_uploaded_file($image['tmp_name'],'../assets/image_uploads/'.$image_convention);
		// $user['image'] = $image_convention;
	} else {
		$image_convention = $user->image;
	}
	
	if(empty($errors)) {
		// Run update query
		$current_user['name'] = $name;
		$current_user['image'] = $image_convention;
		$current_user['website'] = $website;
		$result = update_user($user->id, $current_user);
		if ($result === true) {
			setMsg('msg', 'Your account was updated successfully');
			$updated_user = getUserById($user->id);
			$_SESSION['user'] = $updated_user;
			redirect_to(url_for('/edit_profile.php'));
		}
		
	} else {
		setMsg('errors', $errors);
		redirect_to(url_for('/edit_profile.php'));
	}
	
	
} else {
	// redirect to profile
	redirect_to(url_for('/edit_profile.php'));
}


?>