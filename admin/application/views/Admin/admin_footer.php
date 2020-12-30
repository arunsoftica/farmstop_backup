<footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="#" target="_blank">Farmstop</a>. All rights reserved.</span>
          </div>
        </footer>
    <!--script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script-->
<script src="<?php echo base_url() ?>assets/theam/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/off-canvas.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/hoverable-collapse.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/template.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/settings.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/todolist.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/jquery-jvectormap.min.js"></script>
<script src="<?php echo base_url() ?>assets/theam/js/jquery-jvectormap-world-mill-en.js"></script>
<!--<script src="<?php //echo base_url() ?>assets/theam/js/dashboardjs.js"></script>-->
<script>
    <?php require_once('assets/theam/js/dashboardjs.php') ?>
</script>

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