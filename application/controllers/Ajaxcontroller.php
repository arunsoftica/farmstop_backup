<?php

class Ajaxcontroller extends CI_Controller
{

    public function __construct()
    {
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
else if($page == 'verify_user'){
    $response = $this->verify_user();
}
else if($page == 'resetMyPassword'){
    $response = $this->resetMyPassword();
}
else if($page == 'saveMyPassword'){
    $response = $this->saveMyPassword();
}
else if($page == 'getLiveSearchProducts'){
    $response = $this->getLiveSearchProducts();
}
else if($page == 'resend_otp'){
    $response = $this->resend_otp();
}
else if($page == 'addPreOrder'){
    $response = $this->addPreOrder();
}
else if($page == 'getMangoVariationTypes'){
    $response = $this->getMangoVariationTypes();
}
else if($page == 'getVariationDetail'){
    $response = $this->getVariationDetail();
}
else if($page == 'deleteUserAddress'){
    $response = $this->deleteUserAddress();
}
else if($page == 'getLiveSearchProducts1'){
    $response = $this->getLiveSearchProducts1();
    
}
else if($page == 'delete_all_item_from_cart'){
    $response = $this->delete_all_item_from_cart();
}
else if($page == 'getScrollProduct'){
    $response = $this->getScrollProduct();
}


}
public function getScrollProduct(){
    $start = $this->input->get('offset');
    $limit = $this->input->get('limit');
    $ldid = $this->input->get('ldid');
    $gc = $this->input->get('c');
    //print_r($limit);exit;
    $ur = $this->input->get('ur');
    $xy = $this->input->get('s');
    if (strpos($xy,'?s') !== false) {
            $expl = explode('=',$xy);
            if($expl[1] == 'price-low-to-high'){
                $filter_by = 'price-low-to-high';
            }else if($expl[1] == 'price-high-to-low'){
                $filter_by = 'price-high-to-low';
            }else if($expl[1] == 'customer-review'){
                $filter_by = 'customer-review';
            }else if($expl[1] == 'new-and-popular'){
                $filter_by = 'new-and-popular';
            }
            
            
        }
    $filter_by = '';
    $exur = explode(',',$ur);
    if(empty($exur[0]) && empty($exur[1]) && empty($exur[2])){
        if (strpos($xy,'?s') !== false) {
            $expl = explode('=',$xy);
            if($expl[1] == 'price-low-to-high'){
                $result = $this->Adminmodel->getProductVariationByPriceLow($limit,$start);
            }else if($expl[1] == 'price-high-to-low'){
                $result = $this->Adminmodel->getProductVariationByPriceHigh($limit,$start);
            }else if($expl[1] == 'customer-review'){
                $result = $this->Adminmodel->getProductVariationByCustomerReview($limit,$start);
            }else if($expl[1] == 'new-and-popular'){
                $result = $this->Adminmodel->getProductVariation(null,$limit,$start);
            }
            
            
        }else if(strpos($xy,'?term') !== false && strpos($xy,'&s') == false){
            $xp = explode('&kw=',$xy);
            $search = $xp[1];
            
            $xxp = explode('?term=',$xy);
            //print_r($xxp);exit;
            $terms = explode('&kw',$xxp[1]);
            $term = $terms[0];
            $result = $this->Adminmodel->getProductVariationBySearching(null,$limit,$start,$term,$search,$filter_by);
            
        }else if(strpos($xy,'?term') !== false && strpos($xy,'&s') !== false){
            $xxp = explode('?term=',$xy);
            //print_r($xxp);exit;
            $terms = explode('&kw',$xxp[1]);
            $term = $terms[0];
            
            $xp = explode('&kw=',$xy);
            $srch = explode('&s',$xp[1]);
            $search = $srch[0];
            
            $xpl = explode('&s=',$xy);
            $filter_by = $xpl[1];
            
            
            $result = $this->Adminmodel->getProductVariationBySearching(null,$limit,$start,$term,$search,$filter_by);
            
        }else if(strpos($xy,'?c') !== false){
            $result = $this->Adminmodel->getProductVariationByProductCategory($gc,$limit,$start);
        }else {
            $result = $this->Adminmodel->getProductVariation(null,$limit,$start);
        }
        
    }else if(!empty($exur[0]) && empty($exur[1]) && empty($exur[2])){
         
            $result = $this->Adminmodel->getProductVariationByFilters($exur[0],'','',$filter_by,$limit,$start);
        
        
    }else if(!empty($exur[0]) && !empty($exur[1]) && empty($exur[2])){
        $result = $this->Adminmodel->getProductVariationByFilters($exur[0],$exur[1],'',$filter_by,$limit,$start);
    }else if(!empty($exur[0]) && !empty($exur[1]) && !empty($exur[2])){
        $result = $this->Adminmodel->getProductVariationByFilters($exur[0],$exur[1],$exur[2],$filter_by,$limit,$start);
    }
    
    if($result != FALSE){
        foreach($result as $var){ ?>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 p-1 p-media divid" value="<?php echo $ldid+1; ?>" divid="<?php echo $ldid+1; ?>">
                      
              <div class="productsnew">
              <form class="add_cart" did="<?php echo $ldid; ?>" method="post">
              <input type="hidden" name="userid" id="userid" value="<?php if(isset($_SESSION['login_id'])) echo $_SESSION['login_id']; ?>">
                        
            <?php $mPrice = $this->Adminmodel->getMinMaxPrice($var['id']); ?>
                      <?php if(is_null($mPrice['minsp']) || $mPrice['minsp'] == '0.00'){ 
                      $dc = 0;
                      }
                      else{ 
                      $dc = ((($mPrice['minrp']-$mPrice['minsp'])/$mPrice['minrp'])*100);
                      $dc = number_format((float)$dc, 0, '.', '');
                      } ?>
              <div class="row">
                  <div class="col-sm-5 col-5">
                      <span class="wish-icon">
            <i class="
                    <?php
                    if(isset($_SESSION['login_id'])){
                      $res = $model2->getWishlistStatus($var['id'],$_SESSION['login_id']);
                      if($res != FALSE){
                          echo 'fa fa-heart';
                      }else{
                          echo 'fa fa-heart-o';
                      }
                    }
                    else{
                        echo 'fa fa-heart-o';
                    }
                    ?>
                    
                    "></i><input type="hidden" name="wishlist" class="wlist" id="wlist" value="<?php echo $var['id']; ?>">
            
            
            </span>
                      <div class="save-price box-shadew"><?php if($dc>0){?>
              GET <?php echo $dc; ?>% OFF<?php }else{?>&nbsp;<?php } ?></div>
                      <div class="img-box">
                   <a href="<?php echo base_url('product/'.$var['pslug'].'/'.$var['attribute_slug']);?>">
                  <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $var['fimage'])) ?>" class="img-responsive img-fluid" alt="">  
                  </a>                 
                </div>
                      <div class="productsnew-title">
                  <!--<h6>Farm Fresh</h6>-->
                  <a href="<?php echo base_url('product/'.$var['pslug'].'/'.$var['attribute_slug']);?>"><?php echo $var['attribute_name'] ?></a>
              </div>
                  </div>
                  <div class="col-sm-7 col-7">
                      <div class="row m-0">
                        <div class="col-sms-6 col-6 p-0">
                          <div class="qnty-selection">
                              <span>
                                <?php $vardetail = $this->Adminmodel->getVariationDetail($var['id']); ?>
                                <input type="hidden" name="attribute_id" value="<?php echo $var['id'] ?>">
                      <select class="form-control aprice" name="aprice" required>
                                        <!--<option value="">Select</option>-->
                                        <?php
                                        $cx = 0;
                                            foreach($vardetail as $vdet){ 
                                            if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
                           $sp = $vdet['regular_price'];
                   } else{
                           $sp = $vdet['sale_price'];
                   }
                   if($cx == 0){ $cxpr = $sp; }
                                             echo '<option value="'.$vdet['regular_price'].'-'.$sp.'-'.$vdet['weight'].'-'.$vdet['id'].'">'.$vdet['weight'].'</option>';
                                             $cx = $cx + 1;
                                            }
                                    
