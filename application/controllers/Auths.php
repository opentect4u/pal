<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends MX_Controller {

	public function __construct(){
        
        parent::__construct();

        $this->load->model('Auth');
        
    }

	public function index()	{
        
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){

			if($pass = $this->Auth->f_get_particulars("md_users", array('password'), array("user_id" => $this->input->post('user_id')), 1)) {

			    if(password_verify($this->input->post('password'), $pass->password)){

                    //User Information
                    $select =   array(

                        "u.user_id", "u.user_name", "m.department", "m.emp_catg",

                        "m.emp_type"

                    );

                    $where  =   array(
                        
                        "u.user_id = m.emp_code"    =>  NULL,
                        
                        "u.user_id"                 =>  $this->input->post('user_id'),
                        
                        "u.user_status"             =>  'A'
                    );
                
                    $user_data = $this->Auth->f_get_particulars("md_users u, md_employee m", $select, $where, 1);
                    
                    if(!isset($user_data)){
                        //Setting Messages
                        $message    =   array( 
                                
                            'message'   => 'Inactive User!',
                            
                            'status'    => 'danger'
                            
                        );

                        $this->session->set_flashdata('msg', $message);

                        redirect('auths/login');
                        
                    }
                    //Setting Session Value for audit_trail
                    $this->session->set_userdata('loggedin', $user_data);
                    
                    //Audit Trail value
                    $data_array     =   array(

                        "login_dt"  =>   date('Y-m-d h:m:s'),

                        "user_id"   =>   $this->input->post('user_id'),

                        "terminal_name" => $_SERVER['REMOTE_ADDR']

                    );

                    $this->Auth->f_insert("td_audit_trail", $data_array);

                    //Getting max sl_no for audit trail
                    $select         =   array(

                        "MAX(sl_no) sl_no"

                    );

                    $where      =   array(

                        "user_id"   => $this->input->post('user_id')

                    );

                    $sl_no = $this->Auth->f_get_particulars("td_audit_trail", $select, $where, 1);
                    

                    //Pending Comp Off
                    $this->pending_compoffs();

                    $this->session->set_userdata('tm_audit_sl_no', $sl_no->sl_no);

                    //Setting Application Date
                    $this->session->set_userdata('sysdate', date('d-m-Y'));

                    redirect('auths/home');

                }
                else{

                    //Setting Messages
                    $message    =   array( 
                            
                        'message'   => 'Ivalid Password!',
                        
                        'status'    => 'danger'
                        
                    );

                    $this->session->set_flashdata('msg', $message);
                    
                    redirect('auths/login');
                    
                }

			}
			else{

                //Setting Messages
                $message    =   array( 
                        
                    'message'   => 'Ivalid User!',
                    
                    'status'    => 'danger'
                    
                );

                $this->session->set_flashdata('msg', $message);

                redirect('auths/login');
                
			}
        }
         
		else{

            redirect('auths/login');
            
		}

    }
    

    //Login Function
    public function login(){

        if($this->session->userdata('loggedin')){

            redirect('auths/home');

        }
        else{

            $this->load->view('login/login');

        }    
        
    }

    //Login Function
    public function home(){

        if($this->session->userdata('loggedin')){

            $link['link']       =   array("/assets/plugins/css-chart/css-chart.css");

            $link['title']      =   'IVAC';

            $script['script']   =   [];

            //User Details
            $select = array("emp_code", "emp_name", "department",
                            "designation", "email", "img_path");

            $link['user_dtls']   = $this->Auth->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);

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

            

            //Leave Balance
            unset($select);


            $emp_code = $this->session->userdata('loggedin')->user_id;

            $data['leave_balance'] = $this->Auth->f_get_leave_closing($emp_code);

            $date = date('Y-m-d');

            //Leave Yet to be taken
            /*unset($where);

            $where = array(

                "emp_code"          => $this->session->userdata('loggedin')->user_id,

                "leave_dt > '".date('Y-m-d')."'" => NULL,

                "status"            => 'A'
            );*/

            $data['pending'] = $this->Auth->f_pendig_leave($emp_code,$date);

            //Rejected Leave
            unset($where);

            $where = array(

                "emp_code"          => $this->session->userdata('loggedin')->user_id

            );

            $data['reject'] = $this->Auth->f_get_particulars('td_reject_trans', array("count(1) count"), $where, 1);

            //Pending toHOD
            unset($where);

            $where = array(

                "emp_code"          => $this->session->userdata('loggedin')->user_id,

                "recommendation_status" => 0

            );

            $data['hod'] = $this->Auth->f_get_particulars('td_leaves_trans', array("count(1) count"), $where, 1);

            //Pending to HR
            unset($where);

            $where = array(

                "emp_code"          => $this->session->userdata('loggedin')->user_id,

                "recommendation_status" => 1,

                "approval_status" => 0

            );

            $data['hr'] = $this->Auth->f_get_particulars('td_leaves_trans', array("count(1) count"), $where, 1);



            $this->load->view('header', $link);

            $this->load->view('dashboard', $data);

            $this->load->view('footer', $script);

        }
        else{

            redirect('auths/login');

        }
        
    }

    public function logout(){

        if($this->session->userdata('loggedin')){

            $where  =   array(

                "sl_no"    =>   $this->session->userdata('tm_audit_sl_no')
                
            );

            $this->Auth->f_edit("td_audit_trail", array("logout" => date('Y-m-d h:m:s')), $where);

            $this->session->unset_userdata('loggedin');

            $this->session->unset_userdata('tm_audit_sl_no');

            redirect('auths/login');

        }else{

            redirect('auths/login');

        }
           
    }

    //For Param Value
    public function param(){
    
        if($this->session->userdata('loggedin')){
            
            $data   =  $this->Auth->f_get_particulars("md_parameters", array("param_value"), array("sl_no" => $this->input->get('id')), 1);

            echo $data->param_value;

            exit;

        }

    }

    /****************************** Pending Comp Off *********************************/

    public function pending_compoffs(){

        $where = array(

            "year(balance_dt)" => date('Y'),
            "month(balance_dt) BETWEEN ".(date('m') - 2)." AND ".(date('m') -1)."" => NULL,            
            "emp_code"         => $this->session->userdata('loggedin')->user_id,
            "comp_off_out > 0" => NULL
        );

        $data   =  $this->Auth->f_get_particulars("td_leave_balance", NULL, $where, 0);

        if(!$data){
            
            $data = $this->Auth->f_get_particulars('td_leave_balance', array('MAX(balance_dt) balance_dt'), array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);
            
            $where = array(
                "balance_dt" => $data->balance_dt,
                "emp_code"   => $this->session->userdata('loggedin')->user_id
            );
    
            $this->Auth->f_edit("td_leave_balance", array("comp_off_bal" => 0), $where);

        }
        
    }

}
