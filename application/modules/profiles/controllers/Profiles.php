<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends MX_Controller {

	public function __construct(){

        parent::__construct();

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        $this->load->model('Profile');
        
        $link['link']   =   ["/assets/plugins/dropify/dist/css/dropify.min.css"];

        $link['title']  = 'Profile Manage';

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Profile->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);

        $this->load->view('header', $link);

    }

    public function index(){

        //Profile Details
        $select = array(
            
            "m.emp_code", "m.emp_name", "m.email",
            "m.img_path", "u.password", "m.phn_no"
        
        );

        $where = array(

            "m.emp_code = u.user_id" => NULL,

            "m.emp_code" => $this->session->userdata('loggedin')->user_id

        );

        $profile['profile_dtls']    =   $this->Profile->f_get_particulars("md_employee m, md_users u", $select, $where, 1);
        
        $this->load->view('dashboard', $profile);

        $script['script'] = ["/assets/plugins/dropify/dist/js/dropify.min.js"];

        $this->load->view('footer', $script);
        
    }

    public function f_upload() {

        if(isset($_FILES["imgfile"]["name"])){
            
            $config['upload_path']  = FCPATH.'assets/images/users/';
        
            $config['allowed_types'] = 'gif|jpg|jpeg|png';

            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if(! $this->upload->do_upload("imgfile")){

                echo $this->upload->display_errors();

            }
            else{

                $this->upload->data();

                $data_array = array(

                    "img_path"  => 'assets/images/users/'.$_FILES["imgfile"]["name"]

                );

                $prevLink = $this->Profile->f_get_particulars("md_employee", array("img_path"), array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


                if($prevLink->img_path != 'assets/images/users/profile.png'){

                    unlink(FCPATH.$prevLink->img_path);

                }
                    

                $this->Profile->f_edit("md_employee", $data_array, array("emp_code" => $this->session->userdata('loggedin')->user_id));

            }

        }
        
        exit;

    }

    public function f_changepass(){
        
        $oldPass = $this->input->post('old_pass');
		$newPass = $this->input->post('new_pass');
		$matchPass = $this->Profile->matchPass($oldPass);
		$temp = password_verify($oldPass,$matchPass->password);
        
		if ($temp) {

			$password = password_hash($newPass, PASSWORD_DEFAULT);
            $msgPass = $this->Profile->editPassProcess($password);
            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Password changed!',
                
                'status'    => 'success'
                
            );

        }
        else{

            $message    =   array( 
                    
                'message'   => 'Old password was wrong',
                
                'status'    => 'danger'
                
            );

        }

        $this->session->set_flashdata('msg', $message);

        redirect('profile');
    }

}