                                        ?>
                                      </select>
                              </span>
                          </div>
                      </div>
                      <div class="col-sm-6 col-6 p-0 textquant">
                          <div class="quantity1 quantity mt10px">                   
                        <div>
                            <div class="btn-minuss" value="1"><span class="fa fa-minus"></span></div>
                            <input class="form-control" name="nitem" id="nitem" value="1" readonly="">
                            <div class="btn-pluss" value="1"><span class="fa fa-plus"></span></div>
                        </div>
                    </div>
                      </div>
                  </div>
                      <div class="itemproductdetail">
                  <div class="elementpro">
                      <h5><span class="iconrate">Rs.<?php echo $cxpr;  ?></span></h5>
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="row m-0">
                      <div class="col-sms-12 col-12 p-0">
                          <input type="hidden" name="cnv" class="cnv" value="<?php echo $ldid; ?>" />
                          <div class="text-center-flex submit">
                          <button type="button" class="buybtn btn cart__buy cartnewbtn mrginright2px" >Buy <span class="fas fa-shopping-basket"></span></button>
                          
                          <button value="1" type="submit" id="submit<?php echo $ldid; ?>" class="atcbtn btn cartnewbtn" >Add <span class="fa fa-shopping-cart"></span></button>
                          </div>
                      </div>
                      
                  </div>
              </div>
                  </div>
              </div>
              
              </form>
          </div>
            </div>
            
            
        <?php  $ldid = $ldid+1;}
        
        
    }
    
}


public function delete_all_item_from_cart(){
            unset($_COOKIE['asdfghjkl']);
            setcookie('asdfghjkl', null, time()-3600);
}

public function getVariationDetail(){
    $vid = $this->input->get('vid');
    
    $vardetail = $this->Adminmodel->getVariationDetail($vid);
    //print_r($vardetail);exit;
    if($vardetail != FALSE){
                                             
            if(is_null($vardetail[0]['sale_price']) || $vardetail[0]['sale_price'] == '0.00'){
           $sp = $vardetail[0]['regular_price'];
   } else{
           $sp = $vardetail[0]['sale_price'];
   } ?>
   
   <input type="hidden" name="aprice" value="<?php echo $vardetail[0]['regular_price'].'-'.$sp.'-'.$vardetail[0]['weight'].'-'.$vardetail[0]['id'] ?>" />
    <?php }
}

public function getMangoVariationTypes(){
    $mtype = $this->input->get('v');
    if($mtype == 1){ 
      $vardetail = $this->Adminmodel->getVariationDetail(184);  
    }else if($mtype == 2){ 
      $vardetail = $this->Adminmodel->getVariationDetail(185);  
    }else if($mtype == 3){ 
      $vardetail = $this->Adminmodel->getVariationDetail(186);  
    }else if($mtype == 4){ 
      $vardetail = $this->Adminmodel->getVariationDetail(187);  
    }
    if($vardetail != FALSE){
        echo '<option value="">Select Quantity</option>';
        foreach($vardetail as $vdet){ 
            if(is_null($vdet['sale_price']) || $vdet['sale_price'] == '0.00'){
           $sp = $vdet['regular_price'];
           } else{
                   $sp = $vdet['sale_price'];
           } 
           $wt = explode(' ',$vdet['weight']);
           if($vdet['weight'] != 1){
               echo '<option value="'.$sp.'@'.$wt[0].'">'.$vdet['weight'].' (Rs.'.$sp.')'.'</option>';
           }
             
            }
    }
    
}

