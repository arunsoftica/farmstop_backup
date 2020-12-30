<script type="text/javascript" src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>

<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Search By Product</h4>
    				<div class="add-items d-flex">
    				    
                        <form role="form" class="w-100" id="product_inventory_report" enctype="multipart/form-data" method="post">
                    	 <div class="row">
                       <div class="form-group col-md-6">
                       <h4>Select Product Category</h4>
                       <select name="product" id="product" class="form-control" required>
                        <option value="">Select</option>
                        <?php
                        foreach($products as $prod){ ?>
                         <option value="<?php echo $prod['id']; ?>"><?php echo $prod['title']; ?></option>
                       <?php }
                    
                        ?>
                       </select>
                       </div>
                       <div class="form-group col-md-6">
                       <h4>Select Product</h4>
                       <select name="product_attr" id="product_attr" class="form-control" required>
                        <option value="">Select</option>
                        
                       </select>
                       </div>
                       
                       
                       </div>
                       <div class="row">
                        <div class="form-group col-md-4">
                        <h4>Product Attribute Value</h4>
                        <select name="pro_attr_val" id="pro_attr_val" class="form-control">
                        <option value="">Select</option>  
                    
                        </select>
                        
                       </div>
                       <div class="form-group col-md-4">
                        <h4>From Date</h4>
                        <input type="text" name="fdate" id="date1" data-select="datepicker" class="form-control" readonly>
                       <span class="input-group-btn btndatapicker"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="icon ion-md-calendar"></i></button></span>
                       </div>
                       <div class="form-group col-md-4">
                           
                        <h4>To Date</h4>
                        <input type="text" name="tdate" id="date2" data-select="datepicker" class="form-control" readonly>
                       <span class="input-group-btn btndatapicker"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="icon ion-md-calendar"></i></button></span>
                       </div>
                       
                       </div>
                       
                       
                       <div class="row">
                       <div class="form-group col-md-4">
                       <button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>
                       <p id="response_edit"></p>
                       </div>
                       </div>
                       
                       </form>
    				</div>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                                            <table class="table dataTable no-footer" id="example">
                                                <thead>
                           <th>#</th>
                           <th>Date</th>
                           <th>Product Name</th>
                           <th>Product Category</th>
                           <th>Product Entry</th>
                           <th>Sell Product</th>
                         </thead>
                         
                         <tbody>
                          <?php 
                            $count = 0;
                            if(count($productReport) > 0){
                            foreach($productReport as $report){ ?>
                             <tr>
                               <td><?php echo $count = $count + 1; ?></td>
                               <td><?php echo $report['date']; ?></td>
                               <td><?php echo $report['attribute_name'].' ('.$report['attr_value'].')';?></td>
                               <td><?php echo $report['pro_title']; ?></td>
                               <td><?php echo $total_product[] = $report['update_product']; ?></td>
                               
                               <td><?php echo $sell_product[] = $report['sell_product']; ?></td>
                             </tr>
                    
                    
                           <?php }  ?>
                                
                              <td colspan="4">Total</td>  
                              <td><?php echo array_sum($total_product) ?></td>
                              
                              <td><?php echo array_sum($sell_product) ?></td>
                              
                                
                                
                                
                                
                           <?php } else {
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
<script>
  $(document).on('change', '#product', function (e) {
        //alert('hello');
            var proid = $(this).val();
            
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/get_product_attribute") ?>",
                data: {proid:proid},
                success: function (data) {
                    //alert(data);
                    //$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'your stylesheet url') );
                    
                    $('#product_attr').empty();
                    $('#product_attr').html();

                    $('#product_attr').html(data);

                }
            });
        });
  $(document).on('change', '#product_attr', function (e) {
        //alert('hello');
            var attrid = $(this).val();
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/get_attribute_value") ?>",
                data: {attrid:attrid},
                success: function (data) {
                    
                   var parseJson = jQuery.parseJSON(data);
                    
                    html_content = '';
                    html_content += '<option value="">Select</option>';
                    $.each(parseJson.attribute_value , function(index , value){
                       html_content += '<option value="'+value['id']+'">'+value['weight']+'</option>';
                    });
                    $('#pro_attr_val').empty();
                    $('#pro_attr_val').html(html_content);
                }
            });
            
        });

  $(document).on('submit','#product_inventory',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_product_inventory",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#product_inventory")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));
  
</script>