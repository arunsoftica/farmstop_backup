<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h2 class="page-header">Allocate Student</h2>
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
   <div class="form-group col-md-3">
      <select name="gender" id="gender" class="form-control">
        <option value="">Select</option>
        <option value="m">Male</option>
        <option value="f">Female</option>
      </select>

    </div>
   </div>
   <div class="row">
    <div class="form-group col-md-3">
    <table class="table">
     <tr>
       <div class="col-md-3"><b>Name</b></div>
       <div class="col-md-9" style="padding:2px;">
         <input type="text" name="stuname" id="stuname" placeholder="Search By Name" class="form-control">
       </div>
       

     </tr>
    <tbody id="sid">
     <?php
     
      if($student != FALSE){
      foreach($student as $stu){ ?>
     <tr>
      <td><input type="radio" class="radio" id="stuid<?php echo $stu['id']; ?>" name="stuid" value="<?php echo $stu['id']; ?>"><?php echo $stu['first_name'].' '.$stu['middle_name'].' '.$stu['last_name'].'('.$stu['id'].')'; ?></td>
     
     <?php } }else{ ?>
      <td colspan="3">No Record Found</td>
      
     <?php } ?>
     </tr>
    </tbody>
   </table>
    </div>
    <div class="form-group col-md-1">
      <img id="img" src="<?php echo base_url() ?>assets/admin/images/giphy.gif" height="150" width="150" style="display:none;">
    </div>
   <div class="form-group col-md-8">

    <div class="row">
         <table class="table">
     <tr>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>DOB</th>
       <th>Speciality(Subjects)</th>
     </tr>
     
     <tbody id="trid">
        <tr>
        <td colspan="6">No Record Found</td>     
        </tr>
     </tbody>
   </table>

    </div>
    
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
<script>
   $(document).on('click','input.radio', function (e){
    //$data['student'] = $this->Adminmodel->getStudent();
    $('#img').show();
    var gen = $("#gender").val();
    var ab = $(this).attr('id');
    var de= '#'+ab;
    var  stuid = $(de).attr("value");
    
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/get_student") ?>",
        data: {gen:gen,stuid:stuid},
        success: function (data) {
            //alert(data);
            $('#trid').empty();
            $('#img').hide();
            $('#trid').html();

            $('#trid').html(data);

        }
      });
      

   });

   $(document).on('blur','#stuname', function (e){
      
      var stuname = $("#stuname").val();
      //alert(stuname);
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/search_student") ?>",
        data: {stuname:stuname},
        success: function (data) {
            //alert(data);
            $('#sid').empty();
            $('#sid').html();

            $('#sid').html(data);

        }
      });

   });

</script>