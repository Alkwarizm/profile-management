<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>

    <div class="container">


        <div class="row">

            <div class="col-md-6 mx-auto">
                <div class='card card-body  bg-light mt-5'>
                    <h2>Reset Password</h2>
                    <p>Please fill in credentials to get reset link.</p>
                    <?php 
                    	echo getMsg('msg');
                    	$errors = getMsg('errors');
                    	$data = getMsg('form-data');
                     ?>
                    
                    <form action="<?php echo url_for('/process/p_forgot_password.php'); ?>" method='POST'>


                       <div class="form-group">
                            <label for='email'>Email: <sup>*</sup></label>
                            <input type='email' required="" name="email" class="form-control form-control-lg <?php echo isset($errors['email_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $errors['email_err'] ?? ''; ?></span>
                        </div>
                       


                        <div class="row">

                            <div class='col'>

                                <input type='submit' name='reset-password' value='Send Reset Link' class='btn  btn-block color-set'>

                            </div>



                        </div>
                        <div class="row">
                            <div class='col'>

                                <a href="<?php echo url_for('/login.php'); ?>" class="btn text-right  btn-block">Go Back to Login </a>

                            </div>
                       
                        </div>


                    </form>

                </div>
            </div>

        </div>


    </div>

<?php require INCLUDES_PATH . '/footer.php'; ?>