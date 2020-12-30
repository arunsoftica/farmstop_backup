<link rel="stylesheet" href="<?php echo base_url() ?>assets/multi_select/css/ddstyle.css" type="text/css">

<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script  src="<?php echo base_url() ?>assets/multi_select/js/ddjquery.min.js"> </script>
<script src="<?php echo base_url() ?>assets/multi_select/js/multi_select.min.js"> </script>
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Student</h1>
        <?php //echo $title; ?>
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
   <div class="form-group col-md-4">
   <h4>Select Year*</h4>
   <select name="year" id="year" class="form-control" required>
      <option value="">Select</option>
      <option value="2019-2020">2019-2020</option>
      <option value="2020-2021">2020-2021</option>
      <option value="2021-2022">2021-2022</option>
      <option value="2022-2023">2022-2023</option>
      <option value="2023-2024">2023-2024</option>
      <option value="2024-2025">2024-2025</option>
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Mobile</h4>
   <input type="number" name="mobile" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Email</h4>
   <input type="mobile" name="email" class="form-control" >
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <h4>DOB</h4>
   <input type="text" name="dob" id="date1" data-select="datepicker" class="form-control" readonly>
   <span class="input-group-btn"><button type="button" class="btn btn-primary" data-toggle="datepicker"><i class="fa fa-calendar"></i></button></span>

   </div>
   <div class="form-group col-md-4">
    <h4>Gender</h4>
    <input type="radio" name="gender" id="male" value="m">Male
    <input type="radio" name="gender" id="female" value="f">Female
   </div>
   <div class="form-group col-md-4">
    <h4>Upload Image</h4>
         
   <input type="file" name="image" id="image" class="form-control">
   </div>
   
   </div>

   <div class="row">
    <div class="form-group col-md-6">
    <h4>Address 1</h4>
   <textarea name="address1" id="address1" class="form-control" ></textarea>
   </div>
   <div class="form-group col-md-6">
    <h4>Address 2</h4>
   <textarea name="address2" id="address2" class="form-control" ></textarea>
   </div>
   
   
   </div>
   <div class="row" id="resid"></div>
   <div class="row">
   <div class="form-group col-md-6">
    <h4>Longitude</h4>
   <input type="text" name="longitude" id="longitude" value="<?php set_value('longitude') ?>" class="form-control" readonly>
   
   </div>
   <div class="form-group col-md-6">
    <h4>Latitude</h4>
    <input type="text" name="latitude" id="latitude" value="<?php set_value('latitude') ?>" class="form-control" readonly>
   
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-6">
    <h4>City</h4>
   <input type="text" name="city" class="form-control" >
   </div>
   <div class="form-group col-md-6">
    <h4>State</h4>
   <input type="text" name="state" class="form-control" >
   </div>
   
   </div>

   <div class="row">
   
   <div class="form-group col-md-4">
    <h4>Class</h4>
   
   <select name="class" id="class_id" class="form-control">
    <option value="">Select</option>
    <?php
    foreach($classlist as $class){ ?>
    <option value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>

  <?php  }

    ?>

   </select>
   </div>
   <div class="form-group col-md-4" >
    <h4>Subject</h4>
  
   <!--<select name="subject[]"  data-placeholder="Choose a Subject..." class="chosen-select" multiple tabindex="4">-->
    <select name="subject[]" id="subject_id" multiple class="form-control">
   

   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Total Fees</h4>
   <input type="text" name="total_fees" class="form-control" >
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Time Slot</h4>
   <select class="form-control" name="time_slot">
    <option value="">Select</option>
    <?php
    foreach($timeslot as $tslot){ ?>
    <option value="<?php echo $tslot['id'] ?>"><?php echo $tslot['time1'].'-'.$tslot['time2'] ?></option>

  <?php  }

    ?>
     
   </select>
   <!--div class="col-md-5"><input type="time" name="time1" class="form-control" value="00:00" ></div>
   <div class="col-md-2">TO</div>
   <div class="col-md-5"><input type="time" name="time2" class="form-control" value="00:00" ></div-->
   
   
   </div>
   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
   </div>
   <div class="form-group col-md-4" id="response_edit"></div>
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

<script >
  
$(document).ready(function(){

$(document).on('blur','#address2', function (e){
     var address1 = $("#address2").val();
      if(address1 != ""){
          $.ajax({
          url: "Ajaxcontroller/geocodingData",
          type: "GET",           
          data: {address1:address1},
          success: function(data){
           //console.log(data);
           //alert(data);
              if(data != 'invalid'){
              var arr = data.split(',');
                $("#resid").empty();
                $('#longitude').val(arr[0]);
                $('#latitude').val(arr[1]);
              }
              else{
                $("#longitude").empty();
                $("#latitude").empty();
                $('#resid').html('Please Enter the Correct Address .');
              }
            
           }
          });
      }
   });

$(document).on('change', '#class_id', function (e) {
        //alert('hello');
            var class_id = $(this).val();
            var div_data = '<option value="">Select</option>';
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/get_class") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    //alert(data);
                    //$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'your stylesheet url') );
                    
                    $('#subject_id').empty();
                    $('#subject_id').html();

                    $('#subject_id').html(data);

                }
            });
        });

$(document).on('submit','#add_student',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_student",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#add_student")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));


});



</script>
<!-- drop down multiselect -->
<script>
var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : { allow_single_deselect: true },
  '.chosen-select-no-single' : { disable_search_threshold: 10 },
  '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
  '.chosen-select-rtl'       : { rtl: true },
  '.chosen-select-width'     : { width: '95%' }
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}</script>
<!-- drop down multiselect -->