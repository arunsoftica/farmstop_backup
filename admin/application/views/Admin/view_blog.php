<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Blog</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
     <thead>
       <th>#</th>
       <th>Action</th>
       <th>Title</th>
       <th>Description</th>
       
       <th>Image</th>
       <th>Date</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($blogs) > 0){
        foreach($blogs as $blog){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('update_blog?blid='.$blog['id']) ?>">Edit</a>/<a href="<?php echo base_url('view_blog?delblog='.$blog['id']) ?>">Delete</a></td>
           
           <td><?php echo $blog['title']; ?></td>
           <td><?php echo $blog['description']; ?></td>
           
           <td>
               <img src="<?php echo base_url('uploads/blog_images/').$blog['image'] ?>" height="100" width="100">
               </td>
           
           <td><?php echo $blog['date']; ?></td>




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

<script type="text/javascript">


</script>