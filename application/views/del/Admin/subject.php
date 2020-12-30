<script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>

<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Subject</h1>
        <?php //echo $title; ?>
    </div>
    <div class="row" >
    <div class="col-lg-12" >
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
    <div class="col-lg-12">
    <form role="form" id="add_class" method="post">

   <div class="row">
   <div class="form-group col-md-4">
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
   <div class="form-group col-md-4">
   <h4>Subject Name</h4>
   <input type="text" name="subject_name" class="form-control" >
   </div>
   
   </div>


   <div class="row">
   <div class="form-group col-md-6">
   
   <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
   </div>
   
   </div> 






    </form>
    <table class="table" id="example">
     <thead>
       <th>#</th>
       <th>Class</th>
       <th>Subject</th>
       <th>Date</th>
       <th>Edit</th>
       <th>Delete</th>
     </thead>
     
     <tbody id="trid">
      <tr >
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

<script>
  $(document).on('change', '#class', function (e) {
        //alert('hello');
            var class_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url("Ajaxcontroller/get_subject_by_class") ?>",
                data: {class_id:class_id},
                success: function (data) {
                    
                    $('#trid').empty();
                    $('#trid').html();

                    $('#trid').html(data);
                    $('#example').DataTable(({ 
                      "destroy": true, //use for reinitialize datatable
                   }));

                }
            });
        });

</script>