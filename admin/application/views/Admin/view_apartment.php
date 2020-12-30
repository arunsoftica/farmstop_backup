<div class="content-wrapper">
    <div class="row">
    	<div class="col-lg-12">
    		<div class="card px-3">
    			<div class="card-body">
    			      <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    				<h4 class="card-title">View Apartment</h4>
    				<div class="add-items d-flex">
    				    <div class="table-responsive">
                        <table class="table dataTable no-footer" id="example">
                            <thead>
       <th>#</th>
       <th>Action</th>
       <th>Apartment</th>
       <th>Zone</th>
       <th>Delivery Days</th>
       <th>Location</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($apartments) > 0){
        foreach($apartments as $cat){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td>
               <a href="<?php echo base_url('view_apartment?delapm='.$cat['id']) ?>">Delete</a>
           </td>
           
           <td><?php echo $cat['apartment']; ?></td>
           <td><?php echo $cat['zone_name']; ?></td>
           <td><?php 
              $dds = explode('@',$cat['delivery_days']);
              foreach($dds as $ds){
                  if($ds == 1) echo 'Sunday-';
                  else if($ds == 2) echo 'Monday-';
                  else if($ds == 3) echo 'Tuesday-';
                  else if($ds == 4) echo 'Wednesday-';
                  else if($ds == 5) echo 'Thursday-';
                  else if($ds == 6) echo 'Friday-';
                  else if($ds == 7) echo 'Saturday';
              }
           ?></td>
           <td><?php echo $cat['location']; ?></td>
           
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

<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">View Apartment</h2>
        <?php //echo $title; ?>
    </div>
  <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">

    <div class="col-lg-12">
   <!-- <form role="form" id="view_teachers" method="post"> -->
    <div class="row">
      
    
    <table class="table" id="example">
     <thead>
       <th>#</th>
       <th>Action</th>
       <th>Apartment</th>
       <th>Zone</th>
       <th>Delivery Days</th>
       <th>Location</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($apartments) > 0){
        foreach($apartments as $cat){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td>
               <a href="<?php echo base_url('view_apartment?delapm='.$cat['id']) ?>">Delete</a>
           </td>
           
           <td><?php echo $cat['apartment']; ?></td>
           <td><?php echo $cat['zone_name']; ?></td>
           <td><?php 
              $dds = explode('@',$cat['delivery_days']);
              foreach($dds as $ds){
                  if($ds == 1) echo 'Sunday-';
                  else if($ds == 2) echo 'Monday-';
                  else if($ds == 3) echo 'Tuesday-';
                  else if($ds == 4) echo 'Wednesday-';
                  else if($ds == 5) echo 'Thursday-';
                  else if($ds == 6) echo 'Friday-';
                  else if($ds == 7) echo 'Saturday';
              }
           ?></td>
           <td><?php echo $cat['location']; ?></td>
           
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

   <!-- </form> -->
    </div>



    </div>
    </div>
    </div>
    </div>
  </div>




</div>
</div>


<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript">


</script>