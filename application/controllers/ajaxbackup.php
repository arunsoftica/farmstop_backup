<?php

class Ajaxcontroller extends CI_Controller{

public function __construct(){
  parent::__construct();
  
  $this->load->model('Adminmodel');
  $this->load->library('email');
     
  
}

public function page($page = NULL){

//echo $page;exit;
if($page == 'add_item_to_cart'){
$response = $this->add_item_to_cart();
}
else if($page == 'update_item_to_cart'){
$response = $this->update_item_to_cart();
}
else if($page == 'register_user'){
$response = $this->register_user();
}
else if($page == 'login_user'){
$response = $this->login_user();
}
else if($page == 'facebook_login'){
    
$response = $this->facebook_login();    
}

else if($page == 'add_review'){
   $response = $this->add_review(); 
}
else if($page == 'delete_item_from_cart'){
   $response = $this->delete_item_from_cart(); 
}
else if($page == 'delete_item_cart'){
   $response = $this->delete_item_cart(); 
}
else if($page == 'logout'){
    $response = $this->logout();
}
else if($page == 'show_item_to_checkout'){
    $response = $this->show_item_to_checkout();
}
else if($page == 'go_to_payment'){
    $response = $this->go_to_payment();
}
else if($page == 'add_to_wishlist'){
    $response = $this->add_to_wishlist();
}
else if($page == 'remove_from_wishlist'){
    $response = $this->remove_from_wishlist();
}
else if($page == 'getShippingCost'){
    $response = $this->getShippingCost();
}
else if($page == 'add_user_address'){
    $response = $this->add_user_address();
}
else if($page == 'delete_session_item_cart'){
    $response = $this->delete_session_item_cart();
}
else if($page == 'getSatusOfProduct'){
    $response = $this->getSatusOfProduct();
}
else if($page == 'addContactUs'){
    $response = $this->addContactUs();
}
else if($page == 'verify_otp_cod'){
    $response = $this->verify_otp_cod();
}
else if($page == 'failedUserPayment'){
    $response = $this->failedUserPayment();
}
}



public function add_item_to_cart(){
  //print_r($_POST);exit;
  if($this->input->get('cart') == 2){
     $this->getCookies();
  }else if($this->input->get('cart') == 3){
     $this->getCookies();
  }
  else if($this->input->get('cart') == 1){
     $this->getTotalCartItems();
  }else{
    $expc=array();
    $expc[0] = 1;
  if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            $expc = explode(',',$cookie);
     }else{
           $expc[0] = 1;
     }  
  $result = $this->Adminmodel->add_item_to_cart($expc[0]);
  if($result != FALSE){
        //now cookie update after add item into cart
        if($expc[0] == 1){
            $reslt = explode('-',$result);
            $rslt = $reslt[0].','.$reslt[1];
        }else{
            $reslt = explode('-',$result);
            $rslt = $reslt[1];
        }
        

        if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            //print_r($cookie);
            setcookie('asdfghjkl',$cookie.','.$rslt,time()+86400*14);
        }else{
          setcookie('asdfghjkl',$rslt,time()+86400*14);
        }
        
        
             //echo 'this item added in your cart successfully..';
        
  }
  }
}

