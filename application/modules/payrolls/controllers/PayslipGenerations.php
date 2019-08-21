<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class PayslipGenerations extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Payroll');

        $link['title']  = 'Payslip Generation';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Payroll->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);
        
    }


    //Latest unapproved salary statement of employees'
    public function index(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $year  = $this->input->post('year');
            $month = $year.'-'.$this->input->post('month').'-01';
            
            if($this->input->post('submit') == 'regenerate'){
                //Delete Previvous Data if Exist
                $this->Payroll->f_delete('td_pay_slip', array('month' => date('F', mktime(0, 0, 0, $this->input->post('month'), 10)), 'year' => $year));

            }

            $data   = $this->Payroll->f_get_payDetails($month);

            for($i = 0; $i < count($data); $i++){
                
                $data[$i] = (array) $data[$i];
                $data[$i]['year'] = date('Y');

                $res = $this->Payroll->f_get_particulars('td_absents', array('absent', 'half'), array('emp_code' => $data[$i]['emp_code'], 'month' => $this->input->post('month'), 'year' => $this->input->post('year')), 1);

                $data_array[] = array(
                                    "advance" => $data[$i]['advance'],
                                    "bank_ac_no" => $data[$i]['bank_ac_no'], 
                                    "bank_name" => $data[$i]['bank_name'], 
                                    "basic" => $data[$i]['basic'], 
                                    "conveyance" => $data[$i]['conveyance'], 
                                    "da" => $data[$i]['da'], 
                                    "deduct_for_absent" => ($res)? round((($data[$i]['tot_earnings'] / 30) * $res->absent)) : 0.00, 
                                    "deduct_for_half" => ($res)? round((($data[$i]['tot_earnings'] / 30) * ($res->half / 2))) : 0.00, 
                                    "department" => $data[$i]['department'], 
                                    "designation" => $data[$i]['designation'], 
                                    "email" => $data[$i]['email'], 
                                    "emp_code" => $data[$i]['emp_code'], 
                                    "emp_name" => $data[$i]['emp_name'], 
                                    "esi" => $data[$i]['esi'], 
                                    "esi_no" => $data[$i]['esi_no'], 
                                    "hra" => $data[$i]['hra'], 
                                    "joining_date" => $data[$i]['joining_date'], 
                                    "location" => $data[$i]['location'], 
                                    "misc" => $data[$i]['misc'], 
                                    "month" => $data[$i]['month'], 
                                    "net_amount" => ($res)? $data[$i]['net_amount'] - (round((($data[$i]['tot_earnings'] / 30) * $res->absent)) + round((($data[$i]['tot_earnings'] / 30) * ($res->half / 2)))) : $data[$i]['net_amount'], 
                                    "others" => $data[$i]['others'], 
                                    "p_tax" => $data[$i]['p_tax'], 
                                    "incentives" =>  $data[$i]['incentives'],
                                    "misc_ear" =>  $data[$i]['misc_ear'],
                                    "tds" =>  $data[$i]['tds'],
                                    "lwf" =>  $data[$i]['lwf'],
                                    "accommodation" =>  $data[$i]['accommodation'],
                                    "laundry" =>  $data[$i]['laundry'],
                                    "pan_no" => $data[$i]['pan_no'], 
                                    "pf" => $data[$i]['pf'], 
                                    "pf_ac_no" => $data[$i]['pf_ac_no'], 
                                    "phn_no" => $data[$i]['phn_no'], 
                                    "tot_deduction" => ($res)? $data[$i]['tot_deduction'] + round((($data[$i]['tot_earnings'] / 30) * $res->absent)) + round((($data[$i]['tot_earnings'] / 30) * ($res->half / 2))) : $data[$i]['tot_deduction'], 
                                    "tot_earnings" => $data[$i]['tot_earnings'], 
                                    "trans_dt" => $data[$i]['trans_dt'], 
                                    "year" => $data[$i]['year'],
                                    "base_or_eligibitity" => $data[$i]['base_or_eligibitity'],
                                    "ifsc" => $data[$i]['ifsc']
                                );
                                    
            }

            $this->Payroll->f_insert_multiple('td_pay_slip', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully Generated!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('payroll/payslipgeneration');

        }
        else{
        
            $script['script'] = NULL;

            //Month List
            $data['month_list'] =   $this->Payroll->f_get_particulars("md_month",NULL, NULL, 0);

            $this->load->view("payslipgeneration/form", $data);

            $this->load->view('footer', $script);

        }

    }

    public function f_check(){

        $year  = $this->input->get('year');
        $month = date('F', strtotime($year.'-'.$this->input->get('month').'-01'));
           
        $data = $this->Payroll->f_get_particulars('td_pay_slip', array('count(1) count'), array('month' => $month, 'year' => $this->input->get('year')), 1);

        echo $data->count;

        exit();            

    }

}