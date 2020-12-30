<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once './application/helpers/jwt_helper.php';

class SignupLoginApi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('jwt');
        $this->load->model('Adminmodel');
    }

    public function updateDeviceToken(){
        $userId = trim($this->input->post("userId"));
        $userType = trim($this->input->post("userType"));
        $deviceToken = trim($this->input->post("devicetoken"));
        $os = trim($this->input->post("os"));

        if($userId ==''){
            $error = array("status" => "0", "message" => "Not find user Id.");
            echo json_encode($error);
            exit;            
        }

        if($$userType ==''){
            $error = array("status" => "0", "message" => "Not find user type.");
            echo json_encode($error);
            exit;            
        }

        if($deviceToken ==''){
            $error = array("status" => "0", "message" => "Not find device token.");
            echo json_encode($error);
            exit;            
        }

        if($os ==''){
            $error = array("status" => "0", "message" => "Not find application type.");
            echo json_encode($error);
            exit;
        }

        if($userType == "MANUAL"){
            $registerUpdate = $this->basic_model->update("register_user",array("deviceToken"=>$deviceToken,"os"=>$os),array('id'=>$userId));
            
            if($registerUpdate){
                $success = array("status" => "1", "message" => "Device token update.");
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Device token update fail.");
                echo json_encode($error);
                exit;
            }

        }else{
            $socialDeviceToken=$this->basic_model->update("social_user",array("deviceToken"=>$deviceToken,"os"=>$os),array('social_id'=>$userId));
            if($socialDeviceToken){
                $success = array("status" => "1", "message" => "Device token update.");
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Device token update fail.");
                echo json_encode($error);
                exit;
            }
        }
    }

    public function signUp(){
        $username = trim(addslashes($this->input->post('username')));
        $email = trim(addslashes($this->input->post('email')));
        $password = addslashes($this->input->post('password'));
        $deviceToken = trim($this->input->post("devicetoken"));
        $os = trim($this->input->post("os"));

        if ($username === '' ) {
            $error = array("status" => "0", "message" => "Please enter Username");
            echo json_encode($error);
            exit;
        }

        if ($email === '' ) {
            $error = array("status" => "0", "message" => "Please enter email or mobile number");
            echo json_encode($error);
            exit;
        }

        if ($password === '') {
            $error = array("status" => "0", "message" => "Please enter password");
            echo json_encode($error);
            exit;
        }

        $isMobile = false;
        if(!preg_match("/[a-z]/i", $email)){
            $isMobile = true;
        }

        if($isMobile){
            $record = $this->basic_model->getSingleRecord('register_user',array('mobile'=>$email));
            if($record == true){
                $error = array("status" => "2", "message" => "Mobile Number is already register");
                echo json_encode($error);
                exit;
            }

        }else{
            $record = $this->basic_model->getSingleRecord('register_user',array('email'=>$email));
            if($record == true){
                $error = array("status" => "2", "message" => "Mobile Number is already register");
                echo json_encode($error);
                exit;
            }
        }
        
        if($isMobile){
            $data = array('name' => $username,'mobile' => $email,'password' => $password,'type' => 1,'date' => date('Y-m-d h:i:s'),'app_user'=>1,'status'=>1,"deviceToken"=>$deviceToken,"os"=>$os);
        }else{
            $data = array('name' => $username,'email' => $email,'password' => $password,'type' => 1,'date' => date('Y-m-d h:i:s'),'app_user'=>1,'status'=>1,"deviceToken"=>$deviceToken,"os"=>$os);
        }
        
        $user_id = $this->basic_model->insert('register_user', $data);

        if($user_id > 0)
        {
            $success = array("status" => "1", "message" => "Signup Successfully.");
            echo json_encode($success);
            exit;

        }else{
            $error = array("status" => "0", "message" => "Somthing went wrong try again.");
            echo json_encode($error);
            exit;
        }
    }


    public function socialLogin(){

        $id = $this->input->post("id");
        $email = $this->input->post("email");
        $name = $this->input->post("name");
        $first_name = $this->input->post("first_name");
        $last_name = $this->input->post("last_name");
        $social_type = $this->input->post("social_type");
        $image = $this->input->post("image");
        $deviceToken = trim($this->input->post("devicetoken"));
        $os = trim($this->input->post("os"));

        $record = $this->basic_model->getSingleRecordData('social_user',array('social_id'=>$id));
        
        if(is_array($record) && count($record)>0){
            $this->basic_model->update("social_user",array("deviceToken"=>$deviceToken,"os"=>$os),array('social_id'=>$id));
            $payload = ["data" => $record];
            $key = "secret";
            $token = JWT::encode($payload, $key, 'HS256');
            $success = array("status" => "1", "message" => "Sign in successfully.","user_info"=>$record , "token"=>$token);
            echo json_encode($success);
            exit;
        }
        

        $type = $social_type == "GMAIL" ? "3" :"2";
        $data = array(
            "social_id"=>$id,
            "name"=>$name,
            "email"=> $email,
            "image_url"=>$image,
            "type"=>$type,
            "date"=> date('Y-m-d h:i:s'),
            "deviceToken"=>$deviceToken,
            "os"=>$os
        );
        
        $user_id = $this->basic_model->insert('social_user', $data);
       
        if($user_id > 0)
        {   
            $record = $this->basic_model->getSingleRecordData('social_user',array('social_id'=>$id));
            $payload = ["data" => $record];
            $key = "secret";
            $token = JWT::encode($payload, $key, 'HS256');
            $success = array("status" => "1", "message" => "Signup Successfully.","user_info"=>$record,"token"=>$token);
            echo json_encode($success);
            exit;

        }else{
            $error = array("status" => "0", "message" => "Somthing went wrong try again.");
            echo json_encode($error);
            exit;
        }

    }

    public function login()
    {
        $email = trim(addslashes($this->input->get('email')));
        $password = addslashes($this->input->get('password'));
        $deviceToken = trim($this->input->get("devicetoken"));
        $os = trim($this->input->get("os"));
        
        // echo $email."  ".$password;
        if ($email === '' ) {
            $error = array("status" => "0", "message" => "Please enter email or mobile");
            echo json_encode($error);
            exit;
        }

        $isMobile = false;
        if(!preg_match("/[a-z]/i", $email)){
            $isMobile = true;
        }

        if ($password === '') {
            $error = array("status" => "0", "message" => "Please enter password");
            echo json_encode($error);
            exit;
        }

        // echo $email."  ".$password;
        // $isValidateUser = $this->basic_model->validateUser($email,$isMobile, md5($password));
        $isValidateUser = $this->basic_model->validateUser($email,$isMobile, $password);
        if(is_array($isValidateUser) && count($isValidateUser)>0){
            if($isMobile = true){
                $this->basic_model->update("register_user",array("deviceToken"=>$deviceToken,"os"=>$os),array('mobile'=>$email));
            }else{
                $this->basic_model->update("register_user",array("deviceToken"=>$deviceToken,"os"=>$os),array('email'=>$email));
            }
            
            $payload = ["data" => $isValidateUser];
            $key = "secret";
            $token = JWT::encode($payload, $key, 'HS256');
            $success = array("status" => "1", "token" => $token, "user" =>$isValidateUser);
            //$success = array("status" => "1", "message" => "Signin Successfully.");
            echo json_encode($success);
        } else {
            $error = array("status" => "0", "message" => "Invalid Credentials");
            echo json_encode($error);
            exit;

        }
    }

    public function sendOtp(){
        $email = trim(addslashes($this->input->get('source')));
        // $mobile = trim(addslashes($this->input->get('mobile')));
        $otp = trim(addslashes($this->input->get('otp')));
        $fogetPassword = trim(addslashes($this->input->get('username')));
        $username = trim(addslashes($this->input->get('username')));

        if ($email === '') {
            $error = array("status" => "0", "message" => "Not get Email or Mobile Number");
            echo json_encode($error);
            exit;
        }
        
        $isMobile = false;
        if(!preg_match("/[a-z]/i", $email)){
            $isMobile = true;
        }

        if ($otp === '' ) {
            $error = array("status" => "0", "message" => "Not get otp");
            echo json_encode($error);
            exit;
        }

        if($isMobile){
            $record = $this->basic_model->selectSglRecord('register_user',array('mobile'=>$email));

            //testing purpose
            if($email == "ravendraksingh11@gmail.com"){
                //echo "<pre/>"; print_r($record);die;
            }

            if($fogetPassword == 'forget'){
                if($record == false){
                    $error = array("status" => "0", "message" => "Mobile Number is not register");
                    echo json_encode($error);
                    exit;
                }

                if(is_array($record) && count($record)>0){
                    $username = $record['name'] !="" ?$record['name'] : 'User';
                }

            }else{
                // if($record == true){
                if(is_array($record) && count($record)>0){
                    $error = array("status" => "2", "message" => "Mobile Number is already register");
                    echo json_encode($error);
                    exit;
                }
            }

        }else{

            $record = $this->basic_model->selectSglRecord('register_user',array('email'=>$email));
            //testing purpose
            // if($email == "ravendraksingh11@gmail.com"){
            //     echo "<pre/>"; print_r($record);die;
            // }

            if($fogetPassword == 'forget'){
                if($record == false){
                    $error = array("status" => "0", "message" => "Email is not register");
                    echo json_encode($error);
                    exit;
                }

                if(is_array($record) && count($record)>0){
                    $username = $record['name'] !="" ?$record['name'] : 'User';
                }

            }else{

                if(is_array($record) && count($record)>0){
                    $error = array("status" => "2", "message" => "Email is already register");
                    echo json_encode($error);
                    exit;
                }
            }
            
        }

        
        if($isMobile){
            $status = $this->basic_model->sendOtpModel("" ,$email ,$otp,$username);
        }else{
            $status = $this->basic_model->sendOtpModel($email ,"" ,$otp,$username);
        }

        if($status){
            $error = array("status" => "1", "message" => "Send otp successfully.");
            echo json_encode($error);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Not Send otp.");
            echo json_encode($error);
            exit;
        }
    }


    public function resetPassword(){

        $email = trim($this->input->get("email"));
       $password = trim($this->input->get("pass"));
        
        
        if($email ==''){
            $error = array("status" => "0", "message" => "Somthing went wrong ,Please try again ");
            echo json_encode($error);
            exit;
        }

        if($password =='' ){
            $error = array("status" => "0", "message" => "Somthing went wrong ,Please try again ");
            echo json_encode($error);
            exit;
        }

        $isMobile = false;
        if(!preg_match("/[a-z]/i", $email)){
            $isMobile = true;
        }

        if($isMobile == true)
        {
            $condition = array('mobile'=>$email);
        }else{
            $condition = array('email'=>$email);
        }

        $updateData = array('password'=>$password);
        $result = $this->basic_model->update("register_user",$updateData ,$condition);
        if($result)
        {
            $success = array("status" => "1", "message" => "Successfully Updated ");
            echo json_encode($success);
            exit;

        }else{

            $error = array("status" => "0", "message" => "Somthing went wrong ,Please try again ");
            echo json_encode($error);
            exit;
        }
        // update($table, $data, $condition)
    }

    public function getLocation($lat,$long){
        
        $ch = curl_init("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&key=AIzaSyDV7cINGIE3Re1ACdMWbgcseonHpubiBjE");
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $output = curl_exec($ch);      
          curl_close($ch); 
          $jd = json_decode($output);
          
          $adrs = array();
          if( count($jd->results) > 0 ){
          
          foreach($jd->results[0]->address_components as $addressComp){
            // // print_r($addressComp['long_name']);
            //  echo $addressComp->types[0] ."--- ". $addressComp->long_name."-postal_code";
            //  echo "<br/>";

             $adrs[$addressComp->types[0]] = $addressComp->long_name;
           }
        }
          return $adrs;

          
    }

    public function checkDeliveryLocation(){
        $lat = trim($this->input->get('lat'));
        $lng = trim($this->input->get('lng'));

        if($lat == ''){
            $error = array("status" => "0", "message" => "Not found location");
            echo json_encode($error);
            exit;
        }

        if($lng == ''){
            $error = array("status" => "0", "message" => "Not found location");
            echo json_encode($error);
            exit;
        }

        $address = $this->getLocation($lat,$lng);

        if(count($address) > 0){
            if (array_key_exists("postal_code",$address)){
                $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$address['postal_code']));
                $addressString = implode(",",$address);
                
                if($result != false){
                    $error = array("status" => "1", "available"=>'YES', "message" => "Delivery available at search location ".$addressString ,'address'=>$addressString,"detail"=>$result);
                    echo json_encode($error);
                    exit;
                }else{
                    $error = array("status" => "0", "available"=>'NOT',"message" => "Delivery not available at search location ".$addressString);
                    echo json_encode($error);
                    exit;
                }

            }else{
                $error = array("status" => "0", "message" => "Please try after some time");
                echo json_encode($error);
                exit;
            }

        }else{
            $error = array("status" => "0", "message" => "Please try after some time");
            echo json_encode($error);
            exit;
        }
    }

    public function checkDeliveryByZipcode(){
        $zipcode = trim($this->input->get("zipcode"));

        if($zipcode == ""){
            $error = array("status" => "0", "message" => "not get zipcode");
            echo json_encode($error);
            exit;
        }

        $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$zipcode));
        if(is_array($result) && count($result)>0){
            $success = array("status" => "1", "message" => "Get result", "result"=>$result);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "not found any recored at this zipcode:".$zipcode);
            echo json_encode($error);
            exit;
        }
    }

    public function getAppartment(){
        $keyword = $this->input->get('key');
        //print_r($keyword);die;
        if($keyword !=""){
            $apartment = $this->basic_model->selectLike('apartment',$keyword,'apartment');
        }else{
            $apartment = $this->basic_model->selectAll('apartment',array());
        }

        if(is_array($apartment) && count($apartment)>0){
            $error = array("status" => "1","apartment"=>$apartment);
            echo json_encode($error);
            exit;
        }else{
            $error = array("status" => "0","apartment"=>array(),"message"=>"No match found.");
            echo json_encode($error);
            exit;
        }
    }


    public function checkDeliveryOnPincode($pincode){
        if($pincode == ""){
            $error = array("status" => "0", "message" => "Somthing went wrong",);
            echo json_encode($error);
            exit;
        }

        $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$pincode));
        if(is_array($result) && count($result)>0){
            $success = array("status" => "1", "message" => "Delivery available at this pincode:".$pincode, "details"=>$result);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Delivery is not available at this pincode:".$pincode);
            echo json_encode($error);
            exit;
        }
    }

    public function getUserAddess(){
        
        $userid = trim($this->input->get("user_id"));
        $token = trim($this->input->get("token"));
        $this->basic_model->validateHeader($token);
        if(trim($userid) == ""){
            $error = array("status" => "0","message"=>"not get address details");
            echo json_encode($error);
            exit;
        }

        $addressList = $this->basic_model->selectAll('user_address',array('userid'=>$userid,'status'=>0));
        if(is_array($addressList) && count($addressList)>0){

            //add shiping on particular address
            foreach($addressList as &$address){
                $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$address['zipcode']));
                if(is_array($result) && count($result)>0){
                    $address['shipingCost'] = $result['shipping_cost'];
                }else{
                    $address['shipingCost'] = "";
                }
            }

            $success = array("status" => "1","addressList"=>$addressList);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0","message"=>"not get address details");
            echo json_encode($error);
            exit;
        }
    }

    public function removeUserAddess(){
        
        $userid = trim($this->input->post("user_id"));
        $address_id = trim($this->input->post("address_id"));
        $token = trim($this->input->post("token"));
        $this->basic_model->validateHeader($token);
        if(trim($userid) == ""){
            $error = array("status" => "0","message"=>"not get address details");
            echo json_encode($error);
            exit;
        }

        $result = $this->basic_model->update("user_address",array("status"=>1),array('userid'=>$userid,"id"=>$address_id));
        if ($result){
            $addressList = $this->basic_model->selectAll('user_address',array('userid'=>$userid,'status'=>0));

            //add shiping on particular address
            foreach($addressList as &$address){
                $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$address['zipcode']));
                if(is_array($result) && count($result)>0){
                    $address['shipingCost'] = $result['shipping_cost'];
                }else{
                    $address['shipingCost'] = "";
                }
            }

            $success = array("status" => "1","addressList"=>$addressList);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0","message"=>"not get address details");
            echo json_encode($error);
            exit;
        }
    }

    // public function cleanPreviousDefaultValue(){
    //     $userId = $this->input->get("userId");
    private function cleanPreviousDefaultValue($userId){
        $addressList = $this->basic_model->getSingleRecordData('user_address',
            array('userid'=>$userId,'status'=>0,'default_address'=>'1')
        );
        
        //print_r($addressList);

        if(is_array($addressList) && count($addressList)>0){
            
            $result = $this->basic_model->update("user_address",
                array("default_address"=>'0'),
                array("id"=>$addressList['id'],"userid"=>$userId)
            );

            if($result){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function setUserAddess(){

        $name = trim($this->input->post("name"));
        $pincode = trim($this->input->post("pincode"));
        $deliverOn = trim($this->input->post("deliverOn"));
        $address = trim($this->input->post("address"));
        $email = trim($this->input->post("email"));
        $userId = trim($this->input->post("userId"));
        $district = "Bengaluru";
        $isEditId = trim($this->input->post("updatable"));
        $token = trim($this->input->post("token"));
        $is_default = trim($this->input->post("is_default"));

        $this->basic_model->validateHeader($token);

        if($pincode == ""){
            $error = array("status" => "0","message"=>"Not get pincode");
            echo json_encode($error);
            exit;
        }

        if($userId == ""){
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }

        if($pincode == ""){
            $error = array("status" => "0","message"=>"Not get pincode");
            echo json_encode($error);
            exit;
        }

        if($address == ""){
            $error = array("status" => "0","message"=>"Not get address");
            echo json_encode($error);
            exit;
        }

        if($isEditId == ""){
            $error = array("status" => "0","message"=>"Address not update please try again");
            echo json_encode($error);
            exit;
        }


        if($isEditId>0){
            $data = array(
                "address"=>$address,
                "contactName"=>$name,
                "addressType"=>$deliverOn,
                "district"=>$district,
                "zipcode"=>$pincode,
                "country"=>"India",
                "status"=>0,
                "date"=>date('Y-m-d h:i:s')
            );

            if($is_default == 1){
                $data['default_address'] = '1';
                $this->cleanPreviousDefaultValue($userId);
            }else{
                $data['default_address'] = '0';
            }

            $condition =  array(
                "id"=>$isEditId,
                "userid"=>$userId,
            );

            $res = $this->basic_model->update("user_address",$data,$condition);
            $addressList = $this->basic_model->selectAll('user_address',array('userid'=>$userId,'status'=>0));
            if($res && is_array($addressList) && count($addressList)>0){
                
                //add shiping on particular address
                foreach($addressList as &$address){
                    $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$address['zipcode']));
                    if(is_array($result) && count($result)>0){
                        $address['shipingCost'] = $result['shipping_cost'];
                    }else{
                        $address['shipingCost'] = "";
                    }
                }

                $success = array("status" => "1","addressList"=>$addressList);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0","message"=>"Something went wrong try again");
                echo json_encode($error);
                exit;
            }
        }else{
            $data = array(
                "userid"=>$userId,
                "email"=>$email,
                "address"=>$address,
                "contactName"=>$name,
                "addressType"=>$deliverOn,
                "district"=>$district,
                "zipcode"=>$pincode,
                "country"=>"India",
                "status"=>0,
                "date"=>date('Y-m-d h:i:s')
            );
            
            if($is_default == 1){
                $data['default_address'] = '1';
                $this->cleanPreviousDefaultValue($userId);
            }

            $res = $this->basic_model->insert("user_address",$data);
            $addressList = $this->basic_model->selectAll('user_address',array('userid'=>$userId,'status'=>0));
            if($res > 0 && is_array($addressList) && count($addressList)>0){

                //add shiping on particular address
                foreach($addressList as &$address){
                    $result = $this->basic_model->getSingleRecordData('area_pincode',array('pincode'=>$address['zipcode']));
                    if(is_array($result) && count($result)>0){
                        $address['shipingCost'] = $result['shipping_cost'];
                    }else{
                        $address['shipingCost'] = "";
                    }
                }

                $success = array("status" => "1","addressList"=>$addressList);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0","message"=>"Something went wrong try again");
                echo json_encode($error);
                exit;
            }
        }
    }

    public function uploadUserImage(){
        
        chdir("/home/ilaqadgr/demo1.farmstop.in/uploads");
        
        // $ss = array("status" => "1","message"=>"The file has been uploaded.",'files'=>$__FILES);
        echo json_encode($_FILES[uri]);
        die;
        if (move_uploaded_file($_FILES['file']['tmp_name'],$_FILES['file']['name'])) {
            $error = array("status" => "1","message"=>"The file has been uploaded.");
                echo json_encode($error);
                exit;
          } else {
            $error = array("status" => "0","message"=>"Sorry, there was an error uploading your file.",'data'=>$_FILES);
                echo json_encode($error);
                exit;
          }
    }

    public function updateProfile(){
        $this->basic_model->validateHeader($this->input->post("token"));
        $email = trim($this->input->post("email"));
        $mobile = trim($this->input->post("mobile"));
        $userType = trim($this->input->post("user_type"));
        $userId = trim($this->input->post("user_id"));

        if($email == ""){
            $error = array("status" => "0","message"=>"Please fill email");
            echo json_encode($error);
            exit;
        }

        if($mobile == ""){
            $error = array("status" => "0","message"=>"Please fill mobile");
            echo json_encode($error);
            exit;
        }

        if($userType == ""){
            $error = array("status" => "0","message"=>"not find user type");
            echo json_encode($error);
            exit;
        }

        if($userId == ""){
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }

        if($userType == "MANUAL"){
            //data ,condition
            $existDetails = $this->basic_model->getSingleRecord("register_user",array("email"=>$email,"mobile"=>$mobile,"id"=>$userId));
            if($existDetails){
                    $success = array("status" => "1","message"=>"Update Profile");
                    echo json_encode($success);
                    exit;
            }else{

                $result = $this->basic_model->update("register_user", array("email"=>$email,"mobile"=>$mobile),array("id"=>$userId));
                if($result){
                    $success = array("status" => "1","message"=>"Update Profile");
                    echo json_encode($success);
                    exit;
                }else{
                    $error = array("status" => "0","message"=>"somthing went wrong");
                    echo json_encode($error);
                    exit;
                }
            }

        }else if($userType == "GMAIL" || $userType == "FACEBOOK"){

            $existDetails = $this->basic_model->getSingleRecord("social_user",array("email"=>$email,"mobile"=>$mobile,"social_id"=>$userId));
            
            if($existDetails){
                $success = array("status" => "1","message"=>"Update Profile");
                echo json_encode($success);
                exit;
            }else{
                $result = $this->basic_model->update("social_user",array("email"=>$email,"mobile"=>$mobile),array("social_id"=>$userId));
                if($result){
                    $success = array("status" => "1","message"=>"Update Profile");
                    echo json_encode($success);
                    exit;
                }else{
                    $error = array("status" => "0","message"=>"somthing went wrong");
                    echo json_encode($error);
                    exit;
                }
            }
        }
    }

    public function getNotification(){
        $user_id = trim($this->input->post("user_id"));
        $token = trim($this->input->post("token"));

        if($user_id == ""){
            $error = array("status" => "0","message"=>"not get user id");
            echo json_encode($error);
            exit;
        }

        if($token == ""){
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }

        $this->basic_model->validateHeader($token);

        $result = $this->basic_model->getNotification($user_id);

        if(is_array($result) && count($result)>0){
            $success = array("status" => "1","user_notification"=>$result);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }
    }

    public function removeNotification(){
        $user_id = trim($this->input->post("user_id"));
        $notification_id = trim($this->input->post("notify_id"));
        $token = trim($this->input->post("token"));

        if($user_id == ""){
            $error = array("status" => "0","message"=>"not get user id");
            echo json_encode($error);
            exit;
        }

        if($token == ""){
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }

        if($notification_id == ""){
            $error = array("status" => "0","message"=>"not get notification id");
            echo json_encode($error);
            exit;
        }

        $this->basic_model->validateHeader($token);

        $result = $this->basic_model->delete("user_notification",array("id"=>$notification_id));

        if($result){
            $notifyList = $this->basic_model->selectAll("user_notification",array("user_id"=>$user_id));
            $success = array("status" => "1", "message"=>"Deleted Successfully","user_notification"=>$notifyList);
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0","message"=>"Please login");
            echo json_encode($error);
            exit;
        }
    }

    public function getDeliveryDate(){
        $day = date("l");
            $hour = date('H');
            $nday = '';
            $date = date('Y-m-d');
            if($day == 'Sunday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 1 days'));
                }
                else if($day == 'Sunday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 2 days'));
                }
                else if($day == 'Monday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 1 days'));
                }
                else if($day == 'Monday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 2 days'));
                }
                else if($day == 'Tuesday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 1 days'));
                }
                else if($day == 'Tuesday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 3 days'));
                }
                else if($day == 'Wednesday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 2 days'));
                }
                else if($day == 'Wednesday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 3 days'));
                }
                else if($day == 'Thursday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 1 days'));
                }
                else if($day == 'Thursday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 2 days'));
                }
                else if($day == 'Friday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 1 days'));
                }
                else if($day == 'Friday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 3 days'));
                }
                else if($day == 'Saturday' && $hour < 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 2 days'));
                }
                else if($day == 'Saturday' && $hour >= 12){ 
                $nday = date('Y-m-d', strtotime($date. ' + 3 days'));
                }
            
            $nday = date('d/m/Y',strtotime($nday));
            $success = array("status" => "1", "deliveryDate"=>$nday);
            echo json_encode($success);
            exit;
    }
   
}
