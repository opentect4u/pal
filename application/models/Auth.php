<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Model {

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

        return;

    }

    //For Editing row
    public function f_edit($table_name, $data_array, $where) {

        $this->db->where($where);
        $this->db->update($table_name, $data_array);

        return;

    }

    //For Deliting row
    public function f_delete($table_name, $where) {

        $this->db->delete($table_name, $where);

        return;

    }

    //To fetch leave closing balance of an employee
    public function f_get_leave_closing($emp_cd){

        $sql = $this->db->query("select ml_bal,el_bal,comp_off_bal
                                 from td_leave_balance
                                 where emp_code = '$emp_cd'
                                 and   balance_dt = (select max(balance_dt)
                                                     from   td_leave_balance
                                                     where  emp_code = '$emp_cd')
                                 and trans_cd = (select max(trans_cd)
                                                 from   td_leave_balance
                                                 where  emp_code = '$emp_cd'
                                                 and    balance_Dt =(select max(balance_dt)
                                                                     from   td_leave_balance
                                                                     where  emp_code = '$emp_cd'))");
        return $sql->row();


    }

    //To get no. of pending leave under a HOD to be recomended by him
    public function f_get_hod_recom($emp_cd){

        $sql = $this->db->query("select count(*) lv_count 
                                 from td_leaves_trans 
                                 where recommendation_status = 0
                                 and   emp_code in (select managed_emp
                                                    from   md_manager
                                                    where  manage_by = '$emp_cd')");
        return $sql->row();
    }

    //To get no. of pending leave under a HR to be approved by him
    public function f_get_hr_recom(){

        $sql = $this->db->query("select count(*) lv_count 
                                 from td_leaves_trans 
                                 where recommendation_status = 1
                                 and   rejection_status =   0
                                 and   approval_status = 0");
        return $sql->row();
    }

    //To get no. of pending compoff under a HOD to be recomended by him
    public function f_get_hod_comp($emp_cd){

        $sql = $this->db->query("select count(*) lv_comp_count 
                                 from td_comp_apply 
                                 where recommendation_status = 0
                                 and   emp_code in (select managed_emp
                                                    from   md_manager
                                                    where  manage_by = '$emp_cd')");
        return $sql->row();
    }

    //To get no. of pending compoff under a HR to be approved by him
    public function f_get_hr_comp(){

        $sql = $this->db->query("select count(*) lv_comp_count 
                                 from td_comp_apply 
                                 where recommendation_status = 1
                                 and   rejection_status      = 0
                                 and   approval_status       = 0");
        return $sql->row();
    }

    //Approved Leave yet to be taken
    public function f_pendig_leave($userId,$date){

        $sql = $this->db->query("select count(*)pending_lv 
                                 from td_leaves_trans
                                 where approval_status  = 1
                                 and   rejection_status = 0
                                 and   emp_code         = '$userId'
                                 and   from_dt          > '$date'");

        return $sql->row(); 
    }

    //
    public function f_chk_asn($empno){

        $sql = $this->db->query("select count(*)cnt_emp
                                 from   md_manager
                                 where  managed_emp = '$empno' ");

        return $sql->row();
    }
}