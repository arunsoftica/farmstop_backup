<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Shopping Cart</h2>
            </div>
        </div>
    </div>
</section>
<section>
    
<div class="container">
    <style>

    </style>
 <div class="row mt-3">
        <!--div class="col-sm-8 offset-sm-2 col-12">
            <div class="row m-0 mb-3 bg-inner">
              <div class="col-3">
                  <div class="">
                      <img src="https://www.test.farmstop.in/teao/uploads/product_variation_images/10982494120187neelam0.png" class="img-fluid">
                    </div>
                    
    </div>
                <div class="col-9">
                  <div class="remove-cart-icon">
                      <button  type="button" class="itemdelete" value="" ><span>x</span></button>
                    </div>
                  <div class="product-name">
                      <span>Neelam Mango</span>
                    </div>
                    <p>3<span class="text-muted"> Kg</span></p>
                    <div class="my-3">
                      <span>Rs. 500</span>
                    </div>
                    <div class="quantity1 quantity">
                        <div>
                            <div class="btn-minus" id="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            
                            <input name="total_item[]" class="total_item1" value="1" readonly="">
                            <div class="btn-plus" id="btn-plus" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                    <div class="show-more-btn"><a href="#" class="color-text"><span class="change-text">Show Details</span></a></div>
    </div>
            </div>
            <div class="row m-0 mb-3 bg-inner">
              <div class="col-3">
                  <div class="">
                      <img src="https://www.test.farmstop.in/teao/uploads/product_variation_images/10982494120187neelam0.png" class="img-fluid">
                    </div>
                    
    </div>
                <div class="col-9">
                  <div class="remove-cart-icon">
                      <button  type="button" class="itemdelete" value="" ><span>x</span></button>
                    </div>
                  <div class="product-name">
                      <span>Neelam Mango</span>
                    </div>
                    <p>3<span class="text-muted"> Kg</span></p>
                    <div class="my-3">
                      <span>Rs. 500</span>
                    </div>
                    <div class="quantity1 quantity">
                        <div>
                            <div class="btn-minus" id="btn-minus" value="1"><span class="fa fa-minus"></span></div>
                            
                            <input name="total_item[]" class="total_item1" value="1" readonly="">
                            <div class="btn-plus" id="btn-plus" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                    <div class="show-more-btn"><a href="#" class="color-text"><span class="change-text">Show Details</span></a></div>
    </div>
            </div>
            <div class="bg-inner">
              <div class="align-div-right">
                  
                  <button class="btn bg-green" type="submit" name="submit" id="submit">Update Cart</button>
                    <span class="border-bottom-color"></span>
    </div>
                <div class="align-div-right mt-3">
                  <p>Sub-Total Rs. <span>50</span></p>
                    <p>Shipping Rs. <span>0</span></p>
                    <p class="color-total">Total Rs. <span>50</span></p>
    </div>
                <div class="proceed"><a href="#" class="btn green-btn">Proceed checkout</a>
    </div>
            </div>
        </div-->
        <div class="col-12">
            <div class="table-box table-responsive mb-3 mt-3">
                <form id="update_cart" method="post">
                <table class="table table-cart-div table-striped">
                    <thead>
                        <tr class="d-none table-sm-block">
                            <th scope="col"></th>
                            <th scope="col">Product</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody id="view_cart">
                        
                        
                        
                    </tbody>
                    
                </table>
                </form>
            </div>
        </div>
        <div class="col-12 mb-2 pb-5 mb-5">
            <div class="row">
                <!--div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div-->
                <!--div class="col-sm-12 col-md-6 text-right"-->
                    <div class="col-sm-12 col-md-3 offset-md-9">
                    <a href="<?php echo base_url('checkout') ?>" class="btn btn-block btn-success text-uppercase">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
 </section>   
<script >
$(document).ready(function(){
           
           var cart = 3;
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    if(data == 'no-item'){
                        $('#update_cart').empty();
                        $('#update_cart').html('<div class="text-center p-3"><p>There are no items in your shopping cart.</p><a href="shop" style="font-size:22px; color:#000;">Return to shop</a></div>');
                    }else{
                        $('#view_cart').empty();
                        $('#view_cart').html(data);
                    }
                    
                }
            });
    $(document).on('change', '.total_item', function (e) {
    if($(this).val() <= 0){
        $(this).val(1);
    }
    var ab = $(this).val();
    var a = $(this).parent().siblings('td').children('.total_prices').val();
    
    var aa = a * ab;
    $(this).parent().siblings('td').find('.total_price').val(aa);   
    });


   $(document).on('submit','#update_cart',(function(e){
    
    //$("#submit").addClass('disabled');
    //$("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/update_item_to_cart') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        
        //alert(data);
        alert('your cart updated successfully..');
        location.reload();

     }  
     });  
    }));
    $(document).on('click','#btn-plus',(function(e){
    
                
                var q = $(this).attr('value');
                var now = $(".quantity"+q+"> div > input").val();
                if ($.isNumeric(now)){
                    $(".quantity"+q+"> div > input").val(parseInt(now)+1);
                    var x = $(".quantity"+q+"> div > input").val();
                }else{
                    $(".quantity"+q+"> div > input").val("1");
                    var x = $(".quantity"+q+"> div > input").val();
                }
                
                
    var ab = x;
    //alert(ab);
    var a = $('.total_item'+q).parent().parent().parent().siblings('td').children('.total_prices').val();
    
    //alert(a);
    var aa = a * ab;
    //alert(aa);
    //alert($('.total_item').parent().siblings('td').find('.total_price').val());
    $('.total_item'+q).parent().parent().parent().siblings('td').find('.total_price').val(aa);
            
     
    }));
     $(document).on('click','#btn-minus',(function(e){
         
         var q = $(this).attr('value');
                //var now = $(".quantity > div > input").val();
                var now = $(".quantity"+q+"> div > input").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1 > 0){ now--;}
                    $(".quantity"+q+"> div > input").val(now);
                    var x = $(".quantity"+q+"> div > input").val();
                }else{
                    $(".quantity"+q+"> div > input").val("1");
                    var x = $(".quantity"+q+"> div > input").val();
                }
                var ab = x;
    //alert(ab);
    var a = $('.total_item'+q).parent().parent().parent().siblings('td').children('.total_prices').val();
    
    //alert(a);
    var aa = a * ab;
    //alert(aa);
    //alert($('.total_item').parent().siblings('td').find('.total_price').val());
    $('.total_item'+q).parent().parent().parent().siblings('td').find('.total_price').val(aa);
     }));
     $(document).on('click', '.itemdel', function (e) {
    
    var item_id = $(this).val();
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/delete_item_from_cart") ?>",
                data: {item_id:item_id},
                success: function (data) {
                    alert(data);
                    location.reload();
                    

                }
            });
    });
    
    
});
       
</script>