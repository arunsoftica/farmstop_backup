<div id="page-wrapper">
<div class="row" >
  <?php echo validation_errors(); ?>
  <?php if($feedback=$this->session->flashdata('feedback')): ?>
   
  
                       <center><h3><?php echo $feedback; ?></h3></center> 
   
                        <?php endif; ?>
  <div class="col-lg-12">
        <h2 class="page-header">View Product Variation</h2>
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
       <th>Product</th>
       <th>Variation</th>
       <th>Regular Price</th>
       <th>Sale Price</th>
       <th>Weight</th>
       <th>Date</th>
       <th>Created By</th>
       
       
     </thead>
     
     <tbody>
      <?php 
        $count = 0;
        if(count($variation) > 0){
        foreach($variation as $var){ ?>
         <tr>
           <td><?php echo $count = $count + 1; ?></td>
           <td><a href="<?php echo base_url('update_product_variation?vid='.$var['id']) ?>">Edit</a>/<a href="#">Delete</a></td>           
           <td><?php echo $var['pname']; ?></td>
           <td><?php echo $var['attribute_name']; ?></td>           
           <td><?php echo $var['regular_price']; ?></td>           
           <td><?php echo $var['sale_price']; ?></td>
           <td><?php echo $var['weight']; ?></td>
           <td><?php echo $var['updated_at']; ?></td>
           <td><?php echo $var['mail']; ?></td>




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