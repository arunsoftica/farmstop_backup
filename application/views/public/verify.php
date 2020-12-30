<?php
require_once APPPATH.'views/public/razor/config.php';
require_once APPPATH.'views/public/razor/razorpay-php/Razorpay.php';
/*require('config.php');

session_start();

require('razorpay-php/Razorpay.php');*/
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api('rzp_live_GuJfgGba3jJWjn', 'q6hwYp68aWSjbDCuuYwaX0vo');
    //$api = new Api('rzp_test_RrT5clklzb5HFt', 'U1kkyoEX02qe5lXwWrOpn4wo');
    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{ 
     /*$html = "<p>Your payment was successful</p>
     <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";*/
?>
<script>

    $(document).ready(function(){
        $('#vsubmit').hide();
        //alert('hello');
        $('#vsubmit').click();
        
    });
</script>
<form method="post" id="postFormVerify" action="<?php echo base_url('thankyou'); ?>">
    <input type="hidden" name="razorpay_payment_id" value="<?php echo $_POST['razorpay_payment_id']; ?>" >
    <input type="submit" id="vsubmit" name="submit" value="Submit">
</form>

    
<?php }
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

//echo $html;

?>


