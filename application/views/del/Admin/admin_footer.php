<!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/admin/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url() ?>assets/admin/js/raphael.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/morris.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assets/admin/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.datepicker.js"></script>
    <?php require_once('assets/data_table/data_table_js.php') ?>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            //'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
        } );
    } );
</script>

</body>

</html>