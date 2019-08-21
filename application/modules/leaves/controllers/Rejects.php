<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rejects extends MX_Controller {

	public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }
        
        $this->load->model('Leave');
        
        $link['title']  = 'Leave Management Reject';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Leave->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $select = array(
                'trans_cd', 'trans_dt', 'from_dt', 'to_dt',
                'amount', 'leave_type', 'emp_code'
            );

            //Approve Leave Application
            $where  =   array(

                "emp_code"                =>  $this->input->post('emp_code'),

                "approval_status"         =>  1,
                
                "rejection_status"        =>  0,
                
                "month(trans_dt)"         =>  $this->input->post('month'),
                
                "year(trans_dt)"          =>  $this->input->post('year')

            );
            
            $data['leave_dtls']    =   $this->Leave->f_get_particulars("td_leaves_trans", $select, $where, 0);

            $this->load->view('reject/dashboard', $data);

            $script['script'] = [
                
                '/assets/plugins/footable/js/footable.all.min.js',

                '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
            
            ];

            $this->load->view('footer', $script);

        }
        else{
            
            $script['script'] = NULL;

            //Month List
            $data['month_list'] =   $this->Leave->f_get_particulars("md_month",NULL, NULL, 0);

            //Employee List
            $select = array(
            
                "m.emp_code", "m.emp_name", "d.dept_name department",
                "m.designation", "m.img_path"
                
            );

            $where  = array(

                "m.emp_code = t.emp_code"   => NULL,
                "m.department = d.sl_no"    => NULL,
                "m.emp_status" => 'A'
                        
            ); 

            $data['employee_dtls'] = $this->Leave->f_get_particulars('md_employee m, md_departments d, td_pay_statement t', $select, $where, 0);

            $this->load->view('reject/form', $data);

            $this->load->view('footer', $script);

        }

    }

    //Reject Form
    public function f_delete(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $data_array = array(
                
                'rejection_status' => 1,
                'rejection_remarks' => 'Rejected',
                'rejected_by' => $this->session->userdata('loggedin')->user_name,
                'rejected_dt' => date('Y-m-d h:i:s')
            );

            $this->Leave->f_edit('td_leaves_trans', $data_array, array("trans_cd" => $this->input->post('trans_cd')));

            $this->Leave->f_delete('td_leave_dates', array("trans_cd" => $this->input->post('trans_cd')));
            
            switch ($this->input->post('type')){
                
                case 'M': 
                    $select = array(
                        "emp_code",
                        "ml_bal bal",
                        "MAX(balance_dt) balance_dt"
                        
                    );
                    break;

                case 'E': 
                    $select = array(
                        "emp_code",
                        "el_bal bal",
                        "MAX(balance_dt) balance_dt"
        
                    );
                    break;   
                    
                case 'C': 
                    $select = array(
                        "emp_code",
                        "comp_off_bal bal",
                        "MAX(balance_dt) balance_dt"
        
                    );
                    break;

                case 'HM': 
                    $select = array(
                        "emp_code",
                        "ml_bal bal",
                        "MAX(balance_dt) balance_dt"
                        
                    );
                    break;

                case 'HE': 
                    $select = array(
                        "emp_code",
                        "el_bal bal",
                        "MAX(balance_dt) balance_dt"
        
                    );
                    break;   
                    
                case 'HC': 
                    $select = array(
                        "emp_code",
                        "comp_off_bal bal",
                        "MAX(balance_dt) balance_dt"
        
                    );
                    break;
            }

            $maxDate = $this->Leave->f_get_particulars('td_leave_balance', $select, array('emp_code = "'.$this->input->post('emp_code').'" GROUP BY emp_code, bal' => NULL), 1);

            switch ($this->input->post('type')){
                
                case 'M': 
                    $data_array = array(

                        "ml_bal" => $maxDate->bal + $this->input->post('amount')
                        
                    );
                    break;

                case 'E': 
                    $data_array = array(

                        "el_bal" => $maxDate->bal + $this->input->post('amount')
        
                    );
                    break;   
                    
                case 'C': 
                    $data_array = array(

                        "comp_off_bal" => $maxDate->bal + $this->input->post('amount')
        
                    );
                    break;

                case 'HM': 
                    $data_array = array(

                        "ml_bal" => $maxDate->bal + $this->input->post('amount')
                        
                    );
                    break;

                case 'HE': 
                    $data_array = array(

                        "el_bal" => $maxDate->bal + $this->input->post('amount')
        
                    );
                    break;   
                    
                case 'HC': 
                    $data_array = array(

                        "comp_off_bal" => $maxDate->bal + $this->input->post('amount')
        
                    );
                    break;
            }

            $this->Leave->f_edit('td_leave_balance', $data_array, array('emp_code' => $this->input->post('emp_code'), 'balance_dt' => $maxDate->balance_dt));
            
            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully Rejected!',
                
                'status'    => 'danger'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('leave/reject');
        }

    }

}