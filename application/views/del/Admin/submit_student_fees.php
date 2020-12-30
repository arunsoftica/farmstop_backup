<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">Submit Student Fees</h2>
        <?php //echo $title; ?>
    </div>
    <p>
      <?php
      if(isset($_GET['m'])){
           echo $_GET['m'];
      }

      ?>
    </p>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
      <div class="form-group col-md-4" id="response_edit"></div>
    </div>
    <div class="col-lg-12">
    <form role="form" id="student_fees" method="post">
   <div class="row">
   <div class="form-group col-md-3">
      <h4>Select Class</h4>
   <select name="class" id="class" class="form-control">
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
     <tr>
        <td>Record Not Found</td>
      </tr>
    </tbody>
   </table>
    </div>
    <div class="form-group col-md-1">
      <img id="img" src="<?php echo base_url() ?>assets/admin/images/giphy.gif" height="150" width="150" style="display:none;">
      
    </div>

   <div class="form-group col-md-8" id="refdiv" style="display:none;">
   
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Select Year*</h4>
   
   <input type="text" name="year" id="year" class="form-control" readonly>
   </div>
   
   <div class="form-group col-md-4">
   <h4>Select Month*</h4>
   <select name="month" id="month" class="form-control" required>
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
   </div>

    <div class="row">
   <div class="form-group col-md-4">
   <h4>Student Name</h4>
   <input type="text" name="stunames" id="stunames" class="form-control" readonly>
   </div>
   
   <div class="form-group col-md-4">
   <h4>Class</h4>
   <input type="text" name="stuclass" id="stuclass" class="form-control" readonly>
   </div>
   </div>
   
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Total Fees</h4>
   <input type="number" name="total_fees" id="total_fees" class="form-control" readonly>
   </div>
   
   <div class="form-group col-md-4">
   <h4>Discount</h4>
   <input type="number" value="0" name="discount" id="discount" class="form-control">
   </div>
   </div>
   <div class="row">
   <div class="form-group col-md-4">
   <h4>Submit Fees</h4>
   <input type="number" id="submit_fees" name="submit_fees" class="form-control">
   </div>
   
    </div>
    <div class="row">
      <div class="form-group col-md-4">
   <button type="submit" id="submit" class="btn btn-primary">Submit Fees</button>
   </div>
   <div class="form-group col-md-4">
   <p id="response_edit"></p>
   </div>
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
$(document).on('change', '#class', function (e) {
        //alert('hello');
            var class_id = $(this).val();
            $.ajax({
                type: "GET",
                //url: base_url +"/Ajaxcontroller/get_class",
                url: "<?php echo base_url("Ajaxcontroller/getStudentByClass") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    //alert(data);
                    $('#sid').empty();
                    $('#sid').html();
                    $('#sid').html(data);
                    

                }
            });
        });
  
$(document).on('click','input.radio', function (e){
    
    var  stuid = $(this).val();
    $('#img').show();
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/getStudentFees") ?>",
        data: {stuid:stuid},
        //dataType: "json",
        success: function (data) {
            //alert(data);
            $('#img').hide();
            var parseJson = jQuery.parseJSON(data);
            console.log(parseJson.student_details);
            $('#refdiv').show();
            $('#stunames').val(parseJson.student_details['first_name']+' '+parseJson.student_details['middle_name']+' '+parseJson.student_details['last_name']);
            $('#stuclass').val(parseJson.student_details['classname']);
            $('#total_fees').val(parseJson.student_details['total_fees']);
            $('#submit_fees').val(parseJson.student_details['total_fees']);
            $('#year').val(parseJson.student_details['year']);

        }
      });
      

   });

$(document).on('submit','#student_fees',(function(e){
    e.preventDefault();
    //alert("hello");
    $('#response_edit').html(" ");
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    
      $.ajax({
      url: "Ajaxcontroller/submitStudentFees",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#student_fees")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Submit Fees');
        $("#discount").val('');
    
     }  
     });
   }));

$(document).on('blur','#discount', function (e){
     var dis = $(this).val();
     if(dis == ''){ dis = 0; }
      //alert(dis);
      var tf = $('#total_fees').val();
      //alert(tf);
      var nf = tf-dis;
      $('#submit_fees').val(nf);
      
   });

</script>