public function getCookies(){
    $cnt = 1;
  if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            //remove first item from array use array shift
            $a = explode(',',$cookie);
            array_shift($a);
            
            //print_r($a);exit;
            if($this->input->get('cart') == 3){
            //echo '<form id="update_cart" method="post">';
            //echo '<table>';
            if(empty($a)){
                echo 'no-item';exit;
            }
            }else if($this->input->get('cart') == 2){ ?>
                <h5 class="card-title text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</h5>
                <?php if(empty($a)){ ?>
                <p>There are no items in your shopping cart.</p>
                <?php } ?>
              <ul class="cart-items">
           <?php }
           
            foreach($a as $ar){
              
              $result = $this->Adminmodel->getCartDetailById($ar);
              //print_r($result);exit; ?>
              <?php if($this->input->get('cart') == 2){ ?>
              
              
              <li class="cart-unorder">
                        <div class="row">
                          <div class="col-md-3 col-sm-3 col-3 cart-img">
                              <img src="<?php echo base_url('teao/uploads/product_images/'.$result['img']) ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-9 col-sm-9 col-9 cart-box">
                              <h6>
                                <?php echo $result['attribute_name'] ?>
                                </h6>
                                <label><span class="item_weight"><?php echo $result['weight'] ?> | </span>    QTY: <span><?php echo $result['total_item'] ?> </span>
                                </label>
                                <a href="#" class="stock"><b class="color-purple"><em>In Stock</em></b>
                                </a>
                                <div class="item_product">
                                    <label>
                                        <p>Total</p>
                                        <span>Rs. <?php echo $result['total_item']*$result['sale_price'] ?></span>
                                    </label>
                                </div>
                      <h5><span><button type="button" class="btn btn-sm btn-danger itemdelete" value="<?php echo $result['id'] ?>" ><span class="fa fa-trash"></span> </button></span></h5>
                            </div>
                        </div>
                    </li>
                    
            <?php } else if($this->input->get('cart') == 3){ ?>
              
                 
              <tr>
                            <input type="hidden" name="add_cart_id[]" value="<?php echo $result['id'] ?>">
                            <td data-title="Image"><img class="img-table img-fluid" src="<?php echo base_url('teao/uploads/product_images/'.$result['img']) ?>" /> </td>
                            <td data-title="Product"><?php echo $result['attribute_name'] ?></td>
                            <td data-title="Weight"><?php echo $result['weight'] ?></td>
                            <td data-title="Price"><input type="hidden" name="sale_price[]" class="sale_price" value="<?php echo $result['sale_price'] ?>">
                                Rs. <?php echo $result['sale_price'] ?></td>
                            <td data-title="Quantity"><div class="quantity<?php echo $cnt; ?> quantity">
                        <div>
                            <div class="btn-minus" id="btn-minus" value="<?php echo $cnt; ?>"><span class="fa fa-minus"></span></div>
                            
                            <input  name="total_item[]" class="total_item<?php echo $cnt; ?>" value="<?php echo $result['total_item'] ?>">
                            <div class="btn-plus" id="btn-plus" value="<?php echo $cnt; ?>"><span class="fa fa-plus"></span></div>
                        </div>
                    </div></td>
                            <td data-title="Total">
                                <input type="hidden" name="total_prices[]" class="total_prices" value="<?php echo ($result['total_item']*$result['sale_price'])/$result['total_item'] ?>">
                                Rs. <?php $total_prices[] = ($result['total_item']*$result['sale_price']) ?>
                                <input type="text" name="total_price[]" class="border-bg total_price" value="<?php echo $result['total_item']*$result['sale_price'] ?>" readonly></td>
                            <td class="item-before-none"><button type="button" class="btn btn-sm btn-danger itemdel" value="<?php echo $result['id'] ?>" ><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                            
              
              
              
              
              
              

            <?php $cnt = $cnt + 1; } ?>
          <?php  }
          if($this->input->get('cart') == 2){
             echo '</ul><div class="cart-item-button"><a class="btn btn-md btn-primary btn-block text-uppercase" href="'.base_url().'cart">View Cart</a>'.'<a class="btn btn-md btn-light btn-block text-uppercase" href="'.base_url().'checkout">Checkout</a></div>';
           }else if($this->input->get('cart') == 3){ ?>
            <tr>
                            
                            <td colspan="7" class="text-right item-before-none"><button class="btn bg-primary text-white" type="submit" name="submit"  id="submit">Update Cart</button></td>
                            
                        </tr>
                        
                        <tr>
                            
                            <td class="text-right item-before-none" colspan="7">Sub-Total Rs.<strong> <?php echo array_sum($total_prices) ?></strong></td>
                        </tr>
                        <tr>
                           
                            <td class="text-right item-before-none" colspan="7">Shipping Rs. <strong> 0</stromg></td>
                        </tr>
                        <tr>
                            
                            <td class="text-right item-before-none" colspan="7"><strong>Total Rs. <?php echo array_sum($total_prices) ?></strong> </td>
                        </tr>
            <?php
            //echo '</table>';
            //echo '<button type="submit" name="submit"  id="submit">Update Cart</button>';
            //echo '<a href="'.base_url('checkout').'">Proceed to Checkout</a>';
            //echo '</form>';
           }

  }else{
      if($this->input->get('cart') == 2){ ?>
                <h5 class="card-title text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</h5>
                <p>There are no items in your shopping cart.</p>
                <?php  } else if($this->input->get('cart') == 3){
                    echo 'no-item';
                }
      
  }
  $cnt = $cnt + 1;
}

