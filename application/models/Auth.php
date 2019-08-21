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


}