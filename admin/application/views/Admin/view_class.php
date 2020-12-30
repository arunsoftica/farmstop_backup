<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
	<div class="col-lg-12">
        <h1 class="page-header">Add Class</h1>
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
   <div class="form-group col-md-6">
   <h4>Class Name</h4>
   <input type="text" name="class_name" class="form-control" >
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
       <th>Date</th>
       <th>Edit</th>
       <th>Delete</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($classlist) > 0){
        foreach($classlist as $class){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><?php echo $class['class_name']; ?></td>
           <td><?php echo $class['updated_at']; ?></td>
           <td><a href="<?php echo base_url('update_class?updcid='.$class['id']) ?>">Edit</a></td>
           <td><a onclick="return confirm('are you sure')" href="<?php echo base_url('view_class?delcid='.$class['id']) ?>">Delete</a></td>




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