public function getTotalCartItems(){
  if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            $cnt = explode(',',$cookie);
            echo count($cnt)-1;
  }else{
      echo 0;
  }
}

public function update_item_to_cart(){
   //echo 'hello'; exit;
   $result = $this->Adminmodel->update_item_to_cart();
   if($result != FALSE){
     echo 'your cart updated successfully..';
   }
}

public function register_user(){

  //print_r($_POST);exit;
  $record = $this->Adminmodel->getRegisterUser($_POST['email']);
  if($record != FALSE){
       echo 'exist';
      
  }else{
      $result = $this->Adminmodel->registerUser();
      if($result != FALSE){
         echo 'registered';
       }
  }
  
}

public function login_user(){

  extract($_POST);
  $result = $this->Adminmodel->verifyUserName($usernm);
  //print_r($result);exit;
  if($result != FALSE){
     $res = $this->Adminmodel->verifyUserPassword($result['id'],$passwd);
     if($res != FALSE){
         
            $this->session->set_userdata('login_id' , $res['id']);
            $this->session->set_userdata('login_name' , $res['name']);
            $this->session->set_userdata('login_email' , $res['email']);
            $this->session->set_userdata('login_type' , $res['type']);
            $this->session->set_userdata('login_mobile' , $res['mobile']);
            echo 'yes';
         
     }else{
         echo 'Invalid Password';
     }
   }else{
       echo 'Invalid Mobile or Email';
   }
}

public function facebook_login(){
    $id = $this->input->get('id');
    $name = $this->input->get('name');
    $email = $this->input->get('email');
    $type = $this->input->get('type');
    $iurl = $this->input->get('iurl');
    if(!isset($_SESSION['login_id'])){
        
        $record = $this->Adminmodel->getSocialLogin($id);
        if($record != FALSE){
                $this->session->set_userdata('login_id' , $record['social_id']);
                $this->session->set_userdata('login_name' , $record['name']);
                $this->session->set_userdata('login_email' , $record['email']);
                $this->session->set_userdata('login_type' , $record['type']);
                $this->session->set_userdata('login_mobile' , $record['mobile']);
                echo 'yes';
        }else{
             $result = $this->Adminmodel->facebookLogin($id,$name,$email,$type,$iurl);
            if($result != FALSE){
                $this->session->set_userdata('login_id' , $id);
                $this->session->set_userdata('login_name' , $name);
                $this->session->set_userdata('login_email' , $email);
                $this->session->set_userdata('login_type' , $type);
                $this->session->set_userdata('login_mobile' , $record['mobile']);
                echo 'yes';
           }
        }
        
       
    }else{
        echo 'no';
    }
    
}


public function add_review(){
    $result = $this->Adminmodel->AddReview();
    if($result != FALSE){
        echo 'Review Submitted Successfully';
    }
}

public function delete_session_item_cart(){
    $id = $this->input->get('sess_items');
    //print_r($id);exit;
    if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            $a = explode(',',$cookie);
            
            setcookie('asdfghjkl',$a[0],time()+86400*14);
            
            
    }
}

public function delete_item_from_cart(){
    $id = $this->input->get('item_id');
    //print_r($id);exit;
    if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            $a = explode(',',$cookie);
            //array_shift($a);
            $key = array_search($id,$a);//it will return key
            unset($a[$key]);
            $result = $this->Adminmodel->delete_item_from_cart($id);
            if($result != FALSE){
                setcookie('asdfghjkl',implode(',',$a),time()+86400*14);
                echo 'item deleted successfully';
            }
            
    }
}

public function delete_item_cart(){
    $id = $this->input->get('item_id');
    //print_r($id);exit;
    if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            $a = explode(',',$cookie);
            //array_shift($a);
            $key = array_search($id,$a);//it will return key
            unset($a[$key]);
            $result = $this->Adminmodel->delete_item_from_cart($id);
            if($result != FALSE){
                setcookie('asdfghjkl',implode(',',$a),time()+86400*14);
                echo 'delete';
            }
            
    }
}

