<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Submit Attendence</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="submit_attendence" method="post">

    

   <div class="row">
    <div class="form-group col-md-3">
   <h4>Click here to submit your attendence</h4>
   
   </div>
   <div class="form-group col-md-9">
   <?php
    if($present == 1){ ?>
         
         <button type="button"  class="btn btn-primary" style="font-size:18px;" disabled>I am present</button>
   <?php }else{ ?>
   <button type="submit" name="submit" value="submit" class="btn btn-primary" style="font-size:18px;" >I am present</button>
  <?php }
   ?>
   
   </div>
   
   </div> 

    </form>
    <div class="row">
    <!--<a href="<?php echo base_url() ?>/export">Export to Excel</a>-->
    <center><h4>Daily Attendence Report</h4></center>
    <table class="table">
     <thead>
       <th>#</th>
       <th>Month</th>
       <th>Year</th>
       <th>Present/Absent</th>
       <th>Date Time</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($attendence) > 0){
        foreach($attendence as $att){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           
           
           <td><?php echo $att['month']; ?></td>
           <td><?php echo $att['year']; ?></td>
           <td><?php 
           if($att['present'] == 1) echo 'Present'; else echo 'Absent';
           ?></td>
           <td><?php echo $att['created_at']; ?></td>
           




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

</div>
</div>