<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>

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
    
   <form id="allocate_teacher">
   <div class="row">
    <div class="form-group col-md-4">
     <h4>Time Slot</h4>
    
     <select name="time_slot" id="time_slot" class="form-control">
        <option value="">Select</option>
      <?php
        foreach($timeslot as $tslot){ ?>
        <option value="<?php echo $tslot['id'] ?>"><?php echo date("g:i a", strtotime($tslot['time1'])).'-'.date("g:i a", strtotime($tslot['time2'])); ?></option>

        <?php  } ?>
     

     </select>
    </div>
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
   <div class="form-group col-md-4">
   <h4>Subject</h4>
  
     <select name="subject" id="subject_id" class="form-control">
      <option value="">Select</option>
    

     

     </select>
    </div>
    
   </div> 

   <div class="row">
   
    <div class="form-group col-md-4">
    <button type="button" id="submit" name="submit" class="btn btn-primary">Search</button>
    </div>
   
    </div> 
    <div class="row" id="saveid">
       
    </div>
   
    </form>
    
   <div class="row">
   <table class="table">
    <thead>
     <tr>
       <th>Select</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>DOB</th>
       
     </tr>
     </thead>
     <tbody id="trid">
     
      <tr>
      <td colspan="7">No Record Found</td>
      </tr>
      
     
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

<script >

$(document).ready(function(){

$(document).on('change', '#class_id', function (e) {
        //alert('hello');
            var class_id = $(this).val();
            var div_data = '<option value="">Select</option>';
            $.ajax({
                type: "GET",
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


$(document).on('click', '#submit', function (e) {
            e.preventDefault();
            var time_slot = $("#time_slot").val();
            var subject_id = $("#subject_id").val();
            
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/get_teacher") ?>",
                data: {time_slot:time_slot,subject_id:subject_id},
                success: function (data) {
                    //alert(data);
                    
                    $('#trid').empty();
                    $('#saveid').empty();
                    $('#trid').html();
                    $('#saveid').html('<button type="button" id="save" name="save" class="btn btn-primary" style="float:left;margin:2px;">Allocate Teachers</button>');
                    $('#trid').html(data);

                }
            });
        });

$(document).on('click', '#save', function (e) {
            e.preventDefault();
            var time_slot = $("#time_slot").val();
            var subject_id = $("#subject_id").val();
            var checkboxes = document.getElementsByName('chk[]');
            var vals = "";
            for (var i=0, n=checkboxes.length;i<n;i++) 
            {
                if (checkboxes[i].checked) 
                {
                    vals += ","+checkboxes[i].value;
                }
            }
            if (vals) vals = vals.substring(1);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("Ajaxcontroller/allocate_teacher") ?>",
                data: {time_slot:time_slot,vals:vals,subject_id:subject_id},
                success: function (data) {
                    alert(data);
                    
                    $('#trid').empty();
                    $('#saveid').empty();
                    $('#subject_id').empty();
                    $('#saveid').html(data);
                    $('#trid').html('<td colspan="7">No Record Found</td>');
                    $("#allocate_teacher")[0].reset();
                    $('#subject_id').html('<option value="">Select</option>');
                    

                }
            });
        });


});  

</script>