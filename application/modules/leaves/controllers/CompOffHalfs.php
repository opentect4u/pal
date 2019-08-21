<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompOffHalfs extends MX_Controller {

	public function __construct(){

        parent::__construct();

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        $this->load->model('Leave');
        
        $link['title']  = 'Comp Off Management';

        $link['link']   =   [
            
            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css",

            "/assets/plugins/daterangepicker/daterangepicker.css"
        
        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Leave->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);

    }

    public function index(){

        //CompOff List
        $select =   array(
            
            "trans_cd", "trans_dt", 
            "reason", "from_dt", "to_dt", "remarks", "recommendation_status"
        
        );

        $where  =   array(

            "emp_code"          =>  $this->session->userdata('loggedin')->user_id,
            
            "approval_status"   =>  0,

            "rejection_status"  => 0,
            
            "amount < 1"    => NULL

        );

        $compOff['compOffHalf_dtls']    =   $this->Leave->f_get_particulars("td_comp_apply", $select, $where, 0);
        
        //Department List
        $compOff['department']    =   $this->Leave->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        $this->load->view("compOffHalf/dashboard", $compOff);


        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
        
        ];

        $this->load->view('footer', $script);
        

    }

    //CompOff Add Form
    public function f_add(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $transCd = $this->Leave->f_get_particulars("td_comp_apply", array("max(trans_cd) trans_cd"), NULL, 1);
  			
  			if (!isset($transCd->trans_cd)) {
                  
                $maxCode = date('Y').'1';

              }
              else{

                $maxCode = date('Y').(substr($transCd->trans_cd, 4) + 1);

              }
           
            //For CompOff Trans Table
            $data_array     =   array (
                
                "trans_cd"         =>  $maxCode,

                "trans_dt"         =>  date('Y-m-d'),

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

                "department"       =>  $this->session->userdata('loggedin')->department,

                "reason"           =>  $this->input->post('reason'),
                
                "from_dt"          =>  $this->input->post('from_dt'),

                "to_dt"            =>  $this->input->post('from_dt'),

                "remarks"          =>  $this->input->post('remarks'),

                "amount"           =>  0.5,

                "created_by"       =>  $this->session->userdata('loggedin')->user_name,
    
                "created_dt"       =>  date('Y-m-d h:i:s')
    
            );

            $this->Leave->f_insert('td_comp_apply', $data_array);            

            //For CompOff Date Table
            unset($data_array);

            $data_array     =   array(

                "trans_cd"  =>  $maxCode,

                "emp_code"  =>  $this->session->userdata('loggedin')->user_id,
                
                "comp_dt"  =>  $this->input->post('from_dt')
            );
            
            $this->Leave->f_insert('td_comp_dates', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully added!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('leave/compoffhalf');

        }

        //Dependencies
        $data['url']    = 'add';
        
        //Forwarding Null Value to view
        $data['emp'] = (object) array ("emp_code" => NULL);
        
        $data['compOffHalf_dtls']   =   (object) array ("trans_cd"       =>    NULL,

                                                    "from_dt"        =>    date('Y-m-d'),

                                                    "to_dt"          =>    date('Y-m-d'),

                                                    "reason"         =>    NULL,
                                                        
                                                    "leave_type"     =>    NULL,

                                                    "remarks"        =>    NULL

                                                );

        $this->load->view("compOffHalf/form", $data);

        $script['script'] = [

            "/assets/plugins/moment/moment.js",

            "/assets/plugins/daterangepicker/daterangepicker.js",

            "/js/compValidations.js"

        ];

        $this->load->view('footer', $script);

    }

    //CompOff Edit Form
    public function f_edit(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //For CompOff Trans Table
            $data_array     =   array (

                "reason"           =>  $this->input->post('reason'),
                
                "from_dt"          =>  $this->input->post('from_dt'),

                "to_dt"            =>  $this->input->post('from_dt'),

                "remarks"          =>  $this->input->post('remarks'),

                "modified_by"      =>  $this->session->userdata('loggedin')->user_name,
    
                "modified_dt"      =>  date('Y-m-d h:i:s')
    
            );

            $where  =   array(

                "trans_cd"         =>  $this->session->userdata('valid')['trans_cd'],

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

                "department"       =>  $this->session->userdata('loggedin')->department

            );

            $this->Leave->f_edit('td_comp_apply', $data_array, $where);            

            //Delete Dates
            unset($where);

            $where  =   array(

                "trans_cd"         =>  $this->session->userdata('valid')['trans_cd'],

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id

            );

            $this->Leave->f_delete('td_comp_dates', $where);

            //For CompOff Date Table
            unset($data_array);

            $data_array     =   array(

                "trans_cd"  =>  $this->session->userdata('valid')['trans_cd'],

                "emp_code"  =>  $this->session->userdata('loggedin')->user_id,
                
                "comp_dt"   =>  date("Y-m-d", $date)

            );

            $this->Leave->f_insert('td_comp_dates', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully updated!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('leave/compoffhalf');

        }

        //Dependencies
        $compOff['url']    = 'edit';
        
        //CompOff Details
        $select =   array(
            
            "trans_cd", "reason", "emp_code",
            "from_dt", "to_dt", "remarks"
        
        );

        $where  =   array(

            "trans_cd"         =>  $this->input->get('trans_cd'),

            "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

            "department"       =>  $this->session->userdata('loggedin')->department,

            "approval_status"  => 0

        );

        $compOff['compOffHalf_dtls']    =   $this->Leave->f_get_particulars("td_comp_apply", $select, $where, 1);

        $this->load->view("compOffHalf/form", $compOff);

        $script['script'] = [

            "/assets/plugins/moment/moment.js",

            "/assets/plugins/daterangepicker/daterangepicker.js",

            "/js/compValidations.js"

        ];

        //Setting hidden data for validation
        $data_array =   array(

            "trans_cd"  =>  (isset($compOff['compOffHalf_dtls']->trans_cd))? $compOff['compOffHalf_dtls']->trans_cd : null
            
        );

        $this->session->set_userdata('valid', $data_array);

        $this->load->view('footer', $script);

    }

    //CompOff Edit Form
    public function f_delete(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $this->Leave->f_delete('td_comp_apply', array("trans_cd" => $this->input->post('trans_cd')));

            $this->Leave->f_delete('td_comp_dates', array("trans_cd" => $this->input->post('trans_cd')));

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully deleted!',
                
                'status'    => 'danger'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('leave/compoffhalf');

        }

    }

    //for overlapping dates
    public function f_overlapp(){

        //For Comp Dates
        $where  =   array(
    
            "emp_code"  =>  $this->session->userdata('loggedin')->user_id,

            "comp_dt = '".$this->input->get('fromDt')."'" => NULL
                
        );

        $data   =  $this->Leave->f_get_particulars("td_comp_dates", array("count(1) count"), $where, 1);

        if($data->count != 0){
            
            echo true;

        }
        
        exit;

    }

}