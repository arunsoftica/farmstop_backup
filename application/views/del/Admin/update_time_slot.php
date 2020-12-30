
<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Update Time Slot</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="update_time_slot" method="post">

   <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Time</h4>
   <input type="hidden" name="timeslot_id" value="<?php echo $timeslot['id'] ?>">
   <div class="col-md-5"><input type="time" value="<?php echo $timeslot['time1'] ?>" name="time1" class="form-control" ></div>
   <div class="col-md-2">TO</div>
   <div class="col-md-5"><input type="time" value="<?php echo $timeslot['time2'] ?>" name="time2" class="form-control" ></div>
   
   
   </div>
   </div> 

   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" class="btn btn-primary">Update</button>
   </div>
   
   </div> 






    </form>
    <p id="response_edit"></p>
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

</div>
</div>

<script>
  $(document).on('submit','#update_time_slot',(function(e){
    //alert('hello');
    $('#response_edit').html(" ");
  
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/updateTimeSlot",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        /*$('#response_edit').html(data);
        $("#add_student")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Update');*/
        //window.location.href = "http://stackoverflow.com";
    
     }  
     });  
 }));



</script>