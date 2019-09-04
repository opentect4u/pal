<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***************************************************************
 *  Function to Approve all Half & Full Comp off Aplication.   *   
 *  Means employee informing Mgmt. that he/she has worked on   *
 *  holidays                                                   *
 ***************************************************************/

class CompApproves extends MX_Controller {

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
        
        $link['title']  = 'Comp Off Approve';

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
        
        $temp = ['NoEmp'];

        foreach($emp_list as $e_list){

            array_push($temp, $e_list->managed_emp);
            
        }
        
        //Unapproveed Leave List
        $select     =   array(

            "t.trans_cd", "t.trans_dt", "m.emp_name",

            "t.recommend_remarks","t.recommend_by" ,"d.dept_name"

        );

        $where      =   array(

            "t.emp_code = m.emp_code"   => NULL,

            "t.department = d.sl_no"    => NULL,

            "t.approval_status"         =>  0,

            "t.rejection_status"        =>  0,

            "recommendation_status"     =>  1

        );

        $approve['leave_dtls']     =   $this->Leave->f_get_particulars_in("td_comp_apply t, md_employee m, md_departments d", $select, $temp, $where);
        
        // echo "<pre>";
        // var_dump($approve['leave_dtls']); die;
        
        $this->load->view("compApprove/dashboard", $approve);

        $this->load->view('footer', $script);

    }

    //Approve Form
    public function f_form(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //For Approval
            if($this->input->post('approve_status')){
                //var_dump($this->session->flashdata('valid')); die;
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
                    
                    "emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,
                    
                    "rejection_status"=> 0

                );


                if($this->Leave->f_edit('td_comp_apply', $data_array, $where)){

                    //Update Leave 
                    $this->Leave->f_edit('td_comp_dates', array('status' => 'A'), array('trans_cd' => $this->session->flashdata('valid')['trans_cd']));
                    
                    //Checking if row present in current date
                    $trans_cd = $this->Leave->f_get_particulars('td_leave_balance', array("trans_cd"), array("emp_code" => $this->session->flashdata('valid')['emp_code'], "balance_dt" => date('Y-m-d')), 1);
                    //echo($trans_cd); die;
                    //if(!isset($trans_cd)){
                        
                        //Last balance date
                        unset($data_array);
                        unset($where);

                        /*$select =    array(

                            "emp_code", "ml_bal", "el_bal", "comp_off_bal",
                            "MAX(balance_dt) balance_dt"
        
                        );
        
                        $where  =   array(
        
                            "emp_code = '".$this->session->flashdata('valid')['emp_code']."' GROUP BY emp_code, ml_bal, el_bal, comp_off_bal ORDER BY balance_dt DESC LIMIT 0,1" => NULL
        
                        );*/

                        $emp_code      = $this->session->flashdata('valid')['emp_code'];

                        $leave_balance = $this->Leave->f_get_leave_closing($emp_code);


                        $select1 = array(
                            "trans_dt", "recommend_dt", "from_dt", 
                            "to_dt","remarks","recommendation_status"
                        );

                        $where1   = array(
                            "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],
                            "rejection_status"=> 0
                        );

                        $other_dtls = $this->Leave->f_get_particulars('td_comp_apply', $select1, $where1, 1);


                        $data_array =   array(

                            "balance_dt"    =>  date('Y-m-d'),
    
                            "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],
                            
                            "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                            "status"        => $other_dtls->recommendation_status,

                            "application_dt" => $other_dtls->trans_dt,

                            "recomed_dt"    => $other_dtls->recommend_dt,

                            "from_dt"       => $other_dtls->from_dt,

                            "to_dt"         => $other_dtls->to_dt,

                            "remarks"       => $other_dtls->remarks,                       

                            "comp_off_in"   =>  $this->session->flashdata('valid')['amount'],

                            "ml_bal"        =>  $leave_balance->ml_bal,
                            
                            "el_bal"        =>  $leave_balance->el_bal,
                            
                            "comp_off_bal"  =>  $leave_balance->comp_off_bal + $this->session->flashdata('valid')['amount']
    
                        );
                    
                        $this->Leave->f_insert("td_leave_balance", $data_array);

                    //}
                    /*else{
                        
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

                        $data_array =   array(
                                        
                            "comp_off_in"   =>  $this->session->flashdata('valid')['amount'],

                            "comp_off_bal"  =>  $leave_balance->comp_off_bal + $this->session->flashdata('valid')['amount']
    
                        );
                    
                        $this->Leave->f_edit("td_leave_balance", $data_array, array("trans_cd" => $trans_cd->trans_cd));

                    }*/
                    
                }

                //Setting Messages
                $message    =   array( 
                    
                    'message'   => 'Successfully Approved!',
                    
                    'status'    => 'success'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('leave/compapprove');

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
                
                $this->Leave->f_edit('td_comp_apply', $data_array, $where);

                /////

                $select = array(
                    "trans_dt", "trans_cd", "emp_code",
                    "from_dt", "to_dt", "amount", "rejected_by",
                    "rejected_dt", "rejection_remarks"
                );

                $where = array(
                        "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],
                        "emp_code"      =>  $this->session->flashdata('valid')['emp_code']
                );

                $reject_dtls = $this->Leave->f_get_particulars('td_comp_apply', $select, $where, 1);

                //
                unset($data_array);
                unset($where);

                $data_array = array(

                    "trans_dt"          =>  $reject_dtls->trans_dt,

                    "trans_cd"          =>  $reject_dtls->trans_cd,

                    "emp_code"          =>  $reject_dtls->emp_code, 

                    "leave_type"        =>  'C',  

                    "from_dt"           =>  $reject_dtls->from_dt,

                    "to_dt"             =>  $reject_dtls->to_dt,

                    "amount"            =>  $reject_dtls->amount,

                    "rejection_dt"      =>  $reject_dtls->rejected_dt,

                    "rejection_remarks" =>  $reject_dtls->rejection_remarks,

                    "rejected_by"        =>  $reject_dtls->rejected_by,

                );

                $this->Leave->f_insert("td_reject_trans", $data_array);




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

                redirect('leave/compapprove');

            }

        }

        //Dependencies
        $data['url']    = 'form';
        
        $data['title']  = 'Approve Leave';
        
        //Approve Details
        $select = array(

            "t.trans_cd", "t.emp_code", "m.emp_name",
            "t.reason", "t.from_dt",
            "t.to_dt", "t.remarks", "t.recommend_remarks",
            "d.dept_name", "t.amount"

        );

        $where  =   array(

            "t.emp_code = m.emp_code"   =>  NULL,

            "t.department = d.sl_no"    =>  NULL,

            "t.trans_cd"                =>  $this->input->get('trans_cd'),

            "t.emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,

            "t.rejection_status"        =>  0,

            "t.approval_status"         =>  0,

            "t.recommendation_status"   =>  1,
            
        );
        
        $data['leave_dtls']    =   $this->Leave->f_get_particulars("td_comp_apply t, md_employee m, md_departments d", $select, $where, 1);

        //echo($data['leave_dtls']->trans_cd); die;
        //Setting hidden data for validation
        $data_array =   array(

            "trans_cd"  =>  $data['leave_dtls']->trans_cd,

            "emp_code"  =>  $data['leave_dtls']->emp_code,

            "amount"    =>  $data['leave_dtls']->amount
        );

        $this->session->set_flashdata('valid', $data_array);
        
        echo $this->load->view('compApprove/form', $data, TRUE);

        exit;

    }

}