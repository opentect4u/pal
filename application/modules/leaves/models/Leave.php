<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Model {

	public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag) {

        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)) {

            $this->db->where($where);

        }

        $result		=	$this->db->get($table_name);

        if($flag == 1) {

            return $result->row();
            
        }else {

            return $result->result();

        }

    }

    //For inserting row

    public function f_insert($table_name, $data_array) {

        $this->db->insert($table_name, $data_array);

        return true;

    }

    //For Inserting Multiple Row

    public function f_insert_multiple($table_name, $data_array){

        $this->db->insert_batch($table_name, $data_array);

        return;

    }
    
    //For Editing row

    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);

        return true;

    }

    //For Deliting row

    public function f_delete($table_name, $where) {

        $this->db->delete($table_name, $where);

        return true;

    }

    //For Where in Clause for employees
    public function f_get_particulars_in($table_name, $select=NULL, $where_in='NO', $where=NULL) {

        if(isset($select)) {

            $this->db->select($select);

        }

        if(isset($where)){

            $this->db->where($where);

        }

        if(isset($where_in)){

            $this->db->where_in('m.emp_code', $where_in);

        }
        
        $result	=	$this->db->get($table_name);

        return $result->result();

    }

    /* Shubhankar */ 
    public function f_monthlyMLbalance($date, $leave, $employee) // For JS
    {

        $sql = $this->db->query(" SELECT SUM(amount) AS amount FROM td_leaves_trans 
                                WHERE emp_code = '$employee' AND leave_type = '$leave' 
                                AND approval_status = 1 AND MONTH(trans_dt) = MONTH('$date') ");
                                 
        return $sql->row();

    }

    /* Shubhankar */ 
    public function f_get_latest_elBalanceDt($employee, $date) // For JS 
    {

        $sql = $this->db->query(" SELECT MAX(balance_dt) AS balance_dt FROM td_leave_balance WHERE emp_code = '$employee' AND balance_dt <= '$date' ");
        return $sql->row();

    }

    /* Shubhankar */
    public function f_get_current_elBalance($currBalance_dt, $employee)
    {

        $sql = $this->db->query(" SELECT el_bal FROM td_leave_balance WHERE emp_code = '$employee' AND balance_dt = '$currBalance_dt' ");
        return $sql->row();

    } 


    public function f_get_closings(){
        
        return $this->db->query("SELECT `t1`.*, ifnull(`t2`.`ml_bal`, 0) `sl`, ifnull(`t2`.`el_bal`, 0) `el`, ifnull(`t2`.`comp_off_bal`, 0) `compoff` FROM

                (SELECT `m`.`emp_code`, `m`.`emp_name`, `d`.`dept_name` `department`, MAX(t.balance_dt) balance_dt 
                
                FROM `md_employee` `m`, `md_departments` `d`, `td_leave_balance` `t`
                
                WHERE `m`.`emp_code` = `t`.`emp_code` 
                AND `m`.`department` = `d`.`sl_no` 
                AND `m`.`emp_status` = 'A' GROUP BY t.emp_code) t1, (SELECT * FROM `td_leave_balance`) t2
                
                WHERE t1.emp_code = t2.emp_code
                AND t1.balance_dt = t2.balance_dt")->result();
                
    }

    //Fetching Leave Transaction Details For All Employee With in a given period 
    public function f_get_leave_trans_dtls($from_dt,$to_dt){
        $sql = $this->db->query("select a.trans_cd trans_cd,a.trans_dt trans_dt,a.emp_code emp_code,
                                        b.emp_name emp_name,a.leave_type leave_type,
                                        a.from_dt from_dt,a.to_dt to_dt,a.reason reason,
                                        a.amount amount,
                                        a.recommend_by recommend_by,a.recommend_dt recommend_dt,
                                        a.approval_dt approval_dt
                                from td_leaves_trans a,md_employee b
                                where a.emp_code = b.emp_code
                                and   a.trans_dt between '$from_dt' and '$to_dt' 
                                and   a.approval_status = 1
                                order by a.trans_cd");

        return $sql->result();
    }

}