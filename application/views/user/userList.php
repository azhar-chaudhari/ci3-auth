<!-- ============================================================== -->
<!--Pageloader start here-->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!--Pageloader end here-->
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
                        <h4 class="card-title"><?php echo $plural; ?></h4>
                        <div class="card-tools">
                            <a href="<?php echo site_url($verb . '/add') ?>"
                                class="btn btn-primary btn-sm"><?php echo $this->lang->line('add'); ?></a>
                        </div>
                    </div>

                    <?php if ($this->session->flashdata('msg')) {echo $this->session->flashdata('msg');}?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="dtable">
                                <thead >
                                    <tr>
                                        <th scope="col"><?php echo $this->lang->line('sr_no'); ?></th>

                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <?php
$no = 0;
if (!empty($data)) {

    foreach ($data as $d) {

        $no++;?>
                                    <tr>
                                        <td><?php echo $no; ?></td>

                                        <td><?php echo $d['name'];?></td>
                                        <td><?php echo $d['mobile']; ?></td>
                                        <td><?php echo $d['email']; ?></td>

                                        </td>
                                        <td>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">Action
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a id="btnCP" value="Change Password"  class="nav-link"
                                                            href="<?php echo base_url($verb . '/ChangePassword/' . $d['user_id']); ?>">
                                                            <i class="fa fa-user"></i>
                                                           Change Password</a>
                                                    </li>
                                                     <li><a id="btnLoginHistory" value="Login History"  class="nav-link"
                                                            href="<?php echo base_url($verb . '/login-history/' . $d['user_id']); ?>">
                                                            <i class="fa fa-user"></i>
                                                           Login History</a>
                                                    </li>
                                                    <li> <a id="btnEdit" value="Edit"  class="nav-link"
                                                            href="<?php echo base_url($verb . '/edit/' . $d['user_id']); ?>">
                                                            <i class="fa fa-edit"></i>
                                                            Update</a></li>
                                                    <li><a  data-toggle="modal" id="btnDelete"  class="nav-link"
                                                            value="Delete" data-id="<?php echo $d['user_id']; ?>"
                                                            data-target="#modal_delete"> <i class="fa fa-trash"></i>
                                                            Delete</a></li>
                                                    <li class="divider"></li>
                                                </ul>
                                            </div>


                                        </td>
                                    </tr>
                                    <?php }
}?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $('#dtable').DataTable({
        "autoWidth": false,
        "responsive": true,
        dom: 'lBfrtip',
    });

    //delete button code
    $(document).on("click", '#btnDelete', function() {
        $("#lbl_delete").html("<?php echo $delete; ?>");
        $("#code_delete").val($(this).attr("data-id"));
        $('#modal_delete').modal('show');
    });

    //delete button code
    $(document).on("click", '#btn_delete_yes', function() {

        var jid = $("#code_delete").val();
        url = "<?php echo base_url($verb . '/delete'); ?>";
        deleteData(jid, url);
        $('#modal_delete').modal('hide');
    });

        function deleteData(did, url) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: did
            },
            success: function(resp) {
                if (resp.code == 1) {
                    window.location.reload();
                }
            },
            error: function() {
                window.location.reload();
            },
            done: function() {
                window.location.reload();
            }
        });
    }
});
</script>