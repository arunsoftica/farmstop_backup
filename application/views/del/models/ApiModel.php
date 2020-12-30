<?php

class ApiModel extends CI_Model{

public function __construct(){
  
  date_default_timezone_set('Asia/Kolkata');
  $this->load->library("api_library");
     
  
}

public function getProducts($data){
       $result = $this->api_library->getProductsByFilter($data);
        //echo '<pre>';
        //print_r($result);exit;
       //return $result;
       $results = array();
       foreach($result as $res){
          $record = $this->api_library->getProductVariationByProductId($res['id']); 
          $res['variation']=$record;
          $proimages = $this->api_library->getProductImagesByProductId($res['id']);
          foreach($proimages as $pimage){
              if($pimage['fstatus'] == 1){
                $res['mainImage'] = $pimage['image'];   
              }else{
                 $res['featuredImages'][] = $pimage['image'];
              }
              
          }
          //$res['images']= array("main_image"=>$mainImage,"featured_image"=>$featuredImages);
          //array_push($res,$record);
          //echo '<pre>';
          //print_r($res);exit;
          $results[] = $res;
          
       }
       return $results;
    
    
  }
  public function addToCart($data){
       $result = $this->api_library->addToCart($data);
       if($result != FALSE){
           return $arr = ['success' => 1];
       }else{
           return $arr = ['success' => 0];
       } 
      
  }
  public function getCart($data){
       $result = $this->api_library->getCart($data);
       return $result; 
      
  }

