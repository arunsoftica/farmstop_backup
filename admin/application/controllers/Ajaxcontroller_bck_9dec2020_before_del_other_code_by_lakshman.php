<?php

class Ajaxcontroller extends CI_Controller{

    public function __construct(){
      parent::__construct();
      $this->load->model('Loginmodel');
      $this->load->model('Adminmodel');
    }

    public function get_class(){

        $class_id = $this->input->get('class_id');
        $result = $this->Adminmodel->getSubjectByClass($class_id);
        if(count($result ) > 0){
         foreach($result as $row){
              ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?></option>
              <?php
            }
           
        }
        else{
          ?>
          <option>Record Not Found</option>
          <?php
        } 
    }

    public function add_teacher(){

        $this->form_validation->set_rules('first_name', 'Fisrt name', 'trim|required|alpha');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('address1', 'Address1', 'required');
        $this->form_validation->set_rules('address2', 'Address2', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('qualification', 'Qualification', 'required');
        
        $this->form_validation->set_rules('experience', 'Experience', 'required');
        $this->form_validation->set_rules('class_range[]', 'Class Range', 'required');
        $this->form_validation->set_rules('class', 'Class', 'required');
        $this->form_validation->set_rules('subject[]', 'Subject', 'required');
        $this->form_validation->set_rules('salary_type', 'Salary Type', 'required');
        if( $this->form_validation->run() == true){
              //echo 'function is working'; exit;
              if(isset($_POST['teacher_id'])){
              $_POST['image']='';
                $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/teacher/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              $_POST['image']=$image;

           }else{
              $_POST['image'] = $_POST['image1'];
           }
              $result = $this->Adminmodel->updateTeacher();
              if($result != FALSE){
                echo '<center><h3>Teacher Updated Successfully</center></h3>';
              }}else{
                $_POST['image']='';
                $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/teacher/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              $_POST['image']=$image;

           }
                $result = $this->Adminmodel->addTeacher();
                  if($result != FALSE){
                    $success = $this->Adminmodel->teacherLogin($result);

                    if($success != FALSE){
                      echo '<center><h3>Teacher Added Successfully</center></h3>';
                     
                    }
                  
                  }
                }
              
              
        }
        else{
          echo '<center><h3>Validation Error</center></h3>';
        }
        

    }
   

   public function geocodingData(){
      $address = $this->input->get('address1');
      $addr = str_replace(' ', '+', $address);

      $ch = curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=".$addr."&key=AIzaSyDV7cINGIE3Re1ACdMWbgcseonHpubiBjE");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch); 
        $jd = json_decode($output);
        if( count($jd->results) > 0 ){
          
          $locationArr = $jd->results[0]->geometry->location;
          $latitude = $locationArr->lat;
          $langitude = $locationArr->lng;
          echo $langitude.','.$latitude;
        }
        else{
          echo "invalid"; 
        }

        
   }

    public function add_student(){

        $this->form_validation->set_rules('first_name', 'Fisrt name', 'trim|required|alpha');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob', 'DOB', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('address1', 'Address1', 'required');
        $this->form_validation->set_rules('address2', 'Address2', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('class', 'Class', 'required');
        $this->form_validation->set_rules('subject[]', 'Subject', 'required');
        $this->form_validation->set_rules('time_slot', 'Select Time Slot', 'required');
        $this->form_validation->set_rules('year', 'Select Year', 'required');
        if( $this->form_validation->run() == true){
              //echo 'function is working'; exit;
              if(isset($_POST['student_id'])){
                $_POST['image']='';
                $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/student/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              $_POST['image']=$image;

           }else{
            $_POST['image'] = $_POST['image1'];
           }
              $result = $this->Adminmodel->updateStudent();
              if($result != FALSE){
                echo '<center><h3>Student Updated Successfully</center></h3>';
              } 
              }else{
                $_POST['image']='';
                $image = "";
           if($_FILES['image']['name']){
              $image = $_FILES['image']['name'];
              $imageArr = explode('.',$image);
              $ext = end($imageArr);
              $image = md5(time()).'.'.$ext;
              $postImageconfig = array();
              $this->load->library('image_lib');
              $postImageconfig['upload_path'] = './uploads/student/';
              $postImageconfig['allowed_types'] = 'jpeg|gif|png|jpg';
              $postImageconfig['file_name'] = $image;
              $this->load->library('upload',$postImageconfig);
              $this->upload->do_upload('image');
              //print_r($image);exit;
              $_POST['image']=$image;

           }
              $result = $this->Adminmodel->addStudent();
              if($result != FALSE){
                echo '<center><h3>Student Added Successfully</center></h3>';
              }
              }
              
        }
        else{
          echo '<center><h3>Validation Error</center></h3>';
        }

    }

    public function get_student(){
        $gen = $this->input->get('gen');
        //print_r($gen);exit;
        $stuid = $this->input->get('stuid');
        $result = $this->Adminmodel->getStudent($stuid);
        $results = $this->Adminmodel->searchTeacher($result['latitude'],$result['longitude'],$gen);
        //print_r($results);exit;
        //str_replace('@', ',', $res['subject']);
        $stusub = explode('@', $result['subject']);

        foreach($results as $res){
          $teachersub = explode('@', $res['subject']);
          $teacherid[] = $res['id'];          
          $counts[] = count(array_intersect($stusub, $teachersub)); //compare student subject to teacher subjects

        }
        $arr = array_combine($teacherid,$counts); //mapping
        arsort($arr); //according to count
        $arrkeys = array_keys($arr);
        //$keys=implode(',',$arrkeys);
        //array_values();
        //print_r($keys);exit;
        $record = $this->Adminmodel->searchTeacherById($arrkeys);
        //print_r($record);exit;
        if($record != FALSE){
          $ii=0;
          foreach($record as $rec){ 
            $subname = array();
            $tsubject = explode('@',$rec['subject']);
            foreach($tsubject as $tsub){
              //access element inside foreach
             $sub_details[] = $this->Adminmodel->getsubject($tsub);
             //echo "<pre>";
             //print_r($sub_details[$i]['subject_name']);exit;
             $subname[] = $sub_details[$ii]['subject_name'];
             $ii = $ii+1;
            }
             //print_r($subname);exit;
 
            ?>

              <tr>
              <td><?php echo $rec['first_name'] ?></td>
              <td><?php echo $rec['mobile'] ?></td>
              <td><?php echo $rec['email'] ?></td>
              <td><?php 

              if($rec['gender'] == 'm'){
                 echo 'Male';
              }else if($rec['gender'] == 'f'){
                 echo 'Female';
              }

              ?></td>
              <td><?php echo $rec['dob'] ?></td>
              <td><?php echo implode(',',$subname); ?></td>
              </tr>


          <?php }


        }
        
        
    }

  public function get_teacher(){

   $subject_id = $this->input->get('subject_id');
   $time_slot = $this->input->get('time_slot');
   $result = $this->Adminmodel->getTeachers();
   //echo "<pre>";
   //print_r($result); exit;
   $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
   if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
         $results = $this->Adminmodel->getTeachersByTimeSlot($subject_id,$time_slot,$inst_tbl['id']);
         if($results != FALSE){

              $exp_results = explode(',', $results['teachers_id']);
               //print_r($results);exit;
              $i=0;
            foreach($result as $resl){

              if (in_array($resl['id'], $exp_results)){
              
              }else{
                   $match_teacher[$i]['id'] = $resl['id'];
                   $match_teacher[$i]['subject'] = $resl['subject'];
                   $i = $i+1; 

              }

             

            }
            //echo "<pre>";
            //print_r($match_teacher); exit;


         }else{

            $match_teacher = $result;
         }

    }
   


   $teacher = array();
   foreach($match_teacher as $res){
    $teacher_subject = explode('@', $res['subject']);
    if (in_array($subject_id, $teacher_subject)){
       $teacher[] = $res['id'];
        
    }

   }
  
   $record = $this->Adminmodel->getTeachersBySubjects($teacher);

   if($record != FALSE){
   
         foreach($record as $rec){ ?>
              <tr>
              <td><input type="checkbox" class="checkbox" name="chk[]" value="<?php echo $rec['id'] ?>"></td>
              <td><?php echo $rec['first_name'] ?></td>
              <td><?php echo $rec['mobile'] ?></td>
              <td><?php echo $rec['email'] ?></td>
              <td>
                <?php
            if($rec['gender'] == 'm') echo 'Male'; else echo 'Female';

            ?>
              </td>
              <td><?php echo $rec['dob'] ?></td>
            
              </tr>


          <?php }

   }
   
  }

  public function allocate_teacher(){
     $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
   if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
         //print_r($inst_tbl);exit();
     
     $result = $this->Adminmodel->allocateTeachers($inst_tbl['id']);
     if($result != FALSE){
       echo '<center><h3>Teacher allocated successfully</center></h3>';

     }

   }


  }


  public function search_student(){

       $stuname = $this->input->get('stuname');
       
       $students = $this->Adminmodel->getSearchStudent($stuname);
       if($students != FALSE){
       foreach($students as $stu){ ?>
      <tr>
       <td>
        <input type="radio" class="radio" id="stuid<?php echo $stu['id']; ?>" name="stuid" value="<?php echo $stu['id']; ?>"><?php echo $stu['first_name'].' '.$stu['middle_name'].' '.$stu['last_name'].'('.$stu['id'].')'; ?>
       </td>
      </tr> 
      <?php } }else{ ?>
       <tr><td colspan="3">No Record Found</td></tr>
      <?php }
   }


  public function allocate_student(){

  //echo "function working" ; exit;
    $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
    if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
        $gen = $this->input->get('gen');
        //print_r($gen);exit;
        $stuid = $this->input->get('stuid');
        $result = $this->Adminmodel->getStudent($stuid);
        $results = $this->Adminmodel->searchTeacher($result['latitude'],$result['longitude'],$gen);
        $studentsub = explode('@', $result['subject']);

        //print_r($studentsub);exit;
        $j = 0;
        $subids = array();
        foreach($studentsub as $stusub){
          
          $resultss = $this->Adminmodel->getTeachersbyTimeSlot($stusub,$result['time_slot_id'],$inst_tbl['id']);
          //print_r($resultss); exit;
          if($resultss != FALSE){
            $resultsss[] = $resultss;
          $ress = explode(',',$resultsss[$j]['teachers_id']);
          foreach($ress as $resss){
            $teacherss[] = $resss;
            $subids[]  = $resultsss[$j]['sub_id'];
          }

          $j = $j + 1;
         }
         
        }
        
          //$third_arr = [] ;
          //$js = 0;
         /*foreach($subids as $key=>$value){
          $third_arr[$js][$value] = $teacherss[$js];
             $js++;
         }*/
         /*foreach($teacherss as $key=>$value){
          //$third_arr[] = $value ."=>".$teacherss[$js];
          //use multidimensional array
          $third_arr[$js][$value] = $subids[$js];
             $js++;
         }*/
         
         //echo "<pre>";
         //asort($third_arr);
         //print_r($third_arr);echo $js;


        
        $teachers[] = array_count_values($teacherss);
        
        arsort($teachers);
        $steacher = array();
        
        //print_r($teachers[0][38]);exit;
        foreach($teachers[0] as $key => $value){
              for($l=0; $l<$value; $l++){
               $steacher[] = $key;
              }

        }
        
        
        
        
           if(count($subids)>0){
           $k = 0;
           foreach($subids as $subid){ 
             $sub_details[] = $this->Adminmodel->getsubject($subid);
             $subname = $sub_details[$k]['subject_name'];
             //$record = $this->Adminmodel->getTeachersBySubjects($steacher[$k]);
             $record = $this->Adminmodel->getTeachersBySubjects($teacherss[$k]);
            ?>
              <tr>
                
              <input type="hidden" name="timeslot_id[]" class="timeslot_id" value="<?php echo $result['time_slot_id']; ?>">  
              <input type="hidden" name="student_id[]" class="student_id" value="<?php echo $stuid; ?>">
              <td><input type="checkbox" class="checkbox" name="chk[]" value="<?php echo $record[0]['id'] ?>"></td>
              <td><input type="number" style="width:50px;" name="priority[]" class="priority" value=""></td> 
              <td><?php echo $subname; ?></td>
              <td><?php echo $record[0]['first_name']; ?></td>
              <td><?php echo $record[0]['mobile']; ?></td>
              <td><?php echo $record[0]['email']; ?></td>
              <td><?php
               if($record[0]['gender'] == 'm') echo 'Male'; else echo 'Female';
               ?></td>
              <td><?php echo $record[0]['dob']; ?></td>
            
              </tr>

          
          <?php $k = $k + 1; }

          }

      }


  }

  public function allocate_students(){

  //echo "function working" ; exit;
    $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
    if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
        $gen = $this->input->get('gen');
        //print_r($gen);exit;
        $stuid = $this->input->get('stuid');
        $result = $this->Adminmodel->getStudent($stuid);
        $results = $this->Adminmodel->searchTeacher($result['latitude'],$result['longitude'],$gen);
        $studentsub = explode('@', $result['subject']);

        
        $resultsss = array();
        foreach($studentsub as $stusub){
          
          $resultss = $this->Adminmodel->getTeachersbyTimeSlots($stusub,$result['time_slot_id'],$inst_tbl['id']);
          //echo "<pre>";
          //print_r($resultss);
          //print_r($resultss[0]['teachers_id']);exit;
          if($resultss != FALSE){
            foreach($resultss as $ress){
              /* now check now kya ye teacher se sub isi timeslot me kisi student lo pdha rha h kya ye check krna hai  */
              $chkres = $this->Adminmodel->checkAllocateStudent($ress['teachers_id'],$result['time_slot_id']);
              if($chkres == FALSE){
                 $resultsss[] = $ress['teachers_id'];
              }
              //$resultsss[] = $ress['teachers_id'];

            }
            
          
         }
         
        }
        //$resultsss = array_unique($resultsss);
        $resultsss = array_count_values($resultsss);
        arsort($resultsss);
        $resultsss = array_keys($resultsss);
        //echo "<pre>";
        //print_r($resultsss);exit;
        
        
        
           if(count($resultsss)>0){
           $k = 0;
           foreach($resultsss as $rsult){ 
            
             $sub_details = $this->Adminmodel->teacherAallocationSubject($rsult,$result['time_slot_id']);
             $subname = array();
             $subidd = array();
             $m = 0;
             foreach($sub_details as $subid){
              /*$subdetails[] = $this->Adminmodel->getsubject($subid['sub_id']);
              $subname[] = $subdetails[$m]['subject_name'];*/
              $subidd[] = $subid['sub_id'];
              $subdetails = $this->Adminmodel->getsubject($subid['sub_id']);
              $subname[] = $subdetails['subject_name'];
              /*foreach($subdetails as $sdet){
                $subname[] = $sdet['subject_name'];
              }*/
              $m = $m + 1;
             }
             //echo "<pre>";
             //print_r($subidd);exit;
             //$subname = $sub_details[$k]['subject_name'];
             
             $record = $this->Adminmodel->getTeachersBySubjects($rsult);
             
            ?>
              <tr>
                
              <input type="hidden" name="timeslot_id[]" class="timeslot_id" value="<?php echo $result['time_slot_id']; ?>">  
              <input type="hidden" name="student_id[]" class="student_id" value="<?php echo $stuid; ?>">
              <td><input type="checkbox" class="checkbox flah" id="checkbox" name="chk[]" value="<?php echo $record[0]['id'].'#'.implode('@',$subidd) ?>"></td>
              <td><input type="number" style="width:50px;" id="priority<?php echo $k; ?>" name="priority[]" class="priority"></td> 
              <td><?php echo implode(',',$subname); ?></td>
              <td><?php echo $record[0]['first_name']; ?></td>
              <td><?php echo $record[0]['mobile']; ?></td>
              <td><?php echo $record[0]['email']; ?></td>
              <td><?php
               if($record[0]['gender'] == 'm') echo 'Male'; else echo 'Female';
               ?></td>
              <td><?php echo $record[0]['dob']; ?></td>
            
              </tr>

          
          <?php $k = $k + 1; }

          }

      }


  }
  public function allocateToStudent(){

    $result = $this->Adminmodel->allocateToStudent($_POST);
    //print_r($result);
    if($result != FALSE){
      echo "<center><h3>Student Allocated Successfully</h3></center>";
    }
    /*if($result == 'exist'){
      echo "<center><h3>Allocate Other Teacher. This teacher is already allocated</h3></center>";
    }*/
    
    
  }

  public function getSubjectOfStudent(){
    //$arr = array('name' => 'arun', 'message' => 'hi' );
    //print_r(json_encode($arr)) ;
    $gen = $this->input->get('gen');
    
    $stuid = $this->input->get('stuid');

    $allocateTeacher = $this->Adminmodel->getAllocateTeacher($stuid);
    
    //echo '<pre>';
    //print_r($allocateTeacher);exit;

    $result = $this->Adminmodel->getStudent($stuid);
    $stusub = explode('@', $result['subject']);
    foreach ($stusub as $sub) {
      $subdetails = $this->Adminmodel->getsubject($sub);
      $subname[] = $subdetails['subject_name'];
      $subid[] = $subdetails['id'];
    }
    $ar = array_combine($subid,$subname);
    //print_r($ar);exit;
    echo json_encode(array("teacher_allocate"=>$allocateTeacher , "second_var"=>$ar));

  }

  public function allocateSubjectWise(){

    $subid = $this->input->get('subid');
    $stuid = $this->input->get('stuid');
    
    $allocateTeacher = $this->Adminmodel->getAllocateTeacher($stuid,$subid);
    //print_r($allocateTeacher);exit;

    echo json_encode(array("teacher_allocate"=>$allocateTeacher));

  }

  public function changeTeacher(){
    $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
    if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
        $gen = $this->input->get('gen');
        //print_r($gen);exit;
        $stuid = $this->input->get('stuid');
        $tid = $this->input->get('tid');
        $subbid = $this->input->get('subid');
        $statuss = $this->input->get('status');
        $result = $this->Adminmodel->getStudent($stuid);
        $results = $this->Adminmodel->searchTeacher($result['latitude'],$result['longitude'],$gen);
        $studentsub = explode('@', $result['subject']);
        //print_r($studentsub);exit;

        
        $resultsss = array();
        foreach($studentsub as $stusub){
          
          //$resultss = $this->Adminmodel->getTeachersbyTimeSlotss($stusub,$result['time_slot_id'],$inst_tbl['id'],$tid);
          $resultss = $this->Adminmodel->getTeachersbyTimeSlotsss($stusub,$result['time_slot_id'],$inst_tbl['id'],$tid);
          //echo "<pre>";
          //print_r($resultss);
          //print_r($resultss[0]['teachers_id']);exit;
          if($resultss != FALSE){
            foreach($resultss as $ress){
              $resultsss[] = $ress['teachers_id'];

            }
            
          
         }
         
        }
        //print_r($resultsss);exit;
        //$resultsss = array_unique($resultsss);
        $resultsss = array_count_values($resultsss);
        
        arsort($resultsss);
        $resultsss = array_keys($resultsss);
        //echo "<pre>";
        //print_r($resultsss);exit;
        
        
        
           if(count($resultsss)>0){
           $k = 0;
           foreach($resultsss as $rsult){ 
            
             $sub_details = $this->Adminmodel->teacherAallocationSubjectt($rsult,$result['time_slot_id'],$subbid);
             //print_r($sub_details);exit;//7,9
             $subname = array();
             $subidd = array();
             $m = 0;
             foreach($sub_details as $subid){
              /*$subdetails[] = $this->Adminmodel->getsubject($subid['sub_id']);
              $subname[] = $subdetails[$m]['subject_name'];*/
              $subidd[] = $subid['sub_id'];
              $subdetails = $this->Adminmodel->getsubject($subid['sub_id']);
              $subname[] = $subdetails['subject_name'];
              /*foreach($subdetails as $sdet){
                $subname[] = $sdet['subject_name'];
              }*/
              $m = $m + 1;
             }
             //echo "<pre>";
             //print_r($subidd);exit;
             //$subname = $sub_details[$k]['subject_name'];
             
             $record = $this->Adminmodel->getTeachersBySubjects($rsult);
             
            ?>
              <?php
                if($sub_details != FALSE){
              ?>
              <tr>
              <input type="hidden" name="fetch_data[]" class="fetch_data" value="<?php echo $stuid.','.$tid.','.$subbid.','.$statuss ?>">  
              <input type="hidden" name="timeslot_id[]" class="timeslot_id" value="<?php echo $result['time_slot_id']; ?>">  
              <input type="hidden" name="student_id[]" class="student_id" value="<?php echo $stuid; ?>">
              <td><input type="checkbox" class="checkbox flah" id="checkbox" name="chk[]" value="<?php echo $record[0]['id'].'#'.implode('@',$subidd) ?>"></td>
              <td><input type="number" style="width:50px;" id="priority<?php echo $k; ?>" name="priority[]" class="priority"></td> 
              <td><?php echo implode(',',$subname); ?></td>
              <td><?php echo $record[0]['first_name']; ?></td>
              <td><?php echo $record[0]['mobile']; ?></td>
              <td><?php echo $record[0]['email']; ?></td>
              <td><?php
               if($record[0]['gender'] == 'm') echo 'Male'; else echo 'Female';
               ?></td>
              <td><?php echo $record[0]['dob']; ?></td>
            
              </tr>
              <?php } ?>
          
          <?php $k = $k + 1; }

          }

      }


  }
  
  public function getTeacher(){

    $teacher_id = $this->input->get('tid');
    $month = $this->input->get('month');
    $year = $this->input->get('year');
    //print_r($month);exit;
    $teacher_detail = $this->Adminmodel->teacherPresentDetail($teacher_id,$month,$year);
    //print_r($teacher_detail);exit;
    $lec_cost = $this->Adminmodel->getTeacherLectureCost($teacher_detail[0]['teacher']);
    //print_r($lec_cost);exit;
    if($teacher_detail[0]['stype'] == 'm'){
      $stype = 'Monthly';
    }else if($teacher_detail[0]['stype'] == 'l'){
      $stype = 'Lecture Based';
    }
    $tday = explode('-',$teacher_detail[0]['ldate']);
    //print_r($tday[2]);exit;
    ?>

    <div class="row">
    <div class="form-group col-md-4">
   <h4>Teaching Type</h4>
   <input type="text" name="type" class="form-control" value="<?php if(isset($stype)) echo $stype; ?>" readonly>
   </div>
   <div class="form-group col-md-4">
   <h4>Total Days</h4>
   <input type="text" name="total_days" value="<?php if(isset($stype)) echo $tday[2]; ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Total Present</h4>
   <input type="text" name="total_present" value="<?php if(isset($stype)) echo $teacher_detail[0]['psum']; ?>" class="form-control" >
   </div>
   
   </div>
   <div class="row">
    <?php if(isset($stype) && $teacher_detail[0]['stype'] == 'l'){ ?>
   <div class="form-group col-md-4">
   <h4>One Lecture Cost</h4>
   <input type="text" name="net_sal" value="<?php echo $lec_cost[0]['lcost']; ?>" class="form-control" >
   </div>
 <?php } ?>
 <?php if(isset($teacher_detail[0]['sal']) && !empty($teacher_detail[0]['sal'])){ ?>
   <div class="form-group col-md-4">
   <h4>Net Salary</h4>
   <input type="text" name="net_sal" value="<?php echo $teacher_detail[0]['sal']; ?>" class="form-control" >
   </div>
 <?php } ?>
   <div class="form-group col-md-4">
   <h4>Total Holiday</h4>
   <input type="text" name="total_holiday" id="total_holiday" value="0" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Total Absent</h4>
   <input type="text" name="total_absent" value="<?php if(isset($stype)) echo $tday[2]-$teacher_detail[0]['psum'] ?>" class="form-control" >
   </div>
   </div>
   <?php if(isset($stype) && $teacher_detail[0]['stype'] == 'l'){ ?>
<div class="row">
    <div class="form-group col-md-4">
   <h4>Total Working Days</h4>
   <input type="hidden" name="workingdays" id="workingdays" value="<?php if(isset($stype)) echo $teacher_detail[0]['psum']; ?>" class="form-control" >
   <input type="text" name="working_days" id="working_days" value="<?php if(isset($stype)) echo $teacher_detail[0]['psum']; ?>" class="form-control" >
   </div>
 </div>
   <?php } ?>
   <?php if(isset($teacher_detail[0]['sal']) && !empty($teacher_detail[0]['sal'])){ ?>
   <div class="row">
    <div class="form-group col-md-4">
   <h4>Total Working Days</h4>
   <input type="hidden" name="workingdays" id="workingdays" value="<?php if(isset($stype)) echo $teacher_detail[0]['psum']; ?>" class="form-control" >
   <input type="text" name="working_days" id="working_days" value="<?php if(isset($stype)) echo $teacher_detail[0]['psum']; ?>" class="form-control" >
   </div>
   <div class="form-group col-md-4">
   <h4>Less Amount in Salary(for absent)</h4>
   <input type="text" name="less_amount" value="0" class="form-control" >
   </div>
   </div>
   <?php } ?>

    <?php
    
  }

  public function calculate_salary(){

    //print_r($_POST);exit;
    extract($_POST);
    if($type == 'Monthly'){

      //echo 'Monthly';
      $salary = $net_sal-$less_amount;
      //print_r($salary);exit;
      ?>
    <div class="row">
   <div class="form-group col-md-4">
    <input type="hidden" name="rec" value="<?php echo $year.','.$month.','.$teacher.','.$type.','.$net_sal; ?>">
   <h4>Salary</h4>
   <input type="text" name="insert_sal" id="insert_sal" class="form-control" value="<?php echo $salary ?>">
   </div>
   <div class="form-group col-md-4">
    <h4>Select Payment Method</h4>
    <select name="pay_method" id="pay_method" class="form-control">
    
    <option value="Online">Online</option>
    <option value="Cash">Cash</option>
    <option value="Cheque">Cheque</option>


    </select>
   </div>
   </div>
   <div class="row">
     <div class="form-group col-md-4">
      <h4 id="idno">Transactional Id</h4>
      <input type="text" name="tranid" class="form-control">
     </div>
     <div class="form-group col-md-4">
      <h4>Select Date</h4>
      <input type="date" name="pay_date" class="form-control">

     </div>  
    </div>
    <div class="row">
     <div class="form-group col-md-4">
     <h4>Remark</h4>
     <textarea name="remark" class="form-control"></textarea>

     </div>
    </div>
   
    
     <div class="row">
     <div class="form-group col-md-4">
   
   <button type="submit" name="add_salary" id="add_salary" class="btn btn-primary">Add Salary</button>
   </div>
   </div>
      <?php

    }else if($type == 'Lecture Based'){

      //echo 'Lecture Based';
      $salary = $net_sal*$working_days;
      //print_r($salary);exit;
      ?>
      <div class="row">
   <div class="form-group col-md-4">
   <input type="hidden" name="rec" value="<?php echo $year.','.$month.','.$teacher.','.$type.','.$net_sal; ?>">
   <h4>Salary</h4>
   <input type="text" name="insert_sal" id="insert_sal" class="form-control" value="<?php echo $salary ?>">
   </div>
   <div class="form-group col-md-4">
    <h4>Select Payment Method</h4>
    <select name="pay_method" id="pay_method" class="form-control">
    
    <option value="Online">Online</option>
    <option value="Cash">Cash</option>
    <option value="Cheque">Cheque</option>


    </select>
   </div>
   
   
   </div> 
    <div class="row">
     <div class="form-group col-md-4">
      <h4 id="idno">Transactional Id</h4>
      <input type="text" name="tranid" class="form-control">
     </div>
     <div class="form-group col-md-4">
      <h4>Select Date</h4>
      <input type="date" name="pay_date" class="form-control">

     </div>  
    </div>
    <div class="row">
     <div class="form-group col-md-4">
     <h4>Remark</h4>
     <textarea name="remark" class="form-control"></textarea>

     </div>
    </div>
    <div class="row">
    <div class="form-group col-md-4">
   
    <button type="submit" name="add_salary" id="add_salary" class="btn btn-primary">Add Salary</button>
    </div>
    </div>

      <?php
    }
    

  }

  public function save_salary(){

   //print_r($_POST);exit;
   $get_rec = $this->Adminmodel->existTeacherSalary();
   //print_r($get_rec);exit;
   if($get_rec == FALSE){
       $record = $this->Adminmodel->addTeacherSalary();
       if($record != FALSE){
        echo 'Salary Added Successfully';
   }
   }else{
      echo 'Salary already added';
   }
   

  }

  public function get_subject_by_class(){

    $class_id = $this->input->get('class_id');
    $result = $this->Adminmodel->getSubjectByClass($class_id);
    //echo '<pre>';
    //print_r($result);exit;
    if(count($result) > 0){
      $count = 0;
         foreach($result as $row){
              ?>
              <tr>
              <td><?php echo ++$count;  ?></td>
              <td><?php echo $row['classname']  ?></td>
              <td><?php echo $row['subject_name']  ?></td>
              <td><?php echo $row['updated_at']  ?></td>
              <td><a href="<?php echo base_url('update_subject?updsub='.$row['id']) ?>">Edit</a></td>
              <td><a onclick="return confirm('are you sure')" href="<?php echo base_url('subject?delsub='.$row['id']) ?>">Delete</a></td>
              </tr>
              
              <?php
            }
           
        }
        else{
          ?>
          <option>Record Not Found</option>
          <?php
        } 

  }

  public function teacher_salary(){

    //echo 'working'; exit;
    $result = $this->Adminmodel->getTeacherSalaryReport();
    //print_r($result);exit;
    if(count($result) > 0){
      $count = 0;
         foreach($result as $row){
              ?>
              <tr>
              <td><?php echo ++$count;  ?></td>
              <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']  ?></td>
              <td><?php echo $row['salary']  ?></td>
              <td><?php echo $row['paid_salary']  ?></td>
              <td><?php echo $row['year']  ?></td>
              <td><?php echo $row['month']  ?></td>
              <td><?php echo $row['type']  ?></td>
              <td><?php echo $row['payment_method']  ?></td>
              <td><?php echo $row['transaction_id']  ?></td>
              <td><?php echo $row['pay_date']  ?></td>
              <td><?php echo $row['remark']  ?></td>
              
              </tr>
              
              <?php
            }
           
        }
        else{
          ?>
          <option>Record Not Found</option>
          <?php
        }

  }

  public function getStudentByClass(){
      $class_id = $this->input->get('class_id');
      $result = $this->Adminmodel->getStudentByClass($class_id);
      if(count($result) > 0){
      $count = 0;
         foreach($result as $row){
              ?>
              <tr>
              <td><input type="radio" class="radio" id="stuid<?php echo $row['id']; ?>" name="stuid" value="<?php echo $row['id']; ?>"><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'('.$row['id'].')'; ?></td>
              
              </tr>
              
              <?php
            }
           
        }
        else{
          ?>
          <tr>
          <td>Record Not Found</td>
          </tr>
          <?php
        }


  }

  public function getStudentFees(){
      $stuid = $this->input->get('stuid');
      $result = $this->Adminmodel->getStudent($stuid);
      //print_r($result);exit;
      echo json_encode(array("student_details"=>$result));

  }

  public function submitStudentFees(){

    $record = $this->Adminmodel->checkStudentFees();
    if($record != FALSE){
      echo 'Fees already submitted';
    }else{
      $result = $this->Adminmodel->submitStudentFees();
        if($result != FALSE){
          echo 'Fees Submitted Successfully';
        }
    }
    
    
  }

  public function addTimeSlot(){

    //print_r($_POST);exit;
    $res = $this->Loginmodel->checkLogin($this->session->userdata('uid'));
      
    if($res['inst_tbl_id'] != False){
         $inst_tbl = $this->Loginmodel->getInstitute($res['inst_tbl_id']);
         //print_r($inst_tbl);exit;
         $record = $this->Adminmodel->getsTimeSlot($inst_tbl['id']);
         if($record != FALSE){
          echo('Time Slot Already Added');
        }else{
          
          $result = $this->Adminmodel->addTimeSlot($inst_tbl['id']);
         if($result != FALSE){
          echo('Time Slot Added Successfully');
        }
         

         }
       }
  }

  public function updateTimeSlot(){

    //print_r($_POST);exit;
    $result = $this->Adminmodel->updateTimeSlot();
    if($result != FALSE){
         echo('Time Slot Updated Successfully');

    }

  }

  public function upload_csv(){
    //print_r($_FILES['csvfile']['tmp_name']); exit;
    $file = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($file,"r");
    $i = 0;
    while(($cont = fgetcsv($handle,1000,","))!=false)
    {
      if($i == 0){

      }else{
        $result = $this->Adminmodel->uploadCsvTeacher($cont);
      }
         
      $i++;
         
    }
    if($result != FALSE){
          echo 'record uploaded successfully..';
    }

  }

  public function upload_student_csv(){
    //print_r($_FILES['csvfile']['tmp_name']); exit;
    $file = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($file,"r");
    $i = 0;
    while(($cont = fgetcsv($handle,1000,","))!=false)
    {
      if($i == 0){

      }else{
        $result = $this->Adminmodel->uploadCsvStudent($cont);
      }
         
      $i++;
         
    }
    if($result != FALSE){
          echo 'record uploaded successfully..';
    }

  }

  public function student_fees_report(){
    //echo 'working';exit;
    $class = $this->input->post('class');
    $student = $this->input->post('student');
    $month = $this->input->post('month');
    $year = $this->input->post('year');
    //print_r($year);exit;
    $student_detail = $this->Adminmodel->studentFeesReport($class,$student,$month,$year);
    //print_r($student_detail);exit;
    if($student_detail != FALSE){
       if(count($student_detail) > 0){
      $count = 0;
         foreach($student_detail as $row){
              ?>
              <tr>
              <td><?php echo ++$count; ?></td>
              <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?></td>
              <td><?php echo $row['classname']; ?></td>
              <td><?php echo $row['year']; ?></td>
              <td><?php echo $row['month']; ?></td>
              <td><?php echo $row['total_fees']; ?></td>
              <td><?php echo $row['discount']; ?></td>
              <td><?php echo $row['submit_fees']; ?></td>
              <td><?php echo $row['sdate']; ?></td>
              
              </tr>
              
              <?php
            }
           
        }
        else{
          ?>
          <tr>
          <td>Record Not Found</td>
          </tr>
          <?php
        }
    }
  }
  public function student_fee_receipt(){
    //echo 'working';exit;
    $class = $this->input->post('class');
    $student = $this->input->post('student');
    $month = $this->input->post('month');
    $year = $this->input->post('year');
    //print_r($year);exit;
    $student_detail = $this->Adminmodel->studentFeesReport($class,$student,$month,$year);
    //print_r($student_detail);exit;
    if($student_detail != FALSE){
       if(count($student_detail) > 0){
      $count = 0;
         foreach($student_detail as $row){
              ?>
              <tr>
              <td><?php echo ++$count; ?></td>
              <td><a href="print_receipt?pid=<?php echo $row['id'] ?>" target="_blank">Print</a></td>
              <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?></td>
              <td><?php echo $row['classname']; ?></td>
              <td><?php echo $row['year']; ?></td>
              <td><?php echo $row['month']; ?></td>
              <td><?php echo $row['total_fees']; ?></td>
              <td><?php echo $row['discount']; ?></td>
              <td><?php echo $row['submit_fees']; ?></td>
              <td><?php echo $row['sdate']; ?></td>
              
              </tr>
              
              <?php
            }
           
        }
        else{
          ?>
          <tr>
          <td>Record Not Found</td>
          </tr>
          <?php
        }
    }
  }
  public function get_student_by_class(){
      $class = $this->input->get('class_id'); 
      $result = $this->Adminmodel->get_student_by_class($class);
      //print_r($result);exit;
      if($result != FALSE){
       if(count($result) > 0){
      $count = 0; ?>
              <option value="">Select</option>
     <?php    foreach($result as $row){
              ?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'] ?></option>
              
              <?php
            }
           
        }
        
    } 
      else{
          ?>
          
          <option value="">Record Not Found</option>
          
          <?php
        }
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