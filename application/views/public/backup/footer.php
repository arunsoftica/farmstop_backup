<section class="ftr-contact">
  <div class="container-fluid p-0">
    <div class="row bg-light">
      <div class="col-md-4 offset-md-4 p-3 mb-5">
            <div class="text-white padding-heading-top">
           		<h2 align="center" class="pt-0">Contact </h2>
   		    </div>
          <form method="post" id="contact_us" >
                <div class="form-group">
                <input type="text" name="cname" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group">
                <input type="email" name="cemail" class="form-control" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                <input type="number" name="cmobile" class="form-control"  placeholder="Mobile No">
                </div>
                <div class="form-group">
                <textarea name="cmessage" class="form-control" placeholder=" Enter Message"></textarea>
                </div>
                <!--div class="form-check" align="center">
                <input type="checkbox" class="form-check-input">
                <label class="form-check-label" for="exampleCheck1">LogIn / Newsletter</label>
                </div-->
                <div class="form-check mt-2" align="center">
                <button type="submit" name="csubmit" id="csubmit" class="btn btn-black">Submit</button>
                <p id="contactmsg" style="color:white;"></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>
<div id="social-icon" class="">
  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
</div>
<footer class="page-footer font-small pt-5 pb-5 d-none d-sm-block">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left mt-5">
    <div class="row">
      <div class="col-md-12 col-12-hidden mt-5 text-p">
        <ul class="list-unstyled">
          <li>
            <a href="<?php echo base_url('about') ?>">About</a>
          </li>
          <li>
            <a href="<?php echo base_url('contact') ?>">Contact</a>
          </li>
          <li>
            <a href="#!">Career</a>
          </li>
          <li>
            <a href="<?php echo base_url('blog') ?>">Blog</a>
          </li>
        </ul>
        <a class="faqs"> faqs</a>
      </div>
      
    </div>

  </div>
</footer>
<footer class="footer fixed-bottom box-footer-shadow py-2 bg-white d-block d-sm-none">
  <div class="d-flex align-items-center text-center">
    <a href="#" class="flex-fill"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#000" d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg><p class="text-muted m-0">Home</p></a>
    <a href="#" class="flex-fill"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#000" d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg><p class="text-muted m-0">Cart</p></a>
    <a href="#" class="flex-fill"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path fill="#000" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg><p class="text-muted m-0">Wishlist </p></a>
    <a href="#" class="flex-fill"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#000" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg><p class="text-muted m-0">Account</p></a>
  </div>
</footer>
<!-- Footer -->
</body>
<script>
$(document).ready(function(){
            $(document).on('submit','#contact_us',(function(e){
            $('#contactmsg').html(" ");
            $("#csubmit").addClass('disabled');
            $("#csubmit").text('please wait....'); 
            e.preventDefault();
              $.ajax({
              url: "<?php echo base_url('Ajaxcontroller/addContactUs') ?>",
              type: "POST",        
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,  
              success: function(data){
                
                $('#contactmsg').html(data);
                $("#contact_us")[0].reset();
                $("#csubmit").removeClass("disabled");
                $("#csubmit").text('Submit');
        
             }  
             });  
         }));

            $(document).on('click', '#logoutbtn', function (e) {
            //alert($(this).val());
            var item_id = $(this).val();
            /*if(item_id == 1){
                FB.logout(function(response) {
                  
                });
            }*/
            
                    
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/logout") ?>",
                        data: {item_id:item_id},
                        success: function (data) {
                             if(data == 'lo'){
                                 location.reload();
                             }
                            }
                                    
                                    
                            });
            });
            $(document).on('click', '#sidebarCollapse-cart', function (e) {

            var cart = 2;
                
                $.ajax({
                    type: "GET",
                    
                    url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                    data: {cart:cart},
                    success: function (data) {
                        
                        //alert(data);
                        $('#cart-items').empty();
                        $('#cart-items').html(data);
                    }
                });
                
            });
            
            var cart = 1;
            
            $.ajax({
                type: "GET",
                
                url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                data: {cart:cart},
                success: function (data) {
                    
                    $('#items').empty();
                    $('#items').append(data);
                }
            });
            
            
            $(document).on('submit','#login_user',(function(e){
    
            e.preventDefault();
              $.ajax({
              url: "<?php echo base_url('Ajaxcontroller/login_user') ?>",
              type: "POST",        
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData:false,  
              success: function(data){
                $("#login_user")[0].reset();
                //alert(data);
                if(data == 'yes'){
                    location.reload();
                }
             }  
             });  
         }));
         $(document).on('click', '.itemdelete', function (e) {
    
            var item_id = $(this).val();
                    
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/delete_item_cart") ?>",
                        data: {item_id:item_id},
                        success: function (data) {
                            if(data == 'delete'){
                                    var cart = 2;
                                    
                                    $.ajax({
                                        type: "GET",
                                        
                                        url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                                        data: {cart:cart},
                                        success: function (data) {
                                            
                                            //alert(data);
                                            $('#cart-items').empty();
                                            $('#cart-items').html(data);
                                        }
                                    });
                                    
                                    var cart = 1;
                                    
                                    $.ajax({
                                        type: "GET",
                                        
                                        url: "<?php echo base_url("Ajaxcontroller/add_item_to_cart") ?>",
                                        data: {cart:cart},
                                        success: function (data) {
                                            
                                            $('#items').empty();
                                            $('#items').append(data);
                                        }
                                    });
                            }
                            
                            
        
                        }
                    });
                    
         });


});
            
</script>
</html>