<section class="m-0">
<div class="row m-0">
         <div class="main-banner" style="position: relative;background: #000;">
            <img class="img-fluid" src="assets/img/banner.jpg" style=" width:100%;max-height: 200px;
    opacity: 0.6;"  />
    		<div class="sidemenu-row mb-2 mt-2">
          	 <ul class="sidmenu">
                      <li><a href="#">Home</a> / </li>
                      <li class="active">Order History</li>
                    </ul>
          </div>
        </div>
</div>
</section>
	<section>
    	<div class="container-fluid">
        	<div class="row mt-3 mb-3">
            	<div class="col-sm-3">
                	<div class="account-sidemenu mb-3">
                	<div class="list-group">
    <a href="<?php echo base_url('my-account') ?>" class="list-group-item list-group-item-action active">
        <i class="fa fa-user"></i> My Profile
    </a>
    
    <a href="<?php echo base_url('order-list') ?>" class="list-group-item list-group-item-action">
        Order History 
    </a>
   <a href="<?php echo base_url('wishlist') ?>" class="list-group-item list-group-item-action">
        Wishlist
    </a>
</div>
					</div>
                    <div class="">
                    </div>
                </div>
                <div class="col-sm-9">
                	<div class="acct-head">
                	<h2>Order History</h2>
                    	<div class="table-box table-responsive mb-3 mt-3">
                <form id="update_cart" method="post">
                <table class="table table-cart-div table-striped">
                    <thead>
                        <tr class="d-none table-sm-block">
                            
                            
                            <th>#</th>
                           <th>Order No.</th>
                           <th>View Invoice</th>
                           <th>Product Detail</th>
                           <th>Sub Total</th>
                           <th>Shipping Cost</th>
                           <th>Total Cost</th>
                           <th>Transaction Id</th>
                           <th>Payment Status</th>
                           <th>Delivery Status</th>
                           <th>Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>                            
                        <?php 
                        $count = 0;
                        if(count($orders) > 0){
                        foreach($orders as $order){ 
                        $get_cart_items = $this->Adminmodel->getCartItems($order['id']);
                        if($get_cart_items != FALSE){
                        ?>
              			<tr>
              				<td data-title="#"><?php echo $count = $count + 1; ?></td>
                            <td data-title="Order No."><?php echo $order['order_no']; ?></td>
                            <td data-title="View Invoice"><a href="<?php echo base_url('user_invoice?i='.$order['id']) ?>">View</a></td>
                            <td data-title="Product Detail">
                                <?php
                                
                                foreach($get_cart_items as $get_cart_itemz){
        echo $get_cart_itemz['attributename'].'('.$get_cart_itemz['attribute_value'].') ✘' .$get_cart_itemz['total_item'].'  Rs.'.$get_cart_itemz['saleprice']*$get_cart_itemz['total_item'].' <br/>';
        }
                                ?>
                            </td>
                            <td data-title="Sub Total"><?php echo $sub_total[]=$order['sub_total_cost']; ?></td>
                            <td data-title="Shipping Cost"><?php echo $shipping_total[]=$order['shipping_cost']; ?></td>
                            <td data-title="Total Cost"><?php echo $total[]=$order['total_cost']; ?></td>
                            <td data-title="Transaction Id"><?php echo $order['transaction_id']; ?></td>
                            <td data-title="Payment Status"><?php if($order['status'] == 1) echo 'Paid'; else echo 'Unpaid'; ?></td>
                            <td data-title="Delivery Status"></td>
                            <td data-title="Date"><?php echo $order['date']; ?></td>
                        </tr>
                        <?php } } } else {
                            ?>
                            <tr>
                            <td colspan="10">No Record Found</td>     
                            </tr>
                          <?php } ?>
                        
            		</tbody>
                    
                </table>
                </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    $(document).ready(function(){
                    var sess_items  = "<?php echo $this->session->userdata('your_cart_item') ?>";
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/delete_session_item_cart") ?>",
                        data: {sess_items:sess_items},
                        success: function (data) { 
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
                    
    });
    
 </script>