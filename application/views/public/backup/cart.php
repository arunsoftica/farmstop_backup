<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="assets/img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li class="active">Shopping Cart</li>
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
                <form id="update_cart" method="post">
                <table class="table table-cart-div table-striped">
                    <thead>
                        <tr class="d-none table-sm-block">
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody id="view_cart">
                        
                        
                        
                    </tbody>
                    
                </table>
                </form>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <!--div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div-->
                <!--div class="col-sm-12 col-md-6 text-right"-->
                    <div class="col-sm-12 col-md-6 text-right offset-6">
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
                        $('#update_cart').html('There are no items in your shopping cart.<br><br><a href="shop">Return to shop</a>');
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