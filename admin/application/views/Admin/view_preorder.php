<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			     <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Preorder</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                            <thead>
       <th>#</th>
       <th>Type</th>
       <th>Name</th>
       <th>Email</th>
       <th>Mobile</th>
       <th>Address</th>
       <th>Quantity</th>
       <th>Date</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($preorder) > 0){
        foreach($preorder as $po){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php 
           if($po['mtype'] == 1) echo 'Alphonso'; 
           else if($po['mtype'] == 2) echo 'Banaganapalli';
           else if($po['mtype'] == 3) echo 'Rajagira';
           else if($po['mtype'] == 4) echo 'Neelam';
           ?></td>
           <td><?php echo $po['name']; ?></td>
           <td><?php echo $po['email']; ?></td>
           <td><?php echo $po['mobile']; ?></td>
           <td><?php echo $po['address']; ?></td>
           <td><?php echo $po['quantity'].' kg'; ?></td>
           <td><?php echo date('d-m-Y', strtotime($po['date'])); ?></td>



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