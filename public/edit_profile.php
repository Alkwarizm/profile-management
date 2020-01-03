<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>


    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">
                <div class='card card-body  bg-light mt-5'>

                    <h2>Update Your account Details</h2>
                    <p>
                       <?php 
                       	 	$errors = getMsg('errors'); 
                        ?>

                    </p>
                    <form action="<?php echo url_for('/process/p_edit_profile.php'); ?>" method='POST' enctype="multipart/form-data">
                        <div class="form-group">
                            <label for='name'>Name: <sup>*</sup></label>
                            <input type='text' name="name" class='form-control form-control-lg' value="<?php echo $user->name; ?>">
                            <span class="invalid-feedback"></span>
                        </div>

						<div class="form-group">
                            <label for='name'>Website: <sup>*</sup></label>
                            <input type='text' name="website" class='form-control form-control-lg' value="<?php echo $user->website; ?>">
                            <span class="invalid-feedback"></span>
                        </div>                     
                        
                               
                        <div class="form-group" id="img-upload">
                            <label for='username'>Upload Image: <sup>*</sup></label>
                            <input type='file' name="image" class="form-control <?php echo isset($errors['image_err']) ? 'is-invalid' : '' ;?>">
                            <span class="invalid-feedback"><?php echo $errors['image_err'] ?? ''; ?></span>
                        </div>

                        <div class="form-group w-50" id="img-field">
                        	<img src="<?php echo ($user->image) != ''? url_for('/assets/image_uploads/').$user->image: url_for('/assets/image_uploads/').'user-placeholder.png' ?>" class="img-responsive w-100">
                        	<a href="#" class="img-box">Click here to upload an image</a>
                        </div>
                        
                        
                        <div class="row">

                            <div class='col'>

                                <input type='submit' name='edit' value='Update Now' class='btn color-set btn-block'>

                            </div>


                            <div class='col'>

                                <a href="<?php echo url_for('/change_password.php'); ?>" class="btn btn-light btn-block">Wanna Change Password? </a>

                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>


    </div>


<?php require INCLUDES_PATH . '/footer.php'; ?>