  public function getProductVariation($id = null){
    if($id != null){
        $query = $this->db->select('t.*,c.title as pname')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->where('c.slug', $id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
    }else{
         $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->where('p.fstatus',1)->order_by('t.id','desc')->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array(); 
    }



  }
  public function getProductVariationByPriceLow(){
      
      $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->join('variation_details as v','v.product_variation_id = t.id')->where(['p.fstatus'=>1])->order_by('t.price','asc')->distinct()->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
  }
  public function getProductVariationByPriceHigh(){
      $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->join('variation_details as v','v.product_variation_id = t.id')->where(['p.fstatus'=>1])->order_by('t.price','desc')->distinct()->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
  }
  public function getProductVariationByCustomerReview(){
      $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->where('p.fstatus',1)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
  }
  public function getProductVariationByProductCategory($slug){
      $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_variation_images as p','t.id = p.product_id')->where(['p.fstatus'=>1,'c.slug' => $slug])->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
  }
  public function getProductByProductCategory($id){
      $query = $this->db->select('t.*,c.title as pname')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->where('t.product_id', $id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
      
  }
  public function getFeaturedProduct($id = null){
    if($id != null){
        
    }else{
         $query = $this->db->select('t.*,c.title as pname,i.email as mail,p.image as fimage,v.attribute_name as attribute,v.attribute_slug as slug')->from('featured_product as t')->join('product_variation as v', 'v.id = t.product')->join('product as c', 'c.id = t.product_category')->join('institute_tbl as i', 'i.id = t.published_by')->join('product_variation_images as p','t.product = p.product_id')->where('p.fstatus',1)->limit(8)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array(); 
    }



  }

  public function getMinPrice($id){
    $query = $this->db->select('min(sale_price) as sp')->from('variation_details')->where('product_variation_id',$id)->get();
    return $result = $query->row_array();
  }
  public function getMinMaxPrice($id){
    $query = $this->db->select('min(sale_price) as minsp,max(sale_price) as maxsp,min(regular_price) as minrp,max(regular_price) as maxrp')->from('variation_details')->where('product_variation_id',$id)->get();
    return $result = $query->row_array();
  }

  public function getProductVariations($id = null){

    if($id != null){
        $query = $this->db->select('t.*,c.title as pname,c.description as des,p.image as fimage,pa.product_attr as proattribute')->from('product_variation as t')->join('variation_details as v','v.product_variation_id = t.id')->join('product_attribute as pa','pa.id = v.product_attribute_id')->join('product as c', 'c.id = t.product_id')->join('product_variation_images as p','t.id = p.product_id')->where('p.fstatus',1)->where('t.attribute_slug', $id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
    }



  }

  public function getVariationDetail($id = null){
      if($id != null){
        $query = $this->db->select('t.*')->from('variation_details as t')->where('t.product_variation_id', $id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
      }
  }

  public function add_item_to_cart($uid){

      $res = $this->addItemToCart($uid);
      if($res) return $res; else FALSE;
  }

  public function addItemToCart($uid){
      //print_r($_POST);exit;
     extract($_POST);
     if($uid == 1){
      $user_id = time()+rand()+rand();
      
     }else{
      $user_id = $uid;
     }
     $apr = explode('-',$aprice);
     $query = $this->db->insert('add_cart_items', ['variation_details_id' => $apr[3],'user_id' => $user_id,'email' => '','attribute_id' => $attribute_id,'variation_detail_id' => $apr[3],'total_item' => $nitem,'status' => 0,'date' => date('Y-m-d h:i:s') ]);
     $insert_id = $this->db->insert_id();
         return  $user_id.'-'.$insert_id;


  }

  public function getCartDetailById($id){
    $query = $this->db->select('t.*,c.attribute_name as attribute_name,v.weight as weight,v.regular_price as regular_price,v.sale_price as sale_price,p.image as img')->from('add_cart_items as t')->join('product_variation as c', 'c.id = t.attribute_id')->join('variation_details as v', 'v.id = t.variation_detail_id')->join('product_variation_images as p','p.product_id = c.id')->where('t.id',$id)->where('p.fstatus',1)->get();
    return $result = $query->row_array();


  }

  public function update_item_to_cart(){
      extract($_POST);
      $i = 0;
      foreach($add_cart_id as $acid){
        $query = $this->db->set([ 'total_item' => $total_item[$i] ]);
            $this->db->where('id', $acid);
            $this->db->update('add_cart_items');
            $flag = 1;
         $i = $i + 1;
      }

      if($flag == 1){
        if($query) return TRUE; else FALSE;
      }

  }

  public function registerUser(){
    extract($_POST);
    $query = $this->db->insert('register_user', ['name' => $name,'mobile' => $mobile,'email' => $email,'password' => $passwd,'type' => 1,'date' => date('Y-m-d h:i:s') ]);
    if($query) return TRUE; else FALSE;
  }
  
  public function getRegisterUser($email){
      $query = $this->db->get_where('register_user', ['email' => $email]);
      if($query) return $query->row_array(); else FALSE;
  }
  public function getRegisterUserByMobile($mobile){
      $query = $this->db->get_where('register_user', ['mobile' => $mobile]);
      if($query) return $query->row_array(); else FALSE;
  }

  public function verifyUserName($usernm){
    //print_r($_POST);exit;
    
    $query = $this->db->where('mobile',$usernm)->or_where('email',$usernm)->get('register_user');
    return $result = $query->row_array();
  }
  
  public function verifyUserPassword($id,$passwd){
      $query = $this->db->where('id',$id)->where('password',$passwd)->get('register_user');
      return $result = $query->row_array();
      
  }
  
  public function facebookLogin($id,$name,$email,$type,$iurl){
      $query = $this->db->insert('social_user', ['social_id' => $id,'name' => $name,'email' => $email,'image_url' => $iurl,'type' => $type,'date' => date('Y-m-d h:i:s') ]);
      if($query) return TRUE; else FALSE;
      
  }
  
  public function getSocialLogin($id){
      $query = $this->db->get_where('social_user',['social_id' => $id]);
      if($query) return $result = $query->row_array(); else FALSE;
      
  }
  
  public function AddReview(){
      extract($_POST);
      $query = $this->db->insert('user_review', ['variation_id' => $attr_id, 'name' => $rname, 'email' => $remail,'rating' => $rating, 'title' => $title_review, 'review' => $review, 'status' => 0, 'date' => date('Y-m-d h:i:s')]);
      if($query) return TRUE; else FALSE;
      
  }
  
  public function getApprovedUserReviews($id){
      $query = $this->db->get_where('user_review', ['variation_id' => $id, 'status' => 1]);
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  
  public function delete_item_from_cart($id){
      //print_r($id);exit;
      $query = $this->db->where('id',$id)->delete('add_cart_items');
       if($query) return TRUE; else FALSE;
  }
  
  public function add_user_address(){
      extract($_POST);
      $query = $this->db->insert('user_address', ['userid' => $userid, 'email' => $email, 'address' => $address,'district' => $district, 'zipcode' => $pin, 'country' => 'India', 'status' => 0, 'date' => date('Y-m-d h:i:s')]);
      if($query) return $this->db->insert_id(); else FALSE;
      
  }
  
  public function add_user_payment($addressid){
      extract($_POST);
      $query = $this->db->insert('user_payment', ['timeslot' => $timeslot,'delivery_date' => $delivery_date,'coupon_id' => $coupon_code,'user_type' => $this->session->userdata('login_type'),'user_id' => $userid, 'address_id' => $addressid, 'sub_total_cost' => $sub_total,'shipping_cost' => $shipping, 'total_cost' => $total, 'payment_option' => $optradio, 'transaction_id' => '', 'status' => 0, 'date' => date('Y-m-d h:i:s')]);
      if($query) return $this->db->insert_id(); else FALSE;
  }
  
  public function update_email_add_cart($cpid,$email,$userpayid){
         //print_r($userpayid);exit;
         $flag = 0;
         foreach($cpid as $cpi){
                $query = $this->db->set([ 'email' => $email, 'pay_id' => $userpayid ]);
                    $this->db->where('id', $cpi);
                    $this->db->update('add_cart_items');
                    $flag = 1;
            }
            
        if($flag == 1){
            if($query) return TRUE; else FALSE;
        }
        
  }
  
  public function update_payment_status($cart_item){
      $citem = explode(',',$cart_item);
      foreach($citem as $citems){
          $query = $this->db->set([ 'status' => 1 ]);
                    $this->db->where('id', $citems);
                    $this->db->update('add_cart_items');
                    $flag = 1;
          
      }
      if($flag == 1){
            if($query) return TRUE; else FALSE;
        }
      
      
  }
  
  public function update_user_payment($payment_id,$payu_id){
      $order_status = 1;
      $status = 1;
      if($payu_id == 'COD'){
          $order_status = 0;
          $status = 0;
      }
      $query = $this->db->set([ 'status' => $status, 'transaction_id' => $payu_id, 'order_status' => $order_status ]);
                    $this->db->where('id', $payment_id);
                    $this->db->update('user_payment');
                    if($query) return TRUE; else FALSE;
      
  }
  
  public function failedUserPayment(){
      
      $query = $this->db->set([ 'order_status' =>  5]);
        $this->db->where('id', $this->session->userdata('user_payment_id'));
        $this->db->update('user_payment');
        if($query) return TRUE; else FALSE;
  }
  
  public function check_user_order($payment_id){
      
      $query = $this->db->get_where('user_order', ['payment_id' => $payment_id]);
      
      if($query) return $result = $query->row_array(); else FALSE;
  }
  
  public function add_user_order($payment_id){
      
      $query = $this->db->insert('user_order', ['payment_id' => $payment_id, 'status' => 0,'date' => date('Y-m-d h:i:s')]);
      if($query) return TRUE; else FALSE;
  }
  
  public function addProductToWishlist($product_variation_id,$user_id){
      
      $query = $this->db->insert('wishlist_product', ['userid' => $user_id, 'product_variation_id' => $product_variation_id,'date' => date('Y-m-d h:i:s')]);
      if($query) return TRUE; else FALSE;
      
  }
  
   public function removeProductToWishlist($product_variation_id,$user_id){
      $query = $this->db->where(['userid' => $user_id, 'product_variation_id' => $product_variation_id])->delete('wishlist_product');
      //print_r($this->db->last_query());exit;
       if($query) return TRUE; else FALSE;
      
      
   }
   
   public function getProductImages($productid){
       $query = $this->db->select('product_variation_images.image')->from('product_variation_images')->where(['product_id' => $productid, 'fstatus' => 0])->limit(3)->get();
       //$query = $this->db->get_where('product_images',['product_id' => $productid, 'fstatus' => 0]);
       //print_r($this->db->last_query());exit;
       return $query->result_array();
   }
   
   public function getWishlistStatus($productid,$userid){
       $query = $this->db->where(['product_variation_id' => $productid,'userid' => $userid])->get('wishlist_product');
       if($query) return $result = $query->row_array(); else FALSE;
       
   }
   
   public function getTestimonial(){
       $query = $this->db->limit(3)->get('testimonial');
       if($query) return $query->result_array(); else FALSE;
   }
   public function getShippingCost($pin){
       
       $query = $this->db->where(['pincode' => $pin])->get('area_pincode');
       //print_r($this->db->last_query());exit;
       if($query) return $query->row_array(); else FALSE;
       
   }
   public function getWishlistProduct(){
       //$query = $this->db->get_where('wishlist_product', ['userid' => $this->session->userdata('login_id')]);
       $query = $this->db->select('t.*,c.attribute_name as attributename,p.image')->from('wishlist_product as t')->join('product_variation as c', 'c.id = t.product_variation_id')->join('product_variation_images as p','p.product_id = c.id')->where(['t.userid' => $this->session->userdata('login_id'), 'p.fstatus' => 1 ])->get();
       //print_r($this->db->last_query());exit;
       if($query) return $query->result_array(); else FALSE;
   }
   public function getUserAddress(){
       $query = $this->db->get_where('user_address', ['userid' => $this->session->userdata('login_id')]);
       //print_r($this->db->last_query());exit;
       if($query) return $query->result_array(); else FALSE;
       
   }
   
   public function get_user_address($address,$district,$pin){
       
       $query = $this->db->get_where('user_address', ['address' => $address,'district' => $district,'zipcode' => $pin,'userid' => $this->session->userdata('login_id')]);
       //print_r($this->db->last_query());exit;
       if($query) return $query->row_array(); else FALSE;
   }
   
   public function update_user_mobile($mob){
       if($this->session->userdata('login_type') == 1){
           $query = $this->db->set([ 'mobile' => $mob ]);
                    $this->db->where('id', $this->session->userdata('login_id'));
                    $this->db->update('register_user');
           
       }else{
           $query = $this->db->set([ 'mobile' => $mob ]);
                    $this->db->where('social_id', $this->session->userdata('login_id'));
                    $this->db->update('social_user');
       }
       if($query) return TRUE; else FALSE;
   }
   public function getVariationDetailsIdByCartItem($cartitem){
       
       $query = $this->db->get_where('add_cart_items', ['id' => $cartitem]);
       if($query) return $query->row_array(); else FALSE;
   }
   public function getTodayEntryProductInventory($key,$today_date){
        $query = $this->db->get_where('product_inventory',['variation_details_id' => $key, 'edate' => $today_date, 'status' => 1]);
        //print_r($this->db->last_query());exit;
        if($query) return $query->row_array(); else FALSE;
       
   }
   public function getOldProductInventory($key){
       
       $query = $this->db->get_where('product_inventory',['variation_details_id' => $key, 'status' => 1]);
        if($query) return $query->row_array(); else FALSE;
   }
   public function updateOldProductInventory($key){
       $query = $this->db->set([ 'status' => 0 ]);
                    $this->db->where(['variation_details_id' => $key,'status' => 1]);
                    $this->db->update('product_inventory');
       if($query) return TRUE; else FALSE;
       
   }
   public function addProductInventory($get_old_one,$value){
       
       $query = $this->db->insert('product_inventory', [ 'product_id' => $get_old_one['product_id'], 'product_variation_id' => $get_old_one['product_variation_id'],'variation_details_id' => $get_old_one['variation_details_id'], 'available_product' => $get_old_one['total_product']-$get_old_one['sell_product'], 'sell_product' => $value, 'update_product' => 0, 'total_product' => $get_old_one['total_product']-$get_old_one['sell_product'], 'status' => 1,'edate' => date('Y-m-d'), 'date' => date('Y-m-d h:i:s'), 'admin_id' => $get_old_one['admin_id'] ]);
          if($query) return TRUE; else FALSE;
   }
   public function updateTodayEntryProductInventory($entry_by_date,$key,$value){
        $query = $this->db->set([ 'sell_product' => $entry_by_date['sell_product']+$value ]);
            $this->db->where(['variation_details_id' => $key,'status' => 1]);
            $this->db->update('product_inventory');
       if($query) return TRUE; else FALSE;
       
       
   }
   
   
   public function getSatusOfProduct($id){
       
       $query = $this->db->get_where('product_inventory', ['variation_details_id' => $id, 'status' => 1]);
       //print_r($this->db->last_query());exit;
       if($query) return $query->row_array(); else FALSE;
   }
   public function getStockSatusOfProduct($id){
       $query = $this->db->get_where('product_inventory', ['variation_details_id' => $id,'status' => 1]);
       if($query) return $query->row_array(); else FALSE;
       
   }
   public function getInvoiceDetail($id){
       $query = $this->db->select('p.*,u.address as uaddress,u.district as udistrict,u.zipcode as uzipcode,o.id as oid')->from('user_payment as p')->join('user_address as u','u.id = p.address_id')->join('user_order as o','o.payment_id = p.id')->where(['p.id' => $id])->get();
       if($query) return $query->row_array(); else FALSE;
   }
   public function getCartItems($payid){
       $query = $this->db->select('c.*,p.attribute_name as attributename,v.weight as attribute_value,v.sale_price as saleprice,v.regular_price as regularprice')->from('add_cart_items as c')->join('product_variation as p','p.id = c.attribute_id')->join('variation_details as v','v.id = c.variation_details_id')->where(['c.pay_id'=>$payid])->get();
       //print_r($this->db->last_query());exit;
       if($query) return $query->result_array(); else FALSE;
       
   }
   public function getUserDetails($user_id,$user_type){
       if($user_type == 1){
         $query = $this->db->get_where('register_user',['id' => $user_id]);
         if($query) return $query->row_array(); else FALSE;
       }else{
           $query = $this->db->get_where('social_user',['social_id' => $user_id]);
           if($query) return $query->row_array(); else FALSE;
       }
       
       
   }
   public function addContactUs(){
       extract($_POST);
       $query = $this->db->insert('contact_enquiry', [ 'name' => $cname,'mobile' => $cmobile,'email' => $cemail,'message' => $cmessage, 'date' => date('Y-m-d h:i:s') ]);
          if($query) return TRUE; else FALSE;
       
   }
   public function addCodOtp($otp){
       $query = $this->db->insert('cod_otp', [ 'user_id' => $this->session->userdata('login_id'),'pay_id' => $this->session->userdata('user_payment_id'),'otp_no' => $otp,'date' => date('Y-m-d h:i:s') ]);
          if($query) return TRUE; else FALSE;
   }
   
   public function verifyCodOtp(){
       extract($_POST);
       $query = $this->db->get_where('cod_otp', ['user_id' => $this->session->userdata('login_id'),'pay_id' => $this->session->userdata('user_payment_id'),'otp_no' => $otp]);
       //print_r($this->db->last_query());exit;
       if($query) return $query->row_array(); else FALSE;
   }
   public function getAllOrderByUser(){
       
       $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->where('t.user_id',$this->session->userdata('login_id'))->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
   }
   public function getAllCoupans(){
       $query = $this->db->get_where('coupon_code',[ 'status' => 1]);
       if($query) return $result = $query->result_array(); else FALSE;
   }
   public function getProductSalePrice(){
        $query = $this->db->select('id,sale_price')->get_where('variation_details',['sale_price !=' => 0]);
        if($query) return $result = $query->result_array(); else FALSE;
    }
    public function getProductRegularPrice(){
        $query = $this->db->select('id,regular_price')->get_where('variation_details',['sale_price' => 0.00]);
                if($query) return $result = $query->result_array(); else FALSE;
    }
    public function update_status_register_user($email){
        $query = $this->db->set(['status' => 1])->where(['email' => $email])->update('register_user');
        if($query) return TRUE; else FALSE;
    }
    public function updateResetPassword($pwd,$email){
        $query = $this->db->set(['password' => $pwd])->where('email',$email)->update('register_user');
        if($query) return TRUE; else FALSE;
    }
    public function getBlogs($slug = null){
       if($slug != null){
           $query = $this->db->get_where('blog',['slug' => $slug]);
       if($query) return $query->row_array(); else FALSE;
       }else{
           $query = $this->db->get('blog');
       if($query) return $query->result_array(); else FALSE;
       }
       
   }

}