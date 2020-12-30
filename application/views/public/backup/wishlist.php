
<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li class="active">Wish List Product</li>
                    </ul>
          </div>
        </div>
</div>
</section>


<section>
<div class="container">
 <div class="row">
        <div class="col-12">
            <div class="table-box table-responsive mb-3 mt-3">
                
                    
                <table class="table table-striped">
                    <thead>
                        <tr class="d-none table-sm-block">
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>                            
                        <?php
                        $ct = 0;
                        if(isset($wishlist)){
                        foreach($wishlist as $wlist){
                            
                            $mPrice = $model2->getMinMaxPrice($wlist['product_variation_id']);
                        ?>
                        <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                        <tr>
                            
                            <td><img class="img-table img-fluid" src="<?php echo base_url('teao/uploads/product_images/'.$wlist['image']) ?>"> </td>
                            <td><?php echo $wlist['attributename'] ?></td>
                            <td><?php echo 'Rs. '.$mPrice['minsp'] ?></td>
                            
                            <td class="text-right">
                            	<button type="button" class="btn btn-sm btn-danger witemdel" value="<?php echo $wlist['product_variation_id'] ?>"><i class="fa fa-trash"></i> </button>&nbsp;
                            	<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal<?php echo $wlist['product_variation_id']; ?>" ><i class="fa fa-shopping-cart"></i> </button>
                            </td>
                       </tr>
                       <!-- The Modal -->
<div class="modal" id="myModal<?php echo $wlist['product_variation_id']; ?>">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $wlist['attributename'] ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form class="add_cart" did="<?php echo $ct; ?>" method="post">
          <input type="hidden" name="attribute_id" value="<?php echo $wlist['product_variation_id'] ?>">
            <div class="row m-0">
                <div class="col-sm-5 col-4">
                    <div class="p-1 mt-4">
                    <img src="<?php echo base_url('teao/uploads/product_images/'.$wlist['image']) ?>" class="img-responsive img-fluid" alt="">
                    </div>
                </div>
                <div class="col-sm-7 col-8">
                    <div class="p-3">
                        <div class="padding-heading-top">
           		        <h4><?php echo $wlist['attributename'] ?></h4>
           		   </div>
           		        <div class=" mb-2 mt-2">
           		            <?php $vardetail = $model2->getVariationDetail($wlist['product_variation_id']); ?>
           		        <p>Weight:</p>
                                    <p>
                                    	<select name="aprice" class="aprice" required>
                                    		<option value="">Select</option>
                                    		<?php
                                            foreach($vardetail as $vdet){ 
                                    
                                             echo '<option value="'.$vdet['regular_price'].'-'.$vdet['sale_price'].'-'.$vdet['weight'].'-'.$vdet['id'].'">'.$vdet['weight'].' Rs.'.$vdet['sale_price'].'</option>';
                                            }
                                    
                                    		?>
                                    	</select>
                                    </p>
           		   </div>
           		        <div class="product_stock mb-2 mt-2">
                                        <div class="quantity1 quantity">
                        <h6 class="title-attr"><small>Quantity</small></h6>                    
                        <div>
                            <div class="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            <input name="nitem" id="nitem" value="1" />
                            <div class="btn-plus" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>    
                                    </div>
                        <div class="mb-2 mt-4 submit">
                        
                        <button type="submit" id="submit" class="btn btn-primary  btn-cart">Add to Cart</button>
                        
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <p id="response_edit"></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>
<!-- The Modal -->
                       <?php $ct = $ct + 1; }}else{ echo '<tr><td colspan="4">Please login to add product in your wishlist.</td></tr>'; } ?>
              
            </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>
 </section> 
 
 <script>
 $(document).ready(function(){
     $(document).on('click', '.witemdel', function (e) {
        //alert($("#wlist").val());
        var v = $(this).val();
        
        var u = $("#userid").val();
        
        if(u != ''){
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/remove_from_wishlist") ?>",
                data: {v:v,u:u},
                success: function (data) {
                   alert(data);
                   location.reload();
                    

                }
            });
            
        }else{
            alert('Please login to add product in your wishlist');
        }
            
            
        });
        $(document).on('change', '.aprice', function (e) {
        
        var str = $(this).val();
        var res = str.split("-");
        var v = res[3];
        /*$(this).parent().siblings('.rpsp').html();
        $(this).parent().siblings('.rpsp').html('Sale Price: '+res[1]);*/
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("Ajaxcontroller/getSatusOfProduct") ?>",
            data: {v:v},
            success: function (data) {
               if(data == 'out'){
                   $('.submit').empty();
                   $('.submit').html('Product is out of stock.');
               }else if(data == 'in'){
                   
               }else if(data == 'not'){
                   $('.submit').empty();
                   $('.submit').html('Product is not available in stock.');
               }
                

            }
        });
            
        });
        
    $(document).on('submit','.add_cart',(function(e){
        
        var qq = $(this).attr('did');
        $('#response_edit').html(" ");
        $("#submit").addClass('disabled');
        $("#submit").text('please wait....'); 
        e.preventDefault();
          $.ajax({
          url: "<?php echo base_url('Ajaxcontroller/add_item_to_cart') ?>",
          type: "POST",        
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData:false,  
          success: function(data){
            
            //$('#response_edit').html(data);
            //alert(qq);
            $(".add_cart")[qq].reset();
            //$("#submit").removeClass("disabled");
            //$("#submit").text('Add to Cart');
            alert('this item added in your cart successfully..');
            //location.reload();
            var cart = 1;
                                    
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    $('#items').empty();
                    $('#items').append(data);
                }
            });
    
         }  
         });  
    }));
 });
 </script>
