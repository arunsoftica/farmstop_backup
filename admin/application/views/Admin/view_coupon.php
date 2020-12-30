<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Coupon</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                               <thead>
       <th>#</th>
       <th>Action</th>
       <th>Code</th>
       <th>Type</th>
       <th>Value</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($coupons) > 0){
        foreach($coupons as $coup){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('view_coupon?delcoup='.$coup['id']) ?>">Delete</a></td>
           
           <td><?php echo $coup['code']; ?></td>
           <td><?php 
           
           if($coup['code_type'] == 'p') echo 'Percent'; else echo 'Amount'; 
           
           ?></td>
           
           <td><?php echo $coup['code_value']; ?></td>
           
           




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


</script>