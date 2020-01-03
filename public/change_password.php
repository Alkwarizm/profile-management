<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>

    <div class="container">


        <div class="row">

            <div class="col-md-6 mx-auto mt-5">
                <div class='card card-body  bg-light mt-2 mb-5'>
                    <h2>Change your Password</h2>
                    <p>Please fill in credentials to Change Password.</p>
                    <?php 
                    	 //form errors
                        $errors = getMsg('errors');

                     ?>
                    <form action="<?php echo url_for('/process/p_change_password.php'); ?>" method='POST'>
                        
                        <div class="form-group">
                            <label for='password'>Old Password: <sup>*</sup></label>
                            <input type='password' name="old_password" class="form-control form-control-lg <?php echo isset($errors['old_password_err']) ? 'is-invalid' : '' ;?>" value="">
                            <span class="invalid-feedback"><?php echo $errors['old_password_err'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for='password'>New Password: <sup>*</sup></label>
                            <input type='password' name="password" class="form-control form-control-lg <?php echo isset($errors['password_err']) ? 'is-invalid' : '' ;?>" value="">
                            <span class="invalid-feedback"><?php echo $errors['password_err'] ?? ''; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for='confirm_password'>Confirm Password: <sup>*</sup></label>
                            <input type='password' name="confirm_password" class="form-control form-control-lg <?php echo isset($errors['confirm_password_err']) ? 'is-invalid' : '' ;?>">
                            <span class="invalid-feedback"><?php echo $errors['confirm_password_err'] ?? ''; ?></span>
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