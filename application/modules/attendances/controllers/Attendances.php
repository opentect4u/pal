<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Global Variables.................................

class Attendances extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Attendance');

        $link['title']  = 'Attendance Details';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Attendance->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);
        
    }

    public function index(){

        //Attendance List
        $select =   array(
            
            "t.attendance_dt", "e.emp_code", "e.emp_name", 
            "e.img_path", "d.dept_name department", "t.status"
        );

        $where  =   array(

            "t.emp_code = e.emp_code" =>  NULL,
            
            "e.department = d.sl_no"   =>  NULL,

            "t.attendance_dt"  => date('Y-m-d')
            
        );

        $attendance['attendance_dtls']    =   $this->Attendance->f_get_particulars("td_attendances t, md_employee e, md_departments d", $select, $where, 0);
        
        $this->load->view("attendance/dashboard", $attendance);

        $script['script'] = [
        
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];

        $this->load->view('footer', $script);
        
    }

    public function f_add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if(!empty($_FILES['attndances']['name'])){

                $this->bulkEntry();
                
            }
            else{

                $this->invidualEntry();

            }
        }
        else {

            //Employee List
            $select = array(
                
                "m.emp_code", "m.emp_name", "d.dept_name department"
            );

            $where  = array(

                "m.department = d.sl_no"  => NULL
            ); 

            $data['employee_dtls']    =   $this->Attendance->f_get_particulars("md_employee m, md_departments d", $select, $where, 0);

            $this->load->view("attendance/form", $data);

            $script['script'] = [

                "/assets/plugins/moment/moment.js",
    
                "/assets/plugins/daterangepicker/daterangepicker.js"
    
            ];
    
            $this->load->view('footer', $script);
            
        }

    }

    //For Bulk Entry
    public function bulkEntry(){
        
        $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
					   'text/plain');
        if(!empty($_FILES['attndances']['name']) && in_array($_FILES['attndances']['type'], $csvMimes)){
 
            $csvFile = fopen($_FILES['attndances']['tmp_name'], 'r');
            
            while(($line = fgetcsv($csvFile)) !== FALSE){
                
                $data[] = array(

                    'emp_code'            =>  $line[0],
                    'attendance_dt'       =>  $this->input->post('date'),
                    'status'              =>  $line[3],
                    'created_by'          =>  $this->session->userdata('loggedin')->user_name,
                    'created_dt'          =>  date('Y-m-d h:i:s')

                );
                            
            }
            
            unset($data[0]);
            $data = array_values($data);
            
            $this->Attendance->f_insert_multiple('td_attendances', $data);

            fclose($csvFile);

            //Setting Messages
            $message    =   array( 
                    
                'message'   => 'Successfully added!',
                
                'status'    => 'success'
                
            );

            $this->session->set_flashdata('msg', $message);

            redirect('attendance');

        }

    }

    //For Individual Entry
    public function invidualEntry(){

        $data = array(

            'emp_code'            =>  $this->input->post('emp_code'),
            'attendance_dt'       =>  $this->input->post('date'),
            'status'              =>  $this->input->post('status'),
            'created_by'          =>  $this->session->userdata('loggedin')->user_name,
            'created_dt'          =>  date('Y-m-d h:i:s')

        );

        $this->Attendance->f_insert('td_attendances', $data);

        //Setting Messages
        $message    =   array( 
                
            'message'   => 'Successfully added!',
            
            'status'    => 'success'
            
        );

        $this->session->set_flashdata('msg', $message);

        redirect('attendance');

    }

    //For Status Update of Farmer
    public function f_updateStatus(){

        $value =  ($this->input->get('value') == "A")? "P":"A";

        $this->Attendance->f_edit('td_attendances', array("status" => $value), array('emp_code' => $this->input->get('trans_id')));

        echo $value;

        exit();
    }
	
}
    
?>
