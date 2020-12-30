<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">View Blogger</h2>
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
      
    
    <table class="table" id="example">
     <thead>
       <th>#</th>
       <th>Action</th>
       <th>Name</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>Address</th>
       <th>Image</th>
       <th>Created By</th>
       <th>Date</th>
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($blogger) > 0){
        foreach($blogger as $mod){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="#">Edit</a>/<a href="#">Delete</a></td>
           <td><?php echo $mod['first_name'].' '.$mod['middle_name'].' '.$mod['last_name']; ?></td>
           <td><?php echo $mod['mobile']; ?></td>
           <td><?php echo $mod['email']; ?></td>
           <td><?php
            if($mod['gender'] == 'm') echo 'Male'; else echo 'Female';

            ?></td>
           <td><?php echo $mod['address']; ?></td>
           <td>
            <?php 
           if($mod['types'] == 4){ ?>
           <img src="uploads/blogger/<?php echo $mod['image'] ?>" height="100" width="100">
          <?php } ?> 
           </td>
           <td><?php echo $created_by['email']; ?></td>
           
           <td><?php echo $mod['updated_at']; ?></td>




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


</script>