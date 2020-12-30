<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">View Admin</h2>
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
       
       <th>User</th>
       <th>Mobile</th>
       <th>Email</th>
       <th>Gender</th>
       <th>Address</th>
       <th>Image</th>
       <th>Date</th>
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($admin) > 0){
        foreach($admin as $adm){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('superadmin/view_admin?admdel='.$adm['id']) ?>">Delete</a></td>
           
           <td><?php echo $adm['first_name'].' '.$adm['middle_name'].' '.$adm['last_name']; ?></td>
           <td><?php echo $adm['mobile']; ?></td>
           <td><?php echo $adm['email']; ?></td>
           <td><?php
            if($adm['gender'] == 'm') echo 'Male'; else echo 'Female';

            ?></td>
           <td><?php echo $adm['address']; ?></td>
           <td>
            <?php 
            if(!empty($adm['image'])){ ?>
                 <img src="<?php echo base_url('uploads/admin/'.$adm["image"]) ?>" height="100" width="100">
            <?php }else{ echo 'No Image Found'; } 
            ?>
              
            </td>
           <td><?php echo $adm['updated_at']; ?></td>
           




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

  

</script>