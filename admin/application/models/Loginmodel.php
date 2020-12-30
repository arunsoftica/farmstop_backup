<?php
class Loginmodel extends CI_Model{

public function sign_in(){
    if(is_numeric($this->input->post('username'))){
       $con_arr = ['mobile'=>trim($this->input->post('username'))];
      }
    else{
       $con_arr = ['email'=>$this->input->post('username')];
    }
    $query = $this->db->get_where("user" , $con_arr);
    $result = $query->row_array();
   
    if($query->num_rows() > 0){
          return $result;
    }
    else{
            return FALSE;
        }
}

public function checkLogin($id){
  $query = $this->db->get_where("user" , ['id' => $id]);
    $result = $query->row_array();
   
    if($query->num_rows() > 0){
          return $result;
    }
    else{
            return FALSE;
        }


}

public function getInstitute($id){
  $query = $this->db->get_where("institute_tbl" , ['id' => $id]);
    $result = $query->row_array();
   
    if($query->num_rows() > 0){
          return $result;
          //print_r($result);exit;
    }
    else{
            return FALSE;
        }


}

}