public function addPreOrder(){
    $flag = '';
    extract($_POST);
    $qnp = explode('@',$quantity);
    $quantity1 = $qnp[1];
    $coq = $this->Adminmodel->checkOrderQuantity($mtype);
    if($mtype == 1 || $mtype == 3){
        if($coq != FALSE){
            $qn = $coq['quantity']+$quantity1;
            if($qn < 300){
                $result = $this->Adminmodel->addPreOrder();
                if($result != FALSE){
                    $flag = 1;
                    echo 'Order Submitted Successfully';
                }
            }else{
                echo 'You can not pre order this product anymore';
            }
        }else{
            $result = $this->Adminmodel->addPreOrder();
            if($result != FALSE){
                $flag = 1;
                echo 'Order Submitted Successfully';
            }
        }
    }else if($mtype == 2 || $mtype == 4){
        if($coq != FALSE){
            $qn = $coq['quantity']+$quantity1;
            if($qn < 500){
                $result = $this->Adminmodel->addPreOrder();
                if($result != FALSE){
                    $flag = 1;
                    echo 'Order Submitted Successfully';
                }
            }else{
                echo 'You can not pre order this product anymore';
            }
        }else{
            $result = $this->Adminmodel->addPreOrder();
            if($result != FALSE){
                $flag = 1;
                echo 'Order Submitted Successfully';
            }
        }
    }
    
    if($flag == 1){
        
          $this->load->library("phpmailer_library");
              $mail = $this->phpmailer_library->load();
              $mail->isSMTP();
              $mail->Host = 'mail.farmstop.in';
              $mail->Port = 587; 
              /*$mail->SMTPAuth = true;
              $mail->SMTPSecure = 'tls';*/
              $mail->SMTPAuth = false;
              $mail->SMTPSecure = false;

              $mail->Username = 'sales@farmstop.in';
              $mail->Password = 'Farmstop@123';

              $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
              $mail->addAddress(trim($email));
              $mail->addReplyTo('sales@farmstop.in');
              $mail->isHTML(true);

              $mail->Subject = "FARMSTOP Preorder Email";
              $mail->Body    = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head><body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style='background-color:#54312a;'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,Verdana,sans-serif;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><h1 style='text-align:center;margin:0'><span style='color:#ffffff'><span style='font-size:32px'>Farmstop Preorder Mail</span></span></h1></td></tr></tbody></table></td></tr></tbody></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:0px 18px 9px;text-align:center'></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='center' border='0' cellpadding='0' cellspacing='0' width='54' style='max-width:54px'><tbody><tr><td valign='top' style='padding-top:0;padding-right:9px;padding-bottom:9px;padding-left:9px;text-align:center'><img align='center' alt='' src='https://www.farmstop.in/assets/img/email-verification.png' width='200' style='max-width:200px;padding-bottom:0;display:inline!important;vertical-align:bottom'></td></tr></tbody></table></td></tr><tr><td valign='top' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;'><h1><span style='color:#000'><span style='font-size:20px'>Hi  '".$name."',</span></span></h1><p><span style='color:#7f7f7f'><span style='font-size:20px'> Thanks for pre-ordering organic mangoes. The delicious mangoes will be harvested in a few days, ripened naturally and be bought to your door-step. Thanks for choosing us. </span></span></p><h1><span style='color:#000'><span style='font-size:16px'>Please visit us at https://www.instagram.com/farmstop.in/ or https://www.facebook.com/farmstop.in/ to know more about our farms and organic practices we follow.</span></span></h1></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top' align='right'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;    padding: 10px;'><tbody><tr><td style='padding-top: 26px;' valign='top' align='center'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate!important;border-radius:3px;background-color:#5c3a34bd;width: 100%;'><tbody><tr><td align='center' valign='middle' style='font-family:Arial;font-size:16px;padding:15px'><a title='View Tracking Details' href='#' style='font-weight:bold;letter-spacing:normal;line-height:15px;text-align:center;text-decoration:none;color:#ffffff' target='_blank' data-saferedirecturl='#'></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";

              if(!$mail->send()) {
                  echo 'Message could not be sent.';
                  echo 'Mailer Error: ' . $mail->ErrorInfo;
              } else {
                //echo $votp;
              }
        
    }
    
}


public function resend_otp(){
    $mob = $this->input->get('ro');
    //OTP
          $votp = mt_rand(111111,999999);
          $msgs = "Your otp for verification is $votp";
          $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=trim($mob);
                $message = urlencode("$msgs");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
                
                if($send[0] == "SUBMIT_SUCCESS ") echo $votp; else echo "send message failed";
            /*$curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://sms.softica.in/api_v2/message/send",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "sender_id=FRMSTP&message=$msgs&mobile_no=".trim($mob),
              CURLOPT_HTTPHEADER => array(
                "authorization: Bearer G8hmyDa5mbaAadViHGJeb5-_dTAawETLw60FXvuGhozl3imZUu4JLQra3pVbYOtz",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo $votp;
            }*/
          //OTP
    
}

public function getLiveSearchProducts1(){
    $search = $this->input->get('s');
    $result = $this->Adminmodel->getLiveSearchProducts1($search);
    
    if($result != FALSE){
        foreach($result as $res){ ?>
            <li><a href="<?php echo base_url('product/'.$res['pslug'].'/'.$res['attribute_slug']); ?>"><?php echo $res['attribute_name']; ?></a></li>
        <?php }
    }
}

