<?php
$userId = $userInfo->user_id;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->role_id;
$role = $userInfo->role_title;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user"></i> <?php echo $this->lang->line('my_profile'); ?>
            <small>View or modify information</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">


            <!-- left column -->
            <div class="col-md-3">
                <!-- general form elements -->


                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?php echo base_url(); ?>assets/dist/img/avatar.png" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $name ?></h3>

                        <p class="text-muted text-center"><?= $role ?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right"><?= $email ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile</b> <a class="float-right"><?= $mobile ?></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">You can modify your details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>profileUpdate" method="post" id="editProfile"
                        role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_name">Full Name</label>
                                        <input type="text" class="form-control" id="user_name" name="user_name"
                                            placeholder="<?php echo $name; ?>" maxlength="128" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            placeholder="<?php echo $mobile; ?>" maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>