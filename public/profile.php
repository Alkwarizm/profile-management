<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>

<?php 
	// if(!isUserLoggedIn()) {
	// 	redirect_to(url_for('/login.php'));
	// }
 ?>

<div class="container">

        <div class='jumbotron jumbotron-fluid text-center color-set'>
            <div class="container">
                <h1 class='display-3'>
                    Profile Managment
                </h1>
                <p class='lead'>
                    Here you will be able to upload image and edit information
                </p>

            </div>
        </div>
		<?php 

			echo getMsg('msg_notify');
			// print_r($_COOKIE['user']);

		 ?>
        <div class="col-md-6 mx-auto">

            <div class='card'>


                <div class="card-header color-set">

                    Your Profile Data
                </div>
                <div class='card-body '>
                   

                    <div class="row">

                        <div class="col-md-8">
                            <div class='detail-text'>
                                <label for="name"><strong>Name:</strong></label>
                                <span class='text-data'><?php echo $user->username; ?></span>
                            </div>

                            <div class='detail-text'>
                                <label for="name"><strong>Email:</strong></label>
                                <span class='text-data'><?php echo $user->email; ?></span>
                            </div>

                            <div class='detail-text'>
                                <label for="name"><strong>Account Status:</strong></label>
                                <span class='text-data'> Verified</span>
                            </div>

                            <hr/>
                            <div class='detail-text'>
                                <label for="name"><strong>Created On:&nbsp;</strong></label>
                                <span class='text-data'><?php echo date('d F, Y H:i:s',(int)$user->created_at); ?></span>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <a href="#" class="img-container"><img src="<?php echo ($user->image) != ''? url_for('/assets/image_uploads/').$user->image: url_for('/assets/image_uploads/').'user-placeholder.png' ?>"></a>

                        </div>
                    </div>

                </div>
                <div class='card-footer'>
                    <a href='' data-toggle="modal" data-target="#myModal"><i class='fa fa-trash-o'></i></a>
                    <a href="<?php echo url_for('/edit_profile.php'); ?>" class='pull-right'><i class='fa fa-pencil-square-o'></i></a>
                </div>

            </div>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" style='cursor:pointer;'>&times;</button>

                    </div>
                    <div class="modal-body text-center">
                        <p>Do you really want to delete your account?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="<?php echo url_for('/process/p_deactivate_account.php'); ?>" method="POST">
                        	<input type="submit" class="btn btn-danger" name="deactivate" value="Yes">
                        </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style='cursor:pointer;'>No</button>
                    </div>
                </div>

            </div>
        </div>



    </div>

<?php require INCLUDES_PATH . '/footer.php'; ?>