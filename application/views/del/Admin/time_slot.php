
<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Time Slot</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="add_time_slot" method="post">

   <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Time</h4>
   <div class="col-md-5"><input type="time" name="time1" class="form-control" value="00:00" ></div>
   <div class="col-md-2">TO</div>
   <div class="col-md-5"><input type="time" name="time2" class="form-control" value="00:00" ></div>
   
   
   </div>
   </div> 

   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
   </div>
   
   </div> 






    </form>
    <p id="response_edit"></p>
    <table class="table">
     <thead>
       <th>#</th>
       <th>Time Slot</th>
       <th>Date</th>
       <th>Edit</th>
       <th>Delete</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($timeslot) > 0){
        foreach($timeslot as $tslot){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $tslot['time1'].'-'.$tslot['time2']; ?></td>
           <td><?php echo $tslot['updated_at']; ?></td>
           <td><a href="<?php echo base_url('update_time_slot?updtsid='.$tslot['id']) ?>">Edit</a></td>
           <td><a onclick="return confirm('are you sure')" href="<?php echo base_url('time_slot?deltsid='.$tslot['id']) ?>">Delete</a></td>




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

<script>
  $(document).on('submit','#add_time_slot',(function(e){
    //alert('hello');
    $('#response_edit').html(" ");
  
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/addTimeSlot",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        //$("#add_time_slot")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('SUBMIT');
    
     }  
     });  
 }));



</script>