<?php defined('BASEPATH') OR exit('No direct script access allowed');

    
    if($content == 'home') { $selected = $content; }
    if($content == 'teams') { $selected = $content; $content = '';}
    if($content == 'players') { $selected = $content; $content = '';}
    if($content == 'games') { $selected = $content; $content = '';}
	if($content == 'profile') { $selected = $content; $content = '';}
	if($content == 'users') { $selected = $content; $content = ''; }

	$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
	$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />
	<title><?php echo $system_name; ?></title>

	<!--css -->
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/light-bootstrap-dashboard.css?v=2.0.0" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css" />

    <!--scripts needed to load first (yes I know there's a better way... I'll get to it :) -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.validate.min.js"></script>
	<script>
		let SITEURL = '<?php echo base_url(); ?>';
	</script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>

<body>

	<div class="wrapper">
        <div class="sidebar" data-color="gray">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="<?php echo base_url('admin/home');?>" class="simple-text">PSH Admin</a>
                </div>
                <ul class="nav nav-pills">
                    <?php
                        if ($selected == 'home') {
                            echo '<li class="nav-item active">';
                        }
                        else {
                            echo '<li class="nav-item">';
                        }
                    ?>
                        <a class="nav-link" href="<?php echo base_url('admin/home');?>">
							<i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php
                        if ($selected == 'teams') {
                            echo '<li class="nav-item active">';
                        }
                        else {
                            echo '<li class="nav-item">';
                        }
                    ?>
                        <a class="nav-link" href="<?php echo base_url('admin/team');?>">
							<i class="fas fa-boxes"></i>
                            <p>Teams</p>
                        </a>
                    </li>
                    <?php
                        if ($selected == 'players') {
                            echo '<li class="nav-item active">';
                        }
                        else {
                            echo '<li class="nav-item">';
                        }
                    ?>
                        <a class="nav-link" href="<?php echo base_url('admin/player');?>">
							<i class="fas fa-users"></i>
                            <p>Players</p>
                        </a>
                    </li>
                    <?php
                        if ($selected == 'games') {
                            echo '<li class="nav-item active">';
                        }
                        else {
                            echo '<li class="nav-item">';
                        }
                    ?>
                        <a class="nav-link" href="<?php echo base_url('admin/games');?>">
							<i class="far fa-calendar-check"></i>
                            <p>Games</p>
                        </a>
					</li>
					
					<?php if ($this->session->userdata('role') == 'admin'): ?>
					<?php
						if($selected == 'users') {
							echo '<li class="nav-item active dropdown">';
						} else {
							echo '<li class="nav-item dropdown">';
						}
					?>
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup='true' aria-expanded="false">
							<i class="fas fa-user-cog"></i> <p>Users</p>
						</a>
						<div class="dropdown-menu fade">
							<a class="dropdown-item" href="<?php echo base_url('admin/user/all_user_list'); ?>">All Users</a>
							<a class="dropdown-item" href="#">User Powers</a>
						</div>						
					</li>
					<?php endif; ?>
                </ul>
            </div>
        </div>

        <!--top nav-->
		<div class="main-panel">
			<!--navbar-->
			<nav class="navbar navbar-expand-lg" color-on-scroll="500">
				<div class="container-fluid">
					<span class="page_title"><?php if(isset($page_title)) { echo $page_title; } else { echo 'SHIT'; } ?></span>
					<button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle Navigation">
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
						<span class="navbar-toggler-bar burger-lines"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navigation">
						<ul class="nav navbar-nav ml-auto">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="profile-ava">
										<!--img src="<?php echo $profile->user_img;?>" alt="<?php echo $name; ?>" /-->
									</span>
									<span class="no-icon">TEMP</span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="<?php echo base_url('admin/profile');?>">
										<i class="far fa-id-card"></i>
                                        <span class="profile-text">Profile</span>
									</a>
									<a class="dropdown-item" href="#">
										<i class="far fa-envelope"></i>
                                        <span class="profile-text">Messages</span>
                                    </a>
									<div class="divider"></div>
									<a class="dropdown-item" href="<?php echo base_url('admin/logout');?>">
										<i class="fas fa-power-off"></i>
                                        <span class="profile-text">Log out</span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!--/navbar-->
