<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class Reports extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Attendance');

        $link['title']  = 'Attendance Details';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Attendance->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);

        $this->load->view('header', $link);
        
    }

    //For All Employees
    public function f_all_emp(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Attendance List
            $select =   array(
                
                "t.attendance_dt", "e.emp_code", "e.emp_name", 
                "e.img_path", "d.dept_name department", "t.status"
            );

            $where  =   array(

                "t.emp_code = e.emp_code" =>  NULL,
                
                "e.department = d.sl_no"   =>  NULL,

                "t.attendance_dt"  => $this->input->post('date')
                
            );

            $attendance['attendance_dtls']    =   $this->Attendance->f_get_particulars("td_attendances t, md_employee e, md_departments d", $select, $where, 0);

            $this->load->view("reports/allEmp", $attendance);

            $script['script'] = NULL;

            $this->load->view('footer', $script);

        }
        else {

            $this->load->view('reports/allEmp');

            $script['script'] = NULL;

            $this->load->view('footer', $script);

        }

    }

    //For Individual Employee Form
    public function f_ind_emp(){

        //Employee List
        $select = array(
            
            "m.emp_code", "m.emp_name", "d.dept_name department"
        );

        $where  = array(

            "m.department = d.sl_no"  => NULL
        ); 

        $data['employee_dtls']    =   $this->Attendance->f_get_particulars("md_employee m, md_departments d", $select, $where, 0);

        $this->load->view('reports/indEmpForm', $data);

        $script['script'] = NULL;

        $this->load->view('footer', $script);

    }
    

    //For Individual Reports
    public function f_details_emp(){
        //Attendance List
        $select =   array(
                
            "t.attendance_dt", "e.emp_code", "e.emp_name", 
            "d.dept_name department", "t.status"
        );

        $where  =   array(

            "t.emp_code = e.emp_code" =>  NULL,
            
            "e.department = d.sl_no"   =>  NULL,
            
            "e.emp_code" =>  ($this->input->get('emp_code'))? $this->input->get('emp_code') : $this->session->userdata('loggedin')->user_id,

            "t.attendance_dt BETWEEN '".$this->input->get('from_date')."' AND '".$this->input->get('to_date')."'"  => NULL
            
        );

        $attendance['attendance_dtls']    =   $this->Attendance->f_get_particulars("td_attendances t, md_employee e, md_departments d", $select, $where, 0);

        $this->load->view("reports/indEmpReport", $attendance);

        $script['script'] = NULL;

        $this->load->view('footer', $script);

        $script['script'] = NULL;

        $this->load->view('footer', $script);

    }

}