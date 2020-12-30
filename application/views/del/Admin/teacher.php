
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
        <h1 class="page-header">Add Teacher</h1>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
      
    <form role="form" id="add_teacher"  method="post">

	 <div class="row">
   <div class="form-group col-md-4">
   <h4>First Name</h4>
   <input type="text" name="first_name" value="<?php set_value('first_name') ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Middle Name</h4>
   <input type="text" name="middle_name" value="<?php set_value('middle_name') ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
    <h4>Last Name</h4>
   <input type="text" name="last_name" value="<?php set_value('last_name') ?>" class="form-control" >
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
   <input type="number" name="mobile" onkeyup="mobileNumberValidate(this.value,'Mobile','errMsgMobile','submit')" value="<?php set_value('mobile') ?>" class="form-control" >
   <span id="errMsgMobile"></span>
   </div>
   <div class="form-group col-md-4">
    <h4>Email</h4>
   <input type="email" name="email" onkeyup="emailValidate(this.value,'Email','errMsgEmail','submit')" value="<?php set_value('email') ?>" class="form-control" >
   <span id="errMsgEmail"></span>
   </div>
   
   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <h4>DOB</h4>
   <input type="text"  name="dob" id="date1" data-select="datepicker" class="form-control" value="<?php set_value('dob') ?>" readonly>
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
    <h4>Address1</h4>
   
   <textarea name="address1" id="address1" class="form-control" value="<?php set_value('address1') ?>"></textarea>
   </div>
    <div class="form-group col-md-6">
      <h4>Address2</h4>
   
   <textarea name="address2" id="address2" class="form-control" value="<?php set_value('address2') ?>"></textarea>
   
   
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
    <div class="form-group col-md-4">
    <h4>Qualification</h4>
   <input type="text" name="qualification" value="<?php set_value('qualification') ?>" class="form-control">
   </div>
   <div class="form-group col-md-4">
   <h4>Experience(in year)</h4>
   <input type="text" name="experience" value="<?php set_value('experience') ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Class Range</h4>
   <select name="class_range[]" multiple class="form-control">
    <?php
    foreach($classlist as $class){ ?>
    <option value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>

  <?php  }

    ?>

   </select>
   </div>

   </div>

   <div class="row">
   <div class="form-group col-md-4">
   <h4>Speciality(class)</h4>
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
    <h4>Speciality(subjects)</h4>
    
    <!--<select name="subject[]" id="subject_id" data-placeholder="Choose a Subject..." class="chosen-select" multiple tabindex="4">-->
      <select name="subject[]" id="subject_id" multiple class="form-control">
     <?php
          /*$count=1;
          foreach ($subjectlist as $subject) {
          ?>
          <option value="<?php echo $subject['id'] ?>"><?php echo $subject['subject_name'] ?></option>
          <?php
          //echo $count++;
          //echo ++$count;
          }*/
          ?>
   </select>
   <?php //echo $count-1; ?>
   </div>
   </div>
   <div class="row">
   
   <div class="form-group col-md-4">
    <h4>Salary</h4>
   
   <select name="salary_type" id="salary_type" class="form-control">
    <option value="">Select</option>
     <option value="m">Monthly</option>
     <option value="l">Lecture Dependent</option>
   </select>

   </div>
   </div>
   <div class="row">
   
   <div class="form-group col-md-8" id="append_div">
   
   

   </div>
   
   </div>
   
   <div class="row">
   <div class="form-group col-md-4">
   <button type="submit" name="submit" id="submit" class="btn btn-primary">SUBMIT</button>
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

<script type="text/javascript">

$(document).ready(function () {
  $(document).on('change', '#salary_type', function(){

    //alert($("#speciality :selected").text());
    
    if(this.value == 'm'){
      $("#append_div").empty();
      $("#append_div").append("<input type='text' class='form-control' name='salary' placeholder='Enter Salary' >");
    }
    else if(this.value == 'l'){
      $("#append_div").empty();
      
        //alert('hello');
        var countries_val = [];
        var country_name = [];
      $. each($("#subject_id option:selected"), function(){
       countries_val.push($(this).val());
         country_name.push($(this).text())
      });
      
      var dd = '';

      /*for (i = 0; i < countries_val.length; i++) { 
         dd += '<div class="col-md-12" style="margin:5px;"><div class="col-md-6"><select class="form-control" name="sid'+countries_val[i]+'"><option value="'+ countries_val[i] +'">' + country_name[i] +'</option></select></div><div class="col-md-6"><input type="text" class="form-control" name="lcost'+countries_val[i]+'" placeholder="Enter Cost" ></div></div>'; 
      }*/
      for (i = 0; i < countries_val.length; i++) { 
         dd += '<div class="col-md-12" style="margin:5px;"><div class="col-md-6"><select class="form-control" name="sid[]"><option value="'+ countries_val[i] +'">' + country_name[i] +'</option></select></div><div class="col-md-6"><input type="text" class="form-control" name="lcost[]" placeholder="Enter Cost" ></div></div>'; 
      }
      $("#append_div").html(dd);

      
    }
    
  });

  /*$("#submit").click(function(){

  });*/
   $(document).on('submit','#add_teacher',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....');
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/add_teacher",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#add_teacher")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    /*$('#response_edit').html(data);
    $('#submit').html('Submit').attr('disabled',false); 
    setTimeout(function(){ location.reload() } , 1000);*/
     }  
     });  
 }));

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
            var class_id = $(this).val();
            var div_data = '<option value="">Select</option>';
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/get_class") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    //alert(data);
                    //$('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'your stylesheet url') );
                    
                    //$('#subject_id').empty();
                    $('#subject_id').html();

                    $('#subject_id').html(data);

                }
            });
        });



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