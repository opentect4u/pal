<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class Payrolls extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Payroll');

        $this->load->model('Auth');

        $link['title']  = 'Payroll Details';

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

    public function f_payslipdetails(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $select =   array(

                "emp_code",
                "emp_name",
                "department",
                "designation",
                "basic",
                "da",
                "hra",
                "conveyance",
                "incentives",
                "misc_ear",
                "others",
                "pf",
                "esi",
                "p_tax",
                "advance",
                "tds",
                "lwf",
                "accommodation",
                "laundry",
                "misc",
                "deduct_for_absent",
                "deduct_for_half",
                "tot_earnings",
                "tot_deduction",
                "net_amount",
                "bank_name",
                "bank_ac_no",
                "pf_ac_no",
                "esi_no",
                "pan_no",
                "ifsc",
                "base_or_eligibitity"

            );

            if($this->input->post('emp_code')){

                $where = array(
                    "month" => $this->input->post('month'),
                    "year"  => $this->input->post('year'),
                    "emp_code" => $this->input->post('emp_code')
                );
            }
            else{
                $where = array(

                    "month" => $this->input->post('month'),
                    "year"  => $this->input->post('year')
    
                );
            }

            $data['pay_dtls']   = $this->Payroll->f_get_particulars('td_pay_slip', $select, $where, 0);            

            //Sum of earnings & deductions
            unset($select);
            $select = array(

                "SUM(basic) basic",
                "SUM(da) da",
                "SUM(hra) hra",
                "SUM(conveyance) conveyance",
                "SUM(incentives) incentives",
                "SUM(misc_ear) misc_ear",
                "SUM(others) others",
                "SUM(pf) pf",
                "SUM(esi) esi",
                "SUM(p_tax) p_tax",
                "SUM(advance) advance",
                "SUM(misc) misc",
                "SUM(tds) tds",
                "SUM(lwf) lwf",
                "SUM(accommodation) accommodation",
                "SUM(laundry) laundry",
                "SUM(deduct_for_absent) deduct_for_absent",
                "SUM(deduct_for_half) deduct_for_half",
                "SUM(tot_earnings) tot_earnings",
                "SUM(tot_deduction) tot_deduction",
                "SUM(net_amount) net_amount"

            );

            $data['sum_dtls']   = $this->Payroll->f_get_particulars('td_pay_slip', $select, $where, 1);            

            $this->load->view('reports/payslips', $data);

            $script['script'] = [
                '/assets/plugins/datatables/jquery.dataTables.min.js'
            ];

            $script['cdnscript'] = [
            
                "https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js",
                "https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js",
                "https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"
            ];

            $this->load->view('footer', $script);
            
        }
        else{

            $script['script'] = NULL;

            //Month List
            $data['month_list'] =   $this->Payroll->f_get_particulars("md_month",NULL, NULL, 0);

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

            $data['employee_dtls'] = $this->Payroll->f_get_particulars('md_employee m, md_departments d, td_pay_statement t', $select, $where, 0);

            $this->load->view('reports/payslips', $data);

            $this->load->view('footer', $script);
        }

    }


    /************************ Monthly Payment *********************/

    public function f_payment(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $data['pay_dtls']   = $this->Payroll->f_get_payment();            

            //Sum of earnings & deductions
            $data['sum_dtls']   = $this->Payroll->f_get_payment_sum();            

            $this->load->view('reports/payment', $data);

            $script['script'] = [
                '/assets/plugins/datatables/jquery.dataTables.min.js'
            ];

            $script['cdnscript'] = [
            
                "https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js",
                "https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js",
                "https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"
            ];
            
            $this->load->view('footer', $script);

        }
        else{

            $script['script'] = NULL;

            //Month List
            $data['month_list'] =   $this->Payroll->f_get_particulars("md_month",NULL, NULL, 0);

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

            $data['employee_dtls'] = $this->Payroll->f_get_particulars('md_employee m, md_departments d, td_pay_statement t', $select, $where, 0);

            $this->load->view('reports/payment', $data);

            $this->load->view('footer', $script);

        }

    }
	
}
    
?>
