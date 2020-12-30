
<?php
if(!isset($_SESSION['login_id'])){

$this->load->view('public/login');

 } else { ?> 
	<section class="heading-bar">
    	<div class="container">
        	<div class="row my-5 pb-5">
                <div class="col-sm-6 offset-sm-3">
                    <div class=" text-center">
  <h1 class="display-4">Thank you <?php echo $get_user_details["name"]; ?>!</h1>
  <p class="lead"><strong>Your order has been received</strong> 
Order Number #<?php echo $invoice_details["oid"] ?></p>
<?php
if($invoice_details['payment_option'] == '1' || $invoice_details['payment_option'] == '4'){
                 $pay_method = 'Credit Card/Debit Card/NetBanking';
            }else if($invoice_details['payment_option'] == '2'){
                 $pay_method = 'Cash on delivery';
            }

?>
  <div class="right-table-stru">
                    <table class="table" id="cartitem" border="0"> 
                    <tr>
                        <td colspan="2" align="left" style="background: #c1c1c16e; padding:5px;"><p><span class="d-block"><?php echo $get_user_details["name"]; ?></span><span class="d-block"><?php echo $get_user_details["email"]; ?></span>
<span class="d-block"><?php echo $invoice_details["uaddress"] ?></span>
<span class="d-block"><?php echo $invoice_details["udistrict"] ?></span>
<span class="d-block">India-<?php echo $invoice_details["uzipcode"] ?></span></p></td>
                        <td align="right" style="background: #c1c1c16e;padding:5px;"><p>Rs: <span style="font-size:22px;font-weight:700;"><?php echo $invoice_details["total_cost"]; ?></span></p><p><?php echo $pay_method; ?></p></td>
                    </tr>
                    <?php
                        foreach($get_cart_items as $get_cart_itemz){ 
                       if($get_cart_itemz['saleprice'] == '0.00'){
                            $saleprice = $get_cart_itemz['regularprice'];
                        }else{
                            $saleprice = $get_cart_itemz['saleprice'];
                        }
                   ?>
                    <tr class="cart_item">
                        <td align="left">
                        <img width="70" src="<?php echo base_url('admin/uploads/product_variation_images/'.$get_cart_itemz['pfimage']) ?>" class="img-fluid" alt="">
                        </td>
						<td class="product-weight">
						    <p><?php echo $get_cart_itemz["attributename"] ?></p>
						    <?php echo $get_cart_itemz["attribute_value"] ?>&nbsp;<strong class="product-quantity">× <?php echo $get_cart_itemz["total_item"] ?></strong>
						</td>
						<td align="right" class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ </span>
						<?php echo $saleprice*$get_cart_itemz["total_item"] ?> 
						</span></td>
					</tr>
					<?php } ?>
                    <tr class="cart-subtotal">
			<td align="right" colspan="2">Subtotal</td>
			<td align="right">
			    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ <?php echo $invoice_details["sub_total_cost"] ?></span>
			    </span>
			</td>
			    
		</tr>
		            <tr class="shipping">
        	<td align="right" colspan="2">Shipping</td>
        	<td align="right" data-title="Shipping">
					<p id="shippingcost">₹ <?php echo $invoice_details["shipping_cost"] ?></p></td>
        </tr>
        <?php if($invoice_details["coupon_id"] != ""){ ?>
        <tr class="discount">
        	<td align="right" colspan="2">Discount</td>
        	<td align="right" data-title="Discount">
					<p id="discountcost">₹ <?php
					$disval = $model2->getCouponDiscount($invoice_details["coupon_id"]);
					if($disval['code_type'] == 'p'){
					   $dval =  $disval['code_value'].'%';
					}else if($disval['code_type'] == 'a'){
					   $dval = '₹ '.$disval['code_value']; 
					}
					echo $dval; 
					?></p></td>
        </tr>
        <?php } ?>
               
		            <tr class="order-total">
			<td align="right" colspan="2">Order Total </td>
			<td align="right"><strong><span class="woocommerce-Price-amount amount" id="net_total"><span class="woocommerce-Price-currencySymbol">₹ </span><?php echo $invoice_details["total_cost"] ?></span></strong></td>
		</tr>
          </table>
                </div>
  <p class="lead">
    <a class="btn btn-success btn-sm" href="<?php echo base_url('shop');?>" >Return to Shop</a>
  </p>
  <p class="my-3">Please print this page for your reference</p>
  <button onclick="window.print()">Print</button>
</div>
                	
                </div>
            </div>
        </div>
    </section>
<script>
$(document).ready(function(){
    $(document).on('submit','#add_address',(function(e){
    
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/add_user_address') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //$("#register_user")[0].reset();
        alert(data);
        location.reload();
        
     }  
     });  
 }));
 
});
</script>
 
 <?php } ?>