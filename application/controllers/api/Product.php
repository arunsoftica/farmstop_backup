<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once './application/helpers/jwt_helper.php';

class Product extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('jwt');
        $this->load->model('ProductApiModel');
        
    }

    public function index(){
        // $user         	 = $this->basic_model->validateHeader();
        // print_r($this->Adminmodel->getProductVariation());
		die("product");
    }

    public function getProduct(){

        $prod_id = $this->input->get("prod_id");
        $start = $this->input->get("start");
        $end = $this->input->get("end");

        $products = $this->ProductApiModel->getProducts($prod_id,$start ,$end);

        if (is_array($products)) {
            if(count($products)>0){
                $minimumPurChaseAmt = 360;
                $freeDileveryAt = 999;
                
                $basket = $this->ProductApiModel->getBasket();
                if(!is_array($basket) && count($basket)<=0){
                    $basket = array();
                }else{
                    foreach($basket as &$prod){
                        $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$prod['id']));
                        $minmumPrice = "";
                        $minmumWeight = "";
                        if(is_array($variation) && count($variation)>0){
                            // echo "<pre>";print_r($variation);
                            foreach($variation as $vari)
                            {
                                $temp = array();
                                $temp['varition_detail_id'] = $vari['id'];
                                $temp['varition'] = $vari['weight'];
                                $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                                $minmumPrice = $temp['right_price'];
                                $minmumWeight = $temp['varition'];
                                $prod['variation_details'][] = $temp;
                            }
            
                            $prod['selectedQty'] = 1;//0;
                            $prod['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                            $prod['selectedQtyVariation'] = $variation[0]['weight'];
                            $prod['selectedVariationID'] = $variation[0]['id'];
                            $prod['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                        }
                    }
                }

                $success = array("status" => "1","basket"=>$basket, "product" =>$products, "minimumPurChaseAmt"=>$minimumPurChaseAmt,"freeDileveryAt"=>$freeDileveryAt);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Not found any product in this category");
                echo json_encode($error);
                exit;
            }

        }else{
            $error = array("status" => "0", "message" => "something went wrong");
            echo json_encode($error);
            exit;
        }

    }

    public function getBasketList(){  
        $product = $this->ProductApiModel->getBasket();
        if(!is_array($product) && count($product)<=0){
            $product =  array();
        }else{
        foreach($product as &$prod){
            $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$prod['id']));
            $minmumPrice = "";
            $minmumWeight = "";
            if(is_array($variation) && count($variation)>0){
                // echo "<pre>";print_r($variation);
                foreach($variation as $vari)
                {
                    $temp = array();
                    $temp['varition_detail_id'] = $vari['id'];
                    $temp['varition'] = $vari['weight'];
                    $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                    $minmumPrice = $temp['right_price'];
                    $minmumWeight = $temp['varition'];
                    $prod['variation_details'][] = $temp;
                }

                $prod['selectedQty'] = 1;//0;
                $prod['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                $prod['selectedQtyVariation'] = $variation[0]['weight'];
                $prod['selectedVariationID'] = $variation[0]['id'];
                $prod['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
            }
        }
        }

        if (is_array($product)) {
            if(count($product)>0){
                
                $success = array("status" => "1", "basket" =>$product);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Not found any product in this category");
                echo json_encode($error);
                exit;
            }

        }else{
            $error = array("status" => "0", "message" => "something went wrong");
            echo json_encode($error);
            exit;
        }

    }

    public function getWishListItem($user_id)
    {
        $resutl = $this->basic_model->selectAll('wishlist_product',array("userid"=>$user_id));
        
        if($resutl != false)
        {
            return $resutl;
        }

        return  false;
    }

    public function getProdVariation(){
        $prod_id = $this->input->get("prod_id");
        $start = $this->input->get("start");
        $end = $this->input->get("end");
        $userId = trim($this->input->get('userId'));
        
        if ($prod_id === '' ) {
            $error = array("status" => "0", "message" => "Not get product id");
            echo json_encode($error);
            exit;
        }

        $prodVariation = $this->ProductApiModel->getProductVariation($prod_id, $start,$end);

        if (is_array($prodVariation)) {
            
            if(count($prodVariation)>0){
                
                //select user wish list item
                if($userId != ''){
                    $wishItems = $this->getWishListItem($userId);
                    if($wishItems != false){
                        foreach($prodVariation as &$prod)
                        {
                            $prod['isMyWish'] = '';
                            foreach($wishItems as $wish){
                                if($wish["product_variation_id"] == $prod['id'])
                                    $prod['isMyWish'] = 'heart';
                            }
                        }
                    }else{
                        foreach($prodVariation as &$prod)
                        {
                            $prod['isMyWish'] = '';
                        }
                    }

                }

                //getting variation details
                foreach($prodVariation as &$prod){
                    $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$prod['id']));
                    $minmumPrice = "";
                    $minmumWeight = "";
                    if(is_array($variation) && count($variation)>0){
                        // echo "<pre>";print_r($variation);
                        foreach($variation as $vari)
                        {
                            $temp = array();
                            $temp['varition_detail_id'] = $vari['id'];
                            $temp['varition'] = $vari['weight'];
                            $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                            $minmumPrice = $temp['right_price'];
                            $minmumWeight = $temp['varition'];
                            $prod['variation_details'][] = $temp;
                        }

                        $prod['selectedQty'] = 1;//0;
                        $prod['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                        $prod['selectedQtyVariation'] = $variation[0]['weight'];
                        $prod['selectedVariationID'] = $variation[0]['id'];
                        $prod['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                    }
                }

                $success = array("status" => "1", "product" =>$prodVariation );
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Not found any product in this category");
                echo json_encode($error);
                exit;
            }
        }else{
            $error = array("status" => "0", "message" => "something went wrong");
            echo json_encode($error);
            exit;
        }
    }

    //product list for seraching keyword
    public function getProductBYKeyword(){
        $keyword = trim($this->input->get("term"));
        $userId = trim($this->input->get('userId'));

        if($keyword ==""){
            $error = array("status" => "0", "message" => "Not get Search key");
            echo json_encode($error);
            exit;
        }

        $productList = $this->ProductApiModel->getProductVariationByKeyword($keyword);
        if(is_array($productList))
        {
            if(count($productList)>0){
                
                if($userId != ''){
                    $wishItems = $this->getWishListItem($userId);
                    if($wishItems != false){
                        foreach($productList as &$prod)
                        {
                            $prod['isMyWish'] = '';
                            foreach($wishItems as $wish){
                                if($wish["product_variation_id"] == $prod['id'])
                                    $prod['isMyWish'] = 'heart';
                            }
                        }
                    }else{
                        foreach($productList as &$prod)
                        {
                            $prod['isMyWish'] = '';
                        }
                    }

                }

                //getting variation details
                foreach($productList as &$prod){
                    $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$prod['id']));
                    $minmumPrice = "";
                    $minmumWeight = "";
                    if(is_array($variation) && count($variation)>0){
                        // echo "<pre>";print_r($variation);
                        foreach($variation as $vari)
                        {
                            $temp = array();
                            $temp['varition_detail_id'] = $vari['id'];
                            $temp['varition'] = $vari['weight'];
                            $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                            $minmumPrice = $temp['right_price'];
                            $minmumWeight = $temp['varition'];
                            $prod['variation_details'][] = $temp;
                        }

                        $prod['selectedQty'] = 1;//0;
                        $prod['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                        $prod['selectedQtyVariation'] = $variation[0]['weight'];
                        $prod['selectedVariationID'] = $variation[0]['id'];
                        $prod['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);

                    }
                }
                // echo "<pre>";
                // print_r($productList);die;
                $success = array("status" => "1", "searchProduct"=>$productList);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "not found any product");
                echo json_encode($error);
                exit;
            }

        }else{
            $error = array("status" => "0", "message" => "Something went wrong");
            echo json_encode($error);
            exit;
        }
    }

    //for autocomplete
    public function searchBYKeyword(){
        $key = trim($this->input->get("term"));
         if($key == ""){
            $error = array("status" => "0", "message" => "Something went wrong");
            echo json_encode($error);
            exit;
         }

        $productList = $this->ProductApiModel->getProductAutoComplete($key);
        if(is_array($productList))
        {
            if(count($productList)>0){
                $success = array("status" => "1", "searchProduct"=>$productList);
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "not found any product");
                echo json_encode($error);
                exit;
            }

        }else{
            $error = array("status" => "0", "message" => "Something went wrong");
            echo json_encode($error);
            exit;
        }
    }
    
    public function addInWishList(){
        $prod_id = trim($this->input->get("prodId"));
        $user_id = trim($this->input->get("userId"));
        $action= trim($this->input->get("action"));
        $this->basic_model->validateHeader($this->input->get("token"));
        if($prod_id =='' ){
            $error = array("status" => "0", "message" => "not found product");
            echo json_encode($error);
            exit;
        }

        if($user_id =='' ){
            $error = array("status" => "0", "message" => "not found user id");
            echo json_encode($error);
            exit;
        }

        if($action !="" && $action == "remove"){
            $prod_ids = explode("," ,$prod_id);
            $condition = array("userid"=> $user_id ,"product_variation_id"=>$prod_ids[0]);
            $res = $this->basic_model->delete("wishlist_product" ,$condition);
            if($res){
                $success = array("status" => "1", "message" => "Successfully removed in your wish List");
                echo json_encode($success);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Somthing went wrong");
                echo json_encode($error);
                exit;
            }
        }

        $prod_ids = explode("," ,$prod_id);
        if(count($prod_ids) == 1){

            $data = array("userid"=> $user_id ,"product_variation_id"=>$prod_ids[0] ,"date"=> date('Y-m-d h:i:s'));
            $condition = array("userid"=> $user_id ,"product_variation_id"=>$prod_ids[0]);
            $exist = $this->basic_model->getSingleRecord("wishlist_product" ,$condition);
            if($exist)
            {
                // echo "delete record";
                $res = $this->basic_model->delete("wishlist_product" ,$condition);
            }else{
                // echo "add record";
                $res = $this->basic_model->insert("wishlist_product" ,$data);
            }
        if($res){
            $userWishList = $this->ProductApiModel->getUserWishListItem($user_id);
            if(is_array($userWishList) && count($userWishList)>0){
                
                //set variation detail
                foreach($userWishList as &$wishProd){
                    $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$wishProd['id']));
                    $minmumPrice = "";
                    $minmumWeight = "";
                    if(is_array($variation) && count($variation)>0){
                        // echo "<pre>";print_r($variation);
                        foreach($variation as $vari)
                        {
                            $temp = array();
                            $temp['varition_detail_id'] = $vari['id'];
                            $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                            $minmumPrice = $temp['right_price'];
                            $temp['varition'] = $vari['weight'];
                            $wishProd['variation_details'][] = $temp;
                            $minmumWeight = $temp['varition'];
                        }
                    }

                    $wishProd['selectedQty'] = 1;//0;
                    $wishProd['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                    $wishProd['selectedQtyVariation'] = $variation[0]['weight'];
                    $wishProd['selectedVariationID'] = $variation[0]['id'];
                    $wishProd['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);

                }
            }
            $success = array("status" => "1", "message" => "Successfully added in your wish List",'wishList'=>$userWishList);
            echo json_encode($success);
            exit;        
        }else{
            $error = array("status" => "0", "message" => "Somthing went wrong");
            echo json_encode($error);
            exit;
        }

        }else{
            ///
            // echo "not";
            $error = array("status" => "0", "message" => "Somthing went wrong");
            echo json_encode($error);
            exit;
        }

        // die;

    }

    public function getUserWishList(){

        $user_id = trim($this->input->get("userId"));

        if($user_id == ''){
            $error = array("status" => "0", "message" => "Not found user id");
            echo json_encode($error);
            exit;
        }

        $userWishList = $this->ProductApiModel->getUserWishListItem($user_id);
        if(is_array($userWishList) && count($userWishList)>0){
            
            //set variation detail
            foreach($userWishList as &$wishProd){
                $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$wishProd['id']));
                $minmumPrice = "";
                $minmumWeight = "";
                if(is_array($variation) && count($variation)>0){
                    // echo "<pre>";print_r($variation);
                    foreach($variation as $vari)
                    {
                        $temp = array();
                        $temp['varition_detail_id'] = $vari['id'];
                        $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                        $minmumPrice = $temp['right_price'];
                        $temp['varition'] = $vari['weight'];
                        $wishProd['variation_details'][] = $temp;
                        $minmumWeight = $temp['varition'];
                    }
                }

                $wishProd['selectedQty'] = 1;//0;
                $wishProd['selectedQtyPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);
                $wishProd['selectedQtyVariation'] = $variation[0]['weight'];
                $wishProd['selectedVariationID'] = $variation[0]['id'];
                $wishProd['selectedVariationPrice'] = floatval(($variation[0]['sale_price'] > 0) ? $variation[0]['order_price'] :$variation[0]['regular_price']);

            }

            $success = array("status" => "1", "wishList" => $userWishList);
            echo json_encode($success);
            exit;

        }else{
            
            $error = array("status" => "0", "message" => "Something went wtrong");
            echo json_encode($error);
            exit;
        }
    }

    public function validateCoupon($code){
        if($code == ""){
            $error = array("status" => "0", "message" => "Something went wrong");
            echo json_encode($error);
            exit;
        }

        $result = $this->basic_model->getSingleRecordData("coupon_code",array("code"=>$code));
        if(is_array($result) && count($result)>0){
            
            if($result['status'] == 1)
            {
                $success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>$result['code_value'],"coupon_id"=>$result['id']);
                //$success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>'100',"coupon_id"=>$result['id']);
                echo json_encode($success);
                exit;

            }else{
                $success = array("status" => "1", "message" => "Coupon is expired", "value"=>'');
                echo json_encode($success);
                exit;
            }

        }else{
            $error = array("status" => "1", "message" => "Please enter vaild coupon code","value"=>'');
            echo json_encode($error);
            exit;
        }
        
    }

    // for version new
    public function newValidateCoupon(){
        $user_id = trim($this->input->post("userId"));
        $total = trim($this->input->post("total"));
        $code = trim($this->input->post("coupon_code"));
        $cart_items = trim($this->input->post("cart_items"));
        $token = trim($this->input->post("token"));
        
        // $error = array("status" => "0", "message" => array("user_id"=>$token,"total"=>$total,"code"=>$code,"cart"=>$cart_items));
        //     echo json_encode($error);
        //     exit;

        if($user_id == ""){
            $error = array("status" => "0", "message" => "Please login again.");
            echo json_encode($error);
            exit;
        }

        if($total == ""){
            $error = array("status" => "0", "message" => "Something wnt wrong ,Please try again later.");
            echo json_encode($error);
            exit;
        }

        if($code == ""){
            $error = array("status" => "0", "message" => "Something went wrong");
            echo json_encode($error);
            exit;
        }

        $result = $this->basic_model->getSingleRecordData("coupon_code",array("code"=>$code));
        if(is_array($result) && count($result)>0){
            if($result['status'] == 1)
            {
                //validate FARM15
                if(strtolower($code) === "farm15"){
                    $discount_value = $result['code_value'];

                    if($result['code_type'] == "p" || $result['code_type'] == "P"){
                        $discount_value = ($result['code_value']*$total)/100;
                    }

                    $success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>$discount_value,"coupon_id"=>$result['id']);
                    //$success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>'100',"coupon_id"=>$result['id']);
                    echo json_encode($success);
                    exit;
                }

                //Validate FARMFIRST
                if(strtolower($code) === "farmfirst"){
                    $discount_value = $result['code_value'];

                    if($result['code_type'] == "p" || $result['code_type'] == "P"){
                        $discount_value = ($result['code_value']*$total)/100;
                    }
                    
                    $success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>$discount_value,"coupon_id"=>$result['id']);
                    //$success = array("status" => "1", "message" => "Applied Successfully" ,"value"=>'100',"coupon_id"=>$result['id']);
                    echo json_encode($success);
                    exit;
                }

            }else{
                $success = array("status" => "1", "message" => "Coupon is expired", "value"=>'');
                echo json_encode($success);
                exit;
            }

        }else{
            $error = array("status" => "1", "message" => "Please enter vaild coupon code","value"=>'');
            echo json_encode($error);
            exit;
        }
        
    }

    public function setCartItems(){
        $productIdString = trim($this->input->post('product'));
        $variation_id = trim($this->input->post('variation_id'));
        $totalqty = trim($this->input->post('totalqty'));
        $userId = trim($this->input->post('userId'));
        $emailId = trim($this->input->post('emailId'));
        $selectedVariationPrice = trim($this->input->post("selectedVariationPrice"));

        if($productIdString =="" ){
            $error = array("status" => "1", "message" => "Not get product id string");
            echo json_encode($error);
            exit;
        }

        if($variation_id =="" ){
            $error = array("status" => "1", "message" => "Not get variation id string");
            echo json_encode($error);
            exit;
        }
        if($totalqty =="" ){
            $error = array("status" => "1", "message" => "Not get total quantity string");
            echo json_encode($error);
            exit;
        }

        if($userId =="" ){
            $error = array("status" => "1", "message" => "Not get user id ");
            echo json_encode($error);
            exit;
        }

        $productId = explode(",",$productIdString);
        $variationId = explode(",",$variation_id);
        $totalQty =  explode(",",$totalqty);
        $selectedVarPrice = explode(",",$selectedVariationPrice);
        $prodLength = count($productId);
        $counter = $prodLength > 1 ? $prodLength-1: $prodLength; //when get one prod id without , prefix
        //echo json_encode($_POST);die;
        $batchData = array();
        for($i=0;$i< $counter;$i++){
            $batchData[] = array(
                "user_id"=> $userId,
                "email"=>$emailId,
                "attribute_id"=>$productId[$i],
                "variation_detail_id"=>$variationId[$i],
                "variation_details_id"=>$variationId[$i],
                "variation_price"=>$selectedVarPrice[$i],
                "total_item"=>$totalQty[$i],
                "status"=>0,
                "date"=> date('Y-m-d h:i:s')
            );
        }

        $exist = $this->basic_model->selectAll("add_cart_items", array('user_id'=>$userId , "status"=>0));
        // echo json_encode($exist);die;
        
        if(is_array($exist) && count($exist)>0){
            $newBatchData = array();
            for($i=0;$i< count($batchData);$i++){
                $find = false;
                for($j=0; $j< count($exist);$j++){
                    if($exist[$j]["attribute_id"] == $batchData[$i]["attribute_id"] && $exist[$j]["variation_detail_id"] == $batchData[$i]["variation_detail_id"])
                    {
                        $find =true;
                    }
                }

                if(!$find){
                    $newBatchData []= $batchData[$i];
                }
            }

            $res =$this->basic_model->insertBatch("add_cart_items",$newBatchData );
            if($res){
                $error = array("status" => "1", "message" => "Successfully added","cart_item_id"=>$res);
                echo json_encode($error);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Please try again, somthing went wrong");
                echo json_encode($error);
                exit;
            }
            
        }else{
            //when not find any record
            
            // echo json_encode($batchData);die;
            $res =$this->basic_model->insertBatch("add_cart_items",$batchData );
            if($res){
                $error = array("status" => "1", "message" => "Successfully added","cart_item_id"=>$res);
                echo json_encode($error);
                exit;
            }else{
                $error = array("status" => "0", "message" => "Please try again, somthing went wrong");
                echo json_encode($error);
                exit;
            }
        }
    }


    public function getCartItems(){
        $userId = trim($this->input->get("userId"));

        if($userId == ""){
            $error = array("status" => "0", "message" => "Not get userid");
            echo json_encode($error);
            exit;
        }

        $cartItems = $this->ProductApiModel->getCartItemList($userId);
        if(is_array($cartItems) && count($cartItems)>0){
            
            //set variation detail
            $count = 1;
            foreach($cartItems as &$item){
                $variation = $this->basic_model->selectAll('variation_details',array('product_variation_id'=>$item["prod_id"]));
                $minmumPrice = "";
                $minmumWeight = "";
                if(is_array($variation) && count($variation)>0){
                    // echo "<pre>";print_r($variation);
                    foreach($variation as $vari)
                    {
                        $temp = array();
                        $temp['varition_detail_id'] = $vari['id'];
                        $temp['right_price'] = ($vari['sale_price'] > 0) ? $vari['order_price'] :$vari['regular_price'];
                        $temp['varition'] = $vari['weight'];
                        $item['variation_details'][] = $temp;
                        
                        if($item["selectedVariationID"] == $vari['id']){
                            $minmumPrice = $temp['right_price'];
                            $minmumWeight = $temp['varition'];
                        }

                    }
                }

                // $item['selectedQty'] = 0;
                if($userId == "103178952223038253245"){
                    // echo "<pre>";print_r($variation);
                    // echo $minmumPrice ."* ".$item['selectedQty'];
                    // echo "<br/>";
                }

                $item['selectedQtyPrice'] = ($minmumPrice * $item['selectedQty']);
                $item['selectedQtyVariation'] = $minmumWeight;
                //$item['selectedVariationID'] = "";
                $item['selectedVariationPrice'] = $minmumPrice;
                $item['id'] = $count++;

            }

            $success = array("status" => "1", "message"=>"Get cart item" ,"cart" => $cartItems);
            echo json_encode($success);
            exit;

        }else{
            
            $error = array("status" => "1", "message" => "Not get cart items","cart"=> array());
            echo json_encode($error);
            exit;
        }
    }

    public function deleteCartItems(){
        $prod_id = $this->input->post("product");
        $variation_id = $this->input->post("variation_id");
        $user_id = $this->input->post("userId");
        $cart_item_id = $this->input->post("cart_item_id");

        if($user_id =="")
        {
            $error = array("status" => "0", "message" => "Please login first");
            echo json_encode($error);
            exit;
        }
        
        if($prod_id =="")
        {
            $error = array("status" => "0", "message" => "Not get product id");
            echo json_encode($error);
            exit;
        }

        if($cart_item_id =="")
        {
            $error = array("status" => "0", "message" => "Not get variation id");
            echo json_encode($error);
            exit;
        }

        $cartItems = $this->basic_model->delete("add_cart_items",array("id"=>$cart_item_id));

        if($cartItems){
            $success = array("status" => "1", "message" => "Item remove successfully");
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Somethinf went wrong try again");
            echo json_encode($error);
            exit;
        }
    }

    public function setCartItemsVariation(){
        $attribute_id = $this->input->post("product");
        $variation_details_id = $this->input->post("variation_id");
        $old_variation_details_id = $this->input->post("oldVariationId");
        $userId = $this->input->post("userId");
        $variationPrice = $this->input->post("variationPrice");
        
        $token = $this->input->post("token");

        $this->basic_model->validateHeader($token);
        if($userId == ""){
            $error = array("status" => "0", "message" => "Make sure you are login");
            echo json_encode($error);
            exit;
        }

        if($variation_details_id == ""){
            $error = array("status" => "0", "message" => "Please select correct variation");
            echo json_encode($error);
            exit;
        }

        if($old_variation_details_id == ""){
            $error = array("status" => "0", "message" => "Please select correct variation");
            echo json_encode($error);
            exit;
        }

        if($attribute_id == ""){
            $error = array("status" => "0", "message" => "Please select correct product");
            echo json_encode($error);
            exit;
        }

        $condition = array(
            "user_id"=>$userId,
            "attribute_id"=>$attribute_id ,
            "variation_details_id"=> $old_variation_details_id,
            "variation_detail_id"=>$old_variation_details_id,
            "status"=> 0);

        $data = array(
            "variation_details_id"=> $variation_details_id,
            "variation_detail_id"=>$variation_details_id,
            "variation_price"=>$variationPrice,
            "date"=>date('Y-m-d h:i:s')
        );

        $res = $this->basic_model->update("add_cart_items",$data,$condition);
        if($res){
            $success = array("status" => "1", "message" => "Successfully updated");
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Somthing went wrong ,Please try again");
            echo json_encode($error);
            exit;
        }
    }


    public function manageCartItemsQty(){
        $attribute_id = $this->input->post("product");
        $variation_details_id = $this->input->post("variation_id");
        $userId = $this->input->post("userId");
        $totalQty = $this->input->post("totalQty");

        if($userId == ""){
            $error = array("status" => "0", "message" => "Make sure you are login");
            echo json_encode($error);
            exit;
        }

        if($variation_details_id == ""){
            $error = array("status" => "0", "message" => "Please select correct variation");
            echo json_encode($error);
            exit;
        }

        if($totalQty == "" && $totalQty <= 0){
            $error = array("status" => "0", "message" => "Please select correct variation");
            echo json_encode($error);
            exit;
        }

        if($attribute_id == ""){
            $error = array("status" => "0", "message" => "Please select correct product");
            echo json_encode($error);
            exit;
        }

        $condition = array(
            "user_id"=>$userId,
            "attribute_id"=>$attribute_id ,
            "variation_details_id"=> $variation_details_id,
            "variation_detail_id"=>$variation_details_id,
            "status"=> 0);

        $data = array(
            "total_item"=> $totalQty,
            "date"=>date('Y-m-d h:i:s')
        );

        $res = $this->basic_model->update("add_cart_items",$data,$condition);
        if($res){
            $success = array("status" => "1", "message" => "Successfully updated");
            echo json_encode($success);
            exit;
        }else{
            $error = array("status" => "0", "message" => "Somthing went wrong ,Please try again");
            echo json_encode($error);
            exit;
        }
    }

}
?>