<?php
	$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
	$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Derek Reidy">
	<title><?php echo $system_name; ?></title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/login.css" />

</head>
<body class="bg-dark">

	<?php echo (!empty($error) ? '<p class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$error.'</p>' : ''); ?>
	
	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header text-center">
				<h3>PSH Admin Login</h3>

				<div align="center">
					<?php if(isset($page) && $page == "logout"): ?>
					<div class="alert alert-success hide_msg pull" style="width: 100%">
						<i class="fa fa-check-circle"></i> Logout Successful &nbsp; 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">x</span>
						</button>
					</div>
					<?php endif ?>
				</div>
				
			</div>
			<div class="card-body">
				<form id="login-form" action="<?php echo base_url('auth/log'); ?>" method="post">
					<div class="form-group">
						<div class="form-label-group">
							<input class="form-control" type="email" name="user_name" value="" required="" placeholder="Email Address">
							<label for="inputUsername">Username</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required="required">
							<label for="inputPassword">Password</label>
						</div>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" value="remember-me">
								Remember me
							</label>
						</div>
					</div>
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</form>
				<div class="text-center">
					<a class="d-block small mt-3" href="#">Register for an Account</a>
					<a class="d-block small" href="#">Forgot password?</a>
				</div>
			</div>
		</div>
	</div>

	<!--scripts-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/core/jquery.easing.min.js"></script>
</body>
</html>		
