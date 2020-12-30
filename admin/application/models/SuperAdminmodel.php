<?php

class SuperAdminmodel extends CI_Model{
  public function __construct(){
  
  date_default_timezone_set('Asia/Kolkata');
     
  
  }
  public function add_admin($img){

    $lastID = $this->create_institute($img);
    //print_r($lastID);exit;
    $post=$this->input->post();
      unset($post['submit']);  
    $post['created_at'] = date('Y-m-d h:i:s');
    $post['updated_at'] = date('Y-m-d h:i:s');
    $post['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 15]);
     $query = $this->db->insert('user' , ['username' => 'admin', 'password' => $post['password'], 'mobile' => $post['mobile'], 'email' => $post['email'], 'gender' => $post['gender'], 'type' => '2', 'type_title' => 'admin', 'created_at' => $post['created_at'], 'updated_at' => $post['updated_at'], 'status' => '1', 'inst_tbl_id' => $lastID]);
     if($query) return TRUE; else False;


     
      

  }

  public function create_institute($img){
      
    $post=$this->input->post();
      unset($post['submit']);
    $post['created_at']=date('Y-m-d h:i:s');
    $post['updated_at']=date('Y-m-d h:i:s');
     $query = $this->db->insert('institute_tbl' , ['first_name' => $post['first_name'], 'middle_name' => $post['middle_name'], 'last_name' => $post['last_name'],  'mobile' => $post['mobile'], 'email' => $post['email'], 'address' => $post['address'], 'gender' => $post['gender'], 'image' => $img, 's_id' => $this->session->userdata("uid"), 'created_at' => $post['created_at'], 'updated_at' => $post['updated_at'], 'status' => '1']);
     //if($query) return TRUE; else False;
     $insert_id = $this->db->insert_id();
     return  $insert_id;
     

  }

  public function getAdmin(){

    $query = $this->db->get_where('institute_tbl', [ 'status' => 1 , 's_id' => $this->session->userdata("uid") ]);
    if($query) return $query->result_array(); else FALSE;


  }

  public function admin_delete($aid){
    //echo 'working..';exit;
            $query = $this->db->set('status', 0);
            $this->db->where('id', $aid);
            $this->db->update('institute_tbl');
            //print_r($this->db->last_query());exit;
            if($query) return TRUE; else FALSE;
    
  }

  public function getAdminInactive(){

    $query = $this->db->get_where('institute_tbl', [ 'status' => 0 ]);
    if($query) return $query->result_array(); else FALSE;
  }

  public function admin_active($aid){
       $query = $this->db->set('status', 1);
            $this->db->where('id', $aid);
            $this->db->update('institute_tbl');
            //print_r($this->db->last_query());exit;
            if($query) return TRUE; else FALSE;
  }


}