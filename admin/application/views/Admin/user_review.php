<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">User Review</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                                 <thead>
       <th>#</th>
       <th>Action</th>
       <th>Variation</th>
       <th>Name</th>
       <th>Email</th>
       <th>Rating</th>
       <th>Review Title</th>
       <th>Review</th>
       <th>Date</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($review) > 0){
        foreach($review as $pro){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php if($pro['status'] == 0) echo '<a href="'.base_url("user_review?rwid=").$pro['id'].'">Not Approved</a>'; else echo '<a href="'.base_url("user_review?rwid=").$pro['id'].'">Approved</a>'; ?>/<a href="<?php echo base_url('update_user_review?ur='.$pro['id']) ?>">Edit</a>/<a href="#">Delete</a></td>
           <td><?php echo $pro['name']; ?></td>
           <td><?php echo $pro['aname']; ?></td>
           <td><?php echo $pro['email']; ?></td>
           <td><?php echo $pro['rating']; ?></td>
           <td><?php echo $pro['title']; ?></td>
           <td><?php echo $pro['review']; ?></td>
           <td><?php echo $pro['date']; ?></td>




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