
<?php
if(!isset($_SESSION['login_id'])){

$this->load->view('public/login');

 } else { ?> 
<section class="bg-light heading-bar">
	<div class="container">
        <div class="row">
        	<div class="col-sm-12">
            	<h2>Account</h2>
            </div>
        </div>
    </div>
</section>
	<section>
    	<div class="container">
        	<div class="row mt-3 mb-5 pb-5">
            	<div class="col-sm-2 d-none d-sm-block">
                	<div class="account-sidemenu">
                	<div class="list-group">
    <a href="<?php echo base_url('my-account') ?>" class="list-group-item list-group-item-action active"><i class="far fa-user"></i> My Profile
    </a>
    
    <a href="<?php echo base_url('order-list') ?>" class="list-group-item list-group-item-action"><i class="fas fa-archive"></i> Order History 
    </a>
   <a href="<?php echo base_url('wishlist') ?>" class="list-group-item list-group-item-action"><i class="far fa-heart"></i> Wishlist
    </a>
</div>
					</div>
                    <div class="">
                    </div>
                </div>
                <div class="col-sm-10">
                	<div class="acct-head">
                	<h2>My Profile</h2>
                    <h3><img src="assets/images/user.png" class="img-fluid" /> Account Info <!--<a data-toggle="collapse" href="#collapse-profile" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-pencil act-icon"></span></a>--></h3>
                    	<!--<div class="collapse" id="collapse-profile">
                                    <div class="card card-body add-address">
                                    	<form>
                    	<div class="form-group">
                        	<label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Name" value="" />
                        </div>
                        <div class="form-group">
                        	<label>Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Email" value="" />
                        </div>
                        <div class="form-group">
                        	<label>Mobile No <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Mobile No" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit btnSubmit-check" value="Edit" />
                        </div>
                    </form>
                                    </div>
                                </div>-->
                    	<ul class="info-user">
                        	<li><p>Name: &nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $_SESSION['login_name']; ?></span></p></li>
                            <li><p>Email: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php echo $_SESSION['login_email']; ?></span></p></li>
                            <li><p>Mobile No: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-info"><?php echo $details['mobile']; ?></span></p></li>
                            <li hidden><p>Role: &nbsp;&nbsp;&nbsp;&nbsp;<span>User</span></p></li>
                            <li hidden><p>Status: &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-success">Active</span></p></li>
                        </ul>
                        <h3><img src="assets/img/address.png" class="img-fluid" /> Default address <a class="add-adress-btn" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-plus-circle"></span></a></h3>
                        <div class="collapse" id="collapseExample">
                                    <div class="card card-body add-address">
                        <form id="add_address" method="post">
                            <input type="hidden" name="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>" >
                            <input type="hidden" name="email" value="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>" >
                    	<div class="form-group">
                        	<label>Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" placeholder="Enter Address" required></textarea>
                        </div>
                        <div class="form-group">
                        	<label>District <span class="text-danger">*</span></label>
                            <input type="text" name="district" class="form-control" placeholder="Enter District" value="Bengaluru" readonly/>
                        </div>
                        <div class="form-group">
                        	<label>Pincode <span class="text-danger">*</span></label>
                            <input type="number" name="pin" class="form-control" placeholder="Enter Pincode" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="addsubmit" class="btnSubmit btnSubmit-check" value="Add" />
                        </div>
                    </form>
                                    </div>
                                </div>
                    	<div class="row mr-0 ml-0">
                    	     <?php
                        	    
                        	    foreach($uaddress as $uadrs){
                        	    ?>
                        	<div class="col-sm-6 p-1">
                        	    <!-- Show Address -->
                        	   
                            	<div class="jumbotron jumbotron-address p-4">
                                  <address class="address-act">
                                  	<?php echo $uadrs['address'].' '.$uadrs['district'].' '.$uadrs['zipcode'].' '.$uadrs['country'] ?>
                                  </address>
                                  <ul class="address-btnlist">
                                  	<li class="list-inline">
                                    <li class="list-inline">
                                        <!--<a><span class="fa fa-trash"></span></a>-->
                                        <button onclick="return confirm('Are you sure you want to delete your address?');" type="button" value="<?php echo $uadrs['id'] ?>" class="btn btn-default deladrs"><span class="fa fa-trash"></span></button>
                                        </li>
                                  	
                                    </ul>
         						 </div>
         						 
                            </div>
                            <?php } ?>
         						 <!-- Show Address -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
$(document).ready(function(){
    $(document).on('click','.deladrs', function (e){
                
             var adrs = $(this).val();
              
              $.ajax({
              url: "Ajaxcontroller/deleteUserAddress",
              type: "GET",           
              data: {adrs:adrs},
              success: function(data){
                    
                  alert(data);
                  location.reload();
                
               }
              });
              
           });
    $(document).on('submit','#add_address',(function(e){
    
    e.preventDefault();
      $.ajax({
      url: "<?php echo base_url('Ajaxcontroller/add_user_address') ?>",
      type: "POST",        
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData:false,  
      success: function(data){
        //$("#register_user")[0].reset();
        alert(data);
        location.reload();
        
     }  
     });  
 }));
 
});
</script>
 
 <?php } ?>