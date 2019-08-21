<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MX_Controller {

	public function __construct(){

        parent::__construct();

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        $this->load->model('Employee');
        
        $link['title']  = 'Employee Management';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Employee->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];
        
        //Employee List
        $select = array(
            
                    "m.emp_code", "m.emp_name", "d.dept_name department",
                    "m.designation", "m.email", "m.img_path", "m.emp_status"
                    
        );
        
        $where  = array(

                    "m.department = d.sl_no"    => NULL
        ); 

        $employee['employee_dtls']    =   $this->Employee->f_get_particulars("md_employee m, md_departments d", $select, $where, 0);
        
        $this->load->view("employee/dashboard", $employee);

        $this->load->view('footer', $script);

    }

    //For Status Update of Farmer
    public function f_updateStatus(){

        $value =  ($this->input->get('value') == "A")? "I":"A";

        $this->Employee->f_edit('md_employee', array("emp_status" => $value), array('emp_code' => $this->input->get('trans_id')));
        $this->Employee->f_edit('md_users', array("user_status" => $value), array('user_id' => $this->input->get('trans_id')));

        echo $value;

        exit();
    }

    //Employee Add Form
    public function f_add(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Employee Details
            $data_array = array (

                "emp_code"         =>  $this->input->post('emp_code'),
    
                "emp_name"         =>  $this->input->post('emp_name'),
    
                "emp_catg"         =>  $this->input->post('emp_catg'),
    
                "joining_date"     =>  $this->input->post('join_dt'),
                
                "phn_no"           =>  $this->input->post('phn_no'),
                
                "email"            =>  $this->input->post('email'),

                "gurd_name"        =>  $this->input->post('gurd_name'),

                "marital_status"   =>  $this->input->post('marital_status'),

                "gender"           =>  $this->input->post('gender'),

                "designation"      =>  $this->input->post('designation'),
                
                "department"       =>  $this->input->post('department'),
                
                "emp_type"         =>  $this->input->post('emp_type'),

                "img_path"         =>  "assets/images/users/profile.png",
                
                "created_by"       =>  $this->session->userdata('loggedin')->user_name,
    
                "created_dt"       =>  date('Y-m-d h:i:s')
    
            );
            
            $this->Employee->f_insert('md_employee', $data_array);
            
            //User Details
            unset($data_array);
            
            $data_array = array (

                "user_id"          =>  $this->input->post('emp_code'),
    
                "password"         =>  '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy',
    
                "user_name"        =>  $this->input->post('emp_name'),
                
                "user_status"      =>  'A',
                
                "created_by"       =>  $this->session->userdata('loggedin')->user_name,
    
                "created_dt"       =>  date('Y-m-d h:i:s')
    
            );

            $this->Employee->f_insert('md_users', $data_array);

            //User Details
            unset($data_array);

            $data_array = array (

                "balance_dt"        =>  date('Y-m-d'),
    
                "trans_cd"          =>  date('Y').'1',
    
                "emp_code"          =>  $this->input->post('emp_code'),
                
                "ml_bal"            =>  0,
                
                "el_bal"            =>  0,
    
                "comp_off_bal"      =>  0
    
            );

            $this->Employee->f_insert('td_leave_balance', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully added!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('employees');
        }

        //Dependencies
        $data['url']    = 'add';
        $data['type']   = 'text';
        $data['title']  = 'Add New Employee';

        //Forwarding Null Value to view
        $data['emp'] = (object) array ( "emp_code"         =>    NULL,

                                        "emp_name"         =>    NULL,

                                        "emp_catg"         =>    NULL,

                                        "joining_date"     =>    NULL,
                                        
                                        "phn_no"           =>    NULL,
                                        
                                        "email"            =>    NULL,
                                        
                                        "gurd_name"        =>    NULL,
                                        
                                        "marital_status"   =>    NULL,
                                        
                                        "gender"           =>    NULL,
                                        
                                        "designation"      =>    NULL,
                                        
                                        "department"       =>    NULL,

                                        "emp_type"         =>    NULL,

                                        "termination_date" =>    NULL

                                    );
        
        //Department List
        $data['department']    =   $this->Employee->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        echo $this->load->view('employee/form', $data, TRUE);

        exit;

    }

    //Employee Edit Form
    public function f_edit(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $data_array = array (

                "emp_code"         =>  $this->input->post('emp_code'),
    
                "emp_name"         =>  $this->input->post('emp_name'),
    
                "emp_catg"         =>  $this->input->post('emp_catg'),
    
                "joining_date"     =>  $this->input->post('join_dt'),
                
                "phn_no"           =>  $this->input->post('phn_no'),
                
                "email"            =>  $this->input->post('email'),
                
                "gurd_name"        =>  $this->input->post('gurd_name'),

                "marital_status"   =>  $this->input->post('marital_status'),

                "gender"           =>  $this->input->post('gender'),

                "designation"      =>  $this->input->post('designation'),
                
                "department"       =>  $this->input->post('department'),
                
                "emp_type"         =>  $this->input->post('emp_type'),

                "termination_date" =>  ($this->input->post('termination_dt'))? $this->input->post('termination_dt') : NULL,

                "modified_by"      =>  $this->session->userdata('loggedin')->user_name,
    
                "modified_dt"      =>  date('Y-m-d h:i:s')
    
            );

            $this->Employee->f_edit('md_employee', $data_array, array("emp_code" => $this->input->post('emp_code')));
            
            if($this->input->post('reset_pass') == "R"){

                $this->Employee->f_edit('md_users', array("password" => '$2y$10$I5RflPqwjOrxRneEL0V/ROxvDIgXy9eUkjSiTAnPbBj3LnFSRuwJy'), array("user_id" => $this->input->post('emp_code')));
            
            }
    
            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully updated!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('employees');

        }

        //Dependencies
        $data['url']    = 'edit';
        $data['type']   = 'hidden';
        $data['title']  = 'Edit Employee';
        
        //Employee Details
        $select = array(

            "emp_code", "emp_name", "emp_catg", "joining_date",
            "phn_no", "email", "designation", "department", "emp_type",
            "termination_date", "gurd_name", "marital_status",
            "gender"

        );

        $data['emp'] = $this->Employee->f_get_particulars("md_employee", $select, array("emp_code" => $this->input->get('emp_no')), 1);

        //Department List
        $data['department']    =   $this->Employee->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        echo $this->load->view('employee/form', $data, TRUE);

        exit;

    }

}