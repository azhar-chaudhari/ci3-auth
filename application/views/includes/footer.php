<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b>  1.0
    </div>
    <strong>Copyright &copy; 2021-2022 <?php echo $this->config->item('web_app_name');
?></a>.</strong> All rights
    reserved.
</footer>

<!-- jQuery UI 1.11.2 -->
<!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>assets/js/ciauth.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"
    type="text/javascript"></script>
</script>
<!-- <script src="<?php //echo base_url(); ?>assets/dist/js/pages/dashboard.js" type="text/javascript"></script> -->

<script type="text/javascript">
var windowURL = window.location.href;
pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
var x = $('a[href="' + pageURL + '"]');
x.addClass('active');
x.parent().addClass('active');
var y = $('a[href="' + windowURL + '"]');
y.addClass('active');
y.parent().addClass('active');
</script>
</body>

</html>