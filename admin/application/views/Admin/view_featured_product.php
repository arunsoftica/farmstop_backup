<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Featured Product</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
    <thead>
       <th>#</th>
       <th>Action</th>
       <th>Product Category</th>
       <th>Product</th>
       <th>Type</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($fproduct) > 0){
        foreach($fproduct as $fpro){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('view_featured_product?delfpro='.$fpro['id']) ?>">Delete</a></td>
           
           <td><?php echo $fpro['pro_cat']; ?></td>
           <td><?php echo $fpro['pro']; ?></td>
           <td><?php
           if($fpro['protypes'] == 1){ echo 'Featured';}
           else if($fpro['protypes'] == 2){ echo 'New';}
           ?></td>
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