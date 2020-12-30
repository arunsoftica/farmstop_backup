<?php

class User extends CI_Controller{

public function __construct(){
  parent::__construct();
  $this->load->model('Loginmodel');
  $this->load->model('Adminmodel');
  $this->load->library('email');
     
  
}

public function index(){
  if($this->session->userdata('uid')){
      $result = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      if($result != False){
         if($result['type'] == 1)
         {
            return redirect('superadmin/dashboard');
         }
         else if($result['type'] == 2)
         {
            return redirect('dashboard');
         }
         else if($result['type'] == 3)
         {
            return redirect('teacher/dashboard');
         }

      }

    }
   $this->form_validation->set_rules('username', 'Username', 'required');
   if( $this->form_validation->run() == true){
   	  $result = $this->Loginmodel->sign_in();
   	  if($result != False){
   	     if(password_verify($this->input->post('password'), $result['password']) ){

          
          

   	     	
          
          if($result['type'] == 2){
            $inst_tbl = $this->Loginmodel->getInstitute($result['inst_tbl_id']);
            if($inst_tbl['status'] == 1){
              $this->session->set_userdata('uid' , $result['id']);
              return redirect('dashboard');
            }else{
              $this->session->set_flashdata('login_failed','Contact your administrator to activate your account');
            }
   	     		
   	     	}
          else if($result['type'] == 1){
            $this->session->set_userdata('uid' , $result['id']);
            return redirect('superadmin/dashboard');
          }
          else if($result['type'] == 3){
            
            $inst_tch = $this->Adminmodel->getTeachersBySubjects($result['inst_tbl_id']);
            //print_r($inst_tch);exit;
            if($inst_tch[0]['status'] == 1){
              $this->session->set_userdata('uid' , $result['id']);
              return redirect('teacher/dashboard');
            }else{
              $this->session->set_flashdata('login_failed','Contact your administrator to activate your account');
            }
            
            
          }
   	     	else{
   	     		$this->session->set_flashdata('login_failed','Invalid Type');
   	     	
          }
   	   }
   	     else{

   	     	    $this->session->set_flashdata('login_failed','Invalid Password');
   	     	}

   	  }
   	  else{
   	  	$this->session->set_flashdata('login_failed','Invalid Username');
   	  }   	  
   }
   $this->load->view('public/adminlogin');
}

public function page($page = NULL){

   $data['title'] = $page;
   $data['model2'] = $this->Adminmodel;
   $data['model3'] = $this->Loginmodel;	
   if(! $this->session->uid){ return redirect('/'); }
   $data['user_data'] = $this->Adminmodel->getDetails($this->session->uid);
   
   $result = $this->Adminmodel->getDetails($this->session->uid);
   if($result['type'] != 2){   
     return redirect('logout');
   }
   /*if($this->session->userdata('ustatus') != 2){
   
     return redirect('logout');
   }*/
   
   if($page == 'student'){
      $data['timeslot'] = $this->Adminmodel->getTimeSlot();
      //echo '<pre>';
      //print_r($data['timeslot']);exit;
      $data['classlist'] = $this->Adminmodel->getclass();
   	  //$response =  $this->add_student();

   }
   else if($page == 'update_student'){
    if(isset($_GET['updstu']) && !isset($_GET['i'])){
          $data['student'] = $this->Adminmodel->getStudent($_GET['updstu']);
        }
    if(isset($_GET['updstu']) && isset($_GET['i'])){
          $data['student'] = $this->Adminmodel->getStudents($_GET['updstu']);
        }    
        $data['classlist'] = $this->Adminmodel->getclass();
        $data['timeslot'] = $this->Adminmodel->getTimeSlot();
        $data['model1'] = $this->Adminmodel;
        //echo '<pre>';
        //print_r($data['student']);exit;
   }
   else if($page == 'update_teacher'){
    if(isset($_GET['updtea']) && !isset($_GET['i'])){
          $data['teacher'] = $this->Adminmodel->getTeachersBySubjects($_GET['updtea']);
        }
        if(isset($_GET['updtea']) && isset($_GET['i'])){
          $data['teacher'] = $this->Adminmodel->getImportTeachers($_GET['updtea']);
        }
        $data['subjectlist'] = $this->Adminmodel->getsubject();
        $data['classlist'] = $this->Adminmodel->getclass();
        $data['model1'] = $this->Adminmodel;
        //echo '<pre>';
        //print_r($data['teacher']);exit;
   }
   else if($page == 'time_slot'){
        if(isset($_GET['deltsid'])){
          $response = $this->delete_time_slot();
        }
        $data['timeslot'] = $this->Adminmodel->getTimeSlot();
        //echo '<pre>';
        //print_r($data['timeslot']);exit;
   }
   else if($page == 'update_time_slot'){
        if(isset($_GET['updtsid'])){
          $data['timeslot'] = $this->Adminmodel->getTimeSlot($_GET['updtsid']);
        }
        //echo '<pre>';
        //print_r($data['timeslot']);exit;
        
   }
   else if($page == 'view_class'){
        if(isset($_GET['delcid'])){
          $response = $this->delete_class();
        }
        $data['classlist'] = $this->Adminmodel->getclass();
        $response =  $this->add_class();
   }
   else if($page == 'update_class'){
        if(isset($_GET['updcid'])){
          $data['getclass'] = $this->Adminmodel->getclass($_GET['updcid']);
        }
        //echo '<pre>';
        //print_r($data['getclass']);exit;
        $response =  $this->update_class();
   }
   else if($page == 'subject'){
        if(isset($_GET['delsub'])){
          $response = $this->delete_subject();
        }
        $data['classlist'] = $this->Adminmodel->getclass();
        $response =  $this->add_subject();      
   }
   else if($page == 'update_subject'){
        if(isset($_GET['updsub'])){
          $data['getsubject'] = $this->Adminmodel->getsubject($_GET['updsub']);
        }
        //echo '<pre>';
        //print_r($data['getsubject']);exit;
        $response =  $this->update_subject();      
   }
   else if($page == 'subjects'){

        $response =  $this->add_subjects();      
   }
   else if($page == 'teacher'){
    $data['subjectlist'] = $this->Adminmodel->getsubject();
       // print_r($data);exit;
    $data['classlist'] = $this->Adminmodel->getclass();
   }
   else if($page == 'change_teacher'){
    $data['student'] = $this->Adminmodel->getStudent();
   }
   else if($page == 'view_teacher'){
    if(isset($_GET['deltea'])){
          $response = $this->delete_teacher();
        }
    $data['teachers'] = $this->Adminmodel->getTeachers();
    $data['model1'] = $this->Adminmodel;
    //echo "<pre>";
    //print_r($data['teachers']);exit;
    
   }
   else if($page == 'teacher_update'){
    if(isset($_GET['delteay'])){
          $response = $this->delete_teacher_import();
        }
    $data['teachers'] = $this->Adminmodel->getTeachersToUpdate();
    $data['model1'] = $this->Adminmodel;
    //echo "<pre>";
    //print_r($data['teachers']);exit;
    
   }
   else if($page == 'teacher_salary'){
    $data['teachers'] = $this->Adminmodel->getTeachers();
    //echo "<pre>";
    //print_r($data['teachers']);exit;
    
   }
   
   else if($page == 'view_student'){
    if(isset($_GET['delstu'])){
          $response = $this->delete_student();
        }
    $data['students'] = $this->Adminmodel->getStudent();
    //echo "<pre>";
    //print_r($data['students']);exit;
    $data['model1'] = $this->Adminmodel;
    
    
   }
   else if($page == 'student_update'){
    if(isset($_GET['delstu'])){
          $response = $this->delete_student();
        }
        if(isset($_GET['delstuy'])){
          $response = $this->delete_student_import();
        }
    $data['students'] = $this->Adminmodel->getStudentToUpdate();
    //echo "<pre>";
    //print_r($data['students']);exit;
    $data['model1'] = $this->Adminmodel;
    
    
   }
   else if($page == 'teacher_profile'){
    //print_r($this->uri->segment(1));
    if(isset($_GET['id'])){
        $getid = $_GET['id'];
        $data['teacher'] = $this->Adminmodel->getTeachersBySubjects($getid);
        $data['model1'] = $this->Adminmodel;
        //echo '<pre>';
        //print_r($data);exit;
    }
    
   }
   else if($page == 'student_profile'){
    //print_r($this->uri->segment(1));
    if(isset($_GET['id'])){
        $getid = $_GET['id'];
        $data['student'] = $this->Adminmodel->getstudent($getid);
        $data['model1'] = $this->Adminmodel;
        //echo '<pre>';
        //print_r($data);exit;
        
    }
    
   }
   else if($page == 'search_teacher'){
    $data['student'] = $this->Adminmodel->getStudent();
    
   }
   else if($page == 'allocate_student'){
    //$data['student'] = $this->Adminmodel->getStudent();
    $studs = $this->Adminmodel->getStudentNotAllocated();
    
    $stu = array();
    foreach($studs as $stud){
        $stu[] = $stud['student_id'];
    }
    //print_r($stu);exit;
    $students = implode(',',$stu); //4,5
    if(!empty($stu)){
      $data['student'] = $this->Adminmodel->getStudentForAllocation($stu);
    }else{

      $data['student'] = $this->Adminmodel->getStudent();
    }
    
    //echo '<pre>';
    //print_r($studss);exit;
    
   }
   else if($page == 'allocate_teacher'){
    $data['classlist'] = $this->Adminmodel->getclass();
    $data['timeslot'] = $this->Adminmodel->getTimeSlot();
   }
   else if($page == 'teacher_salary_report'){
    $data['teachers'] = $this->Adminmodel->getTeachers();
   }
   else if($page == 'student_fees_report'){
    $data['classlist'] = $this->Adminmodel->getclass();
    //$data['student'] = $this->Adminmodel->getStudent();
   }
   else if($page == 'student_fee_receipt'){
    $data['classlist'] = $this->Adminmodel->getclass();
    //$data['student'] = $this->Adminmodel->getStudent();
   }
   else if($page == 'submit_student_fees'){
    $data['classlist'] = $this->Adminmodel->getclass();
   }
   else if($page == 'inactive_teacher'){
    if(isset($_GET['intea'])){
          $response = $this->active_teacher();
        }
    $data['teachers'] = $this->Adminmodel->getInactiveTeachers();
    $data['model1'] = $this->Adminmodel;
   }
   else if($page == 'inactive_student'){
    
    if(isset($_GET['instu'])){
          $response = $this->active_student();
        }
    $data['students'] = $this->Adminmodel->getInactiveStudent();
    //echo "<pre>";
    //print_r($data['students']);exit;
    $data['model1'] = $this->Adminmodel;   
   }
   else if($page == 'print_receipt'){
     if(isset($_GET['pid'])){
      $data['fees']  = $this->Adminmodel->print_receipt($_GET['pid']);
      echo '<pre>';
      print_r($data['fees']);exit;
     }
     if(isset($_GET['s']) && isset($_GET['c']) && isset($_GET['y'])){
      $data['fees']  = $this->Adminmodel->print_all_receipt($_GET['s'],$_GET['c'],$_GET['y']);
      echo '<pre>';
      print_r($data['fees']);exit;
     }
   }
   /* Teabox Project */
   else if($page == 'moderator'){

   }
   else if($page == 'blogger'){

   }
   else if($page == 'operation_manager'){

   }
   else if($page == 'view_moderator'){
       if(isset($_GET['delmod'])){
          $response = $this->delete_moderator();
        }
    $data['moderator'] = $this->Adminmodel->getModerator();
    if($data['moderator']){
        $data['created_by'] = $this->Adminmodel->getCreatedBy($data['moderator'][0]['s_id']);
    }
    
    //print_r($data['created_by']['email']);exit;
   }else if($page == 'update_moderator'){
       if(isset($_GET['upmod'])){
           $data['moderator'] = $this->Adminmodel->getModerator($_GET['upmod']);
           
       }
       
   }else if($page == 'update_blogger'){
       if(isset($_GET['upblg'])){
           $data['moderator'] = $this->Adminmodel->getBlogger($_GET['upblg']);
           
       }
       
   }else if($page == 'update_operation_manager'){
       if(isset($_GET['upopm'])){
           $data['moderator'] = $this->Adminmodel->getOperationManager($_GET['upopm']);
           
       }
       
   }
   else if($page == 'view_blogger'){
       if(isset($_GET['delblg'])){
          $response = $this->delete_blogger();
        }
    $data['blogger'] = $this->Adminmodel->getBlogger();
        if($data['blogger']){
          $data['created_by'] = $this->Adminmodel->getCreatedBy($data['blogger'][0]['s_id']);  
        }
    
   }
   else if($page == 'view_operation_manager'){
       if(isset($_GET['delopm'])){
          $response = $this->delete_operation_manager();
        }
    $data['manager'] = $this->Adminmodel->getOperationManager();
        if($data['manager']){
            $data['created_by'] = $this->Adminmodel->getCreatedBy($data['manager'][0]['s_id']);
        }
    
   }
   else if($page == 'product_variation'){
    $data['products'] = $this->Adminmodel->getProducts();
    $data['attributes'] = $this->Adminmodel->getProductAttribute();
   }
   else if($page == 'update_product_variation'){
    $data['products'] = $this->Adminmodel->getProducts();

    if(isset($_GET['vid'])){
      $data['variation'] = $this->Adminmodel->getProductVariation($_GET['vid']);
      
      $data['exdetails'] = $this->Adminmodel->get_attribute_value($_GET['vid']);
      $data['images'] = $this->Adminmodel->getProductVariationImages($_GET['vid']);
      //print_r($data['exdetails']);exit;

    }
   }
   else if($page == 'add_featured_product'){
    $data['products'] = $this->Adminmodel->getProducts();

   }
   else if($page == 'view_featured_product'){
       if(isset($_GET['delfpro'])){
          $response = $this->delete_featured_product();
        }
    $data['fproduct'] = $this->Adminmodel->getFeaturedProducts();

   }
   else if($page == 'product_inventory'){
    $data['products'] = $this->Adminmodel->getProducts();
    $data['attributes'] = $this->Adminmodel->getProductAttribute();
   }
   else if($page == 'product_inventory_report'){
    $data['products'] = $this->Adminmodel->getProducts();
    $data['attributes'] = $this->Adminmodel->getProductAttribute();
    $data['productReport'] =  $this->inventory_report_by_product();
    
   }
   else if($page == 'view_product'){
       if(isset($_GET['delprocat'])){
           $response = $this->deleteProductCategory();
       }
    $data['products'] = $this->Adminmodel->getProducts();

   }
   else if($page == 'update_product'){
    
    if(isset($_GET['proid'])){
     $data['products'] = $this->Adminmodel->getProducts($_GET['proid']);
     $data['images'] = $this->Adminmodel->getProductImages($_GET['proid']);
     /*echo '<pre>';
     print_r($data['images']);exit;*/
    }

   }
   else if($page == 'view_product_variation'){
       if(isset($_GET['delvid'])){
           $this->deleteProductVariation();
       }
    $data['variation'] = $this->Adminmodel->getProductVariation();
     //echo '<pre>';
     //print_r($data['variation']);exit;
   }
   else if($page == 'pages_seo_sem'){
    $data['seo'] = $this->Adminmodel->getPagesSeo();
     //echo '<pre>';
     //print_r($data['variation']);exit;
   }else if($page == 'user_review'){
    if(isset($_GET['rwid'])){
       $response = $this->user_review();
    }
    $data['review'] = $this->Adminmodel->getUserReview();
     //echo '<pre>';
     //print_r($data['review']);exit;
   }else if($page == 'update_user_review'){
    if(isset($_GET['ur'])){
     $data['review'] = $this->Adminmodel->getUserReview($_GET['ur']);
    }
    
    
     //echo '<pre>';
     //print_r($data['review']);exit;
   }
   else if($page == 'user_order'){
     //$data['orders'] = $this->Adminmodel->getAllOrder();
     $data['orders'] = $this->Adminmodel->getAllOrder1();
     //echo '<pre>';
     //print_r($data['order']);exit;
    }else if($page == 'view_preorder'){
        /*if(isset($_GET['delpin'])){
            $response = $this->deletePincode();
        }*/
        $data['preorder'] = $this->Adminmodel->getPreorders();
    }else if($page == 'filter_order'){
        $data['variation'] = $this->Adminmodel->getProductVariation();
      
      if(isset($_GET['fdate'])){
          $data['orders'] = $this->Adminmodel->getSearchAllOrder1($_GET['fdate']);
      }else{
          
      }
    }else if($page == 'basket_delivery'){
        $data['borders'] = $this->Adminmodel->getAllBasketOrders();
        //print_r($data['borders']);exit;
      
      if(isset($_GET['fdate'])){
          $data['orders'] = $this->Adminmodel->getSearchAllOrder1($_GET['fdate']);
      }else{
          
      }
    }
    else if($page == 'failed_transaction'){
    
     $data['orders'] = $this->Adminmodel->getAllOrder2();
     //echo '<pre>';
     //print_r($data['order']);exit;
    }
    else if($page == 'user_invoice'){
     if(isset($_GET['i'])){
         $data['invoice_details'] = $this->Adminmodel->getInvoiceDetail($_GET['i']);
       $data['get_user_details'] = $this->Adminmodel->getUserDetails($data['invoice_details']['user_id'],$data['invoice_details']['user_type']);
       //print_r($data['invoice_details']['user_type']);exit;
       $data['get_cart_items'] = $this->Adminmodel->getCartItems($_GET['i']);
     }
     
    }
    else if($page == 'product_selling_report'){
    
     $data['selling'] = $this->Adminmodel->getSellProduct();
     //echo '<pre>';
     //print_r($data['selling']);exit;
    }
    else if($page == 'view_testimonial'){
        if(isset($_GET['deltestid'])){
            $response = $this->deleteTestimonial();
        }
        $data['testimonials'] = $this->Adminmodel->getTestimonial();
    }else if($page == 'update_testimonial'){
        if(isset($_GET['testid'])){
            $data['testdetail'] = $this->Adminmodel->getTestimonial($_GET['testid']);
            //print_r($data['testdetail']);exit;
        }
    }
    else if($page == 'view_pincode'){
        if(isset($_GET['delpin'])){
            $response = $this->deletePincode();
        }
        $data['pincode'] = $this->Adminmodel->getPincodes();
    }else if($page == 'update_pincode'){
        if(isset($_GET['pinid'])){
            $data['pin'] = $this->Adminmodel->getpincodes($_GET['pinid']);
        }
    }else if($page == 'dashboard'){
        $data['orders'] = $this->Adminmodel->order_management();
        $data['register'] = $this->Adminmodel->customer_management_register();
        $data['social'] = $this->Adminmodel->customer_management_social();
        $data['products'] = $this->Adminmodel->product_management();
        $data['reviews'] = $this->Adminmodel->review_management();
        $data['testimonial'] = $this->Adminmodel->testimonial_management();
        $data['east_order'] = $this->Adminmodel->order_by_location('east');
        /*echo '<pre>';
        print_r($data['east_order']);exit;*/
        $data['west_order'] = $this->Adminmodel->order_by_location('west');
        $data['north_order'] = $this->Adminmodel->order_by_location('north');
        $data['south_order'] = $this->Adminmodel->order_by_location('south');
        $data['order_sales'] = $this->Adminmodel->total_order_sales();
        $data['user_east'] = $this->Adminmodel->users_from_location('east');
        $data['user_west'] = $this->Adminmodel->users_from_location('west');
        $data['user_north'] = $this->Adminmodel->users_from_location('north');
        $data['user_south'] = $this->Adminmodel->users_from_location('south');
        $data['user_all'] = $this->Adminmodel->users_from_all_location();
    }else if($page == 'view_blog'){
        if(isset($_GET['delblog'])){
            $response = $this->deleteBlog();
        }
        $data['blogs'] = $this->Adminmodel->getBlogs();
    }else if($page == 'update_blog'){
        if(isset($_GET['blid'])){
            $data['blogs'] = $this->Adminmodel->getBlogs($_GET['blid']);
        }
        
    }else if($page == 'change_featured_image'){
        if(isset($_GET['chfimg'])){
            $data['fimage'] = $this->Adminmodel->change_featured_image($_GET['chfimg']);
            //print_r($data['fimage']);exit;
        }
        
    }
    else if($page == 'social_user'){
        $data['socialuser'] = $this->Adminmodel->customer_management_social();
    }
    else if($page == 'register_user'){
        $data['socialuser'] = $this->Adminmodel->customer_management_register();
    }else if($page == 'view_zone'){
        if(isset($_GET['delzone'])){
            $response = $this->deleteZone();
        }
        $data['zones'] = $this->Adminmodel->getZones();
    }else if($page == "add_apartment"){
        $data['zones'] = $this->Adminmodel->getZones();
    }else if($page == 'view_apartment'){
        if(isset($_GET['delapm'])){
            $response = $this->deleteApartment();
        }
        $data['apartments'] = $this->Adminmodel->getApartments();
    }else if($page == 'view_import_product_variation'){
       if(isset($_GET['delvid'])){
           $this->deleteProductVariation();
       }
        if(isset($_GET['vpid'])){
            
            $response = $this->change_status_pro_variation();
       }
       
    $data['variation'] = $this->Adminmodel->getProductVariation_import();
    $data['selling'] = $this->Adminmodel->getSellProduct();
     
   }else if($page == 'view_coupon'){
       if(isset($_GET['delcoup'])){
           $response = $this->deleteCoupon();
       }
    $data['coupons'] = $this->Adminmodel->getCoupons();

   }
    
   if($data['title'] != 'print_receipt'){
    $this->load->view('Admin/admin_header' , $data);
    $this->load->view('Admin/admin_sidebar' , $data);
   }

   $this->load->view("Admin/$page" , $data);
   if($data['title'] != 'print_receipt'){
    $this->load->view('Admin/admin_footer' , $data);
   }
}

public function deleteCoupon(){
    $result = $this->Adminmodel->deleteCoupon($_GET['delcoup']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Coupon Deleted Successfully');
        
       return redirect('view_coupon');
    }
 }

public function delete_moderator(){
    $result = $this->Adminmodel->delete_moderator($_GET['delmod']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Moderator Deleted Successfully');
        
       return redirect('view_moderator');
    }
 }
 public function delete_blogger(){
    $result = $this->Adminmodel->delete_moderator($_GET['delblg']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Blogger Deleted Successfully');
        
       return redirect('view_blogger');
    }
 }
 public function delete_operation_manager(){
    $result = $this->Adminmodel->delete_moderator($_GET['delopm']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Operation Manager Deleted Successfully');
        
       return redirect('view_operation_manager');
    }
 }

public function change_status_pro_variation(){
   
  $result = $this->Adminmodel->change_status_pro_variation($_GET['vpid']);
    if($result != FALSE){
      //$this->session->set_flashdata('feedback','Student Deleted Successfully');
        
       return redirect('view_import_product_variation');
    }
}

public function user_review(){
  $result = $this->Adminmodel->statusUserReview($_GET['rwid']);
    if($result != FALSE){
      //$this->session->set_flashdata('feedback','Student Deleted Successfully');
        
       return redirect('user_review');
    }
}

public function inventory_report_by_product(){
    
    $this->form_validation->set_rules('product', 'Product Category', 'required');
    $this->form_validation->set_rules('product_attr', 'Product', 'required');
    if( $this->form_validation->run() == true){
        
        $result = $this->Adminmodel->inventory_report_by_product();
        //echo '<pre>';
        //print_r($result);exit;
        return $result;
    }
}

