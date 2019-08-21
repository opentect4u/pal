<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approves extends MX_Controller {

	public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }
        
        $this->load->model('Leave');
        
        $link['title']  = 'Leave Management Approve';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Leave->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];

        //Select Employees dependent on this HOD
        $emp_list   =   $this->Leave->f_get_particulars("md_employee", array('emp_code managed_emp'), NULL, 0);
        
        $where_in = ['NoEmp'];

        foreach($emp_list as $e_list){

            array_push($where_in, $e_list->managed_emp);
            
        }
        
        //Unapproveed Leave List
        $select     =   array(

            "t.trans_cd", "t.trans_dt", "m.emp_name",

            "t.recommend_remarks", "d.dept_name"

        );

        $where      =   array(

            "t.emp_code = m.emp_code"   => NULL,

            "t.department = d.sl_no"    => NULL,

            "t.approval_status"         =>  0,

            "t.rejection_status"        =>  0,

            "t.recommendation_status"   =>  1,

        );

        $approve['leave_dtls']     =   $this->Leave->f_get_particulars_in("td_leaves_trans t, md_employee m, md_departments d", $select, $where_in, $where);
        
        $this->load->view("approve/dashboard", $approve);

        $this->load->view('footer', $script);

    }

    //Approve Form
    public function f_form(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //For Approval
            if($this->input->post('approve_status')){

                //For Leave Trans
                $data_array =   array (

                    "approval_status"       =>    1,

                    "approve_remarks"       =>  $this->input->post('remarks'),
        
                    "approved_by"           =>  $this->session->userdata('loggedin')->user_name,
        
                    "approval_dt"           =>  date('Y-m-d h:i:s')
        
                );

                $where      =   array(

                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],

                    "leave_type"    =>  $this->session->flashdata('valid')['leave_type'],
                                        
                    "rejection_status"=> 0

                );

                
                if($this->Leave->f_edit('td_leaves_trans', $data_array, $where)){

                    //Update Leave 
                    $this->Leave->f_edit('td_leave_dates', array('status' => 'A'), array('trans_cd' => $this->session->flashdata('valid')['trans_cd']));

                    //Checking if row present in current date
                    $trans_cd = $this->Leave->f_get_particulars('td_leave_balance', array("trans_cd"), array("emp_code" => $this->session->flashdata('valid')['emp_code'], "balance_dt" => date('Y-m-d')), 1);

                    if(!isset($trans_cd) && $this->session->flashdata('valid')['leave_type'] != 'N'){
                        
                        //Last balance date
                        unset($data_array);
                        unset($where);

                        $select =    array(

                            "emp_code", "ml_bal", "el_bal", "comp_off_bal",
                            "MAX(balance_dt) balance_dt"
        
                        );
        
                        $where  =   array(
        
                            "emp_code = '".$this->session->flashdata('valid')['emp_code']."' GROUP BY emp_code, ml_bal, el_bal, comp_off_bal ORDER BY balance_dt DESC LIMIT 0,1" => NULL
        
                        );

                        $leave_balance = $this->Leave->f_get_particulars('td_leave_balance', $select, $where, 1);

                        switch ($this->session->flashdata('valid')['leave_type']) {
                                                    
                            case "E": 

                                    $data_array =   array(

                                        "balance_dt"    =>  date('Y-m-d'),
                
                                        "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                        
                                        "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                        "el_out"        =>  $this->session->flashdata('valid')['amount'],

                                        "ml_bal"        =>  $leave_balance->ml_bal,
                                        
                                        "el_bal"        =>  $leave_balance->el_bal - $this->session->flashdata('valid')['amount'],
                                        
                                        "comp_off_bal"  =>  $leave_balance->comp_off_bal
                
                                    );

                                    $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;
                            
                            case "M": 

                                $data_array =   array(

                                    "balance_dt"    =>  date('Y-m-d'),
            
                                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                    
                                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                    "ml_out"        =>  $this->session->flashdata('valid')['amount'],

                                    "ml_bal"        =>  $leave_balance->ml_bal - $this->session->flashdata('valid')['amount'],
                                    
                                    "el_bal"        =>  $leave_balance->el_bal,
                                    
                                    "comp_off_bal"  =>  $leave_balance->comp_off_bal
            
                                );

                                    $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;

                            case "C": 

                                    $data_array =   array(

                                        "balance_dt"    =>  date('Y-m-d'),
                
                                        "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                        
                                        "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                        "comp_off_out"  =>  $this->session->flashdata('valid')['amount'],

                                        "ml_bal"        =>  $leave_balance->ml_bal,
                                        
                                        "el_bal"        =>  $leave_balance->el_bal,
                                        
                                        "comp_off_bal"  =>  $leave_balance->comp_off_bal - $this->session->flashdata('valid')['amount']
                
                                    );
                                
                                    $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;

                            case "HE": 

                                $data_array =   array(

                                    "balance_dt"    =>  date('Y-m-d'),
            
                                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                    
                                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                    "el_out"        =>  $this->session->flashdata('valid')['amount'],

                                    "ml_bal"        =>  $leave_balance->ml_bal,
                                    
                                    "el_bal"        =>  $leave_balance->el_bal - $this->session->flashdata('valid')['amount'],
                                    
                                    "comp_off_bal"  =>  $leave_balance->comp_off_bal
            
                                );

                                $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;
                        
                            case "HM": 

                                $data_array =   array(

                                    "balance_dt"    =>  date('Y-m-d'),
            
                                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                    
                                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                    "ml_out"        =>  $this->session->flashdata('valid')['amount'],

                                    "ml_bal"        =>  $leave_balance->ml_bal - $this->session->flashdata('valid')['amount'],
                                    
                                    "el_bal"        =>  $leave_balance->el_bal,
                                    
                                    "comp_off_bal"  =>  $leave_balance->comp_off_bal
            
                                );

                                    $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;

                            case "HC": 

                                    $data_array =   array(

                                        "balance_dt"    =>  date('Y-m-d'),
                
                                        "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                                        
                                        "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                                        "comp_off_out"  =>  $this->session->flashdata('valid')['amount'],

                                        "ml_bal"        =>  $leave_balance->ml_bal,
                                        
                                        "el_bal"        =>  $leave_balance->el_bal,
                                        
                                        "comp_off_bal"  =>  $leave_balance->comp_off_bal - $this->session->flashdata('valid')['amount']
                
                                    );
                                
                                    $this->Leave->f_insert("td_leave_balance", $data_array);

                                break;    
                        
                        }

                    }
                    else{

                        //Last balance date
                        unset($data_array);
                        unset($where);

                        $select =    array(

                            "ml_bal", "el_bal", "comp_off_bal"
        
                        );
        
                        $where  =   array(
        
                            "trans_cd" => $trans_cd->trans_cd
        
                        );

                        $leave_balance = $this->Leave->f_get_particulars('td_leave_balance', $select, $where, 1);

                        switch ($this->session->flashdata('valid')['leave_type']) {
                                                    
                            case "E": 

                                    $data_array =   array(

                                        "el_out"        =>  $this->session->flashdata('valid')['amount'],
                                        
                                        "el_bal"        =>  $leave_balance->el_bal - $this->session->flashdata('valid')['amount']
                
                                    );

                                    $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;
                            
                            case "M": 

                                $data_array =   array(

                                    "ml_out"        =>  $this->session->flashdata('valid')['amount'],

                                    "ml_bal"        =>  $leave_balance->ml_bal - $this->session->flashdata('valid')['amount'],
                                    
                                );

                                    $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;

                            case "C": 

                                    $data_array =   array(
                                        
                                        "comp_off_out"  =>  $this->session->flashdata('valid')['amount'],

                                        "comp_off_bal"  =>  $leave_balance->comp_off_bal - $this->session->flashdata('valid')['amount']
                
                                    );
                                
                                    $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;
                            
                            case "HE": 

                                $data_array =   array(

                                    "el_out"        =>  $this->session->flashdata('valid')['amount'],
                                    
                                    "el_bal"        =>  $leave_balance->el_bal - $this->session->flashdata('valid')['amount']
            
                                );

                                $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;
                        
                            case "HM": 

                                $data_array =   array(

                                    "ml_out"        =>  $this->session->flashdata('valid')['amount'],

                                    "ml_bal"        =>  $leave_balance->ml_bal - $this->session->flashdata('valid')['amount'],
                                    
                                );

                                    $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;

                            case "HC": 

                                $data_array =   array(
                                    
                                    "comp_off_out"  =>  $this->session->flashdata('valid')['amount'],

                                    "comp_off_bal"  =>  $leave_balance->comp_off_bal - $this->session->flashdata('valid')['amount']
            
                                );
                            
                                $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                                break;
                
                        }

                    }    

                    
                }

                //Setting Messages
                $message    =   array( 
                    
                    'message'   => 'Successfully Approved!',
                    
                    'status'    => 'success'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('leave/approve');

            }

            //For Reject
            else{

                $data_array =   array (

                    "rejection_status"       =>    1,

                    "rejection_remarks"      =>  $this->input->post('remarks'),
        
                    "rejected_by"            =>  $this->session->userdata('loggedin')->user_name,
        
                    "rejected_dt"            =>  date('Y-m-d h:i:s')
        
                );

                $where      =   array(

                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],

                    "emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL
                    
                );
                
                $this->Leave->f_edit('td_leaves_trans', $data_array, $where);

                //Delete Dates
                unset($where);

                $where  =   array(

                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code']

                );

                $this->Leave->f_delete('td_leave_dates', $where);

                //Setting Messages
                $message    =   array( 
                    
                    'message'   => 'Successfully Rejected!',
                    
                    'status'    => 'danger'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('leave/approve');

            }

        }

        //Dependencies
        $data['url']    = 'form';
        
        $data['title']  = 'Approve Leave';
        
        //Approve Details
        $select = array(

            "t.trans_cd", "t.emp_code", "m.emp_name",
            "t.leave_type", "t.reason", "t.from_dt",
            "t.to_dt", "t.remarks", "t.recommend_remarks",
            "d.dept_name", "t.amount"

        );

        $where  =   array(

            "t.emp_code = m.emp_code"   =>  NULL,

            "t.department = d.sl_no"    =>  NULL,

            "t.trans_cd"                =>  $this->input->get('trans_cd'),

            "t.rejection_status"        =>  0,

            "t.approval_status"         =>  0,

            "t.recommendation_status"   =>  1,
            
        );
        
        $data['leave_dtls']    =   $this->Leave->f_get_particulars("td_leaves_trans t, md_employee m, md_departments d", $select, $where, 1);

        //Setting hidden data for validation
        $data_array =   array(

            "trans_cd"  =>  $data['leave_dtls']->trans_cd,

            "emp_code"  =>  $data['leave_dtls']->emp_code,
            
            "leave_type"=>  $data['leave_dtls']->leave_type,

            "amount"    =>  $data['leave_dtls']->amount
        );

        $this->session->set_flashdata('valid', $data_array);
        
        echo $this->load->view('approve/form', $data, TRUE);

        exit;

    }

}