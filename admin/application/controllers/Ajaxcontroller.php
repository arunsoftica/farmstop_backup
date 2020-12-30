<?php

class Ajaxcontroller extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->model('Loginmodel');
      $this->load->model('Adminmodel');
    }

    /*Teabox Project*/
  public function add_admin(){
    $this->form_validation->set_rules('first_name', 'Fisrt name', 'trim|required|alpha');
  $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]|is_unique[user.mobile]');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
  $this->form_validation->set_rules('password', 'Password', 'required');
  $this->form_validation->set_rules('address', 'Address', 'required');
  $this->form_validation->set_rules('gender', 'Gender', 'required');
      if( $this->form_validation->run() == true){
        $results = $this->Adminmodel->getTotalCount($_POST['admtype']);
        //print_r($results);exit;
        if(($_POST['admtype']==3 && $results<5) || ($_POST['admtype']==4 && $results<10) || ($_POST['admtype']==5 && $results<3)){
           $folname = '';
           if($_POST['admtype'] == 2){
             $folname = 'admin';
           }else if($_POST['admtype'] == 3){
             $folname = 'moderator';
           }else if($_POST['admtype'] == 4){
             $folname = 'blogger';
           }else if($_POST['admtype'] == 5){
             $folname = 'operation_manager';
           }

           $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/'.$folname.'/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              

           }

              $result = $this->Adminmodel->add_admin($image);
              if($result)
              {
                echo 'Admin Added Successfully';
              }
              else
              {
                echo 'Admin Failed to Add, Please Try Again..';
              }
    }
    else{
      if($_POST['admtype']==3){
        echo 'You can add only 5 moderators.';
      }else if($_POST['admtype']==4){
        echo 'You can add only 10 bloggers.';
      }else if($_POST['admtype']==5){
        echo 'You can add only 3 operation manageres.';
      }
    }

    }else{
      echo validation_errors();
    }
  }
  
  public function update_admin(){
    $this->form_validation->set_rules('first_name', 'Fisrt name', 'trim|required|alpha');
  $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
  
  $this->form_validation->set_rules('address', 'Address', 'required');
  $this->form_validation->set_rules('gender', 'Gender', 'required');
      if( $this->form_validation->run() == true){
        $results = $this->Adminmodel->getTotalCount($_POST['admtype']);
        //print_r($results);exit;
        
           $folname = '';
           if($_POST['admtype'] == 2){
             $folname = 'admin';
           }else if($_POST['admtype'] == 3){
             $folname = 'moderator';
           }else if($_POST['admtype'] == 4){
             $folname = 'blogger';
           }else if($_POST['admtype'] == 5){
             $folname = 'operation_manager';
           }

           $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/'.$folname.'/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              

           }else{

              $image = $_POST['image1'];

           }

              $result = $this->Adminmodel->update_admin($image);
              if($result)
              {
                echo 'Admin Updated Successfully';
              }
              else
              {
                echo 'Admin Failed to Update, Please Try Again..';
              }
    

    }else{
      echo validation_errors();
    }
  }

  public function add_product(){
    //print_r($_FILES['image']['name']);exit;
    
    $url=preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['pro_title']);
	$_POST['pro_slug'] = $url;	
    //print_r($url);exit;
    if(isset($_POST['pro_id'])){
      
       $result = $this->Adminmodel->updateProduct();
       if($result != FALSE){
      echo 'Product Updated Successfully..';
      }
    }else{
       $result = $this->Adminmodel->add_product();
       if($result != FALSE){
      echo 'Product Added Successfully..';
       }
    }
    
    
  }
  public function add_blog(){
    $url=preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['pro_title']);
	$_POST['slug'] = $url;
    
    if(isset($_POST['blogid'])){
      
       $result = $this->Adminmodel->update_blog();
       if($result != FALSE){
      echo 'Blog Updated Successfully..';
      }
    }else{
       $result = $this->Adminmodel->add_blog();
       //print_r($result);exit;
       if($result == 1){
         echo 'Blog Added Successfully..';
       }else if($result == 'invalid'){
         echo 'Invalid image format. Only jpg,jpeg and png files are allowed';  
       }
    }
    
    
  }
  
  public function send_push_notification(){
       extract($_POST);
       $result = $this->Adminmodel->send_push_notification();
       //print_r($result);exit;
       if($result == 1){
           
         echo 'Notification send Successfully..';
       }else if($result == 'invalid'){
         echo 'Invalid image format. Only jpg,jpeg and png files are allowed';  
       }
    
    
    
  }

  public function add_product_variation(){
      //print_r($_POST);exit;
      $url=preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attr_name']);
     $_POST['attr_slug']=$url;
    if(isset($_POST['variation_id'])){
      $result = $this->Adminmodel->update_product_variation();
      if($result != FALSE){
        echo 'Product Variation Updated Successfully..';
      }
    }else{
      $result = $this->Adminmodel->add_product_variation();
    if($result != FALSE){
      echo 'Product Variation Added Successfully..';
    }

    }

  }

  public function get_product_attribute(){

    $proid = $this->input->get('proid');
    $result = $this->Adminmodel->get_product_attribute($proid);
    echo '<option value="">Select</option>';
    foreach($result as $res){

      echo '<option value="'.$res['id'].'">'.$res['attribute_name'].'</option>';
    }

  }
  public function get_available_product(){
     $attrid = $this->input->get('variation_detail_id');
     //print_r($attrid);exit;
     $result = $this->Adminmodel->check_product_inventory($attrid);
     echo $result;
  }
  public function add_product_inventory(){
    //print_r($_POST);exit;
    $rec = $this->Adminmodel->checkProductInventory($_POST['pro_attr_val']);
    if($rec != FALSE){
      //now insert and update
      $result = $this->Adminmodel->addProductInventory();
      //print_r($result);exit;
      if($result != FALSE){
        echo 'Product Inventory Updated Successfully..';
      }
    }else{
      $result = $this->Adminmodel->add_product_inventory();
      if($result != FALSE){
        echo 'Product Inventory Updated Successfully..';
      }
    }
    
  }

  public function deleteProductImage(){
    $imgid = $this->input->get('imgid');
    $result = $this->Adminmodel->deleteProductImage($imgid);
    if($result != FALSE){
     echo 'Image deleted successfully..';
    }

  }
  public function deleteProductVariationImage(){
    $imgid = $this->input->get('imgid');
    $result = $this->Adminmodel->deleteProductVariationImage($imgid);
    if($result != FALSE){
     echo 'Image deleted successfully..';
    }

  }

  public function add_pages_seo(){
    $result = $this->Adminmodel->add_pages_seo();
    if($result != FALSE){
     echo 'Pages seo updated successfully..';
    }
  }

  public function update_review(){
  
    $result = $this->Adminmodel->update_review();
    if($result != FALSE){
     echo 'Review updated successfully..';
    }
  }

  public function add_featured_product(){
     extract($_POST); 
    $record = $this->Adminmodel->getFeaturedProducts($protypes);
    //echo '<pre>';
    //print_r(count($record));exit;
    if(count($record) < 8){
    $result = $this->Adminmodel->add_featured_product();
        if($result != FALSE){
         echo 'Featured Product Added successfully..';
        }
    }else{
     echo 'You can add only 8 featured products';   
    }

  }

  public function add_testimonial(){
   
    if(!empty($_POST['rating'])){
      $image = "";
       if($_FILES['image']['name']){
          $image = $_FILES['image']['name'];
          $imageArr = explode('.',$image);
          $ext = end($imageArr);
          $image = md5(time()).'.'.$ext;
          $postImageconfig = array();
          $this->load->library('image_lib');
          $postImageconfig['upload_path'] = './uploads/testimonial/';
          $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
          $postImageconfig['file_name'] = $image;
          $this->load->library('upload',$postImageconfig);
          $this->upload->do_upload('image');
          //print_r($image);exit;
          

       }else if(isset($_POST['testimonial_id'])){
           $image = $_POST['image1'];
       }
       if(isset($_POST['testimonial_id'])){
           $result = $this->Adminmodel->update_testimonial($image);
           if($result != FALSE){
               echo 'Testimonial Updated successfully..';
              }
       }else{
           $result = $this->Adminmodel->add_testimonial($image);
          if($result != FALSE){
           echo 'Testimonial Added successfully..';
          }
       }
    
      
    }else{
      echo 'Please Select Reting*';
    }
    
  }

  public function add_pincode(){
      if(isset($_POST['pincode_id'])){
          $result = $this->Adminmodel->update_pincode();
      if($result != FALSE){
       echo 'Pincode Update successfully..';
      }
      }else{
          $result = $this->Adminmodel->add_pincode();
      if($result != FALSE){
       echo 'Pincode Added successfully..';
      }
      }
     

  }
  public function getProductAttribute(){
     $result = $this->Adminmodel->getProductAttribute();
      if($result != FALSE){
       echo json_encode(array("product_attribute"=>$result));
      }

  }

  public function get_attribute_value(){
    $attrid = $this->input->get('attrid');
    $result = $this->Adminmodel->get_attribute_value($attrid);
    if($result != FALSE){
      echo json_encode(array("attribute_value"=>$result));
    }
  }
  public function updateOrderStatus(){
      $status_val = $this->input->get('status_val');
      $stat = explode(',',$status_val);
      /* order status change email*/
      if($stat[0] != 0 || $stat[0] != 1){
      $msg = '';
      $to   = $stat[2];
        $subject = "FARMSTOP order status changed email";
        $from = 'sales@farmstop.in';
        $message ="<html><body>";
        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10" bgcolor="#DDDDDD">';
        
        $message .= "<tr><td colspan=2>Hello ".$stat[3]."<br/>";
        if($stat[0] == 2){
            $msg = "Your order status is on hold for order no. ".$stat[4];
        }else if($stat[0] == 3){
            $msg = "Your order status is dispatched for order no. ".$stat[4];
        }else if($stat[0] == 4){
            $msg = "Your order status is completed for order no. ".$stat[4];
            $mesg = "Your Farmstop order no. $stat[4] has been delivered on time.Note: If your order has been dropped off at the security desk, Request you to kindly collect them and store them appropriately.Thanks for choosing to go Organic.www.farmstop.in";
            $username="STfrmstop";
                $password = "Farm123";
                $type ="TEXT";
                $sender="FRMSTP";
                $mobile=$stat[7];
                $message = urlencode("$mesg");
                $baseurl ="http://cdn.softica.in/sendsms/sendsms.php";
                $url ="$baseurl?username=$username&password=$password&type=$type&sender=$sender&mobile=$mobile&message=$message";
                $return = file($url);
                
                $send = explode('|',$return[0]);
        }else if($stat[0] == 5){
            $msg = "Your order status is cancelled for order no. ".$stat[4];
        }else if($stat[0] == 6){
            $msg = "Your order status is refunded for order no. ".$stat[4];
        }else if($stat[0] == 7){
            $msg = "Your order status is failed for order no. ".$stat[4];
        }
        $message .= "<b>".$msg."</b><br/>";
        $message .= "Regards,<br/>
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
       if($stat[0] != 0 && $stat[0] != 1){
           $udet = $this->Adminmodel->getUserName($stat[6],$stat[5]);
           if($udet['deviceToken'] != ''){
             $this->orderUpdatePushNotificationToAppUser($msg,$stat[6],$udet['deviceToken'],$stat[4]);  
           }
           
       }
       
      }
      
      /* order status change email*/
      $result = $this->Adminmodel->updateOrderStatus($stat[0],$stat[1]);
      if($result != FALSE){
       echo 'Order Status Updated Successfully';
      }
  }
  
  private function orderUpdatePushNotificationToAppUser($msg,$userId,$deviceToken,$order_no){
        // $msg = "Flat 20% off on Organic vegies.shop now";
        // $type = "order";
        //$userIdAndMobileTokensArr = $this->basic_model->selectAll("register_user",array("os"=>"android","deviceToken !="=>"","status"=>1));
        // $userIdAndMobileTokensArr = $this->basic_model->selectAll("social_user",array("os"=>"android","deviceToken !="=>""));
        
        $android_server_key = "AAAASu6ZOBE:APA91bGuB9p3c0S2jZ2spxN5UVeI9JmstXXBp4Sebyik7zkKX-ZgTf0xDboJx4Ss40serscmQP69WDrOiYZ7EvBpXnCCMaOD-cTTX2f7kQmnMmMfWY75NQEl_2owibMgZcuueTTp7LyP";
        $Pushmessage    = substr($msg , 0, 100) . '.....';
        $type = "order";
        $message = array(
            'title'         => "Farmstop",
            'message'       => $Pushmessage,
            'vibrate'       => 1,
            'sound'         => 1,
            'largeIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'smallIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'type'          =>$type,//'order',
        );

        //$token  = explode(",", $mobiletokens);
        $url = 'https://fcm.googleapis.com/fcm/send';

            $value = trim($deviceToken);
            $ch = curl_init();
            $fields = array(
                'registration_ids' => array($value),
                'data' => $message,
            );
            // echo "<pre>"; print_r($fields);
            // die;

            $headers = array(
                'Authorization:key='.$android_server_key ,
                'Content-Type: application/json'
            );

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            
            $notification = json_decode($result);
            if($notification->failure == 0)
            {
                $this->Adminmodel->insertPushNotification($userId,$msg,$type,$order_no);
                /*$this->basic_model->insert("user_notification", array("user_id"=>$userId,"title"=>"Farmstop Order","message"=>$msg,"type"=>$type,"order_no"=>trim($order_no),"date"=>date('Y-m-d h:i:s')));*/
                return true;
            }else{
                 //echo "Error :".$notification->results[0]->error;
                 return false;
            }
    }
  
  public function checkProductCategorySlug(){
      $slug = $this->input->get('slug');
      $result = $this->Adminmodel->checkProductCategorySlug($slug);
      if($result != FALSE){
          echo 'This product slug already exists';
      }
      
  }
  public function checkProductCategoryTitle(){
      $slug = $this->input->get('slug');
      $result = $this->Adminmodel->checkProductCategoryTitle($slug);
      if($result != FALSE){
          echo 'This product title already exists';
      }
      
  }
  public function checkProductCategoryTitleUpdateTime(){
      $slug = $this->input->get('slug');
      $id = $this->input->get('id');
      $result = $this->Adminmodel->checkProductCategoryTitleUpdateTime($slug,$id);
      if($result != FALSE){
          echo 'This product title already exists';
      }
      
  }
  public function checkProductSlug(){
      $slug = $this->input->get('slug');
      $result = $this->Adminmodel->checkProductSlug($slug);
      if($result != FALSE){
          echo 'This product slug already exists';
      }
      
  }
  public function checkProductName(){
      $slug = $this->input->get('slug');
      $result = $this->Adminmodel->checkProductName($slug);
      if($result != FALSE){
          echo 'This product name already exists';
      }
      
  }
  public function checkProductNameUpdateTime(){
      $slug = $this->input->get('slug');
      $id = $this->input->get('id');
      $result = $this->Adminmodel->checkProductNameUpdateTime($slug,$id);
      if($result != FALSE){
          echo 'This product name already exists';
      }
      
  }
  public function deleteProductVariationDetail(){
      $vid = $this->input->get('vid');
      //print_r($vid);exit;
      $result = $this->Adminmodel->deleteProductVariationDetail($vid);
      if($result != FALSE){
          echo 'Record Deleted Successfully';
      }
  }
  public function change_featured_image(){
      //print_r($_POST);exit;
      $result = $this->Adminmodel->update_featured_image();
      if($result != FALSE){
          echo 'Featured Image Updated Successfully';
      }
      
  }
  public function update_product_price(){
      //print_r($_POST);exit;
      $result = $this->Adminmodel->update_product_price();
      if($result != FALSE){
          echo 'Price Updated Successfully';
      }
      
  }
  
  public function add_apartment(){
     $result = $this->Adminmodel->add_apartment();
      if($result != FALSE){
          echo 'Apartment Added Successfully';
      } 
  }
  
  public function add_zone(){
     $result = $this->Adminmodel->add_zone();
      if($result != FALSE){
          echo 'Zone Added Successfully';
      } 
  }
  
  public function updateBasketDeliveryStatus(){
      $status = $this->input->get('status_val');
      $result = $this->Adminmodel->updateBasketDeliveryStatus($status);
      if($result != FALSE){
          echo 'Status Updated Successfully';
      } 
  }
  
  public function getProductVariations(){
      $v = $this->input->get('pro');
      $result = $this->Adminmodel->getProductVariations($v);
        if($result != FALSE){
            echo '<option value="">Select</option>';
           foreach($result as $res){ ?>
              <option value="<?php echo $res['weight'] ?>"><?php echo $res['weight'] ?></option> 
               
           <?php }
        }
  }
  
  public function variationInventoryStatus(){
      $val = $this->input->get('v');
      $result = $this->Adminmodel->variationInventoryStatus($val);
      if($result != FALSE){
          echo 'Stock Updated Successfully';
      }
      
  }
  
  public function apartment_import(){
      //print_r($_POST);exit;
     //   $this->load->helper(array('text', 'url'));
  $result = $this->Adminmodel->apartment_import();
    if($result != FALSE){
      echo 'Apartment Added Successfully..';
    }else{
        echo'error';
    }
  }
  
   public function add_product_variation_import(){
      //print_r($_POST);exit;
        $this->load->helper(array('text', 'url'));
      $result = $this->Adminmodel->add_product_variation_import();
        if($result != FALSE){
          echo 'Product Variation Added Successfully..';
        }else{
            echo'error';
        }
 }
 public function add_coupon(){
      //print_r($_POST);exit;
     //   $this->load->helper(array('text', 'url'));
  $result = $this->Adminmodel->add_coupon();
    if($result != FALSE){
      echo 'Code Added Successfully..';
    }else{
        echo'error';
    }
  }
}