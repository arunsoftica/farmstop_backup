<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">View Teachers</h2>
        <?php //echo $title; ?>
    </div>
  <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">

    <div class="col-lg-12">
   <!-- <form role="form" id="view_teachers" method="post"> -->
    <div class="row">
    
    <p id="response_edit"></p>
    </div>
    <div class="row">
    
    <table class="table" id="example">
     <thead>
       <th>#</th>
       <th>Action</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>DOB</th>
       <th>Year</th>
       <th>Date</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($teachers) > 0){
        foreach($teachers as $teacher){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('update_teacher?updtea='.$teacher['id'].'&i=1'); ?>">Edit</a>/<a href="<?php echo base_url('teacher_update?delteay='.$teacher['id']); ?>">Delete</a></td>
           <td><?php echo $teacher['first_name'].' '.$teacher['middle_name'].' '.$teacher['last_name']; ?></td>
           <td><?php echo $teacher['mobile']; ?></td>
           <td><?php echo $teacher['email']; ?></td>
           <td>
             <?php
            if($teacher['gender'] == 'm') echo 'Male'; else echo 'Female';

            ?>
           </td>
           <td><?php echo $teacher['dob']; ?></td>
           <td><?php echo $teacher['year']; ?></td>
           <td><?php echo $teacher['created_at']; ?></td>




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

   <!-- </form> -->
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
  $(document).on('click', '#export', function (e) {
        //alert('hello');
            
            
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/view_teacher") ?>",
                data: {},
                success: function (data) {
                    alert(data);
                    
                    
                    

                }
            });
        });

  $(document).on('submit','#upload_csv',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/upload_csv",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#upload_csv")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Upload');
    
     }  
     });  
 }));
</script>