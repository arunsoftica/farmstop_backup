
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Teacher</h1>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="add_student" method="post">

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>First Name</h4>
   <input type="text" name="first_name" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Middle Name</h4>
   <input type="text" name="middle_name" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Last Name</h4>
   <input type="text" name="last_name" class="form-control" >
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-6">
   <h4>Mobile</h4>
   <input type="number" name="mobile" class="form-control" >
   </div>
   <div class="form-group col-md-6">
    <h4>Email</h4>
   <input type="mobile" name="email" class="form-control" >
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-6">
   <h4>DOB</h4>
   <input type="text" name="dob" id="date1" data-select="datepicker" class="form-control" >
   <span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>

   </div>
   <div class="form-group col-md-6">
    <h4>Gender</h4>
    <input type="radio" name="gender" id="male" value="m">Male
    <input type="radio" name="gender" id="female" value="f">Female
   </div>
   
   </div>

   <div class="row">
    <div class="form-group col-md-4">
    <h4>Address</h4>
   
   <textarea name="address" class="form-control"></textarea>
   </div>
   <div class="form-group col-md-4">
    <h4>City</h4>
   <input type="text" name="city" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>State</h4>
   <input type="text" name="state" class="form-control" >
   </div>
   
   </div>

   <div class="row">
   
   
   </div>

   <div class="row">
   
   <div class="form-group col-md-4">
    <h4>Class</h4>
   
   <select name="class" id="class_id" class="form-control">
    <option value="">Select</option>
        <?php
          foreach ($classlist as $class) {
          ?>
          <option value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>
          <?php
          $count++;
          }
          ?>

   </select>
   </div>
   <div class="form-group col-md-4">
    <h4>Subject</h4>
  
   <select name="subject" id="subject_id" class="form-control">
    <option value="">Select</option>
    
    

   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Experience(in year)</h4>
   <input type="text" name="experience" class="form-control" >
   </div>
   </div>

   <div class="row">
   
   <div class="form-group col-md-4">
    <h4>Salary</h4>
   
   <input type="number" class="form-control" name="salary">

   </div>
   <div class="form-group col-md-4">
    <h4>Teaching Type</h4>
  
   <select name="teaching_type" class="form-control">
    <option value="">Select</option>
    <option value="m">Monthly</option>
    <option value="h">Hourly</option>
   </select>

   </div>
   
   </div>
   
   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
   </div>
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
<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
$(document).on('change', '#class_id', function (e) {
      
            var class_id = $(this).val();
            var div_data = '<option value="">Select</option>';
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/get_class") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    //alert(data);
                    $('#subject_id').html();
                    $('#subject_id').html(data);

                }
            });
        });


});  
</script>