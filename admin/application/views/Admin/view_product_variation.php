
<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			        <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Product Variation</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                                <thead>
                               <th>#</th>
                               <th>Action</th>
                               <th>Featured Image</th>
                               <th>Price</th>
                               <th>Inventory</th>
                               <th>Product</th>
                               <th>Variation</th>
                               <th>Date</th>
                               <th>Created By</th>
                               
                               
                             </thead>
                             
                             <tbody>
                              <?php 
                                $count = 0;
                                if(count($variation) > 0){
                                foreach($variation as $var){ ?>
                                 <tr>
                                   <td><?php echo $count = $count + 1; ?></td>
                                   <td><a href="<?php echo base_url('update_product_variation?vid='.$var['id']) ?>">Edit</a>/<a href="<?php echo base_url('view_product_variation?delvid='.$var['id']) ?>">Delete</a></td>
                                   <td><a href="<?php echo base_url('change_featured_image?chfimg='.$var['id']) ?>">Change</a></td>
                                   <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal<?php echo $var['id'] ?>">Update</button>
                                   <form class="update_price" did="<?php echo $var['id'] ?>" method="post">
                                   <div class="modal fade" id="exampleModal<?php echo $var['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Update Product Price</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <p id="updprice<?php echo $var['id'] ?>"></p>
                                        
                                        <?php 
                                        $exdetails = $model2->get_attribute_value($var['id']);
                                       $n = 0;
                                       foreach($exdetails as $exdetail){ ?>
                                    <div class="col-md-12 cls<?php echo $n; ?>">
                                    <div class="row">
                                    <div class="form-group col-md-3">
                                    <h4>Product Attribute</h4>
                                    <input type="hidden" name="product_id" value="<?php echo $var['id'] ?>">
                                    <select name="product_attr[]" class="form-control" >
                                      
                                     
                                     <option value="<?php echo $exdetail['pro_attr_id']; ?>" selected><?php echo $exdetail['pro_attr']; ?></option>
                                   
                                    </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                    <h4>Product Attribute Value</h4>
                                    <input type="text" name="weight[]" value="<?php echo $exdetail['weight'] ?>" class="form-control" readonly>
                                   </div>
                                   <div class="form-group col-md-3">
                                    <h4>Regular Price</h4>
                                    <input type="number" name="regular_price[]" value="<?php echo $exdetail['regular_price'] ?>" class="form-control" required>
                                   </div>
                                   <div class="form-group col-md-3">
                                    <h4>Sale Price</h4>
                                    <input type="number" name="sale_price[]" value="<?php echo $exdetail['sale_price'] ?>" class="form-control">
                                    
                                   </div>
                                   </div>
                                   
                                   
                                   </div>
                                   <?php $n = $n + 1; }  ?>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary p-2" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary p-2">Update Price</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </form>
                                   </td>
                                   <td>
                                       <select class="form-control inventory" name="inventory"><option value="0,<?php echo $var['id'] ?>" <?php if($var['inventory_status'] == 0) echo 'selected'; ?>>In Stock</option><option value="1,<?php echo $var['id'] ?>" <?php if($var['inventory_status'] == 1) echo 'selected'; ?>>Out of Stock</option></select>
                                   </td>
                                   <td><?php echo $var['pname']; ?></td>
                                   <td><?php echo $var['attribute_name']; ?></td>
                                   <td><?php echo $var['updated_at']; ?></td>
                                   <td><?php echo $var['mail']; ?></td>
                        
                        
                        
                        
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
$(document).on('change','.inventory', function (e){
          var v = $(this).val();
          $.ajax({
              url: "Ajaxcontroller/variationInventoryStatus",
              type: "GET",           
              data: {v:v},
              success: function(data){
                 alert(data);
                 
               }
              }); 
     });
$(document).on('submit','.update_price',(function(e){
        var qq = $(this).attr('did');
        e.preventDefault();
          $.ajax({
          url: "<?php echo base_url('Ajaxcontroller/update_product_price') ?>",
          type: "POST",        
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,  
          success: function(data){
            $('#updprice'+qq).html();
            $('#updprice'+qq).html(data);
            //alert(data);
    
         }  
         });  
    }));

</script>