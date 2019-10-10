<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/***************************************************************
 *  Function HOD recommending/rejecting Comp off application   *
 *  to HR.Here application means employee informing Mgmt. that *
 *  he/she has worked on holidays                              *
 ***************************************************************/

class CompRecommends extends MX_Controller {

	public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }
        
        $this->load->model('Leave');

        $this->load->model('Auth');
        
        $link['title']  = 'Comp Off Recommend';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Leave->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);

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

    public function index(){

        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];
        
        //Select Employees dependent on this HOD
        $emp_list   =   $this->Leave->f_get_particulars("md_manager", array('managed_emp'), array("manage_by" => $this->session->userdata('loggedin')->user_id), 0);
        
        $where_in = ['NoEmp'];

        foreach($emp_list as $e_list){

            array_push($where_in, $e_list->managed_emp);
            
        }
        
        //Unrecommended Leave List
        $select     =   array(

            "t.trans_cd", "t.trans_dt", "m.emp_name",

            "t.reason", "t.from_dt", "t.to_dt"

        );

        $where      =   array(

            "t.emp_code = m.emp_code"   => NULL,

            "t.emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,
            
            "t.recommendation_status"   =>  0,

            "rejection_status"          =>  0

        );

        $compRecommend['leave_dtls']     =   $this->Leave->f_get_particulars_in("td_comp_apply t, md_employee m", $select, $where_in, $where);
        
        $this->load->view("compRecommend/dashboard", $compRecommend);

        $this->load->view('footer', $script);

    }

    //Recommend Form
    public function f_form(){
        
        //For Recommend
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if($this->input->post('approve_status')){

                $data_array =   array (

                    "recommendation_status"   =>    1,

                    "recommend_remarks"       =>  $this->input->post('remarks'),
        
                    "recommend_by"            =>  $this->session->userdata('loggedin')->user_name,
        
                    "recommend_dt"            =>  date('Y-m-d h:i:s')
        
                );

                $where      =   array(

                    "trans_cd"      =>  $this->session->flashdata('valid')['trans_cd'],

                    "emp_code"      =>  $this->session->flashdata('valid')['emp_code'],

                    "emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,

                );

                
                $this->Leave->f_edit('td_comp_apply', $data_array, $where);

                //Setting Messages
                $message    =   array( 
                    
                    'message'   => 'Successfully Recommended!',
                    
                    'status'    => 'success'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('leave/comprecommend');

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

                    "emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,

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

                $this->Leave->f_delete('td_comp_dates', $where);

                //Setting Messages
                $message    =   array( 
                    
                    'message'   => 'Successfully Rejected!',
                    
                    'status'    => 'danger'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('leave/comprecommend');

            }

        }

        //Dependencies
        $data['url']    = 'form';
        
        $data['title']  = 'Recommend Comp Off';
        
        //Recommend Details
        $select = array(

            "t.trans_cd", "t.emp_code", "m.emp_name",
            "t.reason", "t.from_dt",
            "t.to_dt", "t.remarks" 

        );

        $where  =   array(

            "t.emp_code = m.emp_code"   =>  NULL,

            "t.trans_cd"                =>  $this->input->get('trans_cd'),

            "t.emp_code != '".$this->session->userdata('loggedin')->user_id."'"   => NULL,

            "t.rejection_status"        =>  0,

            "t.recommendation_status"   =>  0,

            "t.approval_status"         =>  0,
            
        );

        $data['leave_dtls']    =   $this->Leave->f_get_particulars("td_comp_apply t, md_employee m", $select, $where, 1);

        //Setting hidden data for validation
        $data_array =   array(

            "trans_cd"  =>  $data['leave_dtls']->trans_cd,

            "emp_code"  =>  $data['leave_dtls']->emp_code

        );

        $this->session->set_flashdata('valid', $data_array);

        echo $this->load->view('compRecommend/form', $data, TRUE);

        exit;

    }

}