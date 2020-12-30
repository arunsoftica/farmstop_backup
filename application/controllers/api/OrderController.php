<?php
defined('BASEPATH') or exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once './application/helpers/jwt_helper.php';
require_once './application/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class OrderController extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->helper('jwt');
        $this->load->model('ProductApiModel');
        $this->load->model('Adminmodel');
        $this->api_key = "rzp_live_GuJfgGba3jJWjn";//"rzp_test_RrT5clklzb5HFt";
        $this->api_secret = "q6hwYp68aWSjbDCuuYwaX0vo";//"U1kkyoEX02qe5lXwWrOpn4wo";

        //test creds
        // $this->api_key = "rzp_test_RrT5clklzb5HFt";
        // $this->api_secret = "U1kkyoEX02qe5lXwWrOpn4wo";
        
    }
    
    public function getOrderList(){
        $user_id =  trim($this->input->get("user_id"));
        $token_result = $this->basic_model->validateHeader(trim($this->input->get("token")));
        if($user_id == ""){
            $error = array("status" => "0", "message" => "User not login");
            echo json_encode($error);
            exit;
        }


        $orderList = $this->ProductApiModel->getAllOrderByUser($user_id);

        if(is_array($orderList)  && count($orderList)>0){
            foreach($orderList as &$order){
                $order["date"] =  date("d M Y",strtotime($order["date"]));
                //echo "<br/>";
            }
            //die;
            // echo json_encode($orderList);
            // die;
            $success = array("status" => "1", "message" => "User not login","orderList"=>$orderList );
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Not find user order list");
            echo json_encode($error);
            exit;
        }
    }

    public function getOrderDetails(){
        $user_id =  trim($this->input->get("user_id"));
        $orderId_id =  trim($this->input->get("order_no"));
        $token_result = $this->basic_model->validateHeader(trim($this->input->get("token")));
        if($user_id == ""){
            $error = array("status" => "0", "message" => "User not login");
            echo json_encode($error);
            exit;
        }


        $orederDetails = $this->ProductApiModel->getOrderDetails($user_id,$orderId_id);

        if(is_array($orederDetails)  && count($orederDetails)>0){
            foreach($orederDetails as &$order){
                $order["date"] =  date("d M Y",strtotime($order["date"]));
                $variation = $this->basic_model->getSingleRecordData('variation_details',array('id'=>$order['variation_id']));
                $order["variation_value"] = $variation['weight'];
            }
            
            $success = array("status" => "1", "message" => "User not login","orederDetails"=>$orederDetails );
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Not find user order list");
            echo json_encode($error);
            exit;
        }
    }

    public function create_razor_orderId(){

        // $api_key="rzp_test_RrT5clklzb5HFt";
        // $api_secret="U1kkyoEX02qe5lXwWrOpn4wo";
        $userId = trim($this->input->post('user_id'));
        $user_type = trim($this->input->post("user_type"));
        $address_id = trim($this->input->post("address_id"));
        $usr_mob = trim($this->input->post("usr_mob"));

        $subtotal = trim($this->input->post("subtotal"));
        $shhipingCost = trim($this->input->post("shhipingCost"));
        $coupon_id = trim($this->input->post("coupon_id"));
        $total_cost = trim($this->input->post("total_cost"));

        $paymentOption = trim($this->input->post("paymentOption"));
        $status = trim($this->input->post("status"));
        $deliveryDate = trim($this->input->post("deliveryDate"));

        if($userId == ""){
            $error = array("status" => "0", "message" => "User not login");
            echo json_encode($error);
            exit;
        }

        if($address_id == ""){
            $error = array("status" => "0", "message" => "Please select shipping address.");
            echo json_encode($error);
            exit;
        }


        if($subtotal == ""){
            $error = array("status" => "0", "message" => "Not get subtotal");
            echo json_encode($error);
            exit;
        }


        if($shhipingCost == ""){
            $error = array("status" => "0", "message" => "Not get shipping cost");
            echo json_encode($error);
            exit;
        }

        if($total_cost == ""){
            $error = array("status" => "0", "message" => "Not Get total ammount for payment");
            echo json_encode($error);
            exit;
        }

        $orderData = array(
            "user_id"=>$userId,
            "user_type"=>$user_type,
            "address_id"=>$address_id,
            "usr_mob"=>$usr_mob,
            "sub_total_cost"=>$subtotal,
            "shipping_cost"=>$shhipingCost,
            "coupon_id"=>$coupon_id,
            "total_cost"=>$total_cost,
            "payment_option"=>$paymentOption,
            "delivery_date"=>$deliveryDate,
            "status"=>$status,
            "order_status"=>0,
            "date"=>date('Y-m-d h:i:s')
        );

        $orderId = $this->basic_model->insert("user_payment",$orderData);
        if($orderId != "" && $orderId > 0){
            $order_no = $this->basic_model->insert("user_order",array("payment_id"=>$orderId,"status"=>0,"date"=>date('Y-m-d h:i:s')));
            $api = new Api($this->api_key, $this->api_secret);
            $order = $api->order->create(array(
                'receipt' => $orderId,
                'amount' => ($total_cost*100),
                'payment_capture' => 1,
                'currency' => 'INR'
                )
            );

            // print_r($order);
            if($order['id'] !=""){
                $result = array(
                    "razor_orderId"=>$order['id'],
                    "entity"=>$order["entity"],
                    "amount"=>$order["amount"],
                    "amount_paid"=>$order["amount_paid"],
                    "amount_due"=>$order["amount_due"],
                    "currency"=>$order["currency"],
                    "receipt"=>$order["receipt"], // it is farmstop order id
                    "offer_id"=>$order["offer_id"], 
                    "status"=>$order["status"],
                    "attempts"=>$order["attempts"],
                    "order_no"=>$order_no
                );
                $success = array("status" => "1", "message" => "Order Created", "orderData"=>$result);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Something went wrong,try again latter");
                echo json_encode($error);
                exit;
            }
        }else{
            $error = array("status" => "0", "message" => "Something went wrong,try again latter");
            echo json_encode($error);
            exit;
        }
    }


    public function verifyPayment(){

        $razorpay_signature = trim($this->input->post("razorpay_signature"));
        $razorpay_payment_id = trim($this->input->post("razorpay_payment_id"));
        $razorpay_order_id = trim($this->input->post("razorpay_order_id"));
        $foramstopOrderId = trim($this->input->post("foramstopOrderId"));
        $order_no = trim($this->input->post("order_no"));
        $user_id = trim($this->input->post("user_id"));
        $email = trim($this->input->post("email"));
        $cartItems = trim($this->input->post("cart_items"));
        $token_result = $this->basic_model->validateHeader(trim($this->input->post("token")));

        if($user_id == ""){
            $error = array("status" => "0", "message" => "Please login then try again");
            echo json_encode($error);
            exit;
        }

        if($cartItems == ""){
            $error = array("status" => "0", "message" => "not get cartItem.");
            echo json_encode($error);
            exit;
        }

        if($foramstopOrderId == ""){
            $error = array("status" => "0", "message" => "not get farmstop orderid");
            echo json_encode($error);
            exit;
        }

        if($razorpay_signature == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get signature");
            echo json_encode($error);
            exit;
        }

        if($razorpay_payment_id == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get payment id");
            echo json_encode($error);
            exit;
        }

        if($razorpay_order_id == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get razor orderid");
            echo json_encode($error);
            exit;
        }

        $name = $token_result['name'] !=""?$token_result['name'] : "User";
        $price = floatval(trim($this->input->post("total_amt")))/100;

        $success = true;
        $api = new Api($this->api_key, $this->api_secret);
        try
        {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature
            );

            $res = $api->utility->verifyPaymentSignature($attributes);
            
            // //update cart
            // // $condition = array('user_id' => $user_id, 'pay_id'=>'', 'status' => 0);
            // $updateCart = $this->basic_model->update_item_to_cart($cartItems,$email,$foramstopOrderId);

            // //update user_payment
            // $updateUserPayment = $this->basic_model->updateData("user_payment",
            //     array("transaction_id"=>$razorpay_payment_id,"status"=>1),
            //     array("id"=>$foramstopOrderId,"user_id"=>$user_id)
            // );
            // //update user_order table
            // $updateUserOrder = $this->basic_model->updateData("user_order",
            //     array("status"=>1,"date"=>date('Y-m-d h:i:s')),
            //     array("payment_id"=>$foramstopOrderId)
            // );

            // $push_msg = $name." successfull payment of Rs " . $price ." has been received for your order :".$order_no; //Transaction Id:".$razorpay_payment_id
            // $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"order");
            // $this->confirmMsg($foramstopOrderId);
            // $success = array("status" => "1", "message" => "Payment Successfully");
            // echo json_encode($success);
            // exit;

        }catch(SignatureVerificationError $e){
            //update user_order table
            // $updateUserOrder = $this->basic_model->updateData("user_order",
            //     array("status"=>7,"date"=>date('Y-m-d h:i:s')),
            //     array("payment_id"=>$foramstopOrderId)
            // );

            // $push_msg = $name." payment for your order ".$order_no." has failed. Please try again.";
            // $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"payment_failed");

            $success = false;
            // $error = 'Razorpay Error : ' . $e->getMessage();
            // $error = array("status" => "0", "message" => $error);
            // echo json_encode($error);
            // exit;
        }

        if($success == true){
            
            //update cart
            // $condition = array('user_id' => $user_id, 'pay_id'=>'', 'status' => 0);
            $updateCart = $this->basic_model->update_item_to_cart($cartItems,$email,$foramstopOrderId);
            //update user_payment
            $updateUserPayment = $this->basic_model->updateData("user_payment",
                array("transaction_id"=>$razorpay_payment_id,"status"=>1, 'order_status' =>1),
                array("id"=>$foramstopOrderId,"user_id"=>$user_id)
            );
            //update user_order table
            $updateUserOrder = $this->basic_model->updateData("user_order",
                array("status"=>1,"date"=>date('Y-m-d h:i:s')),
                array("payment_id"=>$foramstopOrderId)
            );

            $push_msg = $name." successfull payment of Rs " . $price ." has been received for your order :".$order_no; //Transaction Id:".$razorpay_payment_id
            $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"order");
            $this->confirmMsg($foramstopOrderId);
            $success = array("status" => "1", "message" => "Payment Successfully");
            echo json_encode($success);
            exit;

        }else{
            $push_msg = $name." payment for your order ".$order_no." has failed. Please try again.";
            $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"payment_failed");
            $error = 'Razorpay Error : ' . $e->getMessage();
            $error = array("status" => "0", "message" => $error);
            echo json_encode($error);
            exit;
        }
    }


    private function verifyPaymentTest(){

        $razorpay_signature = trim($this->input->post("razorpay_signature"));
        $razorpay_payment_id = trim($this->input->post("razorpay_payment_id"));
        $razorpay_order_id = trim($this->input->post("razorpay_order_id"));
        $foramstopOrderId = trim($this->input->post("foramstopOrderId"));
        $order_no = trim($this->input->post("order_no"));
        $user_id = trim($this->input->post("user_id"));
        $email = trim($this->input->post("email"));
        $cartItems = trim($this->input->post("cart_items"));
        $token_result = $this->basic_model->validateHeader(trim($this->input->post("token")));

        if($user_id == ""){
            $error = array("status" => "0", "message" => "Please login then try again");
            echo json_encode($error);
            exit;
        }

        if($cartItems == ""){
            $error = array("status" => "0", "message" => "not get cartItem.");
            echo json_encode($error);
            exit;
        }

        if($foramstopOrderId == ""){
            $error = array("status" => "0", "message" => "not get farmstop orderid");
            echo json_encode($error);
            exit;
        }

        if($razorpay_signature == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get signature");
            echo json_encode($error);
            exit;
        }

        if($razorpay_payment_id == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get payment id");
            echo json_encode($error);
            exit;
        }

        if($razorpay_order_id == ""){
            $error = array("status" => "0", "message" => "Something went wrong,not get razor orderid");
            echo json_encode($error);
            exit;
        }

        $name = $token_result['name'] !=""?$token_result['name'] : "User";
        $price = floatval(trim($this->input->post("total_amt")))/100;

        $success = true;
        
        //$api = new Api("rzp_live_GuJfgGba3jJWjn", "q6hwYp68aWSjbDCuuYwaX0vo");//live
        $api = new Api("rzp_test_RrT5clklzb5HFt", "U1kkyoEX02qe5lXwWrOpn4wo");//test
        try
        {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature
            );

            $res = $api->utility->verifyPaymentSignature($attributes);
            //update cart
            // $condition = array('user_id' => $user_id, 'pay_id'=>'', 'status' => 0);
            // $updateCart = $this->basic_model->update_item_to_cart($cartItems,$email,$foramstopOrderId);
            // echo $updateCart;
            // print_r($res);
            // print_r($_POST);
            // die("Testing");
            // //update user_payment
            // $updateUserPayment = $this->basic_model->updateData("user_payment",
            //     array("transaction_id"=>$razorpay_payment_id,"status"=>1),
            //     array("id"=>$foramstopOrderId,"user_id"=>$user_id)
            // );
            // //update user_order table
            // $updateUserOrder = $this->basic_model->updateData("user_order",
            //     array("status"=>1,"date"=>date('Y-m-d h:i:s')),
            //     array("payment_id"=>$foramstopOrderId)
            // );

            // $push_msg = $name." successfull payment of Rs " . $price ." has been received for your order :".$order_no; //Transaction Id:".$razorpay_payment_id
            // $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"order");
            // $this->confirmMsg($foramstopOrderId);
            // $success = array("status" => "1", "message" => "Payment Successfully");
            // echo json_encode($success);
            // exit;

        }catch(SignatureVerificationError $e){
            $success = false;
            //update user_order table
            // $updateUserOrder = $this->basic_model->updateData("user_order",
            //     array("status"=>7,"date"=>date('Y-m-d h:i:s')),
            //     array("payment_id"=>$foramstopOrderId)
            // );

            // die("testing exception");

            // $push_msg = $name." payment for your order ".$order_no." has failed. Please try again.";
            // $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"payment_failed");

            // $success = false;
            // $error = 'Razorpay Error : ' . $e->getMessage();
            // $error = array("status" => "0", "message" => $error);
            // echo json_encode($error);
            // exit;
        }

        if($success == true){

            $updateCart = $this->basic_model->update_item_to_cart($cartItems,$email,$foramstopOrderId);

            $updateUserPayment = $this->basic_model->updateData("user_payment",
                array("transaction_id"=>$razorpay_payment_id,"status"=>1),
                array("id"=>$foramstopOrderId,"user_id"=>$user_id)
            );

            //update user_order table
            $updateUserOrder = $this->basic_model->updateData("user_order",
                array("status"=>1,"date"=>date('Y-m-d h:i:s')),
                array("payment_id"=>$foramstopOrderId)
            );

            $push_msg = $name." successfull payment of Rs " . $price ." has been received for your order :".$order_no; //Transaction Id:".$razorpay_payment_id
            $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"order");
            $this->confirmMsg($foramstopOrderId);
            $success = array("status" => "1", "message" => "Payment Successfully");
            echo json_encode($success);
            exit;

        }else{
            $push_msg = $name." payment for your order ".$order_no." has failed. Please try again.";
            $this->sendNotifications($user_id,$token_result,$order_no,$push_msg,"payment_failed");

            $error = 'Razorpay Error : ' . $e->getMessage();
            $error = array("status" => "0", "message" => $error);
            echo json_encode($error);
            exit;
        }
    }


    public function placedOrderOnCOD(){
        $userId = trim($this->input->post('user_id'));
        $user_type = trim($this->input->post("user_type"));
        $address_id = trim($this->input->post("address_id"));
        $usr_mob = trim($this->input->post("usr_mob"));

        $subtotal = trim($this->input->post("subtotal"));
        $shhipingCost = trim($this->input->post("shhipingCost"));
        $coupon_id = trim($this->input->post("coupon_id"));
        $total_cost = trim($this->input->post("total_cost"));

        $paymentOption = trim($this->input->post("paymentOption"));
        $status = trim($this->input->post("status"));
        $email= trim($this->input->post("email"));
        $deliveryDate = trim($this->input->post("deliveryDate"));
        $cartItems = trim($this->input->post("cart_items"));
        $token_result = $this->basic_model->validateHeader(trim($this->input->post("token")));

        if($userId == ""){
            $error = array("status" => "0", "message" => "User not login");
            echo json_encode($error);
            exit;
        }

        if($address_id == ""){
            $error = array("status" => "0", "message" => "Please select shipping address.");
            echo json_encode($error);
            exit;
        }

        if($cartItems == ""){
            $error = array("status" => "0", "message" => "not get cartItem.");
            echo json_encode($error);
            exit;
        }

        if($subtotal == ""){
            $error = array("status" => "0", "message" => "Not get subtotal");
            echo json_encode($error);
            exit;
        }


        if($shhipingCost == ""){
            $error = array("status" => "0", "message" => "Not get shipping cost");
            echo json_encode($error);
            exit;
        }

        if($total_cost == ""){
            $error = array("status" => "0", "message" => "Not Get total ammount for payment");
            echo json_encode($error);
            exit;
        }

        $orderData = array(
            "user_id"=>$userId,
            "user_type"=>$user_type,
            "address_id"=>$address_id,
            "usr_mob"=>$usr_mob,
            "sub_total_cost"=>$subtotal,
            "shipping_cost"=>$shhipingCost,
            "coupon_id"=>$coupon_id,
            "total_cost"=>$total_cost,
            "payment_option"=>$paymentOption,
            "delivery_date"=>$deliveryDate,
            "transaction_id"=>"COD",
            "status"=>1,
            "order_status"=>0,
            "date"=>date('Y-m-d h:i:s')
        );

        $orderId = $this->basic_model->insert("user_payment",$orderData);
        if($orderId != "" && $orderId > 0){
            $order_no = $this->basic_model->insert("user_order",array("payment_id"=>$orderId,"status"=>1,"date"=>date('Y-m-d h:i:s')));
            //update cart
            $condition = array('user_id' => $userId, 'pay_id'=>'', 'status' => 0);
            // $updateCart = $this->basic_model->updateData("add_cart_items",
            //     array("email"=>$email,"pay_id"=>$orderId,"status"=>1),
            //     $condition
            // );
            
            $updateCart = $this->basic_model->update_item_to_cart($cartItems,$email,$orderId);

            if($updateCart){
                $this->confirmMsg($orderId);
                $name = $token_result['name'] !=""?$token_result['name'] : "User";
                $push_msg = $name." your order successfully placed.Payment type:Cash on delivery, Order Number: ".$order_no; //Transaction Id:".$razorpay_payment_id
                $this->sendNotifications($userId,$token_result,$order_no,$push_msg,'order');
                $success = array("status" => "1", "message" => "Payment Successfully");
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Failed , try again!");
                echo json_encode($error);
                exit;    
            }

        }else{
            $error = array("status" => "0", "message" => "Failed , try again!");
            echo json_encode($error);
            exit;
        }
    }


    public function sendNotifications($userId ,$user_data,$order_no ,$msg,$type){
        $android_server_key = "AAAASu6ZOBE:APA91bGuB9p3c0S2jZ2spxN5UVeI9JmstXXBp4Sebyik7zkKX-ZgTf0xDboJx4Ss40serscmQP69WDrOiYZ7EvBpXnCCMaOD-cTTX2f7kQmnMmMfWY75NQEl_2owibMgZcuueTTp7LyP";
        $Pushmessage    = substr($msg , 0, 100) . '.....';
        $mobileToken = $user_data["deviceToken"];//"cfs06juJS8WcS56eVzHrqb:APA91bEN_VgWzVX8bLhTiyfYVGjfeAv-BsXkedPPbrou9m3NwK72QaIoTzBFxTqUuDxqdWXnjPAFTMmoUoHsey7Qj5WhU_Lni2520sYjI2her49_fnbqH6CxsncLj9F6TjM1D_5u0XNS";
        $message = array(
            'title'         => "Farmstop",
            'message'       => $Pushmessage,
            'vibrate'       => 1,
            'sound'         => 1,
            'largeIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'smallIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'type'          =>$type,//'order',
        );

        $notification = json_decode($this->basic_model->sendPushNotification( $android_server_key, $mobileToken, $message ));
        if($notification->failure == 0)
        {
            $this->basic_model->insert("user_notification", array("user_id"=>$userId,"title"=>"Farmstop Order","message"=>$msg,"type"=>$type,"order_no"=>$order_no,"date"=>date('Y-m-d h:i:s')));
        }
        //echo json_encode($notification);
        //exit;
    }

    public function sendNotificationsTesting(){
        $android_server_key = "AAAASu6ZOBE:APA91bGuB9p3c0S2jZ2spxN5UVeI9JmstXXBp4Sebyik7zkKX-ZgTf0xDboJx4Ss40serscmQP69WDrOiYZ7EvBpXnCCMaOD-cTTX2f7kQmnMmMfWY75NQEl_2owibMgZcuueTTp7LyP";
        $Pushmessage    = substr("Organic food is good for health." , 0, 100) . '.....';
        $mobileToken = "eSe7a7iyS32uEG6LmdGu0f:APA91bHjfiEfQNKgedjbZCJ4HQPDiCSczw1TNM9eFuEVkdRVZQ-NC_UUVxPowOZfWwoN1Whkyhzzghf122BvKARZMREo5cZfUJiAfqNAU8ESTVXPRAVmJtFSr_sIyPm7PqO7CbstIGgH";
        $message = array(
            'title'         => "Farmstop",
            'message'       => $Pushmessage,
            'vibrate'       => 1,
            'sound'         => 1,
            'image'         => "https://www.farmstop.in/assets/images/farmstop.png",
            'largeIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'smallIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'type'          =>$type,//'order',
        );

        $notification = json_decode($this->basic_model->sendPushNotification( $android_server_key, $mobileToken, $message ));
        if($notification->failure == 0)
        {
            //$this->basic_model->insert("user_notification", array("user_id"=>$userId,"title"=>"Farmstop Order","message"=>$msg,"type"=>$type,"order_no"=>$order_no,"date"=>date('Y-m-d h:i:s')));
        }

        //echo json_encode($notification);
        //exit;
    }

    private function confirmMsg($user_payment_id){
        $data = array();
        $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($user_payment_id);
        $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
            //print_r($data['invoice_details']['user_type']);exit;
        $data['get_cart_items'] = $this->Adminmodel->getCartItems($user_payment_id);
            /*pdf code*/
        require_once APPPATH.'views/public/dompdf/autoload.inc.php';     
             /**   **/
        $this->load->library("phpmailer_library");
        $mail = $this->phpmailer_library->load();
        $mail->isSMTP();
        $mail->Host = 'mail.farmstop.in';
        $mail->Port = 587; 
        $mail->SMTPAuth = false;
        $mail->SMTPSecure = false;
     
        $mail->Username = 'sales@farmstop.in';
        $mail->Password = 'Farmstop@123';
     
        $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
        $mail->addAddress(trim($data['get_user_details']['email']));
        $message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";
     
        if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                      $pay_method = 'Credit Card/Debit Card/NetBanking';
                 }else if($data["invoice_details"]['payment_option'] == '2'){
                      $pay_method = 'Cash on delivery';
                 }
     
        $message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
        </span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>Rs: <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
            foreach($data['get_cart_items'] as $get_cart_itemz){ 
                    if($get_cart_itemz['saleprice'] == '0.00'){
                        $saleprice = $get_cart_itemz['regularprice'];
                    }else{
                        $saleprice = $get_cart_itemz['saleprice'];
                    }
            $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/teao/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong> &#215; ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>&#8377; </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
            }
                                                        
            $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
            "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";
        
            $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["total_cost"]."</span></td></tr>";
        
            $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";
                    /*$dompdf = new Dompdf();
                    $dompdf->loadHtml($message);
        
                $dompdf->setPaper('A4','portrait');
                
                $dompdf->render();
                
                $fileatt = $dompdf->output();
                
                $filename = 'Invoice.pdf';
                $encoding = 'base64';
                $type = 'application/pdf';
                    $mail->AddStringAttachment($fileatt,$filename,$encoding,$type);*/
                    //$mail->addAddress(trim('info@softica.in'));
                    $mail->addReplyTo('sales@farmstop.in');
                    $mail->isHTML(true);
        
                    $mail->Subject = "FARMSTOP NEW ORDER MAIL";
                    
                    $mail->Body = $message;
                    if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        //echo $ads;
                    }
                /*pdf code*/
                /* ADD PRODUCT EMAIL only one time */
                /*$to   = $this->session->userdata('login_email');
                $subject = "FARMSTOP New Order Email";
                $from = 'sales@farmstop.in';
        
        $message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";
        
        if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                        $pay_method = 'Credit Card/Debit Card/NetBanking';
                    }else if($data["invoice_details"]['payment_option'] == '2'){
                        $pay_method = 'Cash on delivery';
                    }
        
        $message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
        </span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>Rs: <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
            foreach($data['get_cart_items'] as $get_cart_itemz){ 
                    if($get_cart_itemz['saleprice'] == '0.00'){
                        $saleprice = $get_cart_itemz['regularprice'];
                    }else{
                        $saleprice = $get_cart_itemz['saleprice'];
                    }
            $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/teao/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong>× ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>&#8377; </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
            }
                                                        
            $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
            "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";
        
            $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["total_cost"]."</span></td></tr>";
        
            $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";
        
            $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                $headers .= "From: " . strip_tags($from) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                mail($to, $subject, $message, $headers);*/
                /*$to   = $this->session->userdata('login_email');
                $subject = "FARMSTOP New Order Email";
                $from = 'sales@farmstop.in';
                
                $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
                $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
                $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi '.$data["get_user_details"]["name"].',</p><p>Your order has been received and is now being processed.Your order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
                foreach($data['get_cart_items'] as $get_cart_itemz){ 
                    if($get_cart_itemz['saleprice'] == '0.00'){
                        $saleprice = $get_cart_itemz['regularprice'];
                    }else{
                        $saleprice = $get_cart_itemz['saleprice'];
                    }
                $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
                }
                    if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                        $pay_method = 'Credit Card/Debit Card/NetBanking';
                    }else if($data["invoice_details"]['payment_option'] == '2'){
                        $pay_method = 'Cash on delivery';
                    }
                $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
            $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
                $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
                $message .= "</body></html>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                $headers .= "From: " . strip_tags($from) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                mail($to, $subject, $message, $headers);*/
                
                /*-----*/
                $to   = 'sales@farmstop.in';
                $subject = "FARMSTOP New Order Email";
                $from = 'sales@farmstop.in';
                
                $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
                $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
                $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi FARMSTOP,</p><p>You have received a order.Order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
                foreach($data['get_cart_items'] as $get_cart_itemz){ 
                    if($get_cart_itemz['saleprice'] == '0.00'){
                        $saleprice = $get_cart_itemz['regularprice'];
                    }else{
                        $saleprice = $get_cart_itemz['saleprice'];
                    }
                $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
                }
                    if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                        $pay_method = 'Credit Card/Debit Card/NetBanking';
                    }else if($data["invoice_details"]['payment_option'] == '2'){
                        $pay_method = 'Cash on delivery';
                    }
                $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
            $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
                $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
                $message .= "</body></html>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                $headers .= "From: " . strip_tags($from) . "\r\n";
                $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                mail($to, $subject, $message, $headers);
                
                /*sms code*/
                $uoid = $data["invoice_details"]["oid"];
                $uomob = $data["get_user_details"]["mobile"];
                //$msg = "Your Farmstop order #$uoid has been placed successfully.Thank you.Visit https://www.farmstop.in";
                //$udd = date('d/m/Y',strtotime($data['invoice_details']['delivery_date']));
                $udd = $data['invoice_details']['delivery_date'];//date('d/m/Y',strtotime($data['invoice_details']['delivery_date']));
                $msg = "Your Farmstop Order #$uoid is confirmed! You will receive your order on $udd";
                                    
                $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=$uomob;
                $message = urlencode("$msg");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                                    
                $send = explode('|',$return[0]);
        }

        private function confirmMsgTest(){
            $user_payment_id = $_GET['order_id'];
            $data = array();
            $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($user_payment_id);
            echo "<pre>";print_r($data);die;
            $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
                //print_r($data['invoice_details']['user_type']);exit;
            $data['get_cart_items'] = $this->Adminmodel->getCartItems($user_payment_id);
                /*pdf code*/
            require_once APPPATH.'views/public/dompdf/autoload.inc.php';     
                 /**   **/
            $this->load->library("phpmailer_library");
            $mail = $this->phpmailer_library->load();
            $mail->isSMTP();
            $mail->Host = 'mail.farmstop.in';
            $mail->Port = 587; 
            $mail->SMTPAuth = false;
            $mail->SMTPSecure = false;
         
            $mail->Username = 'sales@farmstop.in';
            $mail->Password = 'Farmstop@123';
         
            $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
            $mail->addAddress(trim($data['get_user_details']['email']));
            $message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";
         
            if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                          $pay_method = 'Credit Card/Debit Card/NetBanking';
                     }else if($data["invoice_details"]['payment_option'] == '2'){
                          $pay_method = 'Cash on delivery';
                     }
         
            $message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
            </span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>Rs: <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
                foreach($data['get_cart_items'] as $get_cart_itemz){ 
                        if($get_cart_itemz['saleprice'] == '0.00'){
                            $saleprice = $get_cart_itemz['regularprice'];
                        }else{
                            $saleprice = $get_cart_itemz['saleprice'];
                        }
                $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/teao/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong> &#215; ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>&#8377; </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
                }
                                                            
                $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
                "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";
            
                $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["total_cost"]."</span></td></tr>";
            
                $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";
                        /*$dompdf = new Dompdf();
                        $dompdf->loadHtml($message);
            
                    $dompdf->setPaper('A4','portrait');
                    
                    $dompdf->render();
                    
                    $fileatt = $dompdf->output();
                    
                    $filename = 'Invoice.pdf';
                    $encoding = 'base64';
                    $type = 'application/pdf';
                        $mail->AddStringAttachment($fileatt,$filename,$encoding,$type);*/
                        //$mail->addAddress(trim('info@softica.in'));
                        $mail->addReplyTo('sales@farmstop.in');
                        $mail->isHTML(true);
            
                        $mail->Subject = "FARMSTOP NEW ORDER MAIL";
                        
                        $mail->Body = $message;
                        if(!$mail->send()) {
                            echo 'Message could not be sent.';
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } else {
                            //echo $ads;
                        }
                    /*pdf code*/
                    /* ADD PRODUCT EMAIL only one time */
                    /*$to   = $this->session->userdata('login_email');
                    $subject = "FARMSTOP New Order Email";
                    $from = 'sales@farmstop.in';
            
            $message ="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head>";
            
            if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                            $pay_method = 'Credit Card/Debit Card/NetBanking';
                        }else if($data["invoice_details"]['payment_option'] == '2'){
                            $pay_method = 'Cash on delivery';
                        }
            
            $message .="<body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:18px;font-style:normal;line-height:30px;text-align:center'><h2 style='text-align:center;margin:0'><span style='color:#000;'><span style=''>Thank you ".$data["get_user_details"]["name"]."<br>Your order has been received<br>Order Number# ".$data["invoice_details"]["oid"]."
            </span></span></h2></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;font-family:Cardo;' width='100%'><tbody><tr><td align='left' style='background: #c1c1c16e; padding-left: 10px; padding-top: 10px'><p><span>".$data["get_user_details"]["name"]."</span><br><span>".$data["get_user_details"]["email"]."</span><br><span>".$data["invoice_details"]["uaddress"]."</span><br><span>".$data["invoice_details"]["udistrict"]."</span><br><span>India-".$data["invoice_details"]["uzipcode"]."</span></p></td><td align='right' style='padding-right: 10px; padding-top: 10px;background: #c1c1c16e;padding:5px;'><p>Rs: <span style='font-size:22px;font-weight:700;'>".$data["invoice_details"]["total_cost"]."</span></p><p>".$pay_method."</p></td></tr></tbody></table></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100% font-family:Cardo;' width='100%'><tbody>";
                foreach($data['get_cart_items'] as $get_cart_itemz){ 
                        if($get_cart_itemz['saleprice'] == '0.00'){
                            $saleprice = $get_cart_itemz['regularprice'];
                        }else{
                            $saleprice = $get_cart_itemz['saleprice'];
                        }
                $message .="<tr><td align='left' style='padding-left: 10px; padding-top: 10px'><img width='70' src='https://www.farmstop.in/teao/uploads/product_variation_images/".$get_cart_itemz["pfimage"]."' class='img-fluid' alt=''></td><td><p>".$get_cart_itemz["attributename"]."</p>".$get_cart_itemz["attribute_value"]."&nbsp;<strong>× ".$get_cart_itemz["total_item"]."</strong></td><td align='right' style='padding-right: 10px;'><span><span>&#8377; </span>".$saleprice*$get_cart_itemz["total_item"]."</span></td></tr>";
                }
                                                            
                $message .="<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px'>Subtotal</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["sub_total_cost"]."</span></td></tr>";
                "<tr><td align='right' colspan='2' style='padding-left: 10px; padding-top: 10px;font-family:Cardo;'>Sipping</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["shipping_cost"]."</span></td></tr>";
            
                $message .="<tr><td align='right' colspan='2' style='font-family:Cardo;padding-left: 10px; padding-top: 10px'>Order total</td><td align='right' style='font-family:Cardo;padding-right: 10px; padding-top: 10px'><span>&#8377; ".$data["invoice_details"]["total_cost"]."</span></td></tr>";
            
                $message .="</tbody></table></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";
            
                $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                    $headers .= "From: " . strip_tags($from) . "\r\n";
                    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                    mail($to, $subject, $message, $headers);*/
                    /*$to   = $this->session->userdata('login_email');
                    $subject = "FARMSTOP New Order Email";
                    $from = 'sales@farmstop.in';
                    
                    $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
                    $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
                    $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi '.$data["get_user_details"]["name"].',</p><p>Your order has been received and is now being processed.Your order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
                    foreach($data['get_cart_items'] as $get_cart_itemz){ 
                        if($get_cart_itemz['saleprice'] == '0.00'){
                            $saleprice = $get_cart_itemz['regularprice'];
                        }else{
                            $saleprice = $get_cart_itemz['saleprice'];
                        }
                    $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
                    }
                        if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                            $pay_method = 'Credit Card/Debit Card/NetBanking';
                        }else if($data["invoice_details"]['payment_option'] == '2'){
                            $pay_method = 'Cash on delivery';
                        }
                    $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
                $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
                    $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
                    $message .= "</body></html>";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                    $headers .= "From: " . strip_tags($from) . "\r\n";
                    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                    mail($to, $subject, $message, $headers);*/
                    
                    /*-----*/
                    $to   = 'sales@farmstop.in';
                    $subject = "FARMSTOP New Order Email";
                    $from = 'sales@farmstop.in';
                    
                    $message = '<html><body style="padding-top:50px;background: #eee;><div style="display:flex;"><div style="width: 25%"></div><div style="max-width: 100%;background: #ffff;padding: 10px;width: 500px;border: 1px #808080 solid;">';
                    $message .= '<table style="width:100%;" cellspacing="0"><tbody>';
                    $message .= '<tr><td colspan="3" style="text-align:center;"><img style="padding: 6px;width: 90px;" src="'.base_url().'assets/images/farmstop.png"></td></tr><tr><td colspan="3" style="background-color: green;color: white;height:62px;font-size:30px;text-align:center">Thanks for your order</td></tr><tr><td colspan="3" style="font-size:18px;padding:20px;"><p>Hi FARMSTOP,</p><p>You have received a order.Order details are shown below for your reference:</p><b>Order #'. $data["invoice_details"]["oid"] .' ('.date("l dS F,Y", strtotime($data["invoice_details"]["date"])).')</b></td></tr><tr><td style="border:1px solid grey;font-size: 18px;padding:10px;"><b>Product</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Quantity</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Price</b></td></tr>';
                    foreach($data['get_cart_items'] as $get_cart_itemz){ 
                        if($get_cart_itemz['saleprice'] == '0.00'){
                            $saleprice = $get_cart_itemz['regularprice'];
                        }else{
                            $saleprice = $get_cart_itemz['saleprice'];
                        }
                    $message .= '<tr><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["attributename"].'('.$get_cart_itemz["attribute_value"].')'.'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$get_cart_itemz["total_item"].'</td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$saleprice*$get_cart_itemz["total_item"].'</td></tr>';
                    }
                        if($data["invoice_details"]['payment_option'] == '1' || $data["invoice_details"]['payment_option'] == '4'){
                            $pay_method = 'Credit Card/Debit Card/NetBanking';
                        }else if($data["invoice_details"]['payment_option'] == '2'){
                            $pay_method = 'Cash on delivery';
                        }
                    $message .= '<tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Subtotal:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["sub_total_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Shipping:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["shipping_cost"].'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Payment Method:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$pay_method.'</td></tr><tr><td colspan="2" style="border:1px solid grey;font-size: 18px;padding:5px;"><b>Total:</b></td><td style="border:1px solid grey;font-size: 18px;padding:5px;">'.$data["invoice_details"]["total_cost"].'</td></tr>';
                $message .= '<tr><td ><b>Billing Address:</b></td><td ><b>Shipping Address:</b></td></tr><tr><td ><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td><td colspan="2"><p style="border:1px solid grey;font-size:18px;padding:5px;">'.$data["get_user_details"]["name"].'<br>'.$data["invoice_details"]["uaddress"].'<br>'.$data["invoice_details"]["udistrict"].','.$data["invoice_details"]["uzipcode"].'<br>India<br>'.$data["get_user_details"]["mobile"].'<br>'.$data["get_user_details"]["email"].'</p></td></tr>';
                    $message .= '</tbody></table></div><div style="width: 25%"></div></div>';
                    $message .= "</body></html>";
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                    $headers .= "From: " . strip_tags($from) . "\r\n";
                    $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
                    //mail($to, $subject, $message, $headers);
                    
                    /* ADD PRODUCT EMAIL */
                    /*sms code*/

                    $uoid = $data["invoice_details"]["oid"];
                    $uomob = $data["get_user_details"]["mobile"];
                    //$msg = "Your Farmstop order #$uoid has been placed successfully.Thank you.Visit https://www.farmstop.in";
                    //echo "date=>".$data['invoice_details']['delivery_date']."<br/>";
                    $udd = $data['invoice_details']['delivery_date'];//date('d/m/Y',strtotime($data['invoice_details']['delivery_date']));
                    echo $udd."<br/>";
                    $msg = "Your Farmstop Order #$uoid is confirmed! You will receive your order on $udd";
                    
                    $username="STfrmstop";
                    $password = "Farm123";
                    $type ="TEXT";
                    $sender="FRMSTP";
                    $mobile=$uomob;
                    $message = urlencode("$msg");
                    $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                    $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                    echo $url;
                    die;
                    //$return = file($url);
                    
                    $send = explode('|',$return[0]);
                    /*sms code*/
    }
        
}
?>