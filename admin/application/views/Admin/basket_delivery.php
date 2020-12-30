<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">Basket Delivery</h4>
    				<form method="get" action="basket_delivery">
                   <div class="row mb-3">
                       <div class="col-lg-6">
                           <input type="date" name="fdate" class="form-control" style="height:40px;">
                       </div>
                       
                       <div class="col-lg-3">
                           <button type="submit"  class="search btn btn-primary">Search</button>
                       </div>
                   </div>
                   </form>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
    				        <table class="table" id="example" data-page-length='100'>
     <thead>
       <th>#</th>
       <th>Order Id</th>
       <th>User Name</th>
       <th>Product Name</th>
       <th>Status</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(isset($borders) && count($borders) > 0){
        foreach($borders as $order){ 
         
         $edate = date('Y-m-d', strtotime("+3 months", strtotime($order['date'])));
         $tday = date("l",strtotime($_GET['fdate']));
         $oday = date("l",strtotime($order['date']));
         $dday = '';
         if($order['date'] <= $_GET['fdate'] && $_GET['fdate'] <= $edate){
            if($oday == 'Sunday') $dday = 'Tuesday';
            else if($oday == 'Monday') $dday = 'Thursday';
            else if($oday == 'Tuesday') $dday = 'Thursday';
            else if($oday == 'Wednesday') $dday = 'Saturday';
            else if($oday == 'Thursday') $dday = 'Saturday';
            else if($oday == 'Friday') $dday = 'Tuesday';
            else if($oday == 'Saturday') $dday = 'Tuesday';
             
         }
         if($tday == $dday){
        ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $order['order_no']; ?></td>
           <td><?php 
           $uname = $model2->getUserName($order['user_id'],$order['user_type']);
           echo $uname['name'];
           
           
           ?></td>
           <td><?php echo $order['attribute_name']; ?></td>
           <td>
               <?php $cbds = $model2->checkBasketDeliveryStatus('1@'.$order['pvid'].'@'.$order['vid'].'@'.$order['order_no'].'@'.$order['id']); ?>
               <?php if($cbds != FALSE){ echo 'Delivered'; }else{ ?>
               <select class="ostatus" >
                  <option value="">Select</option>
                  <option value="1@<?php echo $order['pvid'].'@'.$order['vid'].'@'.$order['order_no'].'@'.$order['id'] ?>">Delivered</option>
                  
               </select>
               <?php } ?>
               
           </td>
           
           
      <?php } }} ?>
     </tbody>
   </table>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<!--<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">Basket Delivery</h2>
    </div>
  <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">

    <div class="col-lg-12">
   <form method="get" action="basket_delivery">
   <div class="row">
       <div class="col-lg-3">
           <input type="date" name="fdate" class="form-control" >
       </div>
       
       <div class="col-lg-3">
           <button type="submit"  class="search btn btn-primary">Search</button>
       </div>
   </div>
   </form>
    <div class="row">
      
    
    <table class="table" id="example" data-page-length='100'>
     <thead>
       <th>#</th>
       <th>Order Id</th>
       <th>User Name</th>
       <th>Product Name</th>
       <th>Status</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(isset($borders) && count($borders) > 0){
        foreach($borders as $order){ 
         
         $edate = date('Y-m-d', strtotime("+3 months", strtotime($order['date'])));
         $tday = date("l",strtotime($_GET['fdate']));
         $oday = date("l",strtotime($order['date']));
         $dday = '';
         if($order['date'] <= $_GET['fdate'] && $_GET['fdate'] <= $edate){
            if($oday == 'Sunday') $dday = 'Tuesday';
            else if($oday == 'Monday') $dday = 'Thursday';
            else if($oday == 'Tuesday') $dday = 'Thursday';
            else if($oday == 'Wednesday') $dday = 'Saturday';
            else if($oday == 'Thursday') $dday = 'Saturday';
            else if($oday == 'Friday') $dday = 'Tuesday';
            else if($oday == 'Saturday') $dday = 'Tuesday';
             
         }
         if($tday == $dday){
        ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $order['order_no']; ?></td>
           <td><?php 
           $uname = $model2->getUserName($order['user_id'],$order['user_type']);
           echo $uname['name'];
           
           
           ?></td>
           <td><?php echo $order['attribute_name']; ?></td>
           <td>
               <?php $cbds = $model2->checkBasketDeliveryStatus('1@'.$order['pvid'].'@'.$order['vid'].'@'.$order['order_no'].'@'.$order['id']); ?>
               <?php if($cbds != FALSE){ echo 'Delivered'; }else{ ?>
               <select class="ostatus" >
                  <option value="">Select</option>
                  <option value="1@<?php echo $order['pvid'].'@'.$order['vid'].'@'.$order['order_no'].'@'.$order['id'] ?>">Delivered</option>
                  
               </select>
               <?php } ?>
               
           </td>
           
           
      <?php } }} ?>
     </tbody>
   </table>

    </div>
    </div>



    </div>
    </div>
    </div>
    </div>
  </div>




</div>
</div>-->


<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).on('change', '.ostatus', function (e) {
     
     var status_val = $(this).val();
     $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/updateBasketDeliveryStatus") ?>",
                data: {status_val:status_val},
                success: function (data) {
                    
                    alert(data);
                    location.reload();
                }
            });
 });
 
 $(document).on('change', '.product', function (e) {
     
     var pro = $(this).val();
     $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/getProductVariations") ?>",
                data: {pro:pro},
                success: function (data) {
                    
                    
                    $('.variation').html();
                    $('.variation').html(data);
                }
            });
 });

</script>