 <?php require '../private/initialize.php'; ?>
 <?php require INCLUDES_PATH . '/header.php'; ?>
 <?php require INCLUDES_PATH . '/navbar.php'; ?>


 <div class="container">


 	<div class="row">

 		<div class="col-md-6 mx-auto mt-5">
 			<div class='card card-body  bg-light '>
 				<h2>Activate Account Request</h2>
				
				<?php 
					echo getMsg('msg');
					$errors = getMsg('errors');
					$data = getMsg('form-data');
				 ?>

 				<form action="<?php echo url_for('/process/p_request_account_activate.php'); ?>" method='POST'>


 					<div class="form-group">
 						<label for='email'>Email: <sup>*</sup></label>
 						<input type='email' name="email" required="" class="form-control form-control-lg <?php echo isset($errors['email_err']) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email']; ?>">
 						<span class="invalid-feedback"><?php echo $errors['email_err'] ?? ''; ?></span>
 					</div>


 					<div class="row">

 						<div class='col'>

 							<input type='submit' name='request-activate-account' value='Send Reset Link' class='btn  btn-block color-set'>

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