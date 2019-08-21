<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends MX_Controller {

	public function __construct(){

        parent::__construct();

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('auths/login');

        }

        $this->load->model('Leave');
        
        $link['title']  = 'Leave Management';

        //Links will be loaded for each leave section
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

        //Leave List
        $select =   array(
            
            "trans_cd", "trans_dt", "leave_type",
            "reason", "from_dt", "to_dt", "remarks", "recommendation_status"
        
        );

        $where  =   array(

            "emp_code"          =>  $this->session->userdata('loggedin')->user_id,
            
            "approval_status"   =>  0,

            "rejection_status"  => 0,

            "leave_type IN ('M','E','C','N')" => NULL
            
        );

        $leave['leave_dtls']    =   $this->Leave->f_get_particulars("td_leaves_trans", $select, $where, 0);
        
        //Department List
        $leave['department']    =   $this->Leave->f_get_particulars("md_departments", array("sl_no", "dept_name"), NULL, 0);

        $this->load->view("leave/dashboard", $leave);

        $script['script'] = [
            
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
        
        ];

        $this->load->view('footer', $script);
        

    }

    //Leave New Add Form
    public function f_add(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $transCd = $this->Leave->f_get_particulars("td_leaves_trans", array("max(trans_cd) trans_cd"), array('year(trans_dt)' => date('Y')), 1);

  			if (!isset($transCd->trans_cd)) {
                  
                $maxCode = date('Y').'1';

              }
              else{
                  
                $maxCode = date('Y').(substr($transCd->trans_cd, 4) + 1);

              }
            
                // Getting the selected date range 
                // $datefilter     =       $_POST['datefilter'];

                // $splittedstring = explode("  ",$datefilter);
                
                // $startDt = date("Y-m-d",strtotime($splittedstring[0]));
                // $endDt = date("Y-m-d",strtotime($splittedstring[1]));
                
                
                //Difference between to dates
                $diff_period    =   date_diff(date_create($this->input->post('from_date')),date_create($this->input->post('to_date')));

                // $diff = abs(strtotime($startDt) - strtotime($endDt));
                // $diff_period = floor($diff)/(60*60*24);
                //echo $diff_period; die;

            //For Leave Trans Table
            $data_array     =   array (
                
                "trans_cd"         =>  $maxCode,

                "trans_dt"         =>  date('Y-m-d'),

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

                "department"       =>  $this->session->userdata('loggedin')->department,
                
                "leave_type"       =>  $this->input->post('leave_type'),

                "reason"           =>  $this->input->post('reason'),
                
                "from_dt"          =>  $this->input->post('from_date'),

                "to_dt"            =>  $this->input->post('to_date'),

                "remarks"          =>  $this->input->post('remarks'),

                "amount"           =>  $diff_period->format('%a') + 1,

                "recommendation_status"=> 0,
                
                "recommend_by"     => NULL,
                
                "recommend_dt"     => NULL,

                "recommend_remarks"=> $recommendation_remarks,

                "created_by"       =>  $this->session->userdata('loggedin')->user_name,
    
                "created_dt"       =>  date('Y-m-d h:i:s')
    
            );

            $this->Leave->f_insert('td_leaves_trans', $data_array);            

            //For Leave Date Table
            unset($data_array);
            for($i = 0; $i <= $diff_period; $i++){

                $date = strtotime("+".$i." day", strtotime($this->input->post('from_date')));
                
                
                $data_array[]     =   array(

                    "trans_cd"  =>  $maxCode,

                    "emp_code"  =>  $this->session->userdata('loggedin')->user_id,
                    
                    "leave_dt"  =>  date("Y-m-d", $date)
                );

            }
            
            $this->Leave->f_insert_multiple('td_leave_dates', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully added!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('leaves');

        }

        //Dependencies
        $data['url']    = 'add';
        
        //Forwarding Null Value to view
        $data['emp'] = (object) array ("emp_code" => NULL);
        
        $data['leave_dtls']   =   (object) array ( "trans_cd"       =>    NULL,

                                                   "from_dt"        =>    date('Y-m-d'),

                                                   "to_dt"          =>    NULL,

                                                   "reason"         =>    NULL,
                                                    
                                                   "leave_type"     =>    NULL,

                                                   "remarks"        =>    NULL

                                                );

        $this->load->view('leave/form', $data);

        $script['script'] = [

            "/assets/plugins/moment/moment.js",

            "/assets/plugins/daterangepicker/daterangepicker.js",

            "/js/moduleValidations.js"

        ];

        $this->load->view('footer', $script);

    }

    //Leave Edit Form
    public function f_edit(){
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            //Difference between to dates
            //$diff_period    =   date_diff(date_create($this->input->post('from_date')),date_create($this->input->post('to_date')));
                $datefilter     =       $_POST['datefilter'];
                $splittedstring = explode("  ",$datefilter);
                $startDt = date("Y-m-d",strtotime($splittedstring[0]));
                $endDt = date("Y-m-d",strtotime($splittedstring[1]));

                $diff = abs(strtotime($startDt) - strtotime($endDt));
                $diff_period = floor($diff)/(60*60*24);
                //echo $diff_period; die;
            //For Leave Trans Table
            $data_array     =   array (

                "leave_type"       =>  $this->input->post('leave_type'),

                "reason"           =>  $this->input->post('reason'),
                
                "from_dt"          =>  $startDt,             //$this->input->post('from_date'),

                "to_dt"            =>  $endDt,             //$this->input->post('to_date'),

                "remarks"          =>  $this->input->post('remarks'),

                "amount"           =>  $diff_period + 1,            //$diff_period->format('%a') + 1,

                "modified_by"      =>  $this->session->userdata('loggedin')->user_name,
    
                "modified_dt"      =>  date('Y-m-d h:i:s')
    
            );

            $where  =   array(

                "trans_cd"         =>  $this->session->userdata('valid')['trans_cd'],

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

                "department"       =>  $this->session->userdata('loggedin')->department

            );

            $this->Leave->f_edit('td_leaves_trans', $data_array, $where);            

            //Delete Dates
            unset($where);

            $where  =   array(

                "trans_cd"         =>  $this->session->userdata('valid')['trans_cd'],

                "emp_code"         =>  $this->session->userdata('loggedin')->user_id

            );

            $this->Leave->f_delete('td_leave_dates', $where);

            //For Leave Date Table
            unset($data_array);

            for($i = 0; $i <= $diff_period; $i++) {

                //$date = strtotime("+".$i." day", strtotime($this->input->post('from_date')));
                $date = strtotime("+".$i." day", $endDt);
                
                
                $data_array[]    =   array(

                    "trans_cd"  =>  $this->session->userdata('valid')['trans_cd'],

                    "emp_code"  =>  $this->session->userdata('loggedin')->user_id,
                    
                    "leave_dt"  =>  date("Y-m-d", $date)

                );

            }

            $this->Leave->f_insert_multiple('td_leave_dates', $data_array);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully updated!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);
    
            redirect('leaves');

        }

        //Dependencies
        $leave['url']    = 'edit';
        
        //Leave Details
        $select =   array(
            
            "trans_cd", "leave_type","reason",
            "from_dt", "to_dt", "remarks"
        
        );

        $where  =   array(

            "trans_cd"         =>  $this->input->get('trans_cd'),

            "emp_code"         =>  $this->session->userdata('loggedin')->user_id,

            "department"       =>  $this->session->userdata('loggedin')->department,

            "approval_status"  => 0
        );

        $leave['leave_dtls']    =   $this->Leave->f_get_particulars("td_leaves_trans", $select, $where, 1);

        $this->load->view('leave/form', $leave);

        $script['script'] = [

            "/assets/plugins/moment/moment.js",

            "/assets/plugins/daterangepicker/daterangepicker.js",

            "/js/moduleValidations.js"

        ];

        //Setting hidden data for validation
        $data_array =   array(

            "trans_cd"  =>  (isset($leave['leave_dtls']->trans_cd))? $leave['leave_dtls']->trans_cd : null
            
        );

        $this->session->set_userdata('valid', $data_array);

        $this->load->view('footer', $script);

    }

    //Leave Delete Form
    public function f_delete(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $this->Leave->f_delete('td_leaves_trans', array("trans_cd" => $this->input->post('trans_cd')));

            $this->Leave->f_delete('td_leave_dates', array("trans_cd" => $this->input->post('trans_cd')));

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully deleted!',
                
                'status'    => 'danger'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('leaves');

        }

    }


