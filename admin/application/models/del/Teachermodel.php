<?php

class Teachermodel extends CI_Model{
  public function __construct(){
  
  date_default_timezone_set('Asia/Kolkata');
     
  
  }
  public function get_inst_tbl(){

     $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));

     if($res['inst_tbl_id'] != False){
      $inst_tbl = $this->Adminmodel->getTeachersBySubjects($res['inst_tbl_id']);
      //echo "<pre>";
      //print_r($inst_tbl[0]['id']);exit;

      if($inst_tbl != FALSE){
           return $inst_tbl[0]['id'];
      }else{
           return FALSE;
      }

     }

}
  public function add_attendence(){
      $inst_tbl = $this->get_inst_tbl();
      //print_r($inst_tbl);exit;
      //F - A full textual representation of a month (January through December)
      //M - A short textual representation of a month (three letters)
      //print_r(date('Y-m-d h:i:s'));exit;
      $post=$this->input->post();
      unset($post['submit']); 
      $post['teacher_id']=$inst_tbl;
      $post['month']=date('F');
      $post['year']=date('Y').'-'.(date('Y')+1);
      //print_r($post);exit;
      $post['present']=1;
      $post['created_at']=date('Y-m-d h:i:s');
      $post['created_date']=date('Y-m-d');
      $query = $this->db->insert('teacher_attendence' , $post);
      if($query) return TRUE; else FALSE;
    
  }

  public function getAttendence($id){

    $query = $this->db->get_where('teacher_attendence', ['teacher_id' => $id]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->result_array(); else FALSE;
}

public function get_today_date_status($id){
     $query = $this->db->get_where('teacher_attendence', ['teacher_id' => $id, 'created_date' => date('Y-m-d')]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->row_array(); else FALSE;

}

public function getTeacherSchedule(){
  $inst_tbl = $this->get_inst_tbl();
  //print_r($inst_tbl);exit;
  $query = $this->db->select('t.*,c.subject_name as subjectname,s.time1 as t1,s.time2 as t2,st.first_name as fname,st.middle_name as mname,st.last_name as lname')->from('allocate_student as t')->join('subject as c', 'c.id = t.sub_id')->join('time_slot as s','s.id = t.timeslot_id')->join('student as st','st.id = t.student_id')->where_in('t.teacher_id', $inst_tbl)->get();
  //print_r($this->db->last_query());exit;
  if($query) return $query->result_array(); else FALSE;

}

public function multiple_allocate_student($dt){
  //echo '<pre>';
  //print_r($dt);exit;
  $query = $this->db->where(['student_id' => $dt['student_id'],'sub_id' => $dt['sub_id'],'timeslot_id' => $dt['timeslot_id'],'teacher_id !=' => $dt['teacher_id'],'status !=' => $dt['status']])->get('allocate_student');
  //print_r($this->db->last_query());exit;
  if($query) return $query->result_array(); else FALSE;
}


}