<?php

class Login extends CI_Controller{

    public function __construct(){
    
        parent::__construct();
        $this->load->model('Loginmodel');
      
  
     
  
    }

	public function index(){

    if($this->session->userdata('id'))
        return redirect('admin/dashboard');

	$this->load->view('public/adminlogin');



}

	 public function admin_login()
    {
        if(is_numeric($this->input->post('username')))
        {
           $this->form_validation->set_rules('username', 'Username', 'trim|required|numeric|max_length[10]');
        }
        else
        {
           $this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email');
        }

      
      $this->form_validation->set_rules('password', 'Password', 'required');
      //$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     if($this->form_validation->run())
     {
        $username=$this->input->post('username');
        $password=$this->input->post('password');
      //  echo "$username and $password";
        
        $login_id=$this->loginmodel->login_valid();
        if($login_id)
        {
             //echo "valid user" ;
        	$this->session->set_userdata('id',$login_id);
        	//$this->load->view('admin/dashboard');
        	return redirect('admin/dashboard');
        }
        else
        {
            $this->session->set_flashdata('login_failed','Invalid Username/Password');
             return redirect('login');

        }
     }
     else
     {
       /* echo "Login Failed";
        echo validation_errors();*/
        $this->load->view('public/adminlogin');
     }

    }


public function logout()
{
        $this->session->unset_userdata('id');
        return redirect('login');

}


}