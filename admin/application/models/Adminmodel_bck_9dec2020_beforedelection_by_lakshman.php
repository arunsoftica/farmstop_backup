<?php

class Adminmodel extends CI_Model{

public function __construct(){
  
  date_default_timezone_set('Asia/Kolkata');
  /*$this->load->model('basic_model');*/   
  
}

public function get_inst_tbl(){

     $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
     if($res['inst_tbl_id'] != False){
      $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
      if($inst_tbl != FALSE){
           return $inst_tbl['id'];
      }else{
           return FALSE;
      }

     }

}


public function add_student(){
    
      $post=$this->input->post();
      unset($post['submit']); 
      $post['created_at']=date('Y-m-d h:i:s');
      $post['updated_at']=date('Y-m-d h:i:s');
      $post['status']=1;
      return $query = $this->db->insert('student' , $post);
      //if($query) return TRUE; else FALSE;
    
}

public function getclass($id = null) {
        $this->db->select()->from('class');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

public function getsubject($id = null) {

        $this->db->select('t.*,c.class_name as classname')->from('subject as t')->join('class as c', 'c.id = t.class');
        if ($id != null) {
            $this->db->where('t.id', $id);
        } else {
            $this->db->order_by('t.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

public function add_class($id){
    
      $post=$this->input->post();
      unset($post['submit']); 
      $post['created_at']=date('Y-m-d h:i:s');
      $post['updated_at']=date('Y-m-d h:i:s');
      $post['status']=1;
      $post['inst_tbl_id']=$id;
      return $query = $this->db->insert('class' , $post);
      //if($query) return TRUE; else FALSE;
    
}

public function add_subject($id){
    
      $post=$this->input->post();
      unset($post['submit']); 
      $post['created_at']=date('Y-m-d h:i:s');
      $post['updated_at']=date('Y-m-d h:i:s');
      $post['status']=1;
      $post['inst_tbl_id']=$id;
      return $query = $this->db->insert('subject' , $post);
      //if($query) return TRUE; else FALSE;
    
}

public function add_subjects($id){
    
      $post=$this->input->post();
      unset($post['submit']); 
      $post['created_at']=date('Y-m-d h:i:s');
      $post['updated_at']=date('Y-m-d h:i:s');
      $post['status']=1;
      $post['inst_tbl_id']=$id;
      return $query = $this->db->insert('subjects' , $post);
      //if($query) return TRUE; else FALSE;
    
}

public function getDetails($id){
    $con_arr=['id'=>$id];
    $query = $this->db->get_where("user" , $con_arr);
    $result=$query->row_array();
    if($result) return $result; else FALSE;
    //print_r($result);exit;


}

public function getSubjectByClass($cid){
   //$query = $this->db->get_where("subject" , ['class' => $cid]);
   $query = $this->db->select('t.*,c.class_name as classname')->from('subject as t')->join('class as c', 'c.id = t.class')->where('t.class',$cid)->get();
   //print_r($this->db->last_query());exit;
   return $result = $query->result_array();
}

public function addTeacher(){

   $inst_tbl = $this->get_inst_tbl();
     if($inst_tbl != False){
       $salary_status = 0;
       if($this->input->post('salary_type') == "m"){
          $salary_cost = $this->input->post('salary');
       }
       else{
         $salary_status = 1;
         $salary_cost = "";
       }

  $data = $this->input->post();
  $query = $this->db->insert('teacher' , ['image' => $data['image'],'year' => $data['year'], 'first_name' => $data['first_name'], 'middle_name' => $data['middle_name'], 'last_name' => $data['last_name'], 'mobile' => $data['mobile'], 'email' => $data['email'], 'dob' => $data['dob'], 'gender' => $data['gender'], 'address1' => $data['address1'], 'address2' => $data['address2'], 'longitude' => $data['longitude'], 'latitude' => $data['latitude'], 'qualification' => $data['qualification'], 'class' => $data['class'], 'class_range' => implode(',',$data['class_range']), 'subject' => implode('@', $data['subject']), 'experience' => $data['experience'], 'teaching_type' => $data['salary_type'], 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'salary' => $salary_cost, 'status' => '1', 's_id' => $inst_tbl]);
    $insert_id = $this->db->insert_id();
      if($insert_id != FALSE){
         if( $salary_status != 0){
            return  $this->lectureCost($insert_id);  
         }else{
          //return TRUE;
          return $insert_id;
         }
         
      } 
 }

}

public function lectureCost($teachers_id){
  $arr1 = $this->input->post('sid');
  $arr2 = $this->input->post('lcost');
  $arr = array_combine($arr1,$arr2);
    $flag = 0;
     foreach($arr as $key=>$value){
         $this->db->insert('teacher_salary_info' , ['teacher_id' => $teachers_id , 'subject_id' => $key , 'lecture_cost' => $value, 'salary' => '']);
       $flag = 1;
     }
    if($flag == 1){
      //return TRUE;
      return $teachers_id;
    }else return FALSE;
}
public function updatelectureCost($teachers_id){
  $arr1 = $this->input->post('sid');
  $arr2 = $this->input->post('lcost');
  $arr = array_combine($arr1,$arr2);
  //print_r($arr);
    $flag = 0;
     foreach($arr as $key=>$value){
         //set where update
         $this->db->set(['lecture_cost' => $value, 'salary' => '']);
         $this->db->where(['teacher_id' => $teachers_id, 'subject_id' => $key]);
         $this->db->update('teacher_salary_info');
         //print_r($this->db->last_query());exit;
       $flag = 1;
     }
    if($flag == 1){
      //return TRUE;
      return $teachers_id;
    }else return FALSE;
}
public function teacherLogin($teacher_id){
   //print_r($this->input->post());
   //exit;
$query = $this->db->insert('user', ['username' => 'Teacher', 'password' => password_hash("teacher", PASSWORD_DEFAULT, ["cost" => 15]), 'mobile' => $this->input->post('mobile'), 'email' => $this->input->post('email'), 'gender' => $this->input->post('gender'), 'type' => '3', 'type_title' => 'teacher', 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => '1', 'inst_tbl_id' => $teacher_id]);


    if($query) return TRUE; else FALSE;


}

public function searchTeacher($latitude,$longitude,$gen){

    
    $result = $this->getTeachers($gen);
    //print_r($result);exit;
    $results = array();
    $i=0;
    foreach($result as $res){
       
       $ch = curl_init("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$latitude.','.$longitude."&destinations=".$res['latitude'].','.$res['longitude']."&key=AIzaSyDV7cINGIE3Re1ACdMWbgcseonHpubiBjE");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch); 
        $jd = json_decode($output);
        if($jd->rows[0]->elements[0]->distance->value <= '10000'){
        $queryy = $this->db->get_where("teacher" , ['longitude' => $res['longitude'], 'latitude' => $res['latitude']]);
        $results[] = $queryy->row_array();
        
        $results[$i]['distance'] = $jd->rows[0]->elements[0]->distance->value;
        $i=$i+1;

        }
        
        
       
    }
       if($results) return $results; else FALSE;
       
       
       //echo implode('@', $results);
       //exit;
  

}

public function addStudent(){
  $inst_tbl = $this->get_inst_tbl();
  if($inst_tbl != False){ 
    $query = $this->db->insert('student' , ['image' => $this->input->post('image'),'first_name' => $this->input->post('first_name'), 'middle_name' => $this->input->post('middle_name'), 'last_name' => $this->input->post('last_name'), 'mobile' => $this->input->post('mobile'), 'email' => $this->input->post('email'), 'dob' => $this->input->post('dob'), 'gender' => $this->input->post('gender'), 'address1' => $this->input->post('address1'), 'address2' => $this->input->post('address2'), 'longitude' => $this->input->post('longitude'), 'latitude' => $this->input->post('latitude'), 'city' => $this->input->post('city'), 'state' => $this->input->post('state'), 'class' => $this->input->post('class'), 'subject' => implode('@', $this->input->post('subject')), 'total_fees' => $this->input->post('total_fees'), 'time_slot_id' => $this->input->post('time_slot'), 'year' => $this->input->post('year'), 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => '1', 's_id' => $inst_tbl]);
      
      if($query) return TRUE; else FALSE;

  }

     

}

public function getTeachers($gen=null){
     $res = $this->get_inst_tbl();
     if($res != False){
          
               if(!empty($gen)){
                   $query = $this->db->get_where("teacher" , ['s_id' => $res, 'gender' => $gen , 'status' => 1]);
               }else{
                  // $this->db->get_where("teacher" , ['s_id' => $res]);
                //$query =  $this->db->join('class', 'class.id = teacher.class');
               $query = $this->db->select('t.*,c.class_name as classname')->from('teacher as t')->join('class as c', 'c.id = t.class')->where('t.status',1)->get();
               //print_r($this->db->last_query());exit;
                            
               }
               
               return $query->result_array();
      }
     
    
}
public function getInactiveTeachers(){
     $res = $this->get_inst_tbl();
     if($res != False){
          
               
               $query = $this->db->select('t.*,c.class_name as classname')->from('teacher as t')->join('class as c', 'c.id = t.class')->where('t.status',0)->get();
               return $query->result_array();
      }
     
    
}

/*public function getStudent(){
     $query = $this->db->get_where("student" , ['s_id' => '5']);
     if($query )return $query->result_array(); else FALSE;

}*/

public function getStudent($id = null) {
  $res = $this->get_inst_tbl();
  if($res != False){
        //$this->db->select()->from('student');
        $this->db->select('t.*,c.class_name as classname,a.time1 as t1,a.time2 as t2')->from('student as t')->join('class as c', 'c.id = t.class')->join('time_slot as a', 'a.id = t.time_slot_id')->where('t.status', 1);
        if ($id != null) {
            $this->db->where('t.id', $id)->where('t.s_id', $res);
        } else {
            $this->db->order_by('t.id');
        }
        $query = $this->db->get();
        if ($id != null) {
           if($query) return $query->row_array(); else FALSE;
        } else {
           if($query) return $query->result_array(); else FALSE;
        }
  }
}
public function getInactiveStudent() {
  $res = $this->get_inst_tbl();
  if($res != False){
        
        $this->db->select('t.*,c.class_name as classname,a.time1 as t1,a.time2 as t2')->from('student as t')->join('class as c', 'c.id = t.class')->join('time_slot as a', 'a.id = t.time_slot_id')->where('t.status', 0);
        
            $this->db->order_by('t.id');
        
        $query = $this->db->get();
        
           if($query) return $query->result_array(); else FALSE;
        
  }
}
public function getStudents($id = null) {
  $res = $this->get_inst_tbl();
  if($res != False){
        //$this->db->select()->from('student');
        $this->db->select('t.*')->from('student as t')->where('t.status', 1);
        if ($id != null) {
            $this->db->where('t.id', $id)->where('t.s_id', $res);
        } else {
            $this->db->order_by('t.id');
        }
        $query = $this->db->get();
        if ($id != null) {
           if($query) return $query->row_array(); else FALSE;
        } else {
           if($query) return $query->result_array(); else FALSE;
        }
  }
}

public function getStudentNotAllocated(){
  $res = $this->get_inst_tbl();
  if($res != False){
    $query = $this->db->select('student_id')->distinct()->get_where('allocate_student',['ins_id' => $res]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->result_array(); else FALSE;


  }

}

public function getStudentForAllocation($students){
  $query = $this->db->where_not_in('id', $students)->get('student');
  if($query) return $query->result_array(); else FALSE;

}

public function searchTeacherById($id){

       $order = sprintf('FIELD(id, %s)', implode(', ', $id));
       $query = $this->db->where_in('id', $id)->order_by($order)->get('teacher');

       if($query) return $query->result_array(); else FALSE;



}
public function getTimeSlot($id=null){
        $this->db->select()->from('time_slot');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            if($query)  return $query->row_array(); else FALSE;
        } else {
            if($query)  return $query->result_array(); else FALSE;
        }
        

}

public function getTeachersBySubjects($teacher){

  //$query = $this->db->where_in('id', $teacher)->get('teacher');
    $query = $this->db->select('t.*,c.class_name as classname')->from('teacher as t')->join('class as c', 'c.id = t.class')->where_in('t.id', $teacher)->get();
    
   if($query) return $query->result_array(); else FALSE;

}

public function getImportTeachers($teacher){

  //$query = $this->db->where_in('id', $teacher)->get('teacher');
    $query = $this->db->select('t.*')->from('teacher as t')->where_in('t.id', $teacher)->get();
    
   if($query) return $query->result_array(); else FALSE;

}

public function allocateTeachers($insid){

      extract($_POST);

      $result = $this->allocateTeachersRecord($insid,$subject_id,$time_slot);

      //print_r($result);exit;

      if($result != FALSE){

           $valss = explode(',',$vals);
            foreach($valss as $valsss){
             $queryy = $this->db->insert('teacher_allocation',['ins_id' => $insid , 'sub_id' => $subject_id , 'teachers_id' => $valsss , 'timeslot_id' => $time_slot]);

            }
           
           $resarray = explode(',', $result['teachers_id']);
           array_push($resarray,$vals);
           $resarray = implode(',',$resarray);
           //print_r($result['id']);exit;
            $query = $this->db->set('teachers_id', $resarray);
            $this->db->where('id', $result['id']);
            $this->db->update('allocate_teachers');
            if($query) return TRUE; else FALSE;



        }else{
            $valss = explode(',',$vals);
            foreach($valss as $valsss){
             $queryy = $this->db->insert('teacher_allocation',['ins_id' => $insid , 'sub_id' => $subject_id , 'teachers_id' => $valsss , 'timeslot_id' => $time_slot]);

            }
            
            $query = $this->db->insert('allocate_teachers',['ins_id' => $insid , 'sub_id' => $subject_id , 'teachers_id' => $vals , 'timeslot_id' => $time_slot]);
            if($query) return TRUE; else FALSE;

        }

}

public function getTeachersByTimeSlot($subject_id,$time_slot,$insid){

    $query = $this->db->get_where('allocate_teachers', ['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->row_array(); else FALSE;
}

public function getTeachersByTimeSlots($subject_id,$time_slot,$insid){

    $query = $this->db->get_where('teacher_allocation', ['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->result_array(); else FALSE;
}
public function getTeachersByTimeSlotss($subject_id,$time_slot,$insid,$tid){

    $query = $this->db->get_where('teacher_allocation', ['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot, 'teachers_id !=' => $tid]);
    //print_r($this->db->last_query());exit;
    if($query) return $query->result_array(); else FALSE;
}
public function getTeachersByTimeSlotsss($subject_id,$time_slot,$insid,$tid){
    //print_r($tid);exit;
    $tids = explode('@',$tid);
    //$query = $this->db->get_where('teacher_allocation', ['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot, 'teachers_id !=' => $tids]);
    $this->db->where(['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot]);
    $this->db->where_not_in('teachers_id', $tids);
    $query = $this->db->get('teacher_allocation');
    //print_r($this->db->last_query());exit;
    if($query) return $query->result_array(); else FALSE;
}
public function allocateTeachersRecord($insid,$subject_id,$time_slot){

$query = $this->db->get_where('allocate_teachers', ['ins_id' => $insid, 'sub_id' => $subject_id, 'timeslot_id' => $time_slot]);
      $result = $query->row_array();
        if($query->num_rows() > 0){
              return $result;
        }
        else{
                return FALSE;
            }

}

public function getSearchStudent($stuname){

$res = $this->get_inst_tbl();
  if($res != False){

      $query = $this->db->like('first_name', $stuname)->where('s_id', $res)->get('student');
      //print_r($this->db->last_query());exit;
      if($query) return $query->result_array(); else FALSE;

  }

}

public function teacherAallocationSubject($teacher_id,$time_slot_id){
$res = $this->get_inst_tbl();
  if($res != False){
      $query = $this->db->select('sub_id')->distinct()->get_where('teacher_allocation',['ins_id' => $res, 'teachers_id' => $teacher_id, 'timeslot_id' => $time_slot_id]);
      //print_r($this->db->last_query());exit;
      if($query) return $query->result_array(); else FALSE;
  }

}
public function teacherAallocationSubjectt($teacher_id,$time_slot_id,$subid){
$res = $this->get_inst_tbl();
  if($res != False){
      $query = $this->db->select('sub_id')->distinct()->get_where('teacher_allocation',['ins_id' => $res, 'teachers_id' => $teacher_id, 'timeslot_id' => $time_slot_id , 'sub_id' => $subid]);
      //print_r($this->db->last_query());exit;
      if($query) return $query->result_array(); else FALSE;
  }

}
public function allocateToStudent($arr){
$res = $this->get_inst_tbl();
  if($res != False){
    //echo "<pre>";
    //print_r($arr);exit;
  $vals = $arr['chk'];
  

  extract($arr);
    foreach($vals  as $val){
      $valss = explode('#',$val);
      //print_r($valss);exit;
      $valsss = explode('$',$valss[1]);
      $subid = explode('@',$valsss[0]);

      
      

      foreach($subid as $subids){
          if(isset($fetch_data[0])){

              $fdata = explode(',',$fetch_data[0]);
        if($fdata[3] == 2){
            
            echo "<center><h3>You can change teacher only 3 times</h3></center>";exit;
          return 2;
        }
        // current and end function in php
        $exends = explode('@',$fdata[1]);
        $ends = end($exends);
        $query = $this->db->get_where("allocate_student" , ['student_id' => $fdata[0], 'sub_id' => $fdata[2], 'teacher_id' => $ends, 'status' => $fdata[3], 'timeslot_id' => $timeslot_id[0]]);
        //print_r($this->db->last_query());exit;
        $result = $query->row_array();
       
        if($query->num_rows() > 0){
            
              $query = $this->db->insert("allocate_student",['ins_id' => $res, 'student_id' => $student_id[0], 'sub_id' => $subids, 'timeslot_id' => $timeslot_id[0], 'teacher_id' => $valss[0], 'priority' => $valsss[1], 'status' => $fdata[3]+1]);
        }
        else{
                $query = $this->db->insert("allocate_student",['ins_id' => $res, 'student_id' => $student_id[0], 'sub_id' => $subids, 'timeslot_id' => $timeslot_id[0], 'teacher_id' => $valss[0], 'priority' => $valsss[1], 'status' => 0]);
            }
          }else{
            
              $query = $this->db->insert("allocate_student",['ins_id' => $res, 'student_id' => $student_id[0], 'sub_id' => $subids, 'timeslot_id' => $timeslot_id[0], 'teacher_id' => $valss[0], 'priority' => $valsss[1], 'status' => 0]);
            
              
          }
        

        
      }

    }
    if($query) return TRUE; else FALSE;
  }


}

public function getAllocateTeacher($stuid = null, $subid = null){
  if($subid != null){
   $query = $this->db->select('t.*,c.subject_name as subname,s.time1 as t1,s.time2 as t2,h.first_name as fname,h.middle_name as mname,h.last_name as lname,h.mobile as mob,h.email as mail,h.gender as gen')->from('allocate_student as t')->join('subject as c', 'c.id = t.sub_id')->join('time_slot as s', 's.id = t.timeslot_id')->join('teacher as h', 'h.id = t.teacher_id')->where(['t.student_id' => $stuid, 't.sub_id' => $subid])->get();
  
  }else{
   $query = $this->db->select('t.*,c.subject_name as subname,s.time1 as t1,s.time2 as t2,h.first_name as fname,h.middle_name as mname,h.last_name as lname,h.mobile as mob,h.email as mail,h.gender as gen')->from('allocate_student as t')->join('subject as c', 'c.id = t.sub_id')->join('time_slot as s', 's.id = t.timeslot_id')->join('teacher as h', 'h.id = t.teacher_id')->where_in('t.student_id', $stuid)->get();
  //$query = $this->db->get_where('allocate_student', ['student_id' => $stuid]);
  //print_r($this->db->last_query());exit; 
  }
  
  if($query) return $query->result_array(); else FALSE;

  
}

public function teacherPresentDetail($teacher_id,$month,$year){

$query = $this->db->select('teacher_id as teacher,h.teaching_type as stype,h.salary as sal,sum(present) as psum,max(created_date) as ldate')->from('teacher_attendence as t')->join('teacher as h','h.id = t.teacher_id')->where(['month' => $month, 'year' => $year, 'teacher_id' => $teacher_id])->get();
//print_r($this->db->last_query());exit;
 if($query) return $query->result_array(); else FALSE;

}

public function getTeacherLectureCost($teacher_id){

$query = $this->db->select('sum(lecture_cost) as lcost')->from('teacher_salary_info')->where(['teacher_id' => $teacher_id])->get();
if($query) return $query->result_array(); else FALSE;

}

public function existTeacherSalary(){
    extract($_POST);
  $arr = explode(',',$rec);
   $query = $this->db->get_where('teacher_salary', ['teacher_id' => $arr[2], 'year' => $arr[0], 'month' => $arr[1], 'type' => $arr[3]]);
   //print_r($this->db->last_query());exit;
   $result = $query->row_array();

   //print_r($query);exit;
   if($query->num_rows() > 0){

           //print_r('1');exit;
           return $result;
    }
    else{
             //print_r('2');exit;
             return FALSE;
        }
}

public function addTeacherSalary(){
//print_r($_POST);exit;
  extract($_POST);
  $arr = explode(',',$rec);


$query = $this->db->insert('teacher_salary',['teacher_id' => $arr[2], 'paid_salary' => $insert_sal, 'year' => $arr[0], 'month' => $arr[1], 'type' => $arr[3], 'payment_method' => $pay_method, 'transaction_id' => $tranid, 'pay_date' => $pay_date, 'remark' => $remark, 'salary' => $arr[4]]);
if($query) return TRUE; else FALSE;

}

public function getTeacherSalaryReport(){
  
  extract($_POST);

  /*$this->db->where('teacher_id',$teacher);
  if($year){ $this->db->where('year',$year); }
  if($month){ $this->db->where('month',$month); }
  $query = $this->db->get('teacher_salary');*/
  $this->db->select('t.*,c.first_name as fname,c.middle_name as mname,c.last_name as lname')->from('teacher_salary as t')->join('teacher as c', 'c.id = t.teacher_id');

  $this->db->where('t.teacher_id',$teacher);
  if($year){ $this->db->where('t.year',$year); }
  if($month){ $this->db->where('t.month',$month); }
  $query = $this->db->get();
  
  if($query) return $query->result_array(); else FALSE;

}

  public function getStudentByClass($cid){
     $query = $this->db->get_where('student',['class'=>$cid]);
      if($query) return $query->result_array(); else FALSE;
  }

  public function submitStudentFees(){
    extract($_POST);
    //print_r($_POST);exit;
    $query = $this->db->insert('student_fees',['student_id' => $stuid, 'class' => $class, 'year' => $year, 'month' => $month, 'total_fees' => $total_fees, 'discount' => $discount, 'submit_fees' => $submit_fees, 'status' => 0, 'sdate' => date('Y-m-d h:i:s')]);
    if($query) return TRUE; else FALSE;
  }

  public function checkStudentFees(){
    extract($_POST);
    $query = $this->db->get_where('student_fees', ['student_id' => $stuid, 'class' => $class, 'month' => $month, 'year' => $year]);
    if($query) return $query->result_array(); else FALSE;

  }

  public function update_class(){
    
    extract($_POST);
    
    $query = $this->db->set(['class_name' => $class_name, 'updated_at' =>date('Y-m-d h:i:s')]);
            $this->db->where('id', $class_id);
            $this->db->update('class');
            if($query) return TRUE; else FALSE;
  }

  public function delete_class($cid){
       $query = $this->db->where('id',$cid)->delete('class');
       if($query) return TRUE; else FALSE;
  }

  public function update_subject(){
    //print_r($_POST);exit;
    extract($_POST);
    
    $query = $this->db->set(['subject_name' => $subject_name, 'updated_at' => date('Y-m-d h:i:s')]);
            $this->db->where('id', $sub_id);
            $this->db->update('subject');
            if($query) return TRUE; else FALSE;
  }
  public function delete_subject($sid){
       $query = $this->db->where('id',$sid)->delete('subject');
       if($query) return TRUE; else FALSE;
  }
  public function delete_student($sid){
       //$query = $this->db->where('id',$sid)->delete('student');
       //if($query) return TRUE; else FALSE;
    $query = $this->db->set('status', 0);
            $this->db->where('id', $sid);
            $this->db->update('student');
            if($query) return TRUE; else FALSE;
  }
  public function active_student($sid){
       //$query = $this->db->where('id',$sid)->delete('student');
       //if($query) return TRUE; else FALSE;
    $query = $this->db->set('status', 1);
            $this->db->where('id', $sid);
            $this->db->update('student');
            if($query) return TRUE; else FALSE;
  }
  public function delete_teacher($tid){
       
    $query = $this->db->set('status', 0);
            $this->db->where('id', $tid);
            $this->db->update('teacher');
            if($query) return TRUE; else FALSE;
  }
  public function active_teacher($tid){
       
    $query = $this->db->set('status', 1);
            $this->db->where('id', $tid);
            $this->db->update('teacher');
            if($query) return TRUE; else FALSE;
  }
  public function delete_student_import($sid){
       $query = $this->db->where('id',$sid)->delete('student');
       if($query) return TRUE; else FALSE;
    
  }
  public function delete_teacher_import($tid){
       $query = $this->db->where('id',$tid)->delete('teacher');
       if($query) return TRUE; else FALSE;
    
  }
  public function getsTimeSlot($ins_id){
       extract($_POST);
       $query = $this->db->get_where('time_slot',['institute_id' => $ins_id, 'time1' => $time1, 'time2' => $time2]);
       //print_r($this->db->last_query());exit;
       if($query) return $query->result_array(); else FALSE;

  }

  public function addTimeSlot($ins_id){
    extract($_POST);
    $query = $this->db->insert('time_slot',['institute_id' => $ins_id, 'time1' => $time1, 'time2' => $time2,'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
    if($query) return TRUE; else FALSE;

  }

  public function updateTimeSlot(){
     extract($_POST);
    $query = $this->db->set(['time1' => $time1,'time2' => $time2,'updated_at' => date('Y-m-d h:i:s')]);
            $this->db->where('id', $timeslot_id);
            $this->db->update('time_slot');
            if($query) return TRUE; else FALSE;


  }

  public function delete_time_slot($tsid){
       $query = $this->db->where('id',$tsid)->delete('time_slot');
       if($query) return TRUE; else FALSE;
  }

  public function updateStudent(){
    $inst_tbl = $this->get_inst_tbl();
  if($inst_tbl != False){ 

    $query = $this->db->set(['image' => $this->input->post('image'),'first_name' => $this->input->post('first_name'), 'middle_name' => $this->input->post('middle_name'), 'last_name' => $this->input->post('last_name'), 'mobile' => $this->input->post('mobile'), 'email' => $this->input->post('email'), 'dob' => $this->input->post('dob'), 'gender' => $this->input->post('gender'), 'address1' => $this->input->post('address1'), 'address2' => $this->input->post('address2'), 'longitude' => $this->input->post('longitude'), 'latitude' => $this->input->post('latitude'), 'city' => $this->input->post('city'), 'state' => $this->input->post('state'), 'class' => $this->input->post('class'), 'subject' => implode('@', $this->input->post('subject')), 'total_fees' => $this->input->post('total_fees'), 'time_slot_id' => $this->input->post('time_slot'), 'year' => $this->input->post('year'), 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => '1', 's_id' => $inst_tbl]);
            $this->db->where('id', $this->input->post('student_id'));
            $this->db->update('student');
            if($query) return TRUE; else FALSE;

  }

  }

  public function getSubjectCost($subid,$teacherid){
     $query = $this->db->get_where('teacher_salary_info',['teacher_id' => $teacherid, 'subject_id' => $subid]);
     if($query) return $query->row_array(); else FALSE;
  }


  public function updateTeacher(){

    $inst_tbl = $this->get_inst_tbl();
  if($inst_tbl != False){ 
    $salary_status = 0;
       if($this->input->post('salary_type') == "m"){
          $salary_cost = $this->input->post('salary');
       }
       else{
         $salary_status = 1;
         $salary_cost = "";
       }

  $data = $this->input->post();
    $query = $this->db->set(['image' => $data['image'],'year' => $data['year'],'first_name' => $data['first_name'], 'middle_name' => $data['middle_name'], 'last_name' => $data['last_name'], 'mobile' => $data['mobile'], 'email' => $data['email'], 'dob' => $data['dob'], 'gender' => $data['gender'], 'address1' => $data['address1'], 'address2' => $data['address2'], 'longitude' => $data['longitude'], 'latitude' => $data['latitude'], 'qualification' => $data['qualification'], 'class' => $data['class'], 'class_range' => implode(',',$data['class_range']), 'subject' => implode('@', $data['subject']), 'experience' => $data['experience'], 'teaching_type' => $data['salary_type'], 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'salary' => $salary_cost, 'status' => '1', 's_id' => $inst_tbl]);
            $this->db->where('id', $this->input->post('teacher_id'));
            $this->db->update('teacher');
            

        if( $salary_status != 0){
        return  $this->updatelectureCost($this->input->post('teacher_id'));  
         }else{
          if($query) return TRUE; else FALSE;
         }

  }
  }

  public function uploadCsvTeacher($cont){
    $inst_tbl = $this->get_inst_tbl();
     if($inst_tbl != False){
    //print_r($cont);exit;
    $query = $this->db->insert('teacher', ['first_name' => $cont[0],'middle_name' => $cont[1],'last_name' => $cont[2],'mobile' => $cont[3],'email' => $cont[4],'gender' => $cont[5],'dob' => $cont[6],'year' => $cont[7],'address1' => $cont[8],'qualification' => $cont[9],'city' => $cont[10],'state' => $cont[11],'experience' => $cont[12],'status' => 1,'s_id' => $inst_tbl,'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
    if($query) return TRUE; else FALSE;
    }
  }

  public function uploadCsvStudent($cont){
    $inst_tbl = $this->get_inst_tbl();
     if($inst_tbl != False){
    //print_r($cont);exit;
    $query = $this->db->insert('student', ['first_name' => $cont[0],'middle_name' => $cont[1],'last_name' => $cont[2],'mobile' => $cont[3],'email' => $cont[4],'gender' => $cont[5],'dob' => $cont[6],'year' => $cont[7],'address1' => $cont[8],'city' => $cont[9],'state' => $cont[10],'status' => 1,'s_id' => $inst_tbl,'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')]);
    if($query) return TRUE; else FALSE;
    }
  }

  public function getStudentToUpdate(){
     $res = $this->get_inst_tbl();
      if($res != False){
        $query = $this->db->get_where('student', ['address2' => '','longitude' => '','latitude' => '','class' => '','subject' => '','total_fees' => '']);

        if($query) return $query->result_array(); else FALSE;

      }

  }
  public function getTeachersToUpdate(){
     $res = $this->get_inst_tbl();
     if($res != False){
      $query = $this->db->get_where('teacher', ['address2' => '','longitude' => '','latitude' => '','class' => '','subject' => '','teaching_type' => '']);

        if($query) return $query->result_array(); else FALSE;


     }

  }

  public function studentFeesReport($class = null,$student = null,$month = null,$year = null){
    //print_r($year);exit;
    
      $this->db->select('t.*,c.class_name as classname,s.first_name as fname,s.middle_name as mname,s.last_name as lname')->from('student_fees as t')->join('class as c', 'c.id = t.class')->join('student as s', 's.id = t.student_id');
        
            
        $this->db->where('t.class',$class);
    if($student){ $this->db->where('t.student_id',$student);}
    if($month){ $this->db->where('t.month',$month); }
    if($year){ $this->db->where('t.year',$year); }
    $query = $this->db->get();

    //print_r($this->db->last_query());

    if($query) return $query->result_array(); else FALSE;
  }

  public function get_student_by_class($class){

     $query = $this->db->get_where('student',[ 'class' => $class ]);
     if($query) return $query->result_array(); else FALSE;
  }

  public function checkAllocateStudent($teachers_id,$time_slot_id){
     $query = $this->db->get_where("allocate_student" , ['teacher_id' => $teachers_id,'timeslot_id' => $time_slot_id]);
     if($query) return $query->result_array(); else FALSE;

  }

  public function print_receipt($pid){
    
    $query = $this->db->get_where('student_fees',['id' => $pid]);
    if($query) return $query->row_array(); else FALSE;
  }
  public function print_all_receipt($stu,$class,$year){
    
    $query = $this->db->get_where('student_fees',['student_id' => $stu, 'class' => $class, 'year' => $year]);
    if($query) return $query->result_array(); else FALSE;
  }
  public function add_admin($img){

    $lastID = $this->create_institute($img);
    //print_r($lastID);exit;
    $post=$this->input->post();
      unset($post['submit']);  
    $post['created_at'] = date('Y-m-d h:i:s');
    $post['updated_at'] = date('Y-m-d h:i:s');

    $post['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 15]);
     $query = $this->db->insert('user' , ['username' => 'admin', 'password' => $post['password'], 'mobile' => $post['mobile'], 'email' => $post['email'], 'gender' => $post['gender'], 'type' => $post['admtype'], 'type_title' => 'admin', 'created_at' => $post['created_at'], 'updated_at' => $post['updated_at'], 'status' => '1', 'inst_tbl_id' => $lastID]);
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

  public function getModerator($id = null){
      if($id != null){
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where(['c.type'=>3,'t.id'=>$id])->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
      }else{
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where('c.type',3)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
      }
     
  }
  public function getBlogger($id = null){
    if($id != null){
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where(['c.type'=>4,'t.id'=>$id])->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
      }else{
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where('c.type',4)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
      }
  }
  public function getOperationManager($id = null){
    if($id != null){
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where(['c.type'=>5,'t.id'=>$id])->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
      }else{
          $query = $this->db->select('t.*,c.type as types')->from('institute_tbl as t')->join('user as c', 'c.inst_tbl_id = t.id')->where('c.type',5)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
      }
  }
  public function getCreatedBy($id){
    
    $insid = $this->getFromUser($id);
    //print_r($insid['inst_tbl_id']);exit;
    $query = $this->db->get_where('institute_tbl', [ 'id' => $insid['inst_tbl_id'] ]);
    return $result = $query->row_array();

  }
  public function getFromUser($id){
    $query = $this->db->get_where('user',[ 'id' => $id ]);
    return $result = $query->row_array();
  }
  public function getTotalCount($type){
     if($type == 3){
         
         $query = $this->db->select('*')->from('user')->where('type',3)->get();
         //print_r($this->db->last_query());exit;
         
         return $query->num_rows();
          
     }else if($type == 4){
           $query = $this->db->select('*')->from('user')->where('type',4)->get();
         
         
         return $query->num_rows();  
     }else if($type == 5){
      //echo 'working';exit;
             $query = $this->db->select('*')->from('user')->where('type',5)->get();
         
         
         return $query->num_rows();
     }

  }
  public function send_push_notification(){
      extract($_POST);
      $image = '';
      if($_FILES['image']['name'][0]){
    $config = array();
    $config['upload_path'] = './uploads/notification_images/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
        for($i=0; $i< count($files['image']['name']); $i++)
        {     
             
            $_FILES['image']['name']= rand().$i.$files['image']['name'][$i];
            $_FILES['image']['type']= $files['image']['type'][$i];
            $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
            $_FILES['image']['error']= $files['image']['error'][$i];
            $_FILES['image']['size']= $files['image']['size'][$i];    
    
            $this->upload->initialize($config);
        
            if ( ! $this->upload->do_upload('image'))
                {
                        return 'invalid';
                }
                else
                {
                        $image = $_FILES['image']['name'];
                }
            
            
        }
    
   }
   if($image != ''){
       $userIdAndMobileTokensArr = $this->getDeviceTokenUsers();
       $imageWithUrl = 'https://www.farmstop.in/admin/uploads/notification_images/'.$image;
           $this->promoNotifications($userIdAndMobileTokensArr,$description,$imageWithUrl);
      $query = $this->db->insert('push_notification',['title' => $pro_title,'message' => $description,'image' => $image,'date' => date('Y-m-d h:i:s')]);
      if($query) return TRUE; else FALSE; 
   }else{
       return FALSE;
   }
      
  }
  private function promoNotifications($userIdAndMobileTokensArr,$msg,$imageWithUrl){
        
        $type = "Promotion";
        $android_server_key = "AAAASu6ZOBE:APA91bGuB9p3c0S2jZ2spxN5UVeI9JmstXXBp4Sebyik7zkKX-ZgTf0xDboJx4Ss40serscmQP69WDrOiYZ7EvBpXnCCMaOD-cTTX2f7kQmnMmMfWY75NQEl_2owibMgZcuueTTp7LyP";
        $Pushmessage    = substr($msg , 0, 100) . '.....';
        $message = array(
            'title'         => "Farmstop",
            'message'       => $Pushmessage,
            'vibrate'       => 1,
            'sound'         => 1,
            'image'          =>$imageWithUrl,
            'largeIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'smallIcon'     => "https://www.farmstop.in/assets/images/farmstop.png",
            'type'          =>$type,//'order',
        );

        //$token  = explode(",", $mobiletokens);
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $validTokens = array();

        foreach ($userIdAndMobileTokensArr as $key => $userData) {
            //print_r($userData["id"]);exit;
            $value = trim($userData["deviceToken"]);
            $userId = $userData["id"];
            
            $ch = curl_init();
            $fields = array(
                'registration_ids' => array($value),
                'data' => $message,
            );
            //echo "<pre>"; print_r($fields);print_r($userData);
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
            // if($notification->failure == 0)
            // {
                $this->db->insert("user_notification", array("user_id"=>$userId,"title"=>"Farmstop Order","message"=>$msg,"type"=>$type,"order_no"=>'','image_url'=>$imageWithUrl, "date"=>date('Y-m-d h:i:s')));
            // }else{
            //     print_r($notification->results[0]->error);exit;
            //     //echo "Error :".$notification->results[0]->error;
            // }
        }                
    }
  public function add_blog(){
      extract($_POST);
      $image = '';
      if($_FILES['image']['name'][0]){
    $config = array();
    $config['upload_path'] = './uploads/blog_images/';
    $config['allowed_types'] = 'jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
        for($i=0; $i< count($files['image']['name']); $i++)
        {     
             
            $_FILES['image']['name']= rand().$i.$files['image']['name'][$i];
            $_FILES['image']['type']= $files['image']['type'][$i];
            $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
            $_FILES['image']['error']= $files['image']['error'][$i];
            $_FILES['image']['size']= $files['image']['size'][$i];    
    
            $this->upload->initialize($config);
    
            if ( ! $this->upload->do_upload('image'))
                {
                        return 'invalid';
                }
                else
                {
                        $image = $_FILES['image']['name'];
                }
            
            
        }
    
   }
   if($image != ''){
      $query = $this->db->insert('blog',['slug' => $slug, 'meta_description' => $meta_description,'meta_keyword' => $meta_keyword,'title' => $pro_title,'description' => $description,'image' => $image,'date' => date('Y-m-d h:i:s')]);
      if($query) return TRUE; else FALSE; 
   }else{
       return FALSE;
   }
      
  }
  public function getDeviceTokenUsers(){
      
      
      $query = $this->db->query("SELECT id,deviceToken FROM register_user where deviceToken != '' union SELECT social_id,deviceToken FROM social_user where deviceToken != ''");
      //print_r($this->db->last_query());
      //exit;
      /*$query = $this->db->query("SELECT id,deviceToken FROM register_user where deviceToken != '' and mobile = '7754069699'
");*/
      if($query) return $query->result_array(); else FALSE;
      
  }
  public function update_blog(){
      extract($_POST);
      $image = '';
      if($_FILES['image']['name'][0]){
    $config = array();
    $config['upload_path'] = './uploads/blog_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
        for($i=0; $i< count($files['image']['name']); $i++)
        {     
             
            $_FILES['image']['name']= rand().$i.$files['image']['name'][$i];
            $_FILES['image']['type']= $files['image']['type'][$i];
            $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
            $_FILES['image']['error']= $files['image']['error'][$i];
            $_FILES['image']['size']= $files['image']['size'][$i];    
    
            $this->upload->initialize($config);
            $this->upload->do_upload('image');
            $image = $_FILES['image']['name'];
            
        }
    
   }else{
       $image = $image1;
   }
      $query = $this->db->set(['slug' => $slug, 'meta_description' => $meta_description,'meta_keyword' => $meta_keyword,'title' => $pro_title,'description' => $description,'image' => $image])->where('id',$blogid)->update('blog');
      
      if($query) return TRUE; else FALSE;
  }
  public function add_product(){
    
    $pid = $this->addProduct();
    if($_FILES['image']['name'][0]){
    $config = array();
    $config['upload_path'] = './uploads/product_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($files['image']['name']); $i++)
    {     
        if($i == 0){
             $fstatus = 1;
        }else{
             $fstatus = 0;
        }    
        $_FILES['image']['name']= rand().$i.$pid.$files['image']['name'][$i];
        $_FILES['image']['type']= $files['image']['type'][$i];
        $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
        $_FILES['image']['error']= $files['image']['error'][$i];
        $_FILES['image']['size']= $files['image']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        if($files['image']['name'][$i]){
            $query = $this->db->insert('product_images' , [ 'product_id' => $pid,'image' => $_FILES['image']['name'],'fstatus' => $fstatus]);
        }
        
              $flag = 1;
    }
    if($flag == 1){
              return TRUE;
           }else{
              return FALSE;
           }
         }else{

          return TRUE;
         }
  }
  public function addProduct(){
    $res = $this->get_inst_tbl();
      if($res != False){
      $post=$this->input->post();
      $query = $this->db->insert('product', ['slug' => $post['pro_slug'],'title' => $post['pro_title'], 'description' => $post['description'],'admin_id' => $res, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => 1, 'page_title' => $post['page_title'], 'meta_desc' => $post['meta_desc'], 'meta_key' => $post['meta_key']]);
      $insert_id = $this->db->insert_id();
      return  $insert_id;
      }
  }

  public function updateProduct(){
    $pid = $this->update_product();
    if($_FILES['image']['name'][0]){

    
    $config = array();
    $config['upload_path'] = './uploads/product_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($files['image']['name']); $i++)
    {  
        //print_r($files['image']['name']);exit;         
        $_FILES['image']['name']= rand().$i.$pid.$files['image']['name'][$i];
        $_FILES['image']['type']= $files['image']['type'][$i];
        $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
        $_FILES['image']['error']= $files['image']['error'][$i];
        $_FILES['image']['size']= $files['image']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        if($files['image']['name'][$i]){
          $query = $this->db->set(['image' => $_FILES['image']['name']])->where(['product_id' => $pid])->update('product_images');  
          /*$query = $this->db->insert('product_images' , [ 'product_id' => $pid,'image' => $_FILES['image']['name']]);*/
        }
        
              $flag = 1;
    }
    if($flag == 1){
              return TRUE;
           }else{
              return FALSE;
           }
         }else{
             $query = $this->db->set(['image' => $_POST['image1']])->where(['product_id' => $pid])->update('product_images');
           /*$query = $this->db->insert('product_images' , [ 'product_id' => $pid,'image' => $_POST['image1']]);*/
           return TRUE;
         }
  }
  public function update_product(){
    $res = $this->get_inst_tbl();
      if($res != False){
      $post=$this->input->post();

      $query = $this->db->set(['slug' => $post['pro_slug'],'title' => $post['pro_title'], 'description' => $post['description'], 'updated_at' => date('Y-m-d h:i:s'), 'updated_by' => $res, 'page_title' => $post['page_title'], 'meta_desc' => $post['meta_desc'], 'meta_key' => $post['meta_key']]);
      $this->db->where(['id' => $post['pro_id']]);
      $this->db->update('product');
      return $post['pro_id'];

      } 

  }

  public function getProducts($id = null){
    if($id != null){
      $query = $this->db->get_where('product' , [ 'id' => $id ]);
      return $result = $query->row_array();
    }else{
      $query = $this->db->select('t.*,c.email as mail')->from('product as t')->join('institute_tbl as c', 'c.id = t.admin_id')->get();
      //$query = $this->db->get('product');
      return $result = $query->result_array();
    }
    
  }
  public function add_product_variation(){
    $varid = $this->add_variation_details();
    if($_FILES['image']['name'][0]){
    $config = array();
    $config['upload_path'] = './uploads/product_variation_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($files['image']['name']); $i++)
    {     
        if($i == 0){
             $fstatus = 1;
        }else{
             $fstatus = 0;
        }    
        $_FILES['image']['name']= rand().$i.$varid.$files['image']['name'][$i];
        $_FILES['image']['type']= $files['image']['type'][$i];
        $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
        $_FILES['image']['error']= $files['image']['error'][$i];
        $_FILES['image']['size']= $files['image']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        if($files['image']['name'][$i]){
            $query = $this->db->insert('product_variation_images' , [ 'product_id' => $varid,'image' => $_FILES['image']['name'],'fstatus' => $fstatus]);
        }
        
              $flag = 1;
    }
  }
    
    $post=$this->input->post();
    $i = 0;
    foreach($post['weight'] as $wt){
      if(!empty($post['product_attr'][$i]) && !empty($wt) && !empty($post['regular_price'][$i])){
          
          if($post['sale_price'][$i] > 0){
              $sp = $post['sale_price'][$i];
          }else{
              $sp = $post['regular_price'][$i];
          }
          if($i == 0){
              $query = $this->db->where('id', $varid)->update("product_variation" , ['price' => $sp]);
              
          }
          
          $queryy = $this->db->get_where('product_variation',['price >' => $sp, 'id' => $varid]);
          
          
              $row = $queryy->row_array();
            
          
          
          if($queryy->num_rows() == 1){
               
               $query1 = $this->db->set(['price' => $sp])->where(['id' => $varid])->update('product_variation');
              
               
          }
          
          $query = $this->db->insert('variation_details', ['product_variation_id' => $varid, 'product_attribute_id' => $post['product_attr'][$i], 'weight' => $wt, 'regular_price' => $post['regular_price'][$i], 'sale_price' => $post['sale_price'][$i], 'order_price' => $sp ]);
      }
      
      $i = $i + 1;
      $flag = 1;
    }
    if($flag == 1) return TRUE; else FALSE;
    
  }

  public function add_variation_details(){
     $res = $this->get_inst_tbl();
      if($res != False){
        $post=$this->input->post();
        $query = $this->db->insert('product_variation', [  'short_description' => $post['short_desc'], 'long_description' => $post['long_desc'],'attribute_slug' => $post['attr_slug'],'product_id' => $post['product'], 'attribute_name' => $post['attr_name'], 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => 1, 'admin_id' => $res ]);
         $insert_id = $this->db->insert_id();
         return  $insert_id;

      }

  }
  
  public function update_product_variation(){
      $pid = $this->updateProductVariation();
      if($_FILES['image']['name'][0]){

    
    $config = array();
    $config['upload_path'] = './uploads/product_variation_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($files['image']['name']); $i++)
    {  
        //print_r($files['image']['name']);exit;         
        $_FILES['image']['name']= rand().$i.$pid.$files['image']['name'][$i];
        $_FILES['image']['type']= $files['image']['type'][$i];
        $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
        $_FILES['image']['error']= $files['image']['error'][$i];
        $_FILES['image']['size']= $files['image']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        if($files['image']['name'][$i]){
          $query = $this->db->insert('product_variation_images' , [ 'product_id' => $pid,'image' => $_FILES['image']['name']]);
        }
        
              $flag = 1;
    }
    if($flag == 1){
              $flag = 2;
           }else{
              return FALSE;
           }
         }else{
             $flag = 2;
         }
         
         if($flag == 2){
             
            $post=$this->input->post();
            $i = 0;
            foreach($post['weight'] as $wt){
              if(!empty($post['product_attr'][$i]) && !empty($wt) && !empty($post['regular_price'][$i])){
                  $queryy = $this->db->get_where('variation_details',['product_variation_id' => $pid, 'product_attribute_id' => $post['product_attr'][$i], 'weight' => $wt]);
                  if($post['sale_price'][$i] > 0){
                              $sp = $post['sale_price'][$i];
                          }else{
                              $sp = $post['regular_price'][$i];
                          }
                          
                         
                  if($queryy->num_rows() == 1){
                      $query = $this->db->set([ 'regular_price' => $post['regular_price'][$i], 'sale_price' => $post['sale_price'][$i], 'order_price' => $sp]);
                        $this->db->where(['product_variation_id' => $pid, 'product_attribute_id' => $post['product_attr'][$i], 'weight' => $wt]);
                        $this->db->update('variation_details');
                    }else{
                        
                        $query = $this->db->insert('variation_details', ['product_variation_id' => $pid, 'product_attribute_id' => $post['product_attr'][$i], 'weight' => $wt, 'regular_price' => $post['regular_price'][$i], 'sale_price' => $post['sale_price'][$i], 'order_price' => $sp ]);
                    }
                    /* price update after delete **** */
                          $chkexistprice = $this->db->get_where('product_variation',['id' => $pid]);
                          $rowchk = $chkexistprice->row_array();
                          $chkexistprice1 = $this->db->get_where('variation_details',['product_variation_id' => $pid, 'order_price' => $rowchk['price']]);
                          $rowchk1 = $chkexistprice1->result_array();
                          //print_r($chkexistprice1->num_rows());exit;
                          if($chkexistprice1->num_rows() >= 1){
                              $queryyy = $this->db->get_where('product_variation',['price >' => $sp, 'id' => $pid]);
                              //$row = $queryy->row_array();
                              if($queryyy->num_rows() == 1){
                                  $query1 = $this->db->set(['price' => $sp])->where(['id' => $pid])->update('product_variation');
                                  
                              }
                          }else{
                              
                              $query1 = $this->db->set(['price' => $sp])->where(['id' => $pid])->update('product_variation');
                              
                          }
                          
                          /* **** */
                  
              }
              
              $i = $i + 1;
              $flag = 3;
            }
             
         }
         if($flag == 3){
             if($query) return TRUE; else FALSE;
         }else{
             return FALSE;
         }
  
      
    
  }

  public function updateProductVariation(){
    $res = $this->get_inst_tbl();
      if($res != False){
        $post=$this->input->post();
        //print_r($post);exit;

        $query = $this->db->set([ 'short_description' => $post['short_desc'], 'long_description' => $post['long_desc'], 'attribute_slug' => $post['attr_slug'],'attribute_name' => $post['attr_name'], 'updated_at' => date('Y-m-d h:i:s'), 'admin_id' => $res]);
        $this->db->where(['id' => $post['variation_id']]);
        $this->db->update('product_variation');
        if($query) return $post['variation_id']; else FALSE;

        

      }
  }

  public function get_product_attribute($proid){

    $query = $this->db->get_where('product_variation', [ 'product_id' => $proid ]);
    return $result = $query->result_array();

  }
  public function check_product_inventory($attrid){

     $rec = $this->checkProductInventory($attrid);
     
     if($rec != FALSE){
      return $rec[0]['total_product']-$rec[0]['sell_product'];
     }else{
      return 0;
     }

  }
  public function checkProductInventory($attrid){

    $query = $this->db->get_where('product_inventory', [ 'variation_details_id' => $attrid , 'status' => 1 ]);
    //print_r($this->db->last_query());exit;
    if($query->num_rows() > 0){
      return $result = $query->result_array();
    }else{
      return FALSE;
    }

  }
  public function add_product_inventory(){
    extract($_POST);
    $res = $this->get_inst_tbl();
      if($res != False){
    $query = $this->db->insert('product_inventory', [ 'product_id' => $product, 'product_variation_id' => $product_attr,'variation_details_id' => $pro_attr_val, 'available_product' => $product_no, 'sell_product' => $available_pro, 'update_product' => $product_no, 'total_product' => $product_no, 'status' => 1,'edate' => date('Y-m-d'), 'date' => date('Y-m-d h:i:s'), 'admin_id' => $res ]);
    if($query) return TRUE; else FALSE;


      }
  }
  public function addProductInventory(){
    //print_r($_POST);exit;
    extract($_POST);
    $res = $this->get_inst_tbl();
      if($res != False){
       $updstat = $this->inventoryStatusUpdate($product,$product_attr,$pro_attr_val);
       if($updstat != FALSE){
          $query = $this->db->insert('product_inventory', [ 'product_id' => $product, 'product_variation_id' => $product_attr,'variation_details_id' => $pro_attr_val, 'available_product' => $available_pro, 'sell_product' => 0, 'update_product' => $product_no, 'total_product' => $product_no+$available_pro, 'status' => 1,'edate' => date('Y-m-d'), 'date' => date('Y-m-d h:i:s'), 'admin_id' => $res ]);
          if($query) return TRUE; else FALSE;
       }
       
        

      }
    
  }
  public function inventoryStatusUpdate($product,$product_attr,$pro_attr_val){

    $query = $this->db->set(['status' => 0]);
    $this->db->where(['product_id' => $product, 'product_variation_id' => $product_attr, 'variation_details_id' => $pro_attr_val, 'status' => 1]);
    $this->db->update('product_inventory');
    if($query) return TRUE; else FALSE;

  }

  public function getProductImages($proid){
    $query = $this->db->get_where('product_images', [ 'product_id' => $proid ]);
    return $result = $query->result_array();

  }
  public function getProductVariationImages($proid){
    $query = $this->db->get_where('product_variation_images', [ 'product_id' => $proid ]);
    return $result = $query->result_array();

  }
  public function deleteProductImage($imgid){
    $query = $this->db->where('id',$imgid)->delete('product_images');
       if($query) return TRUE; else FALSE;

  }
  public function deleteProductVariation($varid){
      $query = $this->db->where('id',$varid)->delete('product_variation');
      $query1 = $this->db->where('product_variation_id',$varid)->delete('variation_details');
      $query2 = $this->db->where('product_id',$varid)->delete('product_variation_images');
       if($query && $query1 && $query2) return TRUE; else FALSE;
      
  }
  public function deleteProductVariationImage($imgid){
    $query = $this->db->where('id',$imgid)->delete('product_variation_images');
       if($query) return TRUE; else FALSE;

  }
  
  public function getPreorders(){
       $query = $this->db->get('pre-order');
       if($query) return $query->result_array(); else FALSE;
   }
   
  public function getSearchAllOrder1($fdate){
      $this->db->select('p.attribute_name,v.weight')->select_sum('total_item')->from('add_cart_items as i')->join('variation_details as v','v.id = i.variation_detail_id')->join('product_variation as p','p.id = v.product_variation_id')->join('user_payment as u','i.pay_id = u.id')->group_by('p.attribute_name');
      
      /*if($product != ''){
          $this->db->where('v.product_variation_id',$product);
      }
      if($variation != ''){
          $this->db->where('v.weight',$variation);
      }*/
      if($fdate != ''){
          $date1 = $fdate.' 00:00:00';
          $date2 = $fdate.' 23:59:59';
          $this->db->where('u.date >=',$date1)->where('u.date <=',$date2);
      }
      $this->db->order_by('i.id','desc');
      
      $query = $this->db->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  public function getProductVariation($id = null){
    if($id != null){
        $query = $this->db->select('t.*,c.title as pname,i.email as mail')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->where('t.id', $id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
    }else{
         $query = $this->db->select('t.*,c.title as pname,i.email as mail')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array(); 
    }



  }

  public function add_pages_seo(){
    extract($_POST);
    $res = $this->get_inst_tbl();
      if($res != False){
    $query = $this->db->set(['home_title' => $home_title, 'home_desc' => $home_desc, 'home_key' => $home_key, 'who_title' => $who_title, 'who_desc' => $who_desc, 'who_key' => $who_key, 'shop_title' => $shop_title, 'shop_desc' => $shop_desc, 'shop_key' => $shop_key, 'locate_title' => $locate_title, 'locate_desc' => $locate_desc, 'locate_key' => $locate_key, 'contact_title' => $contact_title, 'contact_desc' => $contact_desc, 'contact_key' => $contact_key, 'career_title' => $career_title, 'career_desc' => $career_desc, 'career_key' => $career_key, 'bulk_title' => $bulk_title, 'bulk_desc' => $bulk_desc, 'bulk_key' => $bulk_key, 'social_title' => $social_title, 'social_desc' => $social_desc, 'social_key' => $social_key, 'inves_title' => $inves_title, 'inves_desc' => $inves_desc, 'inves_key' => $inves_key, 'created_by' => $res]);
    $this->db->where(['id' => 1]);
    $this->db->update('pages_seo');
    if($query) return TRUE; else FALSE;

      }
    

  }

  public function getPagesSeo(){
     $query = $this->db->get_where('pages_seo', [ 'id' => 1 ]);
     return $result = $query->row_array();

  }

  public function getUserReview($id = null){
    if($id != null){
      $query = $this->db->select('t.*,c.attribute_name as aname')->from('user_review as t')->join('product_variation as c', 'c.id = t.variation_id')->where('t.id',$id)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
    }else{
      $query = $this->db->select('t.*,c.attribute_name as aname')->from('user_review as t')->join('product_variation as c', 'c.id = t.variation_id')->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->result_array();
    }
     
  }

  public function update_review(){
    extract($_POST);
    $query = $this->db->set(['admin_reply' => $reply]);
    $this->db->where(['id' => $review_id]);
    $this->db->update('user_review');
    if($query) return TRUE; else FALSE;
  }

  public function statusUserReview($id){
     $query = 'update user_review set status = case when status = 1 then 0 when status = 0 then 1 end where id ='.$id;
       $this->db->query($query);
    //print_r($this->db->last_query());exit;
    if($query) return TRUE; else FALSE;
  }

  public function add_featured_product(){
      extract($_POST);
      $res = $this->get_inst_tbl();
      if($res != False){
    $query = $this->db->insert('featured_product', [ 'protypes' => $protypes,'product_category' => $product, 'product' => $product_attr, 'status' => 0, 'date' => date('Y-m-d h:i:s'), 'published_by' => $res ]);
          if($query) return TRUE; else FALSE;
        }
  }

  public function add_testimonial($image){
   extract($_POST);
    $res = $this->get_inst_tbl();
    if($res != False){
    $query = $this->db->insert('testimonial', [ 'name' => $name, 'image' => $image,'review' => $review,'rating' => $rating, 'status' => 0, 'date' => date('Y-m-d h:i:s'), 'published_by' => $res ]);
          if($query) return TRUE; else FALSE;  


    }

  }
  public function update_testimonial($image){
      extract($_POST);
      $query = $this->db->set(['name' => $name, 'image' => $image,'review' => $review,'rating' => $rating])->where('id',$testimonial_id)->update('testimonial');
      if($query) return TRUE; else FALSE;
  }
  public function getTestimonial($id = null){
      if($id != null){
          $query = $this->db->get_where('testimonial',['id' => $id]);
      }else{
          $query = $this->db->get_where('testimonial');
      }
      
      if($query) return $query->result_array(); else FALSE;
  }
  public function add_coupon(){
   extract($_POST);
    
    $query = $this->db->insert('coupon_code', [ 'code' => $code,'code_type' => $code_type, 'code_value' => $code_value,'status' => 1, 'date' => date('Y-m-d h:i:s')]);
          if($query) return TRUE; else FALSE;  


    

  }
  
  public function getCoupons(){
      $query = $this->db->order_by('id','desc')->get_where('coupon_code',['status' => 1]);
      if($query) return $query->result_array(); else FALSE;  
  }
  public function deleteCoupon($cid){
      $query = $this->db->set('status',0)->where(['id' => $cid])->update('coupon_code');
      if($query) return TRUE; else FALSE;  
  }

  public function add_pincode(){
   extract($_POST);
    $res = $this->get_inst_tbl();
    if($res != False){
    $query = $this->db->insert('area_pincode', [ 'state' => $state,'area' => $name, 'pincode' => $pin,'shipping_cost' => $shipping, 'status' => 0, 'date' => date('Y-m-d h:i:s'), 'published_by' => $res ]);
          if($query) return TRUE; else FALSE;  


    }

  }
  public function update_pincode(){
      extract($_POST);
      $query = $this->db->set(['state' => $state,'area' => $name, 'pincode' => $pin,'shipping_cost' => $shipping])->where(['id' => $pincode_id])->update('area_pincode');
      //print_r($this->db->last_query());exit;
      if($query) return TRUE; else FALSE;
  }

  public function getProductAttribute(){
    $query = $this->db->get('product_attribute');
    if($query) return $result = $query->result_array(); else FALSE;

  }

  public function get_attribute_value($attrid){
      
    $query = $this->db->select('t.*,p.product_attr as pro_attr,p.id as pro_attr_id')->from('variation_details as t')->join('product_attribute as p','p.id = t.product_attribute_id')->where(['product_variation_id' => $attrid])->get();

    /*$query = $this->db->where(['product_variation_id' => $attrid])->get('variation_details');*/
    if($query) return $result = $query->result_array(); else FALSE;
  }
  
  public function getAllOrder(){
      $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->order_by('t.id','desc')->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  public function getAllOrder1(){
      $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->where(['transaction_id !=' => ''])->order_by('t.id','desc')->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  public function getAllOrder2(){
      $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->where(['transaction_id' => ''])->order_by('t.id','desc')->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  public function getUserName($user_id,$user_type){
      if($user_type == 1){
          $query = $this->db->get_where('register_user',['id' => $user_id]);
          if($query) return $query->row_array(); else FALSE;
      }else{
          $query = $this->db->get_where('social_user',['social_id' => $user_id]);
          if($query) return $query->row_array(); else FALSE;
      }
      
      
  }
  public function getSellProduct(){
      $query = $this->db->select('p.*,v.attribute_name as attribute_name,pr.title as pro_title,d.weight as attr_value')->from('product_inventory as p')->join('product_variation as v' , 'v.id = p.product_variation_id')->join('product as pr','p.product_id = pr.id')->join('variation_details as d','d.id = p.variation_details_id')->get();
      if($query) return $result = $query->result_array(); else FALSE;
      
  }
  public function inventory_report_by_product(){
      extract($_POST);
      //print_r($pro_attr_val);exit;
      if(!empty($fdate) && !empty($tdate)){
          $exfdate = explode('/',$fdate);
          $exf = $exfdate[2].'-'.$exfdate[1].'-'.$exfdate[0].' 00:00:00';
          $extdate = explode('/',$tdate);
          $ext = $extdate[2].'-'.$extdate[1].'-'.$extdate[0].' 23:59:59';
          $query = $this->db->select('p.*,v.attribute_name as attribute_name,pr.title as pro_title,d.weight as attr_value')->from('product_inventory as p')->join('product_variation as v' , 'v.id = p.product_variation_id')->join('product as pr','p.product_id = pr.id')->join('variation_details as d','d.id = p.variation_details_id')->where('p.product_variation_id',$product_attr)->where("p.date between '$exf' and '$ext'");
          if(!empty($pro_attr_val)){
              $query = $this->db->where('p.variation_details_id',$pro_attr_val);
          }
          
           
           $query = $this->db->get();
          //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
          
      }
      else if(!empty($pro_attr_val)){
          $query = $this->db->select('p.*,v.attribute_name as attribute_name,pr.title as pro_title,d.weight as attr_value')->from('product_inventory as p')->join('product_variation as v' , 'v.id = p.product_variation_id')->join('product as pr','p.product_id = pr.id')->join('variation_details as d','d.id = p.variation_details_id')->where(['p.product_variation_id' => $product_attr, 'p.variation_details_id' => $pro_attr_val])->get();
          //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      }else{
          $query = $this->db->select('p.*,v.attribute_name as attribute_name,pr.title as pro_title,d.weight as attr_value')->from('product_inventory as p')->join('product_variation as v' , 'v.id = p.product_variation_id')->join('product as pr','p.product_id = pr.id')->join('variation_details as d','d.id = p.variation_details_id')->where(['p.product_variation_id' => $product_attr])->get();
          //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      }
      
      
  }
  public function getInvoiceDetail($id){
       $query = $this->db->select('p.*,u.address as uaddress,u.district as udistrict,u.zipcode as uzipcode,o.id as oid')->from('user_payment as p')->join('user_address as u','u.id = p.address_id')->join('user_order as o','o.payment_id = p.id')->where(['p.id' => $id])->get();
       if($query) return $query->row_array(); else FALSE;
   }
   public function getCartItems($payid){
       $query = $this->db->select('c.*,p.attribute_name as attributename,v.weight as attribute_value,v.sale_price as saleprice,v.regular_price as regularprice')->from('add_cart_items as c')->join('product_variation as p','p.id = c.attribute_id')->join('variation_details as v','v.id = c.variation_details_id')->where(['c.pay_id'=>$payid])->get();
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
   public function updateOrderStatus($status,$payment_id){
       $query = $this->db->set('order_status',$status);
        if($status == 4){
            $this->db->set('status',1);
        }
        $this->db->set('order_status',$status);
        $this->db->where(['id' => $payment_id]);
        $this->db->update('user_payment');
        
        if($status == 4){
            $query = $this->db->set(['status' => 1])->where('pay_id',$payment_id)->update('add_cart_items');
        }
        if($query) return TRUE; else FALSE;
       
   }
   public function checkProductCategorySlug($slug){
       $query = $this->db->get_where('product',['slug' => $slug]);
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function checkProductCategoryTitle($title){
       $query = $this->db->get_where('product',['title' => $title]);
       //print_r($this->db->last_query());exit;
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function checkProductCategoryTitleUpdateTime($title,$id){
       $query = $this->db->where(['title' => $title, 'id !=' =>$id])->get('product');
       //$query = $this->db->get_where('product',['title' => $title]);
       //print_r($this->db->last_query());exit;
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function checkProductSlug($slug){
       $query = $this->db->get_where('product_variation',['attribute_slug' => $slug]);
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function checkProductName($name){
       $query = $this->db->get_where('product_variation',['attribute_name' => $name]);
       //print_r($this->db->last_query());exit;
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function checkProductNameUpdateTime($name,$id){
       $query = $this->db->where(['attribute_name' => $name, 'id !=' => $id])->get('product_variation');
       //$query = $this->db->get_where('product_variation',['attribute_name' => $name]);
       //print_r($this->db->last_query());exit;
         if($query) return $query->row_array(); else FALSE;
       
   }
   public function deleteProductVariationDetail($vid){
       
       //print_r($vid);exit;
       $evid = explode(',',$vid);
       $query = $this->db->where(['product_variation_id' => $evid[0],'product_attribute_id' => $evid[1], 'weight' => $evid[2]])->delete('variation_details');
       if($query) return TRUE; else FALSE;
   }
   public function deleteTestimonial($testid){
       
       $query = $this->db->where(['id' => $testid])->delete('testimonial');
       if($query) return TRUE; else FALSE;
   }
   public function deleteProductCategory($pro_cat){
       $query = $this->db->where(['id' => $pro_cat])->delete('product');
       $query1 = $this->db->where(['product_id' => $pro_cat])->delete('product_images');
       if($query && $query1) return TRUE; else FALSE;
   }
   public function getPincodes($id = null){
       if($id != null){
           $query = $this->db->get_where('area_pincode',['id' => $id]);
       }else{
           $query = $this->db->get_where('area_pincode');
       }
       
       if($query) return $query->result_array(); else FALSE;
   }
   public function deletePincode($id){
       
       $query = $this->db->where(['id' => $id])->delete('area_pincode');
       if($query) return TRUE; else FALSE;
   }
   
   public function deleteZone($id){
       
       $query = $this->db->where(['id' => $id])->delete('zone');
       if($query) return TRUE; else FALSE;
   }
   
   public function deleteApartment($id){
       
       $query = $this->db->where(['id' => $id])->delete('apartment');
       if($query) return TRUE; else FALSE;
   }
   
   
   public function deleteBlog($id){
       
       $query = $this->db->where(['id' => $id])->delete('blog');
       if($query) return TRUE; else FALSE;
   }
   public function delete_featured_product($id){
       
       $query = $this->db->where(['id' => $id])->delete('featured_product');
       if($query) return TRUE; else FALSE;
   }
   public function order_management(){
       $query = $this->db->where(['transaction_id !=' => '' , 'status' => 1 ])->or_where(['transaction_id' => 'COD' , 'status' => 0])->get('user_payment');
       if($query) return $query->result_array(); else FALSE;
   }
   public function customer_management_register(){
       $query = $this->db->get('register_user');
       if($query) return $query->result_array(); else FALSE;
   }
   public function customer_management_social(){
       $query = $this->db->get('social_user');
       if($query) return $query->result_array(); else FALSE;
   }
   public function product_management(){
       $query = $this->db->get('product_variation');
       if($query) return $query->result_array(); else FALSE;
   }
   public function review_management(){
       $query = $this->db->get_where('user_review',['status' => 0]);
       if($query) return $query->result_array(); else FALSE;
   }
   public function testimonial_management(){
       $query = $this->db->get('testimonial');
       if($query) return $query->result_array(); else FALSE;
   
   }
   public function getBlogs($id = null){
       if($id != null){
           $query = $this->db->get_where('blog',['id' => $id]);
       if($query) return $query->row_array(); else FALSE;
       }else{
           $query = $this->db->get('blog');
       if($query) return $query->result_array(); else FALSE;
       }
       
   }
   public function change_featured_image($id){
       $query = $this->db->select('v.*,i.image as fimg')->from('product_variation as v')->join('product_variation_images as i','i.product_id = v.id')->where(['v.id' => $id, 'i.fstatus' => 1])->get();
       if($query) return $query->row_array(); else FALSE;
       
   }
   public function update_featured_image(){
       extract($_POST);
       

    
    $config = array();
    $config['upload_path'] = './uploads/product_variation_images/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($files['image']['name']); $i++)
    {  
        //print_r($files['image']['name']);exit;         
        $_FILES['image']['name']= rand().$i.$pro_id.$files['image']['name'][$i];
        $_FILES['image']['type']= $files['image']['type'][$i];
        $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
        $_FILES['image']['error']= $files['image']['error'][$i];
        $_FILES['image']['size']= $files['image']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload('image');
        if($files['image']['name'][$i]){
          
          $query = $this->db->set(['image' => $_FILES['image']['name']])->where(['product_id' => $pro_id, 'fstatus' => 1])->update('product_variation_images');  
          
        }
        
              $flag = 1;
    }
    if($flag == 1){
              return TRUE;
           }else{
              return FALSE;
           }
         
   }
   
   public function getFeaturedProducts($type = null){
       if($type != null){
           $query = $this->db->select('f.*,p.title as pro_cat,v.attribute_name as pro')->from('featured_product as f')->join('product as p','p.id = f.product_category')->join('product_variation as v','v.id = f.product')->where('f.protypes',$type)->get();
       }else{
           $query = $this->db->select('f.*,p.title as pro_cat,v.attribute_name as pro')->from('featured_product as f')->join('product as p','p.id = f.product_category')->join('product_variation as v','v.id = f.product')->get();
       }
       
       if($query) return $query->result_array(); else FALSE;
       
   }
   public function update_product_price(){
        extract($_POST);
        $i = 0;
        foreach($weight as $wt){
              if($sale_price[$i] > 0){
                  $sp = $sale_price[$i];
              }else{
                  $sp = $regular_price[$i];
              }
              $query = $this->db->set(['regular_price' => $regular_price[$i],'sale_price' => $sale_price[$i], 'order_price' => $sp])->where(['product_variation_id' => $product_id, 'product_attribute_id' => $product_attr[$i], 'weight' => $wt])->update('variation_details');
              $chkexistprice = $this->db->get_where('product_variation',['id' => $product_id]);
              $rowchk = $chkexistprice->row_array();
              $chkexistprice1 = $this->db->get_where('variation_details',['product_variation_id' => $product_id, 'order_price' => $rowchk['price']]);
              $rowchk1 = $chkexistprice1->result_array();
              //print_r($rowchk1[0]['id']);exit;
              if($chkexistprice1->num_rows() >= 1){
              $queryy = $this->db->get_where('product_variation',['price >' => $sp, 'id' => $product_id]);
                  if($queryy->num_rows() == 1){
                      $query1 = $this->db->set(['price' => $sp])->where(['id' => $product_id])->update('product_variation');
                      
                      
                  }
              }else{
                  $query1 = $this->db->set(['price' => $sp])->where(['id' => $product_id])->update('product_variation');
              }
                  $flag = 1;
            $i = $i + 1;    
        }
        if($flag == 1) return TRUE; else FALSE;
       
   }
   
   public function add_apartment(){
       extract($_POST);
       $dd = implode('@',$ddays);
       $query = $this->db->insert('apartment', [ 'apartment' => $apartment, 'zone' => $zone, 'delivery_days' => $dd, 'location' => $location ]);
       if($query) return TRUE; else FALSE;
   }
   
   public function add_zone(){
       extract($_POST);
       $query = $this->db->insert('zone', [ 'zone_name' => $zone_name, 'type' => $type, 'status' => 1, 'date' => date('Y-m-d h:i:s') ]);
       if($query) return TRUE; else FALSE;
   }
   public function getApartments(){
       $query = $this->db->select('a.*,z.zone_name')->from('apartment as a')->join('zone as z','z.id = a.zone')->get();
       if($query) return $query->result_array(); else FALSE;
   }
   public function getZones(){
      $query = $this->db->get_where('zone');
      if($query) return $query->result_array(); else FALSE;
  }
  public function checkBasketDeliveryStatus($status){
      $st = explode('@',$status);
      $query = $this->db->get_where('basket_delivery',['product_id' => $st[1],'variation_id' => $st[2],'order_id' => $st[3],'pay_id' => $st[4],'status' => 1]);
      if($query) return $query->row_array(); else FALSE;
  }
  public function updateBasketDeliveryStatus($status){
      //print_r($status);exit;
      $st = explode('@',$status);
      $query = $this->db->insert('basket_delivery',['product_id' => $st[1],'variation_id' => $st[2],'order_id' => $st[3],'pay_id' => $st[4],'status' => 1,'date' => date('Y-m-d H:i:s')]);
      if($query) return TRUE; else FALSE;
  }
  public function getAllBasketOrders(){
      $query = $this->db->select('t.*,a.email as umail,a.address as adrs,a.district as dist,a.zipcode as pin,u.id as order_no,v.id as vid,p.attribute_name,p.id as pvid')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->join('add_cart_items as aa','aa.pay_id = t.id')->join('variation_details as v','v.id = aa.variation_detail_id')->join('product_variation as p','p.id = v.product_variation_id')->where(['transaction_id !=' => '', 'p.product_id' => 37])->order_by('t.id','desc')->distinct()->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->result_array(); else FALSE;
      
      
  }
  
  public function users_from_all_location(){
      $query = $this->db->select('count(user_id) as total_user')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->join('zone_pincode as z','z.pincode = a.zipcode')->where(['transaction_id !=' => '','t.status' => 1])->order_by('t.id','desc')->distinct()->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->row_array(); else FALSE;
  }
  
  public function users_from_location($zone){
      $query = $this->db->select('count(user_id) as total_user')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->join('zone_pincode as z','z.pincode = a.zipcode')->where(['transaction_id !=' => '','t.status' => 1])->like('z.zone',$zone)->order_by('t.id','desc')->distinct()->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->row_array(); else FALSE; 
      
  }
  
  public function total_order_sales(){
     $query = $this->db->select_sum('total_cost')->select('count(t.id) as total_order')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->join('zone_pincode as z','z.pincode = a.zipcode')->where(['transaction_id !=' => '','t.status' => 1])->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->row_array(); else FALSE; 
  }
  
  public function order_by_location($zone){
     $query = $this->db->select('count(t.id) as total_order')->from('user_payment as t')->join('user_address as a' , 'a.id = t.address_id')->join('user_order as u','t.id = u.payment_id')->join('zone_pincode as z','z.pincode = a.zipcode')->where(['transaction_id !=' => '','t.status' => 1])->like('z.zone',$zone)->order_by('t.id','desc')->get();
      //print_r($this->db->last_query());exit;
      if($query) return $result = $query->row_array(); else FALSE; 
      
  }
  
  public function getProductVariation_import($id = null){
      $w = array('t.id'=> $id, 't.import_status' => '1', 'pi.status'=>'1' );
      $w1 = array('t.import_status' => '1');
      
    if($id != null){
        $query = $this->db->select('t.*,c.title as pname,i.email as mail,pi.total_product as tp, pi.sell_product as sp')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('product_inventory as pi', 't.id = pi.product_variation_id')->where($w)->get();
         //print_r($this->db->last_query());exit;
         return $result = $query->row_array();
    }else{
         $query = $this->db->select('t.*,c.title as pname,i.email as mail, pi.total_product as tp, pi.sell_product as sp, vds.weight as pwt')->from('product_variation as t')->join('product as c', 'c.id = t.product_id')->join('institute_tbl as i', 'i.id = t.admin_id')->join('variation_details as vds', 't.id = vds.product_variation_id','left')->join('product_inventory as pi', 'vds.id = pi.variation_details_id','left')->group_by('vds.id')->where($w1)->get();
      //   print_r($this->db->last_query());exit;
         return $result = $query->result_array(); 
    }



  }

  public function change_status_pro_variation($id){
     $query = 'update product_variation set status = case when status = 1 then 0 when status = 0 then 1 end where id ='.$id;
       $this->db->query($query);
    //print_r($this->db->last_query());exit;
    if($query) return TRUE; else FALSE;
  }
  
  
 public function apartment_import(){
      $post=$this->input->post();
     // echo"111111111111111";
    $filename = $_FILES['apartment_file']['name'];
  $file = $_FILES['apartment_file']['tmp_name'];
  $handle = fopen($file, "r");
  $c = 0;
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if($ext=='csv')
  {
      // echo"222222222";
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
      {
         //  echo"3333333";
      if($c>0){
          $apartment = $filesop[0]; //product_category
                $location = $filesop[1];
                $zone = $filesop[2];
                
                $queryy = $this->db->get_where('zone',['zone_name' => $zone]);
                $row = $queryy->row_array();
                
                $query = $this->db->insert('apartment' , [ 'apartment' => $apartment,'zone' => $row['id'],'location' => $location, 'addon' => date('Y-m-d h:i:s')]);
                
      }
      $c++;
      }
      $flag = 1;
  }
   if($flag == 1) return TRUE; else FALSE;
 }

 public function add_product_variation_import(){
      $post=$this->input->post();
    $filename = $_FILES['product_file']['name'];
  $file = $_FILES['product_file']['tmp_name'];
  $handle = fopen($file, "r");
  $c = 0;
  $ext = pathinfo($filename, PATHINFO_EXTENSION);

  if($ext=='csv')
  {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
      {
          if($c>0){
      $product_category = $filesop[0]; //product_category
            $product_name = $filesop[1];
            $short_desc = $filesop[2];
            $desc = $filesop[3];
            
  
            $where = "slug='$product_category' OR title='$product_category'";
      
       $query_cat = $this->db->where($where)->get('product');
       $pro_cat = $query_cat->row_array();
     //  print_r($this->db->last_query());
      $slug_product_name = url_title(convert_accented_characters($product_name), 'dash', true);

      $res = $this->get_inst_tbl();
      if($res != False){
        $post=$this->input->post();
        $query = $this->db->insert('product_variation', [  'short_description' => $short_desc, 'long_description' => $desc,'attribute_slug' => $slug_product_name,'product_id' => $pro_cat['id'], 'attribute_name' => $product_name, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s'), 'status' => 0, 'import_status' => 1, 'admin_id' => $res ]);
         $insert_id = $this->db->insert_id();
         $varid = $insert_id;

      }
     
     
     $j=29;
   for($i=0; $i<5; $i++)
    {    
        if($i == 0){
             $fstatus = 1;
        }else{
             $fstatus = 0;
        }    

         $image = $filesop[$j];
       
       if(!empty($image)){
       
            $query = $this->db->insert('product_variation_images' , [ 'product_id' => $varid,'image' => $image,'fstatus' => $fstatus]);
       }
                $flag = 1;
              $j++;
    }
  
  
    $n=4;
    while($n<28)
    {
        for($m=0;$m<5;$m++)
        {
            $product_attribute = $filesop[$n];
         $n++;
            $product_attribute_val = $filesop[$n];
         $n++;
            $regular_price = $filesop[$n];
         $n++;
            $sale_price = $filesop[$n];
         $n++;
            $barcode = $filesop[$n];
         
            if(!empty($product_attribute))
            {
                if($sale_price > 0){
                    $sp = $sale_price;
                }else{
                    $sp = $regular_price;
                }
                
                if($m == 0){
                    $query = $this->db->where('id', $varid)->update("product_variation" , ['price' => $sp]);
                }
                $queryy = $this->db->get_where('product_variation',['price >' => $sp, 'id' => $varid]);
                $row = $queryy->row_array();
                if($queryy->num_rows() == 1){
                    $query1 = $this->db->set(['price' => $sp])->where(['id' => $varid])->update('product_variation');
                }
                 $query_pa = $this->db->get_where('product_attribute',['product_attr' => $product_attribute]);
                 if($query_pa)  $pa = $query_pa->row_array();
                
                  $query_varia = $this->db->insert('variation_details', ['product_variation_id' => $varid, 'product_attribute_id' => $pa['id'], 'weight' => $product_attribute_val, 'regular_price' => $regular_price, 'sale_price' => $sale_price, 'order_price' => $sp, 'barcode' => $barcode ]);
            }
            
           $n++;
        }
         $flag = 1;
    }
        }
            $c++;
      }
  }
     if($flag == 1) return TRUE; else FALSE;
 }
 
 public function variationInventoryStatus($val){
       $exp = explode(',',$val);
       $query = $this->db->set('inventory_status',$exp[0])->where('id',$exp[1])->update('product_variation');
       if($query) return TRUE; else FALSE;
   }
   
 public function delete_moderator($mid){
     //print_r($mid);exit;
     $query = $this->db->where('inst_tbl_id',$mid)->delete('user');
     $query1 = $this->db->where('id',$mid)->delete('institute_tbl');
     if($query && $query1) return TRUE; else FALSE;
 }
 
 public function update_admin($img){

    $post=$this->input->post();
      unset($post['submit']); 
    
    $query1 = $this->db->set(['first_name' => $post['first_name'], 'middle_name' => $post['middle_name'], 'last_name' => $post['last_name'],  'mobile' => $post['mobile'], 'email' => $post['email'], 'address' => $post['address'], 'gender' => $post['gender'], 'image' => $img])->where(['id' => $post['getid']])->update('institute_tbl');

    $query = $this->db->set(['mobile' => $post['mobile'], 'email' => $post['email'], 'gender' => $post['gender']]);
    if(trim($post['password']) != ''){
       $post['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT, ['cost' => 15]);
       $this->db->set(['password' => $post['password']]);
    }
    
    $this->db->where([ 'inst_tbl_id' => $post['getid'] ]);
    $this->db->update('user'); 
    
    if($query && $query1) return TRUE; else False;


     
      

  }

}