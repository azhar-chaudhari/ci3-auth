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

                    <div class="card-header">
                        <h3 class="card-title"> <?php echo $singular; ?></h3>
                    </div>
                    <?php if ($this->session->flashdata('msg')) {echo $this->session->flashdata('msg');}?>
                    <div class="card-body ">

                        <form id="norm_form" method="post" action="<?php echo site_url($verb . '/update') ?>">
                            <input type="hidden" name="saveType" id="saveType" value="1">
                            <input type="hidden" name="id" id="id" value="<?php echo $row->task_id; ?>">

                            <div class="row p-1">
                               
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label for="name"
                                            class=" control-label">Task</label>
                                        <textarea type="text" id="task_title" name="task_title"  placeholder="Enter Task"
                                            class="form-control" aria-describedby="task_title"><?php echo set_value('task_title', $row->task_title); ?>
</textarea>
                                        <?php echo form_error('task_title'); ?>
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