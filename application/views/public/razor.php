    <div style="height:700px;max-height:700px;">
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p style=" text-align:center; padding:50px"><a href="<?php echo base_url(); ?>" class="btn btn-success"> Back to Home</a></p>
            </div>
         </div>
    </div>
    
    <div id="razor">
      <form class="postFormsRazor" id="postFormsRazor" action="<?php echo base_url('thankyou') ?>" method="POST">
    <!-- Note that the amount is in paise = 50 INR -->
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_live_GuJfgGba3jJWjn"
        data-amount="<?php echo $_SESSION['totalAmount']*100 ?>"
        data-buttontext="Pay with Razorpay"
        data-name="FARMSTOP"
        data-description="Product Payment"
        data-image="<?php echo base_url('assets/images/farmstop.png') ?>"
        data-prefill.name="<?php if(isset($_SESSION['login_name'])) echo $_SESSION['login_name']; ?>"
        data-prefill.email="<?php if(isset($_SESSION['login_email'])) echo $_SESSION['login_email']; ?>"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" value="Hidden Element" name="hidden">
    </form>  
    </div>
    
<script>
$('.razorpay-payment-button').hide();
    $(document).ready(function(){
        
        $('#postFormsRazor').submit();
    });
</script>
 