 public function delete_time_slot(){
    //print_r($_GET['delcid']);exit;
    $result = $this->Adminmodel->delete_time_slot($_GET['deltsid']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Time Slot Deleted Successfully');
        
       return redirect('time_slot');
    }
 }
 public function deleteProductVariation(){
     $result = $this->Adminmodel->deleteProductVariation($_GET['delvid']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Product Variation Deleted Successfully');
        
       return redirect('view_product_variation');
    }
     
 }
 public function deleteTestimonial(){
    $result = $this->Adminmodel->deleteTestimonial($_GET['deltestid']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Testimonial Deleted Successfully');
        
       return redirect('view_testimonial');
    }
 }
 public function deletePincode(){
    $result = $this->Adminmodel->deletePincode($_GET['delpin']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Pincode Deleted Successfully');
        
       return redirect('view_pincode');
    }
 }
 public function deleteZone(){
    $result = $this->Adminmodel->deleteZone($_GET['delzone']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Zone Deleted Successfully');
        
       return redirect('view_zone');
    }
 }
 
 public function deleteApartment(){
    $result = $this->Adminmodel->deleteApartment($_GET['delapm']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Apartment Deleted Successfully');
        
       return redirect('view_apartment');
    }
 }
 
 public function deleteBlog(){
    $result = $this->Adminmodel->deleteBlog($_GET['delblog']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Blog Deleted Successfully');
        
       return redirect('view_blog');
    }
 }
 
