
<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			       <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Product Selling & Inventory Report</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                                <thead>
       <th>#</th>
       <th>Date</th>
       <th>Product Name</th>
       <th>Product Category</th>
       <th>Available Product</th>
       <th>Add Product</th>
       <th>Sell Product</th>
       <th>Net Product</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($selling) > 0){
        foreach($selling as $order){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $order['date']; ?></td>
           <td><?php echo $order['attribute_name'].' ('.$order['attr_value'].')';?></td>
           <td><?php echo $order['pro_title']; ?></td>
           <td><?php echo $order['total_product']-$order['update_product']; ?></td>
           <td><?php echo $order['update_product']; ?></td>
           <td><?php echo $order['sell_product']; ?></td>
           <td><?php echo $order['total_product']-$order['sell_product']; ?></td>
         </tr>


       <?php } } else {
        ?>
        <tr>
        <td colspan="6">No Record Found</td>     
        </tr>
      <?php } ?>
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
     
     alert(this.value);
 });

</script>