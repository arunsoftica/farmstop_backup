<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    <div class="col-lg-12">
        <h1 class="page-header">Calculate Teacher Salary</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="calculate_salary" method="post">

   <div class="row">
    <div class="form-group col-md-4">
   <h4>Select Year*</h4>
   <select name="year" id="year" class="form-control">
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
   <h4>Select Month*</h4>
   <select name="month" id="month" class="form-control">
      <option value="">Select</option>
      <option value="January">January</option>
      <option value="February">February</option>
      <option value="March">March</option>
      <option value="April">April</option>
      <option value="May">May</option>
      <option value="June">June</option>
      <option value="July">July</option>
      <option value="August">August</option>
      <option value="September">September</option>
      <option value="October">October</option>
      <option value="November">November</option>
      <option value="December">December</option>
   </select>
   </div>
   <div class="form-group col-md-4">
   <h4>Select Teacher*</h4>
   <select name="teacher" id="teacher" class="form-control">
    <option value="">Select</option>
        <?php
          foreach ($teachers as $teacher) {
          ?>
          <option value="<?php echo $teacher['id'] ?>"><?php echo $teacher['first_name'].' '.$teacher['middle_name'].' '.$teacher['last_name'].'('.$teacher['id'].')' ?></option>
          <?php
          $count++;
          }
          ?> 

   </select>
   </div>
   
   </div> 
<div id="refdiv">
<!--   <div class="row">
    <div class="form-group col-md-4">
   <h4>Teaching Type</h4>
   <input type="text" name="type" class="form-control" readonly>
   </div>
   <div class="form-group col-md-4">
   <h4>Total Days</h4>
   <input type="text" name="total_days" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Total Present</h4>
   <input type="text" name="total_present" class="form-control" >
   </div>
   
   </div>
   <div class="row">
   
   <div class="form-group col-md-4">
   <h4>Total Holiday</h4>
   <input type="text" name="total_holiday" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Total Absent</h4>
   <input type="text" name="total_absent" class="form-control" >
   </div>
   </div>-->
</div>

   <div class="row">
    
   </div>
   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" id="submit" class="btn btn-primary" disabled>Calculate Salary</button>
   </div>
   
   </div> 
   





    </form>
    <form role="form" id="save_salary" method="post">
    <div id="response_edit"></div>
    </form>
    <div id="responseedit"></div>
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

    $(document).on('change', '#pay_method', function (e) {
       var v = $(this).val();
       if(v == 'Online'){
        //alert('Online');
        $('#idno').empty();
        $('#idno').html('Transactional Id');

       }else if(v == 'Cash'){
        //alert('Cash');
        $('#idno').empty();
        $('#idno').html('Boucher No.');

       }else if(v == 'Cheque'){
        //alert('Cheque');
        $('#idno').empty();
        $('#idno').html('Cheque No.');

       }

    });

    $(document).on('change', '#teacher', function (e) {
            //alert($(this).val());
            var tid = $(this).val();
            var month = $('#month').val();
            var year = $('#year').val();
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/getTeacher") ?>",
                data: {tid:tid,month:month,year:year},
                success: function (data) {
                    //alert(data);
                    $('#refdiv').empty();
                    $('#refdiv').html(data);
                    $('#response_edit').empty();
                    $('#submit').prop("disabled", false);
                    //Always use the prop() method to enable or disable elements when using jQuery
                    

                }
            });
        });
$(document).on('submit','#calculate_salary',(function(e){
    $('#response_edit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/calculate_salary",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        //$("#calculate_salary")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Calculate Salary');
    
     }  
     });  
 }));
$(document).on('blur','#total_holiday', function (e){

    //alert('hello');
    
    var a = $('#workingdays').val();
    var b = $('#total_holiday').val();
    var c = parseInt(a)+parseInt(b);
    $('#working_days').val(c);


});

$(document).on('submit','#save_salary',(function(e){
    $('#responseedit').html(" ");
  //$('#submit').html('<i style="color:#FFF;" class="fa fa-circle-o-notch fa-spin"></i> please wait...').attr('disabled',true);
    $("#add_salary").addClass('disabled');
    $("#add_salary").text('please wait....'); 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/save_salary",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#responseedit').html(data);
        $("#save_salary")[0].reset();
        $("#add_salary").removeClass("disabled");
        $("#add_salary").text('Add Salary');
    
     }  
     });  
 }));
</script>