 public function delete_featured_product(){
     $result = $this->Adminmodel->delete_featured_product($_GET['delfpro']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Featured Product Deleted Successfully');
        
       return redirect('view_featured_product');
    }
     
 }
 
 public function deleteProductCategory(){
    $result = $this->Adminmodel->deleteProductCategory($_GET['delprocat']);
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Product Category Deleted Successfully');
        
       return redirect('view_product');
    }
 }
 public function add_subject(){
 $this->form_validation->set_rules('class', 'Class', 'trim|required');
 $this->form_validation->set_rules('subject_name', 'Subject', 'trim|required');
 if( $this->form_validation->run() == true){
      $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      //print_r($res);exit();
      if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
         $result = $this->Adminmodel->add_subject($inst_tbl['id']);
          if($result)
          {
            $this->session->set_flashdata('feedback','Subject Added Successfully');
            
            return redirect('subject');
          }
          else
          {
            $this->session->set_flashdata('feedback','Subject Failed to Add, Please Try Again..');
            
            return redirect('subject');
          }

       }
      

    }

 }

 public function add_subjects(){
 
 $this->form_validation->set_rules('subject_name', 'Subject', 'trim|required');
 if( $this->form_validation->run() == true){
      $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      //print_r($res);exit();
      if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
         $result = $this->Adminmodel->add_subjects($inst_tbl['id']);
          if($result)
          {
            $this->session->set_flashdata('feedback','Subject Added Successfully');
            
            return redirect('subjects');
          }
          else
          {
            $this->session->set_flashdata('feedback','Subject Failed to Add, Please Try Again..');
            
            return redirect('subjects');
          }

       }
      

    }

 }

