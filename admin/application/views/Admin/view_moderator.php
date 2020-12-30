<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Moderator</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                                        <thead>
       <th>#</th>
       <th>Action</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>Address</th>
       <th>Image</th>
       <th>Created By</th>
       <th>Date</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($moderator) > 0){
        foreach($moderator as $mod){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('update_moderator?upmod='.$mod['id']) ?>">Edit</a>/<a onclick="return confirm('Are you sure?');" href="<?php echo base_url('view_moderator?delmod='.$mod['id']) ?>">Delete</a></td>
           <td><?php echo $mod['first_name'].' '.$mod['middle_name'].' '.$mod['last_name']; ?></td>
           <td><?php echo $mod['mobile']; ?></td>
           <td><?php echo $mod['email']; ?></td>
           <td><?php
            if($mod['gender'] == 'm') echo 'Male'; else echo 'Female';

            ?></td>
           <td><?php echo $mod['address']; ?></td>
           <td>
            <?php 
           if($mod['types'] == 3){ ?>
           <img src="uploads/moderator/<?php echo $mod['image'] ?>" height="100" width="100">
          <?php } ?> 
           </td>
           <td><?php echo $created_by['email']; ?></td>
           
           <td><?php echo $mod['updated_at']; ?></td>




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