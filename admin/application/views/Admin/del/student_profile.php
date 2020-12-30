<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>

  <div class="col-lg-12">
        <h2 class="page-header">Student Profile<?php echo ' ('.$student['first_name'].' '.$student['middle_name'].' '.$student['last_name'].') ' ?></h2>
        <?php //echo $title; ?>
    </div>
  <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">

    <div class="col-lg-12">
      <div class="row">
   <div class="form-group col-md-2">
   <h4>Image</h4>
   </div>
   <div class="form-group col-md-4" >
    <?php
      if($student['image']){ ?>
        <img src="<?php echo base_url('uploads/student/'.$student['image']) ?>" height="120" width="120">
     <?php }else{
        echo 'No Image Found';
      }
    ?>
   
   </div>
 </div>
     <div class="row">
   <div class="form-group col-md-2">
   <h4>Name</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['first_name'].' '.$student['middle_name'].' '.$student['last_name'].'</h4>'; ?>
   </div>
   
   </div>
  
    <div class="row">
   <div class="form-group col-md-2">
   <h4>Mobile</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['mobile'].'</h4>'; ?>
   </div>
   
   </div>

    <div class="row">
   <div class="form-group col-md-2">
   <h4>Email</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['email'].'</h4>'; ?>
   </div>
   
   </div>

    <div class="row">
   <div class="form-group col-md-2" >
   <h4>Gender</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php 
   if($student['gender'] == 'm') echo '<h4>'.'Male'.'</h4>'; else echo '<h4>'.'Female'.'</h4>';
   
   ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Date of Birth</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['dob'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Address</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['address1'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Class</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['classname'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Subject</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php //echo '<h4>'.$student['subject'].'</h4>'; ?>
   <?php
        $subid = explode('@',$student['subject']);
        $k = 0;
        foreach($subid as $sub){
                 $subdetail[] = $model1->getsubject($subid[$k]);
                 $subname[] = $subdetail[$k]['subject_name'];
            $k = $k + 1;     
        }
        echo '<h4>'.implode(',',$subname).'<h4>';
        

   ?>
   </div>
   
   </div>

   
   
   <div class="row">
   <div class="form-group col-md-2">
   <h4>Registration Date Time</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$student['created_at'].'</h4>'; ?>
   </div>
   
   </div>


    </div>



    </div>
    </div>
    </div>
    </div>
  </div>




</div>
</div>


<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
