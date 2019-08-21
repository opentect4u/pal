<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Attendance extends CI_Model{

		
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

		//For Inserting Multiple Row

		public function f_insert_multiple($table_name, $data_array){

			$this->db->insert_batch($table_name, $data_array);
	
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

		public function f_get_absents($month, $year){

			$sql = "SELECT t1.*, t2.month, t2.year, t2.absent, t2.half FROM (SELECT `e`.`emp_code`, `e`.`emp_name`, `e`.`img_path`, `d`.`dept_name` `department` FROM `md_employee` `e` , `md_departments` `d` WHERE `e`.`department` = `d`.`sl_no` AND `e`.`emp_status` = 'A') t1 LEFT JOIN (SELECT * FROM td_absents WHERE month = $month AND YEAR = $year ) t2 ON t1.emp_code = t2.emp_code";

			return $this->db->query($sql)->result();
		}

	}
	

?>
