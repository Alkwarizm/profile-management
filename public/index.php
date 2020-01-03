<?php require_once '../private/initialize.php'; ?>
<!-- header -->
<?php require INCLUDES_PATH . '/header.php'; ?>
<!-- navbar -->
<?php require INCLUDES_PATH . '/navbar.php'; ?>



<div class="container">

	<div class='jumbotron jumbotron-fluid text-center color-set'>
		<div class="container">
			<h1 class='display-6'>LOGIN &amp; REGISTER</h1>
			<p class="text-lead">Create the complete login and register form</p>
		</div>
		<!-- <?php echo serialize('Some common string'); ?> -->
		<!-- <?php echo URL_ROOT; ?> -->
		<!-- <?php 
			$now = strtotime('now');
			$before = '1552968475';
			$before = strtotime($before);
			echo 'Now : '.$now. '<br/>';
			echo 'Before: '. $before . '<br/>';
			echo date('d-m-Y H:i:s', $now).'<br/>';
			echo date('d-m-Y H:i:s', 1552968475).'<br/>';
			echo $_SERVER['SCRIPT_NAME'].'<br/>';
			echo $_SERVER['REQUEST_URI']. '<br/>';
			
			print_r($user);
			print_r($_SESSION['user']);
			// unset($_SESSION['user']);
		 ?> -->
	</div>

	<div class="row">
		<div class="col-md-6">

			<div class='card card-custom'>


				<div class="card-header card-header-custom text-center">

					<a href="<?php echo url_for('/index.php'); ?>" class="active" id="login-form-link mx-auto">Features [Part - 1]</a>
				</div>
				<div class='card-body'>

					<div class="row">
						<div class="col-lg-12">


							<ul class="list-group text-center">
								<li class="list-group-item">Login / Register</li>
								<li class="list-group-item">Profile mangement System</li>
								<li class="list-group-item">Forget/Reset Password</li>
								<li class="list-group-item">Remember me Option</li>

							</ul>


						</div>
					</div>



				</div>


			</div>
		</div>

		<div class="col-md-6 ">

			<div class='card card-custom'>


				<div class="card-header card-header-custom text-center">

					<a href="" class="active" id="login-form-link mx-auto">Features [Part - 2]</a>
				</div>
				<div class='card-body'>

					<div class="row">
						<div class="col-lg-12">


							<ul class="list-group text-center">

								<li class="list-group-item">Deactivate Account</li>
								<li class="list-group-item">Email Verification</li>
								<li class="list-group-item">Account Verification</li>
								<li class="list-group-item">XSS &amp; SQL injection prevention</li>
							</ul>


						</div>
					</div>



				</div>


			</div>
		</div>
	</div>

</div>

<?php require INCLUDES_PATH . '/footer.php'; ?>