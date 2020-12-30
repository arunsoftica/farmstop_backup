<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Filter Order</h4>
    				<div class="add-items d-flex">
    				    <form class="w-100" method="get" action="filter_order">
   <div class="row">
       <div class="col-lg-3">
           <input type="date" name="fdate" class="form-control" >
       </div>
       <!--<div class="col-lg-3">-->
       <!--    <select name="product" class="product form-control">-->
       <!--        <option value="">Select</option>-->
       <!--        <?php foreach($variation as $vr){ ?>-->
       <!--        <option value="<?php echo $vr['id'] ?>"><?php echo $vr['attribute_name'] ?></option>-->
       <!--        <?php } ?>-->
       <!--    </select>-->
       <!--</div>-->
       <!--<div class="col-lg-3">-->
       <!--    <select name="variation" class="variation form-control" >-->
       <!--        <option value="">Select</option>-->
               
       <!--    </select>-->
       <!--</div>-->
       <div class="col-lg-3">
           <button type="submit"  class="search btn btn-primary">Search</button>
       </div>
   </div>
   </form>
    				</div>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example" data-page-length='100'>
    <thead>
       <th>#</th>
       <th>Product Name</th>
       <th>Weight / Unit</th>
       <th>Quantity</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(isset($orders) && count($orders) > 0){
        foreach($orders as $order){ 
        
        ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $order['attribute_name'].'('.$order['weight'].')'; ?></td>
           <td><?php echo $order['weight']; ?></td>
           <td><?php echo $order['total_item']; ?></td>
           
      <?php }} ?>
     </tbody>
   </table>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>




<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).on('change', '.status', function (e) {
     
     var status_val = $(this).val();
     $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/updateOrderStatus") ?>",
                data: {status_val:status_val},
                success: function (data) {
                    
                    alert(data);
                    location.reload();
                }
            });
 });
 
 $(document).on('change', '.product', function (e) {
     
     var pro = $(this).val();
     $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/getProductVariations") ?>",
                data: {pro:pro},
                success: function (data) {
                    
                    
                    $('.variation').html();
                    $('.variation').html(data);
                }
            });
 });

</script>