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
    <form role="form" id="allocate_student" method="post">
    <button type="submit" id="submit" name="save" class="btn btn-primary" style="float:left;margin:2px;">Allocate Student</button>


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


   $(document).on('submit','#allocate_student',(function(e){
    e.preventDefault();
    alert("hello");
    
   }));


   

</script>