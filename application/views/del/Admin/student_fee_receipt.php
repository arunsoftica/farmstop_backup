<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    <div class="col-lg-12">
        <h1 class="page-header">Student Fee Receipt</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="fee_receipt" method="post">

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
   <h4>Select Class*</h4>
   <select name="class" id="class" class="form-control" required>
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
   <h4>Select Student*</h4>
   <select name="student" id="student" class="form-control" required>
    <option value="">Select</option>
        

   </select>
   </div>
   
   </div> 


   <div class="row">
    
   </div>
   <div class="row">
   <div class="form-group col-md-3">
   
   <button type="submit" name="submit" id="submit" class="btn btn-primary">Search</button>
   </div>
   <div class="form-group col-md-3">
   
   <button type="button" name="printall" id="printall" class="btn btn-primary">Print All Receipt</button>
   </div>
   </div> 
   





    </form>
    <table class="table">
     <tr>
       <th>#</th>
       <th>Receipt</th>
       <th>Student</th>
       <th>Class</th>
       <th>Year</th>
       <th>Month</th>
       <th>Total Fees</th>
       <th>Discount</th>
       <th>Submit Fees</th>
       <th>Date</th>
       
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
    </div>
    </div>
    </div>

</div>
</div>
<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
<script>
$(document).on('change', '#class', function (e) {
        //alert('hello');
            var class_id = $(this).val();
            
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/get_student_by_class") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    //alert(data);
                    $('#student').empty();
                    $('#student').html(data);

                }
            });
        });
$(document).on('submit','#fee_receipt',(function(e){
 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/student_fee_receipt",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#trid').empty();
        $('#trid').html(data);
        //$("#salary_report")[0].reset();
    
     }  
     });  
 }));  

$(document).on('click','#printall', function (e){
     var year = $('#year').val();
     var cls = $('#class').val();
     var stu = $('#student').val();
     if(year != ''){
      if(cls != ''){
        if(stu != ''){
          
        window.location.href = "print_receipt?s="+stu+"&c="+cls+"&y="+year;

        }else{
          alert('Select Student');
        }

      }else{
       alert('Select Class');
      }


     }else{
      alert('Select Year');
     }
   });
</script>