<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class Payslips extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Payroll');

        $this->load->model('Auth');

        $link['title']  = "Payslip";

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Payroll->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);

        //Notification for HOD and HR
        $userType   =   $this->session->userdata('loggedin')->emp_type;

        $userId     =   $this->session->userdata('loggedin')->user_id;

        if($userType == 'H'){  

            $link['totLv']      =   $this->Auth->f_get_hod_recom($userId);

            $link['totComp']    =   $this->Auth->f_get_hod_comp($userId);                

        }elseif($userType == 'HR'){

            $link['totLv']      =   $this->Auth->f_get_hr_recom();

            $link['totComp']    =   $this->Auth->f_get_hr_comp();
        }


        $this->load->view('header', $link);
        
    }


    //Latest unapproved salary statement of employees'
    public function index(){

        $script['script'] = [
        
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];
        
        //Employee List
        $select = array(
            
            "trans_dt", "month", "year", "net_amount"
                    
        );
        
        $where  = array(

            "emp_code = '".$this->session->userdata('loggedin')->user_id."' ORDER BY trans_dt DESC" => NULL
                    
        ); 

        $data['pay_list'] = $this->Payroll->f_get_particulars('td_pay_slip', $select, $where, 0);
    
        $this->load->view("payslip/dashboard", $data);

        $this->load->view('footer', $script);

    }

    public function f_view(){
        
        $script['script'] = [];

        $where = array(
            
            "month"     => $this->input->get('month'),
            "year"      => $this->input->get('year'),
            "emp_code"  => $this->session->userdata('loggedin')->user_id

        );

        $data['pay_list'] = $this->Payroll->f_get_particulars('td_pay_slip', NULL, $where, 1);
        
        $this->load->view("payslip/salaryslip", $data);

        $this->load->view('footer', $script);

    }
	
}
    
?>
