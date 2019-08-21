<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForwardLeaves extends MX_Controller {

	public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        if($this->session->userdata('loggedin')->emp_type != 'HR'){
            
            redirect('auths/home');
            
        }
        
        $this->load->model('Leave');
        
        $link['title']  = 'Leave Management ForwardLeave';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Leave->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        $script['script'] = [];
        
        $this->load->view("forwardLeave/form");

        $this->load->view('footer', $script);

    }

    //ForwardLeave Form
    public function f_operations(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Get Param Values
            $where = array(

                "sl_no BETWEEN 8 AND 12 ORDER BY sl_no" => NULL

            );

            $data['param_val']  =   $this->Leave->f_get_particulars("md_parameters", array("sl_no", "param_value"), $where, 0);

            //Employees' Leave Balances
            $select =    array(

                "o.emp_code", "m.emp_catg", "o.ml_bal",
                "o.el_bal", "o.comp_off_bal"

            );

            $where  =   array(

                "o.emp_code = i.emp_code"       => NULL,

                "o.emp_code = m.emp_code"       => NULL,
                
                "o.balance_dt = i.balance_dt"   => NULL,

                "m.emp_status" => 'A'

            );

            $sql = "(SELECT `emp_code`, MAX(balance_dt) balance_dt FROM `td_leave_balance` GROUP BY emp_code) i";

            $data['leave_bal']  = $this->Leave->f_get_particulars('td_leave_balance o,'.$sql.', md_employee m', $select, $where, 0);

            for($i = 0; $i < count($data['leave_bal']); $i++) {
                
                if($data['leave_bal'][$i]->emp_catg == 'C'){

                    $data_array =   array(

                        "balance_dt"    =>  date('Y-m-d'),

                        "emp_code"      =>  $data['leave_bal'][$i]->emp_code,
                        
                        "trans_cd"      =>  date('Y').'0',

                        "ml_bal"        =>  0,
                        
                        "el_bal"        =>  (($data['leave_bal'][$i]->el_bal + $data['param_val'][1]->param_value) >= $data['param_val'][4]->param_value)? 48 : $data['leave_bal'][$i]->el_bal + $data['param_val'][1]->param_value,
                        
                        "comp_off_bal"  =>  0

                    );
                
                    $this->Leave->f_insert("td_leave_balance", $data_array);


                }
                else if($data['leave_bal'][$i]->emp_catg == 'P'){

                    $data_array =   array(

                        "balance_dt"    =>  date('Y-m-d'),

                        "emp_code"      =>  $data['leave_bal'][$i]->emp_code,
                        
                        "trans_cd"      =>  date('Y').'0',

                        "ml_bal"        =>  0,
                        
                        "el_bal"        =>  (($data['leave_bal'][$i]->el_bal + $data['param_val'][0]->param_value) >= $data['param_val'][4]->param_value)? 48 : $data['leave_bal'][$i]->el_bal + $data['param_val'][0]->param_value,
                        
                        "comp_off_bal"  =>  0

                    );
                
                    $this->Leave->f_insert("td_leave_balance", $data_array);

                }

            }

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Leave Successfully Forwarded!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
            
            redirect('leave/forwardLeaves');

        }

    }    

}