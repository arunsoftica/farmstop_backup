<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Pincode</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                               <thead>
       <th>#</th>
       <th>Action</th>
       <th>state</th>
       <th>Area</th>
       <th>Pincode</th>
       <th>Shipping Cost</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($pincode) > 0){
        foreach($pincode as $pin){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('update_pincode?pinid='.$pin['id']) ?>">Edit</a>/<a href="<?php echo base_url('view_pincode?delpin='.$pin['id']) ?>">Delete</a></td>
           
           <td><?php echo $pin['state']; ?></td>
           <td><?php echo $pin['area']; ?></td>
           
           <td><?php echo $pin['pincode']; ?></td>
           
           <td><?php echo $pin['shipping_cost']; ?></td>




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