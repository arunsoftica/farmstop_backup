<?php

class SuperAdmin extends CI_Controller{

public function __construct(){
  parent::__construct();
  $this->load->model('Loginmodel');
  $this->load->model('Adminmodel');
  $this->load->model('SuperAdminmodel');  
  
}

public function page($page = NULL){
   $data['title'] = $page;	
   if(! $this->session->uid){ return redirect('/'); }
   $data['user_data'] = $this->Adminmodel->getDetails($this->session->uid);
   $result = $this->Adminmodel->getDetails($this->session->uid);
   if($result['type'] != 1){   
     return redirect('logout');
   }
   if($page == 'admin'){
      $response =  $this->add_admin();
      
   }
   if($page == 'view_admin'){
      if(isset($_GET['admdel'])){
         $response = $this->delete_admin();
      }
      $data['admin'] = $this->SuperAdminmodel->getAdmin();
      
   }
   if($page == 'inactive_institute'){
      if(isset($_GET['admact'])){
         $response = $this->active_admin();
      }
      $data['admin'] = $this->SuperAdminmodel->getAdminInactive();
      
   }

   $this->load->view('Admin/admin_header' , $data);
   $this->load->view('SuperAdmin/admin_sidebar' , $data);
   $this->load->view("SuperAdmin/$page" , $data);
   $this->load->view('Admin/admin_footer' , $data);
   
   
}

public function add_admin(){
  
  $this->form_validation->set_rules('first_name', 'Fisrt name', 'trim|required|alpha');
  $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]|is_unique[user.mobile]');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
  $this->form_validation->set_rules('password', 'Password', 'required');
  $this->form_validation->set_rules('address', 'Address', 'required');
  $this->form_validation->set_rules('gender', 'Gender', 'required');
      if( $this->form_validation->run() == true){
           $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/admin/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              

           }

              $result = $this->SuperAdminmodel->add_admin($image);
              if($result)
              {
                $this->session->set_flashdata('feedback','Admin Added Successfully');
                
                return redirect('superadmin/admin');
              }
              else
              {
                $this->session->set_flashdata('feedback','Admin Failed to Add, Please Try Again..');
                
                return redirect('superadmin/admin');
              }
    }


}

  public function delete_admin(){
    //echo 'working';exit;
    $result = $this->SuperAdminmodel->admin_delete($_GET['admdel']);
    //print_r($result);exit;
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Admin Deleted Successfully');
        
       return redirect('superadmin/view_admin');
    }
  }
  public function active_admin(){
    //echo 'working';exit;
    $result = $this->SuperAdminmodel->admin_active($_GET['admact']);
    //print_r($result);exit;
    if($result != FALSE){
      $this->session->set_flashdata('feedback','Admin Asctivated Successfully');
        
       return redirect('superadmin/inactive_institute');
    }
  }




}