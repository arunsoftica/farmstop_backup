<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h2 class="page-header">Change Teacher</h2>
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
    <form role="form" id="allocate_student" method="post">
   <div class="row">
   <div class="form-group col-md-3">
      <select name="gender" id="gender" class="form-control">
        <option value="">Select</option>
        <option value="m">Male</option>
        <option value="f">Female</option>
      </select>
      <input type="hidden" name="studentid" id="studentid" value="">

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
    <div class="row" id="saveid">
      

    </div>
    <div class="row">

    <table class="table">
     <thead>
      <th>Action</th>
       <th>#</th>

       <th>Timeslot</th>
       <th>Subject</th>
       <th>Teacher</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       
     </thead>
     
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
    <div class="col-lg-12">
      <div class="form-group col-md-4" id="response_edits"></div>
    </div>
    <form role="form" id="student_allocate" method="post">
    <div class="row" id="saveidd">
      

    </div>
   <table class="table">
     <thead>
       <th>#</th>
       <th>Priority</th>
       <th>Subject</th>
       <th>Teacher</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>DOB</th>
       
     </thead>
     
     <tbody id="tridd">
        <tr>
        <td colspan="6">No Record Found</td>     
        </tr>
     </tbody>
   </table>
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
    
    
    var gen = $("#gender").val();
    
    var  stuid = $(this).val();

    $("#studentid").val(stuid);

    $('#img').show();
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/getSubjectOfStudent") ?>",
        data: {gen:gen,stuid:stuid},
        //dataType: "json",
        success: function (data) {
          var parseJson = jQuery.parseJSON(data);

            //alert(data);
            //console.log(parseJson.second_var);
            console.log(parseJson.teacher_allocate);
            
            $('#trid').empty();
            $('#img').hide();
            var inc = 1;

              var html_content = ''; 
                  html_content             +='<div class="col-md-12">';
                  html_content             +=   '<div class="col-md-6">';
                  html_content             +=   '<select name="subject" id="subject" class="form-control">';
                  html_content             +=       '<option value="">Select Subject</option>';

                  $.each(parseJson.second_var , function(index , value){
                      html_content += '<option value="'+index+'">'+ value +'</option>';
                   });
                 
                        

                  html_content += ''
                  html_content            +=     '</select>';
                  html_content              +=   '</div>';
                  html_content             +=    '<div class="col-md-6">';
                  
                  html_content             +=    '</div>';
                  html_content              +=   '</div>';


        
            $('#saveid').html(html_content);
            var html_content1 = '';
                var gens = '';
                $.each(parseJson.teacher_allocate , function(index , value){
                  if(value['gen'] == 'm'){
                      gense = 'Male';
                  }else if(value['gen'] == 'f'){
                      gense = 'Female';
                  }
                      html_content1 += '<tr>';
                      html_content1 += '<td></td>';
                      html_content1 += '<td>'+ inc +'</td>';
                      html_content1 += '<td>'+ value['t1']+'-'+ value['t2'] +'</td>';
                      html_content1 += '<td>'+ value['subname'] +'</td>';
                      html_content1 += '<td>'+ value['fname']+' '+ value['mname'] +' '+ value['lname'] +'</td>';
                      html_content1 += '<td>'+ value['mob'] +'</td>';
                      html_content1 += '<td>'+ value['mail'] +'</td>';
                      html_content1 += '<td>'+ gense +'</td>';
                      html_content1 += '</tr>';
                      inc = inc + 1;
                   });
                
                
            $('#trid').html();
              
            $('#trid').html(html_content1);
            

        }
      });
      

   });
   $(document).on('click','#secbtn', function (e){
      //alert($(this).val());
      var str = $(this).val();
      var res = str.split(",");
      var stuid = res[0];
      var tid = res[3];
      var subid = res[1];
      var status = res[5];
      $('#img').show();
      var gen = $("#gender").val();
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/changeTeacher") ?>",
        data: {gen:gen,stuid:stuid,tid:tid,subid:subid,status:status},
        success: function (data) {
            //alert(data);
            $('#tridd').empty();
            $('#img').hide();
            $('#saveidd').html('<button type="submit" id="submit" name="save" class="btn btn-primary" style="float:left;margin:2px;">Allocate Student</button>');
            $('#tridd').html();
              
            $('#tridd').html(data);

        }
      });

   });
   $(document).on('change','#subject', function (e){
      
      var stuid = $('#studentid').val();
      var subid = $(this).val();
      $('#img').show();
      $.ajax({
        type: "GET",
        url: "<?php echo base_url("Ajaxcontroller/allocateSubjectWise") ?>",
        data: {subid:subid,stuid:stuid},
        success: function (data) {
          var parseJson = jQuery.parseJSON(data);
            //alert(data);
            $('#trid').empty();
            $('#img').hide();
            var inc = 1;
            //alert(parseJson.teacher_allocate.length);
            var ts = [];
            i=0;  
            var html_content1 = '';
                var gense = '';
                $.each(parseJson.teacher_allocate , function(index , value){
                  if(value['gen'] == 'm'){
                      gense = 'Male';
                  }else if(value['gen'] == 'f'){
                      gense = 'Female';
                  }
                      ts[i++] = value['teacher_id'];

                      html_content1 += '<tr>';
                      if(inc == parseJson.teacher_allocate.length){
                        var tsj = ts.join('@');
                        //alert(tsj);
                        html_content1 += '<td><button type="button" class="btn btn-primary" id="secbtn" value="'+value['student_id']+','+value['sub_id']+','+value['timeslot_id']+','+tsj+','+value['gen']+','+value['status']+'">Change Teacher</button></td>';
                      }else{
                        html_content1 += '<td></td>';
                      }
                      
                      html_content1 += '<td>'+ inc +'</td>';
                      html_content1 += '<td>'+ value['t1']+'-'+ value['t2'] +'</td>';
                      html_content1 += '<td>'+ value['subname'] +'</td>';
                      html_content1 += '<td>'+ value['fname']+' '+ value['mname'] +' '+ value['lname'] +'</td>';
                      html_content1 += '<td>'+ value['mob'] +'</td>';
                      html_content1 += '<td>'+ value['mail'] +'</td>';
                      html_content1 += '<td>'+ gense +'</td>';
                      html_content1 += '</tr>';
                      inc = inc + 1;
                   });
                
                
            $('#trid').html();
              
            $('#trid').html(html_content1);

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
  
   $(document).on('submit','#student_allocate',(function(e){
    e.preventDefault();
    //alert("hello");
    $('#response_edits').html(" ");
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    
      $.ajax({
      url: "Ajaxcontroller/allocateToStudent",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        var html_content = '';
        html_content += '<tr>';
        html_content += '<td colspan="6">No Record Found</td>';
        html_content += '</tr>';
        $('#response_edits').html(data);
        $("#student_allocate")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Allocate Student');
        $("#saveidd").empty();
        $("#tridd").empty();
        $("#tridd").html(html_content);
        //window.location.href = '<?php echo base_url() ?>change_teacher?m='+data;
     }  
     });
   }));

   $(document).on('submit','#allocate_student',(function(e){
    e.preventDefault();
    //alert("hello");
    $('#response_edit').html(" ");
    $("#submit").addClass('disabled');
    $("#submit").text('please wait....'); 
    
      $.ajax({
      url: "Ajaxcontroller/allocateToStudent",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //alert(data);
        $('#response_edit').html(data);
        $("#allocate_student")[0].reset();
        $("#submit").removeClass("disabled");
        $("#submit").text('Allocate Student');
    
     }  
     });
   }));

   $(document).on('blur','.priority', function (e){
    var ab = $(this).val();
    //alert(ab);

    //var a = $(this).parent().siblings('td').find('.flah').val();
    var a = $(this).parent().siblings('td').children('.flah').val();
    //alert(a);
    var aa = a + '$' + ab;
    $(this).parent().siblings('td').find('.flah').val(aa);
   });
  

</script>