<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Login History
            <small>track login history</small>
        </h1>
    </section>
    <section class="content">

        <div class="card">
                <form action="<?php echo base_url() ?>user/login-history" method="POST" id="searchList">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <input for="fromDate" type="text" id="fromDate" name="fromDate" value="<?php echo $fromDate; ?>"
                                    class="form-control datepicker" placeholder="From Date" />
                            </div>
                            <div class="col-3">
                                <input id="toDate" type="text" id="toDate" name="toDate" value="<?php echo $toDate; ?>"
                                    class="form-control datepicker" placeholder="To Date" />
                            </div>
                            <div class="col-3">
                                <input id="searchText" type="text" name="searchText" value="<?php echo $searchText; ?>"
                                    class="form-control" placeholder="Search Text" />
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-md btn-primary btn-sm searchList pull-right"><i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                                &nbsp;&nbsp;
                                <button class="btn btn-md btn-default btn-sm pull-right resetFilters"><i
                                        class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= !empty($userInfo) ? $userInfo->name." : ".$userInfo->email : "All users" ?></h3>
                        <div class="card-tools">
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body table-responsive ">
                        <table class="table table-hover">
                            <tr>
                                <th>Session Data</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Agent Full String</th>
                                <th>Platform</th>
                                <th>Date-Time</th>
                            </tr>
                            <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                            <tr>
                                <td><?php echo $record->session_data ?></td>
                                <td><?php echo $record->machine_ip ?></td>
                                <td><?php echo $record->user_agent ?></td>
                                <td><?php echo $record->agent_string ?></td>
                                <td><?php echo $record->platform ?></td>
                                <td><?php echo $record->created_at ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                        </table>

                    </div><!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/bower_components/datepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">
     document.getElementById("fromDate").defaultValue ="<?php echo date('d-m-Y');?>";
     document.getElementById("toDate").defaultValue ="<?php echo date('d-m-Y');?>";
    $('#fromDate').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });
    $('#toDate').datetimepicker({
        timepicker: false,
        format: 'd-m-Y'
    });
jQuery(document).ready(function() {
    jQuery('ul.pagination li a').click(function(e) {
        e.preventDefault();
        var link = jQuery(this).get(0).href;
        jQuery("#searchList").attr("action", link);
        jQuery("#searchList").submit();
    });


    jQuery('.resetFilters').click(function() {
        $(this).closest('form').find("input[type=text]").val("");
    })
});
</script>