public function logout(){
        $this->session->unset_userdata('login_id');
        $this->session->unset_userdata('login_name');
        $this->session->unset_userdata('login_email');
        $this->session->unset_userdata('login_type');
        $this->session->unset_userdata('login_mobile');
        $this->session->unset_userdata('totalAmount');
        $this->session->sess_destroy();
        if(isset($_COOKIE['asdfghjkl'])){
            //print_r('hello');exit;
            unset($_COOKIE['asdfghjkl']);
            setcookie('asdfghjkl', null, time()-3600);
            echo 'lo';
        }else{
            echo 'lo';
        }
        
        //return redirect('/');
}

public function show_item_to_checkout(){
    if(isset($_COOKIE['asdfghjkl'])){
            $cookie = get_cookie('asdfghjkl');
            //remove first item from array use array shift
            $a = explode(',',$cookie);
            array_shift($a);
            $pid = array();
            $psum = array();
            foreach($a as $ar){
              
              $result = $this->Adminmodel->getCartDetailById($ar);?>
              <tr class="cart_item">
                  <?php echo $pid[] = $result['id'] ?>
						<td class="product-name"><?php echo $result['attribute_name'].'-'.$result['weight'] ?>&nbsp;<strong class="product-quantity">× <?php echo $result['total_item'] ?></strong></td>
						<td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ </span><?php echo $psum[] = $result['total_item']*$result['sale_price'] ?></span></td>
					</tr>
          <?php  } ?>
          <tr class="cart-subtotal">
			<th>Subtotal</th>
			<td>
			    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ <?php echo array_sum($psum) ?></span>
			    <input type="hidden" name="pid" id="pid" value="<?php echo implode(',',$pid) ?>" />
			    <input type="hidden" name="sub_total" id="sub_total" value="<?php echo array_sum($psum) ?>" />
			    <input type="hidden" name="shipping" id="shipping" value="" />
			    <input type="hidden" name="total" id="total" value="<?php echo array_sum($psum) ?>" />
			    <input type="hidden" name="total1" id="total1" value="<?php echo array_sum($psum) ?>" />
			    <input type="hidden" name="txnid" value="<?php echo $txnid=time().rand(10,99); ?>" readonly   size="40"/>
                <input type="hidden" name="productinfo" value="Product Fee" size="50" placeholder="" required/>
                <input  name="surl" value="<?php echo base_url('order-list') ?>" size="64"  type="hidden"/></td>
                <input type="hidden" name="furl" value="<?php echo base_url('fail') ?>" size="64" />
			    </td>
		</tr>
		<tr class="shipping">
        	<th>Shipping</th>
        	<td data-title="Shipping">
					<p id="shippingcost">₹ 0</p></td>
        </tr>
        <tr class="order-total">
			<th>Total</th>
			<td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ </span>
			<span id="total_amount"><?php echo array_sum($psum) ?></span>
			
			</span></strong> </td>
		</tr>
          
          <?php
    }
    
}

public function go_to_payment(){
    //print_r($_POST);exit;
    extract($_POST);
    if($readtc == 'on'){
        
        $updatemob = $this->Adminmodel->update_user_mobile($mobile);
        $getAddress = $this->Adminmodel->get_user_address($address,$district,$pin);
        if($getAddress != FALSE){
            $addressid = $getAddress['id'];
        }else{
            $addressid = $this->Adminmodel->add_user_address();
            
        }
        
        if($updatemob != FALSE){
            $userpay = $this->Adminmodel->add_user_payment($addressid);
            
            if($userpay != FALSE){
                $checkOrder = $this->Adminmodel->check_user_order($userpay);
               //print_r($checkOrder);exit;
               if($checkOrder == FALSE){
                   $ordertb = $this->Adminmodel->add_user_order($userpay);
               }
                $this->session->set_userdata('user_payment_id' , $userpay);
                $this->session->set_userdata('your_cart_item' , $pid);
                $cpid = explode(',',$pid);
                $updemail = $this->Adminmodel->update_email_add_cart($cpid,$email,$userpay);
                if($updemail != FALSE){
                    
                    if($optradio == 1){
                        /* payu code*/
                            /*$MERCHANT_KEY = "ibc8DXoU";
                            $SALT = "KFA1FbT62u";*/
                            $MERCHANT_KEY = "QMBzI1i5";
                            $SALT = "I9vzBecBba";
                        
                        	$hashseq=$MERCHANT_KEY.'|'.$txnid.'|'.$total.'|'.$productinfo.'|'.$name.'|'.$email.'|||||||||||'.$SALT;
                        	$hash =strtolower(hash("sha512", $hashseq));
                        	$payar = Array($optradio,$MERCHANT_KEY,$SALT,$hash,$txnid,$total,$name,$email,$mobile,$productinfo,$surl,$furl);
                        	echo json_encode(array("pay_u"=>$payar));
                            ?>
                            
                            <?php
                            
                            
                            /* payu code*/
                    }
                    else if($optradio == 4){ 
                      
                      //$payar = [$optradio,'rzp_test_UZAcQOZFtEtGvt'];
                      $payar = array($optradio,'rzp_test_UZAcQOZFtEtGvt');
                      echo json_encode(array("pay_u"=>$payar));
                     } else if($optradio == 2){
                         /* COD otp can be sent again & again in same mobile no. */
                         $ran = mt_rand(111111,999999999);
                         $otp = substr($ran,0,6); 
                         $mob_otp = $this->Adminmodel->addCodOtp($otp);
                         if($mob_otp != FALSE){
                           $payar = array($optradio,$mobile);
                           echo  json_encode(array("pay_u"=>$payar));
                         }
                         
                     }
                    
                    
                }
                
                 
            }
            
        }
    
    }
    
    
}

