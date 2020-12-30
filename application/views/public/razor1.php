<div style="height:500px;max-height:700px;">
        <div class="col-lg-12">
                <p style=" text-align:center; padding:50px"><a class="btn view-all" href="<?php echo base_url() ?>"><span class="fas fa-home"></span><br><br><br><br><br><br> Back to Home</a></p>
            </div>
    </div>
<?php
require_once APPPATH.'views/public/razor/config.php';
require_once APPPATH.'views/public/razor/razorpay-php/Razorpay.php';
/*require('config.php');
require('razorpay-php/Razorpay.php');*/
//session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api('rzp_live_GuJfgGba3jJWjn', 'q6hwYp68aWSjbDCuuYwaX0vo');
//$api = new Api('rzp_test_RrT5clklzb5HFt', 'U1kkyoEX02qe5lXwWrOpn4wo');
//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $_SESSION['farmstop_order_id'],
    'amount'          => $_SESSION['totalAmount'] * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

/*$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}*/

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Farmstop",
    "description"       => "Product Payment",
    "image"             => base_url('assets/images/farmstop.png'),
    "prefill"           => [
    "name"              => $_SESSION['login_name'],
    "email"             => $_SESSION['login_email'],
    "contact"           => $_SESSION['login_mobile'],
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

//require("checkout/{$checkout}.php");
?>
<form class="postFormsRazor" id="postFormsRazor" action="<?php echo base_url('verify') ?>" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="<?php echo $_SESSION['farmstop_order_id']; ?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?php echo $_SESSION['farmstop_order_id']; ?>">
</form>
<script>
$('.razorpay-payment-button').hide();
    $(document).ready(function(){
        if (performance.navigation.type == 1) {
            //alert('yes');
            window.location.href = "<?php echo base_url('checkout') ?>";
        }else{
            //alert('no');
            $('#postFormsRazor').submit();
        }
        
    });
</script>
