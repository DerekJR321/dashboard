<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb">
                    <div class="text-muted bcrumb float-right">
                        <i class="fas fa-home"></i> <a href="<?php echo base_url();?>admin/home">Home</a> / <i class="far fa-address-card"></i> Profile
                    </div>
                </div>
                <div class="row">
                    <!-- left side -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $profile->name;?>" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-1">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $profile->username;?>" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label for="profileInputEmail">Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="you@yourdomain.com" value="<?php echo $profile->email;?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Level</label>
                                                <!-- add code to check level of user. if admin status, enable level -->
                                                <input type="text" class="form-control" id="level" name="level" disabled="" placeholder="Level" value="<?php echo $profile->level;?>" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-1">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <!-- add code to check level of user. if admin status, enable status -->
                                                <input type="text" class="form-control" id="status" name="status" disabled="" placeholder="status" value="<?php echo $profile->status;?>" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill float-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- //left side -->

                    <!-- right side -->
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                                <img src="<?php echo base_url();?>assets/img/profile-head.jpg" alt="">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a class="image-link" href="<?php echo $profile->user_img;?>" target="_blank" alt="<?php echo $profile->name;?>">
                                        <img class="avatar border-gray" src="<?php echo $profile->user_img; ?>" alt="">
                                    </a>
                                    <a href="#">
                                        <h5 class="title"><?php echo $profile->name;?></h5>
                                    </a>
                                    <p class="description">
                                        <?php echo $profile->username; ?>
                                    </p>
                                </div>
                                <p class="description text-center">
                                    Level: <?php echo $profile->level; ?><br />
                                    Status: <?php echo $profile->status; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
