<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			     <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">User order</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer checkbox-table" id="example">
                        <thead>
                            <th><input type="checkbox" /> All</th>
       <th>#</th>
       <th>Order No.</th>
       <th>User Name</th>
       <th>View Detail</th>
       <!--th>Sub Total</th>
       <th>Shipping Cost</th-->
       <th>Total Cost</th>
       <th>Transaction Id</th>
       <th>Delivery Status</th>
       <th>Action</th>
       <th>Date</th>
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
             <td><input type="checkbox" /></td>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $order['order_no']; ?></td>
           <td><?php 
           $uname = $model2->getUserName($order['user_id'],$order['user_type']);
           echo $uname['name'];
           
           
           ?></td>
           <td><a href="<?php echo base_url('user_invoice?i='.$order['id']) ?>">View</a></td>
           <!--td><?php //echo $sub_total[]=$order['sub_total_cost']; ?></td>
           <td><?php //echo $shipping_total[]=$order['shipping_cost']; ?></td-->
           <td><?php echo $total[]=$order['total_cost']; ?></td>
           <td><?php echo $order['transaction_id']; ?></td>
           <td>
               <select name="status" class="status" class="form-control">
                   <option value="0,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 0){ echo 'selected'; }   ?>>Pending Payment</option>
                   <option value="1,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 1){ echo 'selected'; }   ?>>Processing</option>
                   <option value="2,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 2){ echo 'selected'; }   ?>>On Hold</option>
                   <option value="3,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 3){ echo 'selected'; }   ?>>Dispatched</option>
                   <option value="4,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 4){ echo 'selected'; }   ?>>Completed</option>
                   <option value="5,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 5){ echo 'selected'; }   ?>>Cancelled</option>
                   <option value="6,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 6){ echo 'selected'; }   ?>>Refunded</option>
                   <option value="7,<?php echo $order['id'].','.$uname['email'].','.$uname['name'].','.$order['order_no'].','.$order['user_type'].','.$order['user_id'].','.$uname['mobile'] ?>" <?php if($order['order_status'] == 7){ echo 'selected'; }   ?>>Failed</option>
                   
                   
               </select>
               </td>
               <td><label class="badge badge-info" data-toggle="modal" data-target="#Onhold">On hold</label> <label class="badge badge-danger">Pending</label> <label class="badge badge-success">Closed</label> <label class="badge badge-warning">Processing</label></td>
           <td><?php echo $order['date']; ?></td>
         </tr>


       <?php } } ?>
          <td colspan="4">Total Amount:</td>
          <!--td><?php //echo array_sum($sub_total); ?></td>
          <td><?php //echo array_sum($shipping_total); ?></td-->
          <td><?php echo array_sum($total); ?></td>
          <td colspan="3"></td>
            
            
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
<!-- Modal -->
<div id="Onhold" class="modal fade" role="dialog">
  <div class="modal-dialog">
        
    <!-- Modal content-->
    <div class="modal-content">
      <button type="button" class="close btn-close-pop" data-dismiss="modal">&times;</button>
      <div class="modal-body">
          
        <p>Some text in the modal.</p>
      </div>
    </div>

  </div>
</div>


<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script>
    $(".checkbox-table thead tr th:first input:checkbox").click(function () {
    var checkedStatus = this.checked;
    $(".checkbox-table tbody tr td:first-child input:checkbox").each(function () {
        this.checked = checkedStatus;
        //$(this).parent().parent().addClass('selectedas');
        //$('input[name=checkit]:checked').parent().parent();
    });
});
</script>
<script type="text/javascript">
 $(document).on('change', '.status', function (e) {
     
     var status_val = $(this).val();
     $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/updateOrderStatus") ?>",
                data: {status_val:status_val},
                success: function (data) {
                    
                    alert(data);
                    location.reload();
                }
            });
 });

</script>