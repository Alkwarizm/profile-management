<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>

   <div class="container">

		
        <div class="row">

            <div class="col-md-6 mx-auto">
                <div class='card card-body  bg-light mt-5'>
                    <h2>Login</h2>
                    <p>Please fill in credentials to log in.</p>
					<?php
						echo getMsg('msg_notify');
						$errors = getMsg('errors');
						$data = getMsg('form-data'); 
						echo isset($errors['login_err']) ? "<div class=\"alert alert-danger text-center\">" . $errors['login_err'] . "</div>" : "";
					 ?>
                    <form action="<?php echo url_for('/process/p_login.php'); ?>" method='POST'>
                        <div class="form-group">
                            <label for='username'>Username: <sup>*</sup></label>
                            <input type='text' name="username" class="form-control form-control-lg <?php echo isset($errors['username_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['username'] ?? ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['username_err'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for='password'>Password: <sup>*</sup></label>
                            <input type='password' name="password" class="form-control form-control-lg <?php echo isset($errors['password_err']) ? 'is-invalid' : '' ;?>">
                            <span class="invalid-feedback"><?php echo $errors['password_err'] ?? ''; ?></span>
                        </div>

                        <div class="form-check mb-2 text-center">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberme">
                            <label class="form-check-label text-primary" for="exampleCheck1">Remember Me</label>
                        </div>


                        <div class="row">

                            <div class='col'>

                                <input type='submit' name='login' value='Login' class='btn  btn-block color-set'>

                            </div>



                        </div>
                        <div class="row">
                            <div class='col'>

                                <a href="<?php echo url_for('forgot_password.php'); ?>" class="btn  btn-block">Forget Passsword?</a>

                            </div>


                            <div class='col'>

                                <a href="<?php echo url_for('/register.php'); ?>" class="btn  btn-block">No account? Register</a>

                            </div>
                        </div>


                    </form>

                </div>
            </div>

        </div>


    </div>



<?php require INCLUDES_PATH . '/footer.php'; ?>