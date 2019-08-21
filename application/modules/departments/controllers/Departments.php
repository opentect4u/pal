<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends MX_Controller {

	public function __construct(){

        parent::__construct();

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        $this->load->model('Department');
        
        $link['title']  = 'Department Management';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Department->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js'
        
        ];
        
        //Department List
        $select = array("sl_no", "dept_name");

        $department['department_dtls']    =   $this->Department->f_get_particulars("md_departments", $select, NULL, 0);
        
        
        //Department List
        $department['department']    =   $this->Department->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        $this->load->view("department/dashboard", $department);

        $this->load->view('footer', $script);
        

    }

    //Department Add Form
    public function f_add(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Department Details
            $data_array = array (

                "sl_no"            =>  $this->input->post('sl_no'),
    
                "dept_name"        =>  $this->input->post('dept_name'),
    
                "sl_no"         =>  $this->input->post('sl_no'),
    
                "created_by"       =>  $this->session->userdata('loggedin')->user_name,
    
                "created_dt"       =>  date('Y-m-d h:i:s')
    
            );
            
            $this->Department->f_insert('md_departments', $data_array);
            
            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully added!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('departments');
        }

        //Dependencies
        $data['url']    = 'add';
        $data['type']   = 'hidden';
        $data['title']  = 'Add New Department';

        //Forwarding Null Value to view
        $data['data'] = (object) array ( "sl_no"         =>    NULL,

                                        "dept_name"      =>    NULL,

                                    );
        
        //Department List
        $data['department']    =   $this->Department->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        echo $this->load->view('department/form', $data, TRUE);

        exit;

    }

    //Department Edit Form
    public function f_edit(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $data_array = array (
    
                "dept_name"        =>  $this->input->post('dept_name'),
    
                "sl_no"         =>  $this->input->post('sl_no'),
    
                "modified_by"      =>  $this->session->userdata('loggedin')->user_name,
    
                "modified_dt"      =>  date('Y-m-d h:i:s')
    
            );
    
            $this->Department->f_edit('md_departments', $data_array, array("sl_no" => $this->input->post('sl_no')));
    
            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully updated!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('departments');

        }

        //Dependencies
        $data['url']    = 'edit';
        $data['type']   = 'hidden';
        $data['title']  = 'Edit Department';
        
        //Department Details
        $select = array(

            "sl_no", "dept_name"
        );

        $data['data']          = $this->Department->f_get_particulars("md_departments", $select, array("sl_no" => $this->input->get('sl_no')), 1);

        echo $this->load->view('department/form', $data, TRUE);

        exit;

    }

}