public function search_teacher(){
       $this->form_validation->set_rules('student', 'Student', 'required');
       //$this->form_validation->set_rules('distance', 'Distance', 'required');
       if($this->form_validation->run() == true){
       $result = $this->Adminmodel->searchTeacher();
       if($result != FALSE){
        return $result;
       }
       else{
        return FALSE;
        
       }
       
       }
       

}

public function logout()
{
        $this->session->unset_userdata('uid');
        $this->session->sess_destroy();
        return redirect('/');

}

public function page2($id = null){


echo $this->uri->segment(2);exit;

}

public function export(){
    $thead = array();
    $tr = array();
    //echo 'function is working';exit;
    $data['teachers'] = $this->Adminmodel->getTeachers();
    //print_r($data);exit;
    // file name for download
    $fileName = "Teachers Detail" . date('Ymd') . ".xls";
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    $flag = 0;
    $i = 0;
    foreach($data['teachers'] as $teacher){
           if($flag == 0){
              $thead[] = array_keys($teacher);
              $flag = 1;
              echo implode("\t",$thead[0]). "\n";
           }
           
           $tr[] = array_values($teacher);
           echo implode("\t",$tr[$i]). "\n";
           $i++;
    }
    //print_r(implode('\t',$thead[0]));exit;
    //print_r(implode('\t',$tr));exit;
    //print_r($thead);exit;
    exit;
  }
