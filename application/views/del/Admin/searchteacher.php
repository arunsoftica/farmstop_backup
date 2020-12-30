<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Search Teacher</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="search_teacher" method="post">

   <div class="row">
    <div class="form-group col-md-4">
      <h4>Select Distance</h4>
      <select name="distance" class="form-control">
      <option value="">Select</option>
      <option value="1000">1 km</option>
      <option value="2000">2 km</option>
      <option value="3000">3 km</option>
      <option value="4000">4 km</option>
      <option value="5000">5 km</option>
      <option value="6000">6 km</option>
      <option value="7000">7 km</option>
      <option value="8000">8 km</option>
      <option value="9000">9 km</option>
      <option value="10000">10 km</option>
    </select>
    </div>
   <div class="form-group col-md-4">
    <h4>Select Student</h4>
    <select name="student" class="form-control">
      <option value="">Select Student</option>
     <?php foreach($student as $stu){ ?>

      <option value="<?php echo $stu['latitude'].','.$stu['longitude']; ?>"><?php echo $stu['first_name'].' '.$stu['middle_name'].' '.$stu['last_name']; ?></option>

    <?php } ?>

    </select>
    </div>
   
   </div> 

   <div class="row">
   
    <div class="form-group col-md-4">
    <button type="submit" name="submit" class="btn btn-primary">Search</button>
    </div>
   
   </div> 

   <div class="row">
   <table class="table">
     <tr>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>DOB</th>
       <th>Speciality(Class)</th>
       <th>Speciality(Subjects)</th>
     </tr>
     <?php
     
      if($teachers != FALSE){
      foreach($teachers as $teacher){ ?>
     <tr>
      <td><?php echo $teacher['first_name'] ?></td>
      <td><?php echo $teacher['mobile'] ?></td>
      <td><?php echo $teacher['email'] ?></td>
      <td><?php echo $teacher['gender'] ?></td>
      <td><?php echo $teacher['dob'] ?></td>
      <td><?php echo $teacher['class'] ?></td>
      <td><?php echo $teacher['subject'] ?></td>

     
     <?php } }else{ ?>
      <td colspan="3">No Record Found</td>
      
     <?php } ?>
     </tr>
   </table>

   </div>






    </form>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</div>
</div>