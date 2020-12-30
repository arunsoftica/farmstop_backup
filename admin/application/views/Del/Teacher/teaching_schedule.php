<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Teaching Schedule Report</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    
    <div class="row">
    <!--<a href="<?php echo base_url() ?>/export">Export to Excel</a>-->
    
    <table class="table">
     <thead>
       <th>#</th>
       <th>Student</th>
       <th>Subject</th>
       <th>TimeSlot</th>
       <th>Status</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($schedule) > 0){
        foreach($schedule as $sch){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           
           
           <td><?php echo $sch['fname'].' '.$sch['mname'].' '.$sch['lname']; ?></td>
           <td><?php echo $sch['subjectname']; ?></td>
           <td><?php echo $sch['t1'].'-'.$sch['t2']; ?></td>
           <td><?php echo $sch['current_status']; ?></td>
           
           




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