public function getLiveSearchProducts(){
    $search = $this->input->get('s');
    $type = $this->input->get('r');
    $xyz = $this->input->get('x');
    $result = $this->Adminmodel->getLiveSearchProducts($search,$type);
    
    if($result != FALSE){
        foreach($result as $res){ ?>
        <?php if($type == 1){ ?>
        
        <?php if($xyz == 1){ ?>
          <li class="apart clickremovesearch" val="<?php echo $res['delivery_days'] ?>"><a href="#" data-toggle="modal" data-target="#myModalap<?php echo $res['id'] ?>"><?php echo $res['apartment'].'('.$res['location'].')' ?>
           </a><br>
           
           </li>
        <?php }else if($xyz == 2){ ?>
           
           
           <li class="apart clickremovesearch" val="<?php echo $res['delivery_days'] ?>"><a data-toggle="modal"  data-toggle="modal" data-target="#myModalMobile<?php echo $res['id'] ?>"><?php echo $res['apartment'].'('.$res['location'].')' ?></a></li>
           
        <?php } ?>
        
        <?php } else if($type == 2){ ?>
        
        <?php if($xyz == 1){ ?>
          <li class="apart clickremovesearch"><a href="#" data-toggle="modal" data-target="#myModalap<?php echo $res['id'] ?>"><?php echo $res['area'].'('.$res['pincode'].')' ?>
           </a><br>
           
           </li>
        <?php }else if($xyz == 2){ ?>
           <li class="apart clickremovesearch" ><a href="#" data-toggle="modal" data-target="#myModalMobile<?php echo $res['id'] ?>"><?php echo $res['area'].'('.$res['pincode'].')' ?>
           </a><br>
           
           </li>
           
           
           
        <?php } ?>
        
        
        <?php } ?>
        
           
           <?php if($xyz == 1){ ?>
            <!-- The Modal -->
  <div class="modal" id="myModalap<?php echo $res['id'] ?>" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">
              <?php
              if($type == 1){ echo $res['apartment']; }
              else if($type == 2){ echo $res['area'].'('.$res['pincode'].')'; }
               
              ?>
              </h4>
          <button type="button" class="close lipopclose" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body p-0">
            <div class="delivery-pop">
                <img src="<?php echo base_url(); ?>assets/images/yes.png" alt="">
              <h1>Thank You!</h1>
              <?php if($type == 1){ ?>
              <p>Delivery available on these days:</p>
           <?php
           $days  = explode('@',$res['delivery_days']);
           $dayz = array();
           foreach($days as $day){
            if($day == 1) $dayz[] = 'Sunday';
            else if($day == 2) $dayz[] = 'Monday';
            else if($day == 3) $dayz[] = 'Tuesday';
            else if($day == 4) $dayz[] = 'Wednesday';
            else if($day == 5) $dayz[] = 'Thursday';
            else if($day == 6) $dayz[] = 'Friday';
            else if($day == 7) $dayz[] = 'Saturday';
           }
               echo "<div class='box-popmsg'><h3 class='cupon-pop'><span>Monday, Tuesday, Wednesday, Friday, Saturday</span></h3></div>";
               //echo "<div class='box-popmsg'><h3 class='cupon-pop'><span>".implode(', ',$dayz)."</span></h3></div>";
            //}
           ?>
              
              
              <?php } ?>
              
              <?php if($type == 2){ ?>
              <p>Delivery available on these days:</p>
              <div class="box-popmsg"><h3 class="cupon-pop"><span>Monday, Tuesday, Wednesday, Friday, Saturday</span></h3></div>
              <?php } ?>
          
            </div>
            <div class="shopnowpop">
                <a href="<?php echo base_url('shop'); ?>">Shop Now</a>
            </div>
        </div>
        
      </div>
    </div>
  </div>
        <?php }else if($xyz == 2){ ?>
           <div class="modal animated bounce"  id="myModalMobile<?php echo $res['id'] ?>" role="dialog" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">
                                                              <?php
              if($type == 1){ echo $res['apartment']; }
              else if($type == 2){ echo $res['area'].'('.$res['pincode'].')'; }
               
              ?>              </h4>
                                                          <button type="button" class="close lipopclose_m" data-dismiss="modal">×</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <div class="modal-body p-0">
                                                            <div class="delivery-pop">
                                                                <img src="https://www.farmstop.in/assets/images/yes.png" alt="">
                                                                            <h1>Thank You!</h1>
                                                                                                        <?php if($type == 1){ ?>
              <p>Delivery available on these days:</p>
           <?php
           $days  = explode('@',$res['delivery_days']);
           $dayz = array();
           foreach($days as $day){
            if($day == 1) $dayz[] = 'Sunday';
            else if($day == 2) $dayz[] = 'Monday';
            else if($day == 3) $dayz[] = 'Tuesday';
            else if($day == 4) $dayz[] = 'Wednesday';
            else if($day == 5) $dayz[] = 'Thursday';
            else if($day == 6) $dayz[] = 'Friday';
            else if($day == 7) $dayz[] = 'Saturday';
           }
               echo "<div class='box-popmsg'><h3 class='cupon-pop'><span>Monday, Tuesday, Wednesday, Friday, Saturday</span></h3></div>";
               //echo "<div class='box-popmsg'><h3 class='cupon-pop'><span>".implode(', ',$dayz)."</span></h3></div>";
            //}
           ?>
              
              
              <?php } ?>
              
              <?php if($type == 2){ ?>
              <p>Delivery available</p>
              <div class="box-popmsg"><h3 class="cupon-pop"><span>Tuesday, Thursday, Saturday</span></h3></div>
              <?php } ?>                           
                                                                            
                                                                                                        
                                                                                      
                                                            </div>
                                                            <div class="shopnowpop">
                                                                <a href="https://www.farmstop.in/shop">Shop Now</a>
                                                            </div>
                                                        </div>
                                                        
                                                      </div>
                                            </div>
                                        </div>
           
           
           
        <?php } ?>
           
       <?php }
        
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
                <div class="text-center"><img src="<?php echo base_url();?>assets/images/empty-cart.png" class="img-fluid">
                <p><i class="fa fa-frown-o" aria-hidden="true"></i> Looks like you haven’t added anything to your cart yet! <a href="<?php echo base_url('shop') ?>">Shop Now</a></p>
                </div>
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
                              <img src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $result['img'])) ?>" class="img-fluid" alt="">
                            </div>
                            <div class="col-md-9 col-sm-9 col-9 cart-box">
                              <h6>
                                <?php echo $result['attribute_name'] ?>
                                </h6>
                                <label><span class="item_weight"><?php echo $result['weight'] ?> | </span>    QTY: <span><?php echo $result['total_item'] ?> </span>
                                </label>
                                
                                <div class="item_product">
                                    <label>
                                        <p>Total</p>
                                        <span>Rs. <?php 
                                        if($result['sale_price'] == '0.00') echo $result['total_item']*$result['regular_price']; else echo $result['total_item']*$result['sale_price'];
                                        ?></span>
                                    </label>
                                </div>
                      <h5><span><button type="button" class="btn btn-sm btn-danger itemdelete" value="<?php echo $result['id'] ?>" ><span class="fa fa-trash"></span> </button></span></h5>
                            </div>
                        </div>
                    </li>
                    
            <?php } else if($this->input->get('cart') == 3){ ?>
              
                 
              <tr>
                            <input type="hidden" name="add_cart_id[]" value="<?php echo $result['id'] ?>">
                            <td data-title="Image"><img class="img-table img-fluid" src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $result['img'])) ?>" /> </td>
                            <td data-title="Product"><?php echo $result['attribute_name'] ?></td>
                            <td data-title="Weight"><?php echo $result['weight'] ?></td>
                            <td data-title="Price"><input type="hidden" name="sale_price[]" class="sale_price" value="<?php 
                                       if($result['sale_price'] == '0.00') echo $result['regular_price']; else echo $result['sale_price'];?>">
                                Rs. <?php 
                                       if($result['sale_price'] == '0.00') echo $result['regular_price']; else echo $result['sale_price']; ?></td>
                            <td data-title="Quantity"><div class="quantity<?php echo $cnt; ?> quantity">
                        <div>
                            <div class="btn-minus" id="btn-minus" value="<?php echo $cnt; ?>"><span class="fa fa-minus"></span></div>
                            
                            <input  name="total_item[]" class="total_item<?php echo $cnt; ?>" value="<?php echo $result['total_item'] ?>" readonly>
                            <div class="btn-plus" id="btn-plus" value="<?php echo $cnt; ?>"><span class="fa fa-plus"></span></div>
                        </div>
                    </div></td>
                            <td data-title="Total">
                                <input type="hidden" name="total_prices[]" class="total_prices" value="<?php 
                                        if($result['sale_price'] == '0.00') echo ($result['total_item']*$result['regular_price'])/$result['total_item']; else echo ($result['total_item']*$result['sale_price'])/$result['total_item'];?>">
                                Rs. <?php 
                                        if($result['sale_price'] == '0.00') $total_prices[] = ($result['total_item']*$result['regular_price']);else $total_prices[] = ($result['total_item']*$result['sale_price']);?>
                                <input type="text" name="total_price[]" class="border-bg total_price" value="<?php 
                                        if($result['sale_price'] == '0.00') echo ($result['total_item']*$result['regular_price']); else echo ($result['total_item']*$result['sale_price']);?>" readonly></td>
                            <td class="item-before-none"><button type="button" class="btn btn-sm btn-danger itemdel" value="<?php echo $result['id'] ?>" ><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                            
              
              
              
              
              
              

            <?php $cnt = $cnt + 1; } ?>
          <?php  }
          if($this->input->get('cart') == 2){
             echo '</ul><div class="cart-item-button"><a class="btn btn-md btn-success btn-block text-uppercase" href="'.base_url().'cart">View Cart</a>'.'<a class="btn btn-md btn-light btn-block text-uppercase" href="'.base_url().'checkout">Checkout</a></div>';
           }else if($this->input->get('cart') == 3){ ?>
            <tr>
                            
                            <td colspan="7" class="text-right item-before-none"><button class="btn updatecart-btn text-white" type="submit" name="submit" id="submit">Update Cart</button></td>
                            
                        </tr>
                        
                        <tr>
                            
                            <td class="text-right item-before-none" colspan="7">Sub-Total: Rs.<strong> <?php echo array_sum($total_prices) ?></strong></td>
                        </tr>
                        <tr>
                           
                            <td class="text-right item-before-none" colspan="7">Shipping Charges: Rs. <strong> 0</stromg></td>
                        </tr>
                        <tr>
                            
                            <td class="text-right item-before-none" colspan="7"><strong>Total: Rs. <?php echo array_sum($total_prices) ?></strong> </td>
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
                    <div class="text-center"><img src="<?php echo base_url();?>assets/images/empty-cart.png" class="img-fluid"></div>
                <p class="text-center"><i class="fa fa-frown-o" aria-hidden="true"></i> Looks like you haven’t added anything to your cart yet! <a href="<?php echo base_url('shop') ?>">Shop Now</a></p>
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

public function verify_user(){
    $email = $this->input->get('loginid');
     $verify = $this->Adminmodel->update_status_register_user($email);
           if($verify != FALSE){
               $this->load->helper('url');
               redirect(base_url('my-account?msg=yes'));
           }else{
               $this->load->helper('url');
               redirect(base_url('my-account?msg=no'));
           }
}

public function register_user(){

  //print_r($_POST);exit;
  $record = $this->Adminmodel->getRegisterUser($_POST['email']);
  if($record != FALSE){
       echo 'exist';
      
  }else{
      $rec = $this->Adminmodel->getRegisterUserByMobile($_POST['mobile']);
      if($rec != FALSE){
       echo 'mobile'; } else {
      $result = $this->Adminmodel->registerUser();
      if($result != FALSE){
          //OTP
          $votp = mt_rand(111111,999999);
          $msgs = "Your otp for verification is $votp";
          $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=trim($_POST['mobile']);
                $message = urlencode("$msgs");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
                
                //if($send[0] == "SUBMIT_SUCCESS ") echo $votp; else echo "send message failed";
            /*$curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://sms.softica.in/api_v2/message/send",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "sender_id=FRMSTP&message=$msgs&mobile_no=".trim($_POST['mobile']),
              CURLOPT_HTTPHEADER => array(
                "authorization: Bearer G8hmyDa5mbaAadViHGJeb5-_dTAawETLw60FXvuGhozl3imZUu4JLQra3pVbYOtz",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
             
            }*/
          //OTP
          $link = base_url();
          //print_r($link);
          extract($_POST);
          $this->load->library("phpmailer_library");
              $mail = $this->phpmailer_library->load();
              $mail->isSMTP();
              $mail->Host = 'mail.farmstop.in';
              $mail->Port = 587; 
              /*$mail->SMTPAuth = true;
              $mail->SMTPSecure = 'tls';*/
              $mail->SMTPAuth = false;
              $mail->SMTPSecure = false;

              $mail->Username = 'sales@farmstop.in';
              $mail->Password = 'Farmstop@123';

              $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
              $mail->addAddress(trim($email));
              $mail->addReplyTo('sales@farmstop.in');
              $mail->isHTML(true);

              $mail->Subject = "FARMSTOP Register User Verify Email";
              $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head><body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><h1 style='text-align:center;margin:0'><span style='color:#000; text-transform: uppercase;'><span style='font-size:32px'>Farmstop
</span></span></h1></td></tr><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'></td></tr></tbody></table></td>
</tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><h1><span style='color:#000'><span style='font-size:20px'>Verification Code</span></span></h1><h1><span style='color:#000'><span style='font-size:20px'>Enter OTP <span style='font-size:30px; letter-spacing:2; margin-left:10px; margin-right:10px;color:#E91E63;'>".$votp."</span> to continue.</span></span></h1><p><span style='color:#7f7f7f'><span style='font-size:16px'> Here's your OTP verification code.<br>code will expire in 10 minutes</span></span></p><p style='margin-top: 60px;'>*If you did not try to sign in just now, please change your password to protect
your account</p></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>
";
              /*$mail->Body    = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head><body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style='background-color:#54312a;'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,Verdana,sans-serif;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><h1 style='text-align:center;margin:0'><span style='color:#ffffff'><span style='font-size:32px'>Farmstop Verify User Mail</span></span></h1></td></tr></tbody></table></td></tr></tbody></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:0px 18px 9px;text-align:center'></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='center' border='0' cellpadding='0' cellspacing='0' width='54' style='max-width:54px'><tbody><tr><td valign='top' style='padding-top:0;padding-right:9px;padding-bottom:9px;padding-left:9px;text-align:center'><img align='center' alt='' src='https://www.demo.farmstop.in/assets/img/email-verification.png' width='200' style='max-width:200px;padding-bottom:0;display:inline!important;vertical-align:bottom'></td></tr></tbody></table></td></tr><tr><td valign='top' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;'><h1><span style='color:#000'><span style='font-size:20px'>Hi  '".$name."',</span></span></h1><p><span style='color:#7f7f7f'><span style='font-size:16px'> thanks for register with us.</span></span></p><h1><span style='color:#000'><span style='font-size:20px'>Enter OTP <span style='font-size:30px; letter-spacing:2; margin-left:10px; margin-right:10px;font-family: cursive;
color:#3dbbf2;'>'".$votp."'</span> to continue.</span></span></h1></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top' align='right'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%;    padding: 10px;'><tbody><tr><td style='padding-top: 26px;' valign='top' align='center'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse:separate!important;border-radius:3px;background-color:#5c3a34bd;width: 100%;'><tbody><tr><td align='center' valign='middle' style='font-family:Arial;font-size:16px;padding:15px'><a title='View Tracking Details' href='#' style='font-weight:bold;letter-spacing:normal;line-height:15px;text-align:center;text-decoration:none;color:#ffffff' target='_blank' data-saferedirecturl='#'></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>";*/

              if(!$mail->send()) {
                  echo 'Message could not be sent.';
                  echo 'Mailer Error: ' . $mail->ErrorInfo;
              } else {
                //echo $votp;
              }
          /*$to   = $_POST['email'];
        $subject = "FARMSTOP Register User Verify Email";
        $from = 'sales@farmstop.in';
        
        $message = '<html><body><table>';
        $message .= '<tr></tr><tr><td><a href="'.base_url('Ajaxcontroller/verify_user?loginid='.$to).'" target="_blank">Hey click here to activate your farmstop account</a></td></tr>';
        $message .= '</table>';
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);*/
         //echo 'registered';
         echo $votp;
       }}
  }
  
}

public function login_user()
{

    extract($_POST);
    $result = $this->Adminmodel->verifyUserName($usernm);
    //print_r($result);exit;
    if($result != FALSE)
    {
        $res = $this->Adminmodel->verifyUserPassword($result['id'],$passwd);
        if($res != FALSE)
        {
            if($res['status'] == 1)
            {
                $this->session->set_userdata('login_id',       $res['id']);
                $this->session->set_userdata('login_name',     $res['name']);
                $this->session->set_userdata('login_email',    $res['email']);
                $this->session->set_userdata('login_type',     $res['type']);
                $this->session->set_userdata('login_mobile',   $res['mobile']);
                echo 'yes';
            }
            else
            {
                //echo 'please verify verification link that has been sent to your registered email id';
                $votp = mt_rand(111111,999999);
                $msgs = "Your otp for verification is $votp";
                $this->session->set_userdata('login_vmob' , $votp);
                $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=trim($res['mobile']);
                $message = urlencode("$msgs");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
                
                //////////
                $this->load->library("phpmailer_library");
                $mail = $this->phpmailer_library->load();
                $mail->isSMTP();
                $mail->Host = 'mail.farmstop.in';
                $mail->Port = 587; 
                /*$mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';*/
                $mail->SMTPAuth = false;
                $mail->SMTPSecure = false;
                
                $mail->Username = 'sales@farmstop.in';
                $mail->Password = 'Farmstop@123';
                
                $mail->setFrom('sales@farmstop.in', 'FARMSTOP');
                $mail->addAddress(trim($res['email']));
                $mail->addReplyTo('sales@farmstop.in');
                $mail->isHTML(true);
                
                $mail->Subject = "FARMSTOP Register User Verify Email";
                $mail->Body = "
                                <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Untitled Document</title></head><body><table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%'><tbody><tr><td align='center' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 1px #dcdbdb solid;;max-width:600px;margin:auto'><tbody><tr><td align='center' valign='top' style=''><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='min-width:100%'><tbody><tr><td valign='top'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%;padding-top: 14px;' width='100%'><tbody><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><h1 style='text-align:center;margin:0'><span style='color:#000; text-transform: uppercase;'><span style='font-size:32px'>Farmstop
                                </span></span></h1></td></tr><tr><td valign='top' style='padding:10px;color:#ffffff;font-family:Cardo;font-size:25px;font-style:normal;font-weight:bold;line-height:100%;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'></td></tr></tbody></table></td>
                                </tr></tbody></table></td></tr></tbody></table></td></tr><tr><td align='center' valign='top'><table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'  style='min-width:100%'><tbody><tr><td valign='top' style='padding-top:9px'><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><h1><span style='color:#000'><span style='font-size:20px'>Verification Code</span></span></h1><h1><span style='color:#000'><span style='font-size:20px'>Enter OTP <span style='font-size:30px; letter-spacing:2; margin-left:10px; margin-right:10px;color:#E91E63;'>".$votp."</span> to continue.</span></span></h1><p><span style='color:#7f7f7f'><span style='font-size:16px'> Here's your OTP verification code.<br>code will expire in 10 minutes</span></span></p><p style='margin-top: 60px;'>*If you did not try to sign in just now, please change your password to protect
                                your account</p></td></tr><tr><td valign='top' style='padding:10px;text-align:center'><img src='https://www.farmstop.in/assets/images/farmstop.png' width='100'><p style='font-family:Cardo;'> #350, 10 Th main, ITI Layout,<br> Sector 7, HSR layout,<br> Bengaluru, Karnataka, 560078</p></td></tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' style='max-width:100%;min-width:100%' width='100%'><tbody><tr><td valign='top' style='padding:10px;text-align:left; width: 50%;'><a href='#'><img src='https://www.farmstop.in/assets/images/iphone.png' width='100'></a><a href='#'><img src='https://www.farmstop.in/assets/img/farmstop-app.png' width='100'></a></td><td valign='top' style='padding:10px;text-align:right; width: 50%;'><a target='_blank' href='https://www.facebook.com/farmstop.in'><img src='https://www.farmstop.in/assets/images/fb.png' alt='facebook' class='img-fluid' width='30'></a><a target='_blank' href='https://twitter.com/farmstopindia'><img src='https://www.farmstop.in/assets/images/tw.png' alt='Twitter' class='img-fluid' width='30'></a><a target='_blank' href='https://www.instagram.com/farmstop.in/'><img src='https://www.farmstop.in/assets/images/ista.png' alt='Instagram' class='img-fluid' width='30'></a><a target='_blank' href='https://www.linkedin.com/company/farmstop-in'><img src='https://www.farmstop.in/assets/images/linkedin.png' alt='linkedin' class='img-fluid' width='30'></a><a target='_blank' href='https://www.youtube.com/channel/UCD1Eu_hIA1tZVK88zsPwOCQ?view_as=subscriber'><img src='https://www.farmstop.in/assets/images/yt.png' alt='youtube' class='img-fluid' width='30'></a></td></tr></tbody></table></td></tr><tr><td style='padding-top:0;padding-right:18px;padding-bottom:9px;padding-left:18px; text-align:center;font-family:Cardo;'><p>Copyright 2020 farmstop foods private limited</p></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>
                                ";
              

                if(!$mail->send()) 
                {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } 
                else
                {
                        //echo $votp;
                }
                    
                //////////
                echo $res['mobile'];
        }
        }
        else
        {
            echo 'Invalid Password';
        }
    }
    else
    {
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
    if(isset($_COOKIE['asdfghjkl']) && $id == 1){
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
            /*unset($_COOKIE['asdfghjkl']);
            setcookie('asdfghjkl', null, time()-3600);*/
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
            <td><img width="70" src="<?php echo base_url('admin/uploads/product_variation_images/'.preg_replace('/\s+/', '_', $result['img'])) ?>" class="img-fluid" alt=""></td>
            <td class="product-weight">
                <p><?php echo $result['attribute_name'] ?></p>
                <?php echo $result['weight'] ?>
                &nbsp;<strong class="product-quantity">× <?php echo $result['total_item'] ?></strong>
            </td>
            <td class="product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ </span>
            <?php 
                        if($result['sale_price'] == '0.00') echo $psum[] = $result['total_item']*$result['regular_price']; else echo $psum[] = $result['total_item']*$result['sale_price']; 
?> 
            </span></td>
          </tr>
          <?php  } ?>
          <tr class="cart-subtotal">
      <th>Subtotal</th>
      <td></td>
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
                <input type="hidden" name="coupon_code" id="coupon_code" value="">
          </td>
    </tr>
    <tr class="shipping">
          <th>Shipping</th>
          <td></td>
          <td data-title="Shipping">
          <p id="shippingcost">₹ 0</p></td>
        </tr>
        <tr class="order-total">
      <th>Total</th>
      <td></td>
      <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹ </span>
      <span id="total_amount"><?php echo array_sum($psum) ?></span>
      
      </span></strong> </td>
    </tr>
          <tr class="order-total">
            <td colspan="2" align="left"><input data-toggle="modal" data-target="#coupon-code" type="text" id="applied_coupon_code" class="form-control" placeholder="Enter coupon code" readonly />
            <!--<span><a data-toggle="modal" data-target="#coupon-code">View Coupon</a></span>-->
            </td>
      <td align="right" class="coupon-code"><button class="btn btn-dark mt-0" type="button">Apply</button> </td>
      
    </tr>
    <tr class="order-total">
      <th colspan="2">Net Total</th>
      <td><strong><span class="woocommerce-Price-amount amount" id="net_total"><span class="woocommerce-Price-currencySymbol">₹ </span><?php echo array_sum($psum) ?></span></strong></td>
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
                   $_SESSION['farmstop_order_id'] = $ordertb;
               }
                $this->session->set_userdata('user_payment_id' , $userpay);
                $this->session->set_userdata('your_cart_item' , $pid);
                $cpid = explode(',',$pid);
                $updemail = $this->Adminmodel->update_email_add_cart($cpid,$email,$userpay);
                if($updemail != FALSE){
                    
                    if($optradio == 1){
                        /* payu code*/
                            $MERCHANT_KEY = "lRJkyV0S";
                            $SALT = "i8baiw0GP0";
                            /*$MERCHANT_KEY = "QMBzI1i5";
                            $SALT = "I9vzBecBba";*/
                        
                          $hashseq=$MERCHANT_KEY.'|'.$txnid.'|'.$total.'|'.$productinfo.'|'.$name.'|'.$email.'|||||||||||'.$SALT;
                          $hash =strtolower(hash("sha512", $hashseq));
                          $payar = Array($optradio,$MERCHANT_KEY,$SALT,$hash,$txnid,$total,$name,$email,$mobile,$productinfo,$surl,$furl);
                          echo json_encode(array("pay_u"=>$payar));
                            ?>
                            
                            <?php
                            
                            
                            /* payu code*/
                    }
                    else if($optradio == 4){ 
                      $this->session->set_userdata('totalAmount' , $_POST['total']);
                      //$payar = [$optradio,'rzp_test_UZAcQOZFtEtGvt'];
                      $payar = array($optradio,'rzp_test_UZAcQOZFtEtGvt');
                      echo json_encode(array("pay_u"=>$payar));
                     } else if($optradio == 2){
                           $payar = array($optradio);
                           echo  json_encode(array("pay_u"=>$payar));
                         /* COD otp can be sent again & again in same mobile no. */
                         /*$ran = mt_rand(111111,999999999);
                         $otp = substr($ran,0,6); 
                         $mob_otp = $this->Adminmodel->addCodOtp($otp);
                         if($mob_otp != FALSE){
                           $payar = array($optradio,$mobile);
                           echo  json_encode(array("pay_u"=>$payar));
                         }*/
                         
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
        
        /*echo $result['shipping_cost'];*/
        if($ta >= 999){
            echo 0;
        }else{
            echo 30;
        }
        //echo 30;
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
            if($npro > 0){
                echo 'in';
            }else{
                echo 'out';
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
        $subject = "FARMSTOP contact us enquiry";
        $from = 'sales@farmstop.in';
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
        <a href='#'>FARMSTOP</a>
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

public function resetMyPassword(){
    $email = $this->input->get('email');
    //print_r($email);exit;
    $result = $this->Adminmodel->verifyUserName($email);
    if($result != FALSE){
        //OTP
          $votp = mt_rand(111111,999999);
          $msgs = "Your OTP for Reset Password is $votp";
          $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=trim($result['mobile']);
                $message = urlencode("$msgs");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
                
                //if($send[0] == "SUBMIT_SUCCESS ") echo $votp; else echo "send message failed";
            /*$curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://sms.softica.in/api_v2/message/send",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "sender_id=FRMSTP&message=$msgs&mobile_no=".trim($result['mobile']),
              CURLOPT_HTTPHEADER => array(
                "authorization: Bearer G8hmyDa5mbaAadViHGJeb5-_dTAawETLw60FXvuGhozl3imZUu4JLQra3pVbYOtz",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              //echo $response;exit;
            }*/
          //OTP
        /*$to   = $email;
        $subject = "FARMSTOP RESET EMAIL";
        $from = 'sales@farmstop.in';
        $message ="<html><body>";
        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10" bgcolor="#DDDDDD">';
        
        $message .= "<tr><td colspan=2>
        <a href='".base_url('reset-password?em='.base64_encode($email))."'>Click here to reset your password</a>
        <td><tr>";
        $message .= "<tr><td>Regards,<br/>
        <a href='".base_url()."'>FARMSTOP</a>
        <br/>
        </td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
       $headers .= "From: " . strip_tags($from) . "\r\n";
       $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
       mail($to, $subject, $message, $headers);*/
        echo $votp;
    }else{
        echo 'Invalid Mobile';
    }
    
}

public function saveMyPassword(){
    $pwd = $this->input->get('pwd');
    $email = $this->input->get('email');
    if(!empty(trim($pwd))){
        $result = $this->Adminmodel->updateResetPassword($pwd,$email);
        if($result != FALSE){
            echo 'saved';
        }
        
    }else{
        echo 'Enter Password';
    }
    
}

public function deleteUserAddress(){
    $adrs = $this->input->get('adrs');
    $result = $this->Adminmodel->deleteUserAddress($adrs);
        if($result != FALSE){
            echo 'Address deleted successfully';
        }
    
}

}