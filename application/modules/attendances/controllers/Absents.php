<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absents extends MX_Controller {

    public function __construct(){

        parent::__construct();
        
        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        $this->load->model('Attendance');

        $link['title']  = 'Absent Details';

        $link['link']   =   [

            "/assets/plugins/footable/css/footable.core.css",

            "/assets/plugins/bootstrap-select/bootstrap-select.min.css"

        ];

        $select = array("emp_code", "emp_name", "img_path");

        $link['user_dtls']   = $this->Attendance->f_get_particulars("md_employee", $select, array("emp_code" => $this->session->userdata('loggedin')->user_id), 1);


        $this->load->view('header', $link);
        
    }

    public function index(){

        //Abcent List
        $data =   $this->Attendance->f_get_absents(date('m'), date('Y'));
        
        $absent['absent_dtls'] = $this->genAbsent($data);

        $absent['month'] = $this->Attendance->f_get_particulars('md_month', null, null, 0);

        $this->load->view("absent/dashboard", $absent);

        $script['script'] = [
        
            '/assets/plugins/footable/js/footable.all.min.js',

            '/assets/plugins/bootstrap-select/bootstrap-select.min.js',

            'js/footable-init.js',

            '/assets/plugins/datatables/jquery.dataTables.min.js'
        
        ];

        $this->load->view('footer', $script);
        
    }

    public function genAbsent($data){

        $string = '';

        foreach($data as $list){
            $string .= '

                <tr>

                    <td><input type="text" style="border: none; width: 70px; color: #77848c;" name="emp_code[]" value="'.$list->emp_code.'" readonly /></td>
                    <td class="row">
                        
                        <img class="avatar" src="'.base_url($list->img_path).'" alt="Profile Image" height="40" width="50">
                        <div style="margin-left: 10px;">

                            '.$list->emp_name.'

                        </div>    
                        
                    </td>
                    <td>'.$list->department.'</td>
                    <td><input type="text" class="form-control" name="absent[]" style="width: 70px;" value="'.(($list->absent)? $list->absent : 0).'" /></td>
                    <td><input type="text" class="form-control" name="half[]" style="width: 70px;" value="'.(($list->half)? $list->half : 0).'" /></td>

                </tr>
            
            ';
        }

        return $string;

    }

    public function f_add(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
             if(!empty($_FILES['inputfile']['name'])){

                $this->bulkEntry();
                
            }
            else{ 
                $this->Attendance->f_delete('td_absents', array('month'=>$this->input->post('month'), 'year'=>$this->input->post('year')));

                $this->invidualEntry();

             }
        }
        else {

            //Employee List
            $select = array(
                
                "m.emp_code", "m.emp_name", "d.dept_name department"
            );

            $where  = array(

                "m.department = d.sl_no"  => NULL,
                "m.emp_status" => 'A'

            ); 

            $data['employee_dtls']    =   $this->Attendance->f_get_particulars("md_employee m, md_departments d", $select, $where, 0);

            $this->load->view("absent/form", $data);

            $script['script'] = [

                "/assets/plugins/moment/moment.js",
    
                "/assets/plugins/daterangepicker/daterangepicker.js"
    
            ];
    
            $this->load->view('footer', $script);
            
        }

    }

    public function bulkEntry(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            if(!empty($_FILES['inputfile']['name']) && in_array($_FILES['inputfile']['type'], $csvMimes)){
    
                $csvFile = fopen($_FILES['inputfile']['tmp_name'], 'r');
    
                $i = true;
                $j = false;
                $k = 0;
                $status = false;
                echo "<pre>";
    
                while(($line = fgetcsv($csvFile)) !== FALSE){
    
                    $data_array[] = array(

                        'emp_code'          =>  explode(',', $line[0])[1],
                        'basic'             =>  $line[1],
                        'da'                =>  $line[2],
                        'hra'               =>  $line[3],
                        'conveyance'        =>  $line[4],
                        'tot_earnings'      =>  $line[7],
                        'pf'                =>  ($line[8] === 'N/A')? 0: $line[8],
                        'tot_deduction'     =>  $line[8],
                        'net_amount'        =>  $line[7] - $line[8],
    
                    );

                    }
                        
                }
                
                $this->Attendance->f_insert_multiple('td_pay_statement', $data_array);
                //$this->Attendance->f_insert_multiple('md_users', $user);
                die;
                fclose($csvFile);
            
        }
    }

    public function f_getDtls(){

        $data =   $this->Attendance->f_get_absents($this->input->get('month'), $this->input->get('year'));
        echo $this->genAbsent($data);

        exit();

    }

    //For Individual Entry
    public function invidualEntry(){

        for($i = 0; $i < count($this->input->post('emp_code')); $i++){

            $dataForInsert[] = array(
                
                "month"         => $this->input->post('month'),
                "year"          => $this->input->post('year'),
                "emp_code"      => $this->input->post('emp_code')[$i],
                "absent"        => $this->input->post('absent')[$i],
                "half"          => $this->input->post('half')[$i]
                
            );
            
        }

        if(isset($dataForInsert)){
            $this->Attendance->f_insert_multiple('td_absents', $dataForInsert);
        }

        //Setting Messages
        $message    =   array( 
                
            'message'   => 'Successfully added!',
            
            'status'    => 'success'
            
        );

        $this->session->set_flashdata('msg', $message);

        redirect('attendance/absents');

    }
	
}
    
?>
