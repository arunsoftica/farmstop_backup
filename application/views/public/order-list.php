<?php
if(isset($_SESSION['login_id'])){ ?>
<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Order History</h2>
            </div>
        </div>
    </div>
</section>
	<section>
    	<div class="container">
        	<div class="row mt-3 mb-3">
            	<div class="col-sm-2 d-none d-sm-block">
                	<div class="account-sidemenu mb-3">
                	<div class="list-group">
     <a href="<?php echo base_url('my-account') ?>" class="list-group-item list-group-item-action"><i class="far fa-user"></i> My Profile
    </a>
    
    <a href="<?php echo base_url('order-list') ?>" class="list-group-item list-group-item-action active"><i class="fas fa-archive"></i> Order History 
    </a>
   <a href="<?php echo base_url('wishlist') ?>" class="list-group-item list-group-item-action"><i class="far fa-heart"></i> Wishlist
    </a>
</div>
					</div>
                    <div class="">
                    </div>
                </div>
                <div class="col-sm-10">
                	<div class="acct-head">
                    	<div class="table-box table-responsive mb-3">
                <form id="update_cart" method="post">
                <table class="table table-cart-div table-striped">
                    <thead>
                        <tr class="d-none table-sm-block" >
                           <th><b></b>Order No.</th>
                           
                           <th>Product Detail</th>
                           <th>Total Amount</th>
                           <th>Payment Status</th>
                           <th>Order Status</th>
                           <th>Invoice</th>
                           <th>Track your order</th>
                           <th>Order Date</th>
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
                            <td data-title="Order No."><?php echo $order['order_no']; ?></td>
                            <td class="widthproductdes" data-title="Product Detail">
                                <?php
                                
                                foreach($get_cart_items as $get_cart_itemz){
                                    if($get_cart_itemz['saleprice'] == '0.00'){
                                        $saleprice = $get_cart_itemz['regularprice'];
                                    }else{
                                        $saleprice = $get_cart_itemz['saleprice'];
                                    }
        echo $get_cart_itemz['attributename'].'('.$get_cart_itemz['attribute_value'].') ✘' .$get_cart_itemz['total_item'].'  Rs.'.$saleprice*$get_cart_itemz['total_item'].' <br/>';
        }
                                ?>
                            </td>
                            <td data-title="Total Amount"><?php echo $total[]=$order['total_cost']; ?></td>
                            <!--<td data-title="Transaction Id"><?php echo $order['transaction_id']; ?></td>-->
                            <td data-title="Payment Status"><?php if($order['status'] == 1) echo 'Paid'; else echo 'Unpaid'; ?></td>
                            <td data-title="Order Status">
                                <?php
                                if($order['order_status'] == 0) echo 'Pending Payment';
                                if($order['order_status'] == 1) echo 'Processing';
                                if($order['order_status'] == 2) echo 'Hold';
                                if($order['order_status'] == 3) echo 'Dispatched';
                                if($order['order_status'] == 4) echo 'Completed';
                                if($order['order_status'] == 5) echo 'Cancelled';
                                if($order['order_status'] == 6) echo 'Refunded Payment';
                                if($order['order_status'] == 7) echo 'Failed';
                                ?>
                            </td>
                            <td data-title="Invoice"><a href="<?php echo base_url('user_invoice?i='.$order['id']) ?>">View</a></td>
                            <td data-title="Tracking Id"><a href="<?php echo base_url('tracking?i='.$order['id']) ?>">View</a></td>
                            <td data-title="Order Date"><?php echo $order['date']; ?></td>
                        </tr>
                        <?php } } } else {
                            ?>
                            <tr>
                            <td colspan="11">No Record Found</td>     
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
                    var sess_items  = "<?php echo $afterpay; ?>";
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
 <?php } else { $this->load->view('public/login'); } ?>