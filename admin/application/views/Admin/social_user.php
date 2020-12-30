<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Social User</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                                 <thead>
       <th>#</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       
       <th>User From</th>
       <th>Date</th>
     </thead>
     
                                 <tbody>
                                  <?php 
                                    $count = 0;
                                    if(count($socialuser) > 0){
                                    foreach($socialuser as $suser){ ?>
                                     <tr>
                                       <td><?php echo $count = $count + 1; ?></td>
                                       <td><?php echo $suser['name']; ?></td>
                                       <td><?php echo $suser['mobile']; ?></td>
                                       <td><?php echo $suser['email']; ?></td>
                                       <td><?php if($suser['type'] == 2) echo 'Facebook'; else echo 'Google'; ?></td>
                                       <td><?php echo $suser['date']; ?></td>
                                       
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