public function verify_otp_cod(){
    $verify_otp = $this->Adminmodel->verifyCodOtp();
     if($verify_otp != FALSE){
       $payar = array('yes');
       echo  json_encode(array("verify_otp"=>$payar));
     }else{
       $payar = array('no');
       echo  json_encode(array("verify_otp"=>$payar));
     }
}

public function add_to_wishlist(){
    
    $product_variation_id = $this->input->get('v');
    $user_id = $this->input->get('u');
    $result = $this->Adminmodel->addProductToWishlist($product_variation_id,$user_id);
    if($result != FALSE){
        echo 'Product added in your wishlist';
        
    }
}

public function remove_from_wishlist(){
    
    $product_variation_id = $this->input->get('v');
    $user_id = $this->input->get('u');
    $result = $this->Adminmodel->removeProductToWishlist($product_variation_id,$user_id);
    if($result != FALSE){
        echo 'Product removed from your wishlist';
        
    }
    
}

public function getShippingCost(){
    $ta = $this->input->get('ta');
    $pin = $this->input->get('pin');
    $result = $this->Adminmodel->getShippingCost($pin);
    if($result != FALSE){
        //$this->session->unset_userdata('totalAmount');
        //$this->session->sess_destroy();
        $this->session->set_userdata('totalAmount' , $ta+$result['shipping_cost']);
        echo $result['shipping_cost'];
    }else{
        echo 'no';
    }
        
    
}

public function add_user_address(){
    
    $addressid = $this->Adminmodel->add_user_address();
    if($addressid != FALSE){
        echo 'Address added successfully';
    }
}

public function getSatusOfProduct(){
    
    $id = $this->input->get('v');
    $result = $this->Adminmodel->getSatusOfProduct($id);
    //print_r($result);exit;
    if($result != FALSE){
        $record = $this->Adminmodel->getStockSatusOfProduct($id);
        if($record != FALSE){
            $npro = $record['total_product'] - $record['sell_product'];
            if($npro == 0){
                echo 'out';
            }else{
                echo 'in';
            }
            
        }
        
    }else{
        echo 'not';
    }
    
}

public function addContactUs(){
    $result = $this->Adminmodel->addContactUs();
    if($result != FALSE){
        $to   = $_POST['cemail'];
        $subject = "TEAO contact us enquiry";
        $from = 'info@softica.in';
        $message ="<html><body>";
        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10" bgcolor="#DDDDDD">';
        
        $message .= "<tr><td colspan=2>Hello ".$_POST['cname']." has successfully submitted request with us.<br/>
        
        <b>Email :-</b>&nbsp;". $_POST['cemail'] ."
        <br/>
        <b>Phone :-</b>&nbsp;". $_POST['cmobile'] ."
        <br/>
        <b>Subject :-</b>&nbsp;". $subject ."
        <br/>
        <b>Message :-</b>&nbsp;". $_POST['cmessage'] ."
        <br/>
        <tr><td>
        Regards,<br/>
        <a href='#'>TEAO</a>
        <br/>
        </td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);
        echo 'Enquiry Submitted successfully';
    }
}

public function failedUserPayment(){
    $result = $this->Adminmodel->failedUserPayment();
    if($result != FALSE){
        echo 'fail';
        
    }
    
}

}