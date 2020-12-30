<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Product</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                            <thead>
                               <th>#</th>
                               <th>Action</th>
                               <th>Title</th>
                               <th>Description</th>
                               
                               <th>Created By</th>
                               <th>Date</th>
                               
        </thead>
                             
                             <tbody>
                              <?php 
                                $count = 0;
                                if(count($products) > 0){
                                foreach($products as $pro){ ?>
                                 <tr>
                                   <td><?php echo $count = $count + 1; ?></td>
                                   <td><a href="<?php echo base_url('update_product?proid='.$pro['id']) ?>">Edit</a>/<a href="<?php echo base_url('view_product?delprocat='.$pro['id']) ?>">Delete</a></td>
                                   
                                   <td><?php echo $pro['title']; ?></td>
                                   <td><?php echo substr($pro['description'],0,50).'....'; ?></td>
                                   
                                   <td><?php echo $pro['mail']; ?></td>
                                   
                                   <td><?php echo $pro['updated_at']; ?></td>
                        
                        
                        
                        
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