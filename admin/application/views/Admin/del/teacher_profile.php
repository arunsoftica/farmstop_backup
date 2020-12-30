<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">Teacher Profile<?php echo ' ('.$teacher[0]['first_name'].' '.$teacher[0]['middle_name'].' '.$teacher[0]['last_name'].') ' ?></h2>
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
      if($teacher[0]['image']){ ?>
        <img src="<?php echo base_url('uploads/teacher/'.$teacher[0]['image']) ?>" height="120" width="120">
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
   <?php echo '<h4>'.$teacher[0]['first_name'].' '.$teacher[0]['middle_name'].' '.$teacher[0]['last_name'].'</h4>'; ?>
   </div>
   
   </div>
  
    <div class="row">
   <div class="form-group col-md-2">
   <h4>Mobile</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['mobile'].'</h4>'; ?>
   </div>
   
   </div>

    <div class="row">
   <div class="form-group col-md-2">
   <h4>Email</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['email'].'</h4>'; ?>
   </div>
   
   </div>

    <div class="row">
   <div class="form-group col-md-2" >
   <h4>Gender</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php 
   if($teacher[0]['gender'] == 'm') echo '<h4>'.'Male'.'</h4>'; else echo '<h4>'.'Female'.'</h4>';
   
   ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Date of Birth</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['dob'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Address</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['address1'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Qualification</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['qualification'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Class</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['classname'].'</h4>'; ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Subject</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php //echo '<h4>'.$teacher[0]['subject'].'</h4>'; ?>
   <?php
        $subid = explode('@',$teacher[0]['subject']);
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
   <h4>Class Range</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php 
   $sub = array();
   $subnm = array();
   $class_range = explode(',',$teacher[0]['class_range']);
   $i = 0;
   foreach($class_range as $crange){
         $sub[]= $model1->getclass($crange);
         $subnm[] = $sub[$i]['class_name'];
         $i = $i+1;
   }
   echo '<h4>'.implode(',',$subnm).'</h4>'; 
   ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Teaching Type</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php
      if($teacher[0]['teaching_type'] == 'm'){
         echo '<h4>Monthly</h4>';  
      }else if($teacher[0]['teaching_type'] == 'l'){
         echo '<h4>Lecture Based</h4>';
      }
     ?>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-2">
   <h4>Experience</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['experience'].' years'.'</h4>'; ?>
   </div>
   
   </div>
   
   <div class="row">
   <div class="form-group col-md-2">
   <h4>Registration Date Time</h4>
   </div>
   <div class="form-group col-md-4" style="background-color:pink;">
   <?php echo '<h4>'.$teacher[0]['created_at'].'</h4>'; ?>
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
