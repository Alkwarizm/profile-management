 <?php require '../private/initialize.php'; ?>
 <?php require INCLUDES_PATH . '/header.php'; ?>
 <?php require INCLUDES_PATH . '/navbar.php'; ?>

 <?php 
 	if (!isset($_SESSION['reset-code'])) {
 		setMsg('msg_notify', 'You cannot access this page', 'danger');
 		redirect_to(url_for('/login.php'));
 	}
  ?>

   <div class="container">


        <div class="row">

            <div class="col-md-6 mx-auto mt-5">
                <div class='card card-body  bg-light mt-2 mb-5'>
                    <h2>Reset your Password</h2>
                    <p>Please fill in credentials to Reset Password.</p>
                    <?php 
                    	echo getMsg('msg');
                    	$errors = getMsg('errors');
                    	$data = getMsg('form-data');
                     ?>
                    <form action="<?php echo url_for('/process/p_reset_password.php'); ?>" method='POST'>

                        <div class="form-group">
                            <label for='password'>Password: <sup>*</sup></label>
                            <input type='password' name="password" class="form-control form-control-lg <?php echo isset($errors['password_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $errors['password_err'] ?? ''; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for='confirm_password'>Confirm Password: <sup>*</sup></label>
                            <input type='password' name="confirm_password" class="form-control form-control-lg <?php echo isset($errors['conf_password_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['confirm_password']; ?>">
                            <span class="invalid-feedback"><?php echo $errors['conf_password_err'] ?? ''; ?></span>
                        </div>


                        <div class="row">

                            <div class='col'>

                                <input type='submit' name='reset_password' value='Reset Password' class='btn  btn-block color-set'>

                            </div>



                        </div>
                        


                    </form>

                </div>
            </div>

        </div>


    </div>

 <?php require INCLUDES_PATH . '/footer.php'; ?>