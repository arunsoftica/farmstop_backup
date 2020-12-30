<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
    <div class="col-lg-12">
        <h1 class="page-header">Teacher Salary Report</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="salary_report" method="post">

   <div class="row">
    <div class="form-group col-md-4">
   <h4>Select Year</h4>
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
   <h4>Select Month</h4>
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
   <select name="teacher" id="teacher" class="form-control" required>
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


   <div class="row">
    
   </div>
   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" id="submit" class="btn btn-primary">Search</button>
   </div>
   
   </div> 
   





    </form>
    <table class="table" >
      <thead>
     <tr>
       <th>#</th>
       <th>Teacher's Name</th>
       <th>Salary</th>
       <th>Paid Salary</th>
       <th>Year</th>
       <th>Month</th>
       <th>Type</th>
       <th>Payment Method</th>
       <th>Transaction Id</th>
       <th>Payment Date</th>
       <th>Remark</th>
     </tr>
     </thead>
     <tbody id="trid">
        <tr>
        <td colspan="11">No Record Found</td>     
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

$(document).on('submit','#salary_report',(function(e){
 
    e.preventDefault();
      $.ajax({
      url: "Ajaxcontroller/teacher_salary",
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


</script>