<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $this->config->item('web_app_name'); ?> | <?php echo $this->config->item('web_app_subtext'); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">

    <div class="login-box">

        <div class="card card-outline card-primary">
             <div class="card-header text-center">
                    <a href="#"><b><?php echo $this->config->item('web_app_name'); ?></b></a>
                </div>
            <div class="card-body">
               
                <p class="login-box-msg"><?php echo $this->lang->line('forgot_password'); ?></p>
                <?php $this->load->helper('form');?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                <?php
$this->load->helper('form');
$error = $this->session->flashdata('error');
$send = $this->session->flashdata('send');
$notsend = $this->session->flashdata('notsend');
$unable = $this->session->flashdata('unable');
$invalid = $this->session->flashdata('invalid');
if ($error) {
    ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php }

if ($send) {
    ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $send; ?>
                </div>
                <?php }

if ($notsend) {
    ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $notsend; ?>
                </div>
                <?php }

if ($unable) {
    ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $unable; ?>
                </div>
                <?php }

if ($invalid) {
    ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $invalid; ?>
                </div>
                <?php }?>

                <form action="<?php echo base_url(); ?>resetPasswordUser" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>"
                            name="login_email" required />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <label for="remember">
                                    <a
                                        href="<?php echo base_url() ?>login"><?php echo $this->lang->line('login'); ?></a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" class="btn btn-primary btn-block btn-flat"
                                value="<?php echo $this->lang->line('submit'); ?>" />
                        </div>
                        <!-- /.col  -->
                    </div>

                </form>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>