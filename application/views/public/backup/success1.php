
<?php
if (isset($_POST['razorpay_payment_id'])) {
	$razorpay_payment_id = $_POST['razorpay_payment_id'];
	
	echo "Razorpay success ID: ". $razorpay_payment_id;
}else if(isset($_POST['payuMoneyId'])){
    if($_POST['status'] == 'success'){
        echo "<h3>Thank You. Your order status is ". $_POST['status'] .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$_POST['payuMoneyId'].".</h4>";
          echo "<h4>We have received a payment of Rs. " . $_POST['amount'] . ". Your order will soon be shipped.</h4>";
    
    }   
}
?>

<script>
                    var sess_items  = "<?php echo $this->session->userdata('your_cart_item') ?>";
                    $.ajax({
                        type: "GET",
                        
                        url: "<?php echo base_url("Ajaxcontroller/delete_session_item_cart") ?>",
                        data: {sess_items:sess_items},
                        success: function (data) { 
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
                    });
    
</script>