/*contact form code start*/
    public function contactMsg (){
    
     if($this->input->post('name')){
       if($this->input->post('email')){
         if($this->input->post('mobile')){
          if($this->input->post('message')){
               $msg = '<div style="font-family:HelveticaNeue-Light,Arial,sans-serif;background-color:#eeeeee">
  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
    <tbody>
        <tr>
          <td>
                <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                <tbody>
                  <tr>
                      <td>
                      <table width="690" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                            <tbody>
                              <tr>
                                    <td colspan="3" height="80" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding:0;margin:0;font-size:0;line-height:0">
                                        <table width="690" align="center" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                          <tr>
                                              <td width="30"></td>
                                                <td align="left" valign="middle" style="padding:0;margin:0;font-size:0;line-height:0"></td>
                                                <td width="30"></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                          </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        
                              </td>
                        </tr>
                            
                            <tr bgcolor="#ffffff">
                                <td width="30" bgcolor="#eeeeee"></td>
                                <td>
                                    <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                      <tr>
                                          <td colspan="4" align="center">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td colspan="4" align="center"><h2 style="font-size:24px">User Contact Email</h2></td>
                                        </tr>
                                        <tr>
                                          <td colspan="4">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right" valign="top"><span  style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Name</span></td>
                                            <td width="30"></td>
                                            <td align="left" valign="middle">
                                                <h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">'.$this->input->post("name").'</h3>
                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                    <tr>
                                          <td width="120" align="right" valign="top"><span  style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Mobile</span></td>
                                            <td width="30"></td>
                                            <td align="left" valign="middle">
                                                <h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">'.$this->input->post("mobile")."".$this->input->post('website').'</h3>
                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right" valign="top"><span  style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Email ID</span></td>
                                            <td width="30"></td>
                                            <td align="left" valign="middle">
                                              <h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">'.$this->input->post("email").'</h3>
                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right" valign="top"><span  style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Mobile</span></td>
                                            <td width="30"></td>
                                            <td align="left" valign="middle">
                                              <h3 style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">'.$_POST['mobile'].'</h3>
                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                                
                                              <div style="line-height:10px;padding:0;margin:0">&nbsp;</div>
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                                        <tr>
                                          <td width="120" align="right" valign="top"><span  style="color:#404040;font-size:18px;line-height:24px;font-weight:bold;padding:0;margin:0">Comment </span></td>
                                            <td width="30"></td>
                                            <td align="left" valign="middle">
                                              <div style="color:#404040;font-size:16px;line-height:22px;font-weight:lighter;padding:0;margin:0">'.$_POST['message'].'</div>
                                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                            </td>
                                            <td width="30"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <table width="570" align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                      <tr>
                                          <td>
                                              <h2 style="color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                          <td align="center">
                                                <div style="text-align:center;width:100%;padding:40px 0">
                                                    <table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">
                                                    <tbody>
                                                      <tr>
                                                          <td align="center" style="margin:0;text-align:center"></td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                </div>
                                          </td>
                                      </tr><tr><td>&nbsp;</td>
                                      </tr></tbody></table></td>
                                <td width="30" bgcolor="#eeeeee"></td>
                            </tr>
                            </tbody>
                            </table>
                        <table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
                            <tbody>
                              <tr>
                                  <td>
                                        <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                                        <tbody>
                                          <tr><td colspan="2" height="30"></td></tr>
                                            
                                            <tr><td colspan="2" height="5"></td></tr>
                                           
                                        </tbody>
                                        </table>
                                    </td>
                          </tr>
                            </tbody>
                            </table>
                      </td>
                  </tr>
                </tbody>
                </table>
            </td>
    </tr>
  </tbody>
    </table>
</div>';  
          $config['mailtype'] = 'html';
                     $this->email->initialize($config);
          $this->email->from("arun@sofica.in","Arun");
          $this->email->to("education.season@gmail.com");
          $this->email->subject('Contact Enquiry');
          $this->email->message($msg);
          if( $this->email->send() ){
               
                //$this->email->print_debugger(array('headers'));
                echo '<div class="notice notice-success">
                                 <strong>Success </strong>Message send , We will contact shortly  .</div>.';exit;
                   }
                 else{
                     //echo "<pre>";
                     print_r($this->email->print_debugger(array('headers')));exit;
                    echo '<div class="notice notice-danger">
                                 <strong>Note </strong>Un-expected try again .</div>.';exit; 
                   }     
         }
      else{
          echo '<div class="notice notice-danger">
                         <strong>Note </strong>Message is required .</div>.';exit; 
         }   
         }   
         else{
          echo '<div class="notice notice-danger">
                  <strong>Note </strong>Mobile number is required  .</div>.';exit; 
         }
      }
       else{
          echo '<div class="notice notice-danger">
                         <strong>Note </strong>Email is required .</div>.';exit; 
      }  
    }
     else{
      echo '<div class="notice notice-danger">
                         <strong>Note </strong>Name is required .</div>.';exit;  
    }   
     
  }
  /*Contact form code End*/


}