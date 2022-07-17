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
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">

                    <div class="card-header ">
                        <h3 class="card-title"> <?php echo $singular; ?></h3>
                    </div>
                    <?php if ($this->session->flashdata('msg')) {echo $this->session->flashdata('msg');}?>
                    <div class="card-body ">

                        <form id="norm_form" method="post" action="<?php echo site_url($verb . '/update') ?>"
                            enctype='multipart/form-data'>
                            <input type="hidden" name="saveType" id="saveType" value="1">
                            <input type="hidden" name="id" id="id" value="<?php echo $row->user_id; ?>">

                            <div class="row p-1">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                       <label for="name"
                                            class=" control-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name"
                                            aria-describedby="name"
                                            value="<?php echo set_value('name', $row->name); ?>">
                                        <?php echo form_error('name'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="name"
                                            class=" control-label">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Enter Mobile No."
                                            aria-describedby="mobile"
                                            value="<?php echo set_value('mobile', $row->mobile); ?>">
                                        <?php echo form_error('mobile'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="name"
                                            class=" control-label"><?php echo $this->lang->line('email'); ?></label>
                                        <input type="text" id="email" name="email" class="form-control"  placeholder="Enter Email"
                                            aria-describedby="email"
                                            value=" <?php echo set_value('email', $row->email); ?>">
                                        <?php echo form_error('email'); ?>
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


                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
<script type="text/javascript">
$(document).ready(function() {

    validateData("#norm_form", {

    });

});
</script>