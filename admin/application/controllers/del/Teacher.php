<?php

class Teacher extends CI_Controller{

public function __construct(){
  parent::__construct();
  $this->load->model('Loginmodel');
  $this->load->model('Adminmodel');
  $this->load->model('Teachermodel');  
  
}

public function page($page = NULL){
  
   $data['title'] = $page;
   $data['model2'] = $this->Adminmodel;
   $data['model3'] = $this->Loginmodel;	
   if(! $this->session->uid){ return redirect('/'); }
   $data['user_data'] = $this->Adminmodel->getDetails($this->session->uid);
   $result = $this->Adminmodel->getDetails($this->session->uid);
   if($result['type'] != 3){   
     return redirect('logout');
   }
   if($page == 'dashboard'){
      //$response =  $this->add_admin();
      
   }
   if($page == 'submit_attendence'){

    $inst_tbl = $this->Teachermodel->get_inst_tbl();
    $stat = $this->Teachermodel->get_today_date_status($inst_tbl);
    //echo "<pre>";
    //print_r($stat['present']);exit;
    $data['present'] = $stat['present'];
    $data['attendence'] = $this->Teachermodel->getAttendence($inst_tbl);
      $response =  $this->add_attendence();
      
   }
   if($page == 'teaching_schedule'){
      $data['schedule'] =  $this->Teachermodel->getTeacherSchedule();
      $datas =  $this->Teachermodel->getTeacherSchedule();
      $i = 0;
      foreach($datas as $dt){
        
          $frec = $this->Teachermodel->multiple_allocate_student($dt);
          // return no. of rows now compare status
          //print_r($frec);exit;
          if($frec != FALSE){
           foreach($frec as $rec){
            //echo '<pre>';
            //print_r($rec);
            if($dt['status'] > $rec['status'] ){
                  $flag = 0;
            }else{
                  
                  $flag = 1;
            }
          }
          
           
          }else{
            $flag = 0;
          }
           if($flag == 1){
           $data['schedule'][$i]['current_status']='Inactive';
          }else{
           $data['schedule'][$i]['current_status']='Active';
          }
        $i = $i + 1;
      }
          
      //echo '<pre>';
      //print_r($data);exit;
      //exit;
   }

   $this->load->view('Admin/admin_header' , $data);
   $this->load->view('Teacher/teacher_sidebar' , $data);
   $this->load->view("Teacher/$page" , $data);
   $this->load->view('Admin/admin_footer' , $data);
   
   
}

public function add_attendence(){
  //print_r($this->input->post());exit;
          if($this->input->post('submit')){     
              $result = $this->Teachermodel->add_attendence();
              //print_r($result);exit;
              if($result)
              {
                $this->session->set_flashdata('feedback','Attendence Added Successfully');
                
                return redirect('teacher/submit_attendence');
              }
              else
              {
                $this->session->set_flashdata('feedback','Attendence Failed to Add, Please Try Again..');
                
                return redirect('teacher/submit_attendence');
              }
            }

}




}