/**********************REPORTS************************/

    //For Leave Leaser
    public function f_ledger(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Opening Balances
            $select =    array(

                "emp_code","trans_cd", "ml_bal", "el_bal", 
                "comp_off_bal", "MAX(balance_dt) balance_dt"

            );

            $where  =   array(

                "emp_code = '".($this->input->post('emp_code')? $this->input->post('emp_code') : $this->session->userdata('loggedin')->user_id)."'" => NULL,

                "balance_dt < '".$this->input->post('from_date')."' GROUP BY trans_cd, ml_bal, el_bal, comp_off_bal ORDER BY balance_dt DESC, trans_cd DESC LIMIT 0,1" => NULL
                
            );

            $data['open_bal']  = $this->Leave->f_get_particulars("td_leave_balance", $select, $where, 1);

            //Remaining Balances
            unset($select);
            unset($where);
            $select =    array(

                "trans_cd", "ml_in", "el_in", "comp_off_in",
                "ml_out", "el_out", "comp_off_out",
                "ml_bal", "el_bal", "comp_off_bal",
                "balance_dt"

            );

            $where  =   array(

                "emp_code = '".($this->input->post('emp_code')? $this->input->post('emp_code') : $this->session->userdata('loggedin')->user_id)."'" => NULL,

                "balance_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' ORDER BY balance_dt" => NULL
                
            );

            $data['remaining_bal']  = $this->Leave->f_get_particulars("td_leave_balance", $select, $where, 0);

            $emp_code = $this->input->post('emp_code')? $this->input->post('emp_code') : $this->session->userdata('loggedin')->user_id;

            $data['emp_code'] = $emp_code;

            $from_dt = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');

            $data['date'] = array($from_dt,$to_date);


            //Employee Name

            unset($select);
            unset($where);

            $select =    array(

                "emp_name"
            );

            $where  =   array(

                "emp_code = '".($this->input->post('emp_code')? $this->input->post('emp_code') : $this->session->userdata('loggedin')->user_id)."'" => NULL
                
            );


            $data['emp_name'] = $this->Leave->f_get_particulars("md_employee", $select, $where, 0);

            
            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js',
                
                '/assets/plugins/datatables/jquery.dataTables.min.js'
            ];

            $script['cdnscript'] = [
            
                "https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js",
                "https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js",
                "https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"
            ];

            $this->load->view('reports/ledger/leaveledger', $data);

            $this->load->view('footer', $script);
        }
        else{

            //IF User is a HOD
            if($this->session->userdata('loggedin')->emp_type == 'H'){

                //Select Employees dependent on this HOD
                $emp_list   =   $this->Leave->f_get_particulars("md_manager", array('managed_emp'), array("manage_by" => $this->session->userdata('loggedin')->user_id), 0);
                
                $where_in = [$this->session->userdata('loggedin')->user_id];

                foreach($emp_list as $e_list){

                    array_push($where_in, $e_list->managed_emp);
                    
                }
                
                //Unrecommended Leave List
                $select     =   array(

                    "m.emp_code", "m.emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars_in("md_employee m", $select, $where_in, NULL);
                
            }//IF User is a HR
            else if($this->session->userdata('loggedin')->emp_type == 'HR'){

                $select     =   array(

                    "emp_code", "emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars("md_employee", $select, NULL, 0);

            }
            else{

                $data['emp_dtls'] = NULL;

            }

            $this->load->view('reports/ledger/form', $data);
            
            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
            
            ];

            $this->load->view('footer', $script);
        }

    }

    //For Leave Details
    public function f_details(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Leave Details
            $select = array(
                "trans_cd", "trans_dt", "recommend_dt",
                "approval_dt","from_dt","to_dt" ,"reason","recommend_by"
            );

            $where  =   array(

                "emp_code = '".($this->input->post('emp_code')? $this->input->post('emp_code') : $this->session->userdata('loggedin')->user_id)."'" => NULL,

                "trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' ORDER BY trans_dt" => NULL
                
            );

            $data['leave_dtls']  = $this->Leave->f_get_particulars("td_leaves_trans", NULL, $where, 0);

            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js',
                
                '/assets/plugins/datatables/jquery.dataTables.min.js'
            ];

            $this->load->view('reports/details/leavedetails', $data);

            $this->load->view('footer', $script);
        }
        else{

            //IF User is a HOD
            if($this->session->userdata('loggedin')->emp_type == 'H'){

                //Select Employees dependent on this HOD
                $emp_list   =   $this->Leave->f_get_particulars("md_manager", array('managed_emp'), array("manage_by" => $this->session->userdata('loggedin')->user_id), 0);
                
                $where_in = [$this->session->userdata('loggedin')->user_id];

                foreach($emp_list as $e_list){

                    array_push($where_in, $e_list->managed_emp);
                    
                }
                
                //Unrecommended Leave List
                $select     =   array(

                    "m.emp_code", "m.emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars_in("md_employee m", $select, $where_in, NULL);
                
            }//IF User is a HR
            else if($this->session->userdata('loggedin')->emp_type == 'HR'){

                $select     =   array(

                    "emp_code", "emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars("md_employee", $select, NULL, 0);

            }
            else{

                $data['emp_dtls'] = NULL;

            }

            $this->load->view('reports/details/form', $data);
            
            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
            
            ];

            $this->load->view('footer', $script);
        }

    }

    //For Leave Details For All Employees
    public function f_details_all(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Parameter Dates
            $fromDt = $this->input->post('from_date');
            $toDate = $this->input->post('to_date');

            $data['dates'] = array($fromDt,$toDate);

            $_SESSION['frm_dt'] = $fromDt;
            $_SESSION['to_dt']  = $toDate;

            //Leave Details
            $select = array(
                "trans_cd", "trans_dt","emp_code","leave_type","recommend_dt",
                "approval_dt","from_dt","to_dt" ,"reason","recommend_by","amount"
            );

            $where  =   array(

                "trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' ORDER BY trans_cd" => NULL
                
            );

            $data['leave_dtls_all']  = $this->Leave->f_get_leave_trans_dtls($fromDt,$toDate);

            

            
            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js',
                
                '/assets/plugins/datatables/jquery.dataTables.min.js'
            ];

            $this->load->view('reports/details/leavedetails_all', $data);

            $this->load->view('footer', $script);
        }
        else{

            //IF User is a HOD
            /*if($this->session->userdata('loggedin')->emp_type == 'H'){

                //Select Employees dependent on this HOD
                $emp_list   =   $this->Leave->f_get_particulars("md_manager", array('managed_emp'), array("manage_by" => $this->session->userdata('loggedin')->user_id), 0);
                
                $where_in = [$this->session->userdata('loggedin')->user_id];

                foreach($emp_list as $e_list){

                    array_push($where_in, $e_list->managed_emp);
                    
                }
                
                //Unrecommended Leave List
                $select     =   array(

                    "m.emp_code", "m.emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars_in("md_employee m", $select, $where_in, NULL);
                
            }//IF User is a HR
            else if($this->session->userdata('loggedin')->emp_type == 'HR'){

                $select     =   array(

                    "emp_code", "emp_name"

                );

                $data['emp_dtls']     =   $this->Leave->f_get_particulars("md_employee", $select, NULL, 0);

            }
            else{

                $data['emp_dtls'] = NULL;

            }*/



            $this->load->view('reports/details/form_all');
            
            $script['script'] = [
            
                '/assets/plugins/footable/js/footable.all.min.js',
    
                '/assets/plugins/bootstrap-select/bootstrap-select.min.js'
            
            ];

            $this->load->view('footer', $script);
        }

    }

    //Report In Excel
    public function pwExpence_xlsx() {

        $this->load->library('excel');

        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        $table_column = array("Leave No.","Date","Employee Code","Name","Leave Type","Leave Period",
                              "No.of Days","Recomend Date","Recomended By","Approval Date","Reason");

        $column = 0;

        foreach($table_column as $values){
            $object->getActiveSheet()->SetCellValueByColumnAndRow($column,1,$values);
            $column++;	
        }
 

        $xldata = $this->Leave->f_get_leave_trans_dtls($_SESSION['frm_dt'],$_SESSION['to_dt']);
        $rowCount = 2;

        foreach($xldata as $row){

            $object->getActiveSheet()->SetCellValueByColumnAndRow(0,$rowCount,$row->trans_cd);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(1,$rowCount,$row->trans_dt);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(2,$rowCount,$row->emp_code);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(3,$rowCount,$row->emp_name);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(4,$rowCount,$row->leave_type);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(5,$rowCount,$row->from_dt.'-'.$row->to_dt);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(6,$rowCount,$row->amount);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(7,$rowCount,$row->recommend_dt);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(8,$rowCount,$row->recommend_by);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(9,$rowCount,$row->approval_dt);
            $object->getActiveSheet()->SetCellValueByColumnAndRow(10,$rowCount,$row->reason);
            
            



            $rowCount++;
        }

        $filename = "All_Leave_Details-".date("d-m-Y H-i-s").'.xlsx';
        $object->getActiveSheet()->setTitle("All Leave Details");

        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($object,'Excel2007');
        $writer->save('php://output');
       
        exit;
    }

    //For Individual Details
    public function f_detail(){
        
        $select = array(

            "t.trans_cd", "t.emp_code", "m.emp_name",
            "t.leave_type", "t.reason", "t.from_dt",
            "t.to_dt", "t.remarks", "t.recommendation_status",
            "t.recommend_remarks", "t.recommend_by", "t.recommend_dt",
            "t.approval_status", "t.approved_by", "t.approval_dt",
            "t.approve_remarks", "t.rejection_status", "t.rejection_remarks",
            "t.rejected_by", "t.rejected_dt", "d.dept_name", "t.amount"

        );

        $where  =   array(

            "t.emp_code = m.emp_code"   =>  NULL,

            "t.department = d.sl_no"    =>  NULL,

            "t.trans_cd"                =>  $this->input->get('trans_cd')
            
        );
        
        $data['leave_dtls']    =   $this->Leave->f_get_particulars("td_leaves_trans t, md_employee m, md_departments d", $select, $where, 1);

        echo $this->load->view('reports/details/modal', $data, TRUE);

        exit();
    }
    //For Leave Closing Balance
    public function f_leaveBalance(){

        //Maximum Leave Balances
        $select = array(
            
            "trans_cd", "ml_bal", "el_bal",
            "comp_off_bal", "MAX(balance_dt) balance_dt"
        
        );

        $where  =   array(

            "emp_code = '".$this->session->userdata('loggedin')->user_id."' GROUP BY trans_cd, ml_bal, el_bal, comp_off_bal ORDER BY balance_dt DESC LIMIT 0,1" => NULL

        );

        $data = $this->Leave->f_get_particulars('td_leave_balance', $select, $where, 1);

        echo json_encode($data);
        
        exit();
    }

    /* Shubhankar */
    public function f_monthlyMLbalance() // For JS / getting the ML taken in this month
    {

        $date   =   $this->input->get('fromDate');
        $leave   =   $this->input->get('leaveType');
        $employee = $this->session->userdata('loggedin')->user_id;
        $result = $this->Leave->f_monthlyMLbalance($date, $leave, $employee);
        echo json_encode($result);
        exit();

    }


    /* Shubhankar */
    public function f_monthlyELbalance() // For JS / getting EL taken in this month and EL balance on application date(fromDt)
    {

        $date   =   $this->input->get('fromDate');
        $leave   =   $this->input->get('leaveType');
        $employee = $this->session->userdata('loggedin')->user_id;
        $latestElBalanceDt = $this->Leave->f_get_latest_elBalanceDt($employee, $date); // for getting max balance_dt to get el_balance
        $currBalance_dt = $latestElBalanceDt->balance_dt;
        
        $currElBalance = $this->Leave->f_get_current_elBalance($currBalance_dt, $employee); // for getting el_balance on leave application date

        echo json_encode($currElBalance);
        exit();

    }

    //For EL count 
    public function f_countEl(){

        $where  =   array(

            "emp_code"  =>  $this->session->userdata('loggedin')->user_id,

            "trans_dt BETWEEN '".$this->input->get('fromDt')."' AND '".$this->input->get('toDt')."'" => NULL

        );

        $data   =  $this->Leave->f_get_particulars("td_leaves_trans", array("count(1) count"), $where, 1);

        echo $data->count;

        exit;

    }

    //for overlapping dates
    public function f_overlapp(){

        $where  =   array(

            "emp_code"  =>  $this->session->userdata('loggedin')->user_id,

            "leave_dt BETWEEN '".$this->input->get('fromDt')."' AND '".$this->input->get('toDt')."'" => NULL

        );

        $data   =  $this->Leave->f_get_particulars("td_leave_dates", array("count(1) count"), $where, 1);

        if($data->count != 0){

            $data   =   $this->Leave->f_get_particulars("td_leave_dates", array("MAX(leave_dt) leave_dt"), array("emp_code"  =>  $this->session->userdata('loggedin')->user_id), 1);

            //Max leave date
            echo $data->leave_dt;

        }
        else {

            echo 1;

        }
        
        exit;

    }

    //for Lower Value of Compp Of
    public function f_lowerVal(){

        $select =    array(

            "emp_code", "comp_off_bal",
            "MAX(balance_dt) balance_dt",

        );

        $where  =   array(

            "emp_code = '".$this->session->userdata('loggedin')->user_id."' GROUP BY emp_code, comp_off_bal ORDER BY balance_dt DESC LIMIT 0,1" => NULL
            
        );

        $data   =  $this->Leave->f_get_particulars("td_leave_balance", $select, $where, 1);
        
        if($data->comp_off_bal == 0){

            echo false;

        }
        else {

            echo true;

        }
        
        exit;

    }

    #El Limit for those employees
    #Who have el balance <= 18

    public function f_elLimit(){

        //Last EL Out Date
        $data = $this->Leave->f_get_particulars('td_leave_balance', array('month(MAX(balance_dt)) month', 'year(MAX(balance_dt)) year'), array('emp_code' => $this->session->userdata('loggedin')->user_id, 'el_out > 0' => NULL, 'year(balance_dt)'=>date('Y')), 1);

        $lastDate= ($data->month) ? ($data->year.'-'.$data->month.'-'.'01') : date('Y').'-01-01';
        // $curDate= date('Y').'-'.date('m').'-'.'01';
        $curDate= $this->input->get('fromDt');
        
        $data = $this->Leave->f_get_particulars(NULL, array("TIMESTAMPDIFF(month, '$lastDate', '$curDate') AS DateDiff"), NULL, 1);
        
        echo $data->DateDiff;

        exit();
    }

    //Ml Limit for employees
    #An Employee can take 2 Sick Leave in a quarter
    public function f_mlLimit(){

        //In current year how many SL an employee has taken already
        $data = $this->Leave->f_get_particulars('td_leaves_trans', array('emp_code', 'SUM(amount) ml_out'), array('emp_code' => $this->session->userdata('loggedin')->user_id, 'leave_type' => 'M', 'year(trans_dt) = "'.date('Y').'" GROUP BY emp_code' => NULL), 1);

        // if($data){
        //     $lastDate = $data->year.'-'.$data->month.'-'.'01';
        // }
        // else{
        //     $lastDate = date('Y').'-01-01';
        //     $data = (object) array("ml_bal" => 2);
        // }
        
        // switch(date("F", strtotime($lastDate))){
        //     case 'January':
        //         $prevQuarter = 1;
        //         break;
        //     case 'February':
        //         $prevQuarter = 1;
        //         break;  
        //     case 'March':
        //         $prevQuarter = 1;
        //         break;
        //     case 'April':
        //         $prevQuarter = 2;
        //         break;
        //     case 'May':
        //         $prevQuarter = 2;
        //         break;
        //     case 'June':
        //         $prevQuarter = 2;
        //         break;
        //     case 'July':
        //         $prevQuarter = 3;
        //         break;  
        //     case 'August':
        //         $prevQuarter = 3;
        //         break;
        //     case 'September':
        //         $prevQuarter = 3;
        //         break;
        //     case 'October':
        //         $prevQuarter = 4;
        //         break;
        //     case 'November':
        //         $prevQuarter = 4;
        //         break;
        //     case 'December':
        //         $prevQuarter = 4;
        //         break;                
            
        // }

        switch(date("F", strtotime($this->input->get('fromDt')))){
            case 'January':
                $currQuarter = 1;
                break;
            case 'February':
                $currQuarter = 1;
                break;  
            case 'March':
                $currQuarter = 1;
                break;
            case 'April':
                $currQuarter = 2;
                break;
            case 'May':
                $currQuarter = 2;
                break;
            case 'June':
                $currQuarter = 2;
                break;
            case 'July':
                $currQuarter = 3;
                break;  
            case 'August':
                $currQuarter = 3;
                break;
            case 'September':
                $currQuarter = 3;
                break;
            case 'October':
                $currQuarter = 4;
                break;
            case 'November':
                $currQuarter = 4;
                break;
            case 'December':
                $currQuarter = 4;
                break;                
            
        }

        //echo date("F", strtotime($lastDate)).'-'.date("F", strtotime(date('Y-m-d')));exit;
        echo ($currQuarter * 2) - $data->ml_out;

        exit();
    }
}