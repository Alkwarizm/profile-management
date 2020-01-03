 <?php require '../private/initialize.php'; ?>
 <?php require INCLUDES_PATH . '/header.php'; ?>
 <?php require INCLUDES_PATH . '/navbar.php'; ?>

 <div class="container">


        <div class="row">

            <div class="col-md-6 mx-auto">
                <div class='card card-body  bg-light mt-2 mb-5'>
                    <h2>Register</h2>
                    <p>Please fill in credentials to Sign Up.</p>
                    <?php 
                        echo getMsg('msg');

                        //form errors
                        $errors = getMsg('errors');

                        //form data
                        $data = getMsg('form_data');
                     ?>
                    <form action="<?php echo url_for('/process/p_register.php'); ?>" method="POST">

                        <div class="form-group">
                            <label for='name'>Name: <sup>*</sup></label>
                            <input type='name' name="name" class="form-control form-control-lg <?php echo isset($errors['name_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['name'] ?? ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['name_err'] ?? ''; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for='username'>Username: <sup>*</sup></label>
                            <input type='text' name="username" class="form-control form-control-lg <?php echo isset($errors['username_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['username'] ?? ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['username_err'] ?? ''; ?></span>
                        </div>


                        <div class="form-group">
                            <label for='email'>Email: <sup>*</sup></label>
                            <input type='email' name="email" class="form-control form-control-lg <?php echo isset($errors['email_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ?? ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['email_err'] ?? ''; ?></span>
                        </div>

                         <div class="form-group">
                            <label for='email'>Website: <sup>*</sup></label>
                            <input type='text' name="website" class="form-control form-control-lg <?php echo isset($errors['website_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['website'] ?? ''; ?>">
                            <span class="invalid-feedback"><?php echo $errors['website_err'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for='password'>Password: <sup>*</sup></label>
                            <input type='password' name="password" class="form-control form-control-lg <?php echo isset($errors['password_err']) ? 'is-invalid' : '' ;?>" value="">
                            <span class="invalid-feedback"><?php echo $errors['password_err'] ?? ''; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for='confirm_password'>Confirm Password: <sup>*</sup></label>
                            <input type='password' name="confirm_password" class="form-control form-control-lg <?php echo isset($errors['password_err']) ? 'is-invalid' : '' ;?>" value="">
                            <span class="invalid-feedback"><?php echo $errors['password_err'] ?? ''; ?></span>
                        </div>


                        <div class="row">

                            <div class='col'>

                                <input type='submit' id="submit" name='register' value='Register' class='btn  btn-block color-set'>

                            </div>



                        </div>
                        <div class="row">
                            <div class='col'>

                                <a href="<?php echo url_for('/login.php'); ?>" class="btn  btn-block">Have account? Login</a>

                            </div>
                        </div>


                    </form>

                </div>
            </div>

        </div>


    </div>

 <?php require INCLUDES_PATH . '/footer.php'; ?>
