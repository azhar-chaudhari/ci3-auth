<!-- ============================================================== -->
<!--Pageloader start here-->
<!-- ============================================================== -->
<!-- ============================================================== -->

<div class='content-wrapper'>
    <section class='content-header'>
        <h1>
            <i class='fa fa-users'></i> <?php echo $singular; ?>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <!-- general form elements -->


                <div class="card card-primary">
                    <div class="card-body card-profile">
                        <div class="widget-user-image">
                            <!-- <img class="img-responsive img-circle"
                                src="<?php echo base_url(); ?>uploads/user/<?=$rec->user_profile_url;?>" alt="User profile picture"> -->
                        </div>

                        <!-- <h3 class="profile-username text-center"><?=$rec->last_name. " ". $rec->first_name;?></h3> -->


                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                                <b><?php echo $this->lang->line('name'); ?></b> <a
                                    class="pull-right"><?=$rec->last_name. " ". $rec->first_name;?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('email'); ?></b> <a
                                    class="pull-right"><?=$rec->email?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('mobile'); ?></b> <a
                                    class="pull-right"><?=$rec->mobile?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form id="norm_form" method="post" action="<?php echo site_url($verb . '/UpdatePasswordWeb') ?>">
                    <input type="hidden" name="user_id" id="id" value="<?php echo $rec->user_id; ?>">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">You can modify user Password</h3>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword1">New Password</label>
                                        <input type="password" class="form-control" placeholder="New password"
                                            name="password" id="password" maxlength="20" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPassword2">Confirm New Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm new password"
                                            name="cpassword" id="cpassword" maxlength="20" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btnSubmit"
                                class="btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
                            <a href="<?php echo site_url($verb); ?>" id="btnCancel"
                                class="btn btn-light"><?php echo $this->lang->line('cancel'); ?></a>
                        </div>
                    </div>

            </div>
            <div class="col-md-3">
                <?php
$msg = $this->session->flashdata('msg');
if ($msg) {
    echo $this->session->flashdata('msg');
}?>


            </div>
        </div>

    </section>
</div>
<script type="text/javascript">
$(document).ready(function() {

    validateData("#norm_form", {
        password: 'required',
        cNewPassword: 'required',
    });

});
</script>