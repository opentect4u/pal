<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Payroll extends CI_Model{

		
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

		public function f_get_payDetails($month){
			$sql = 'SELECT DATE("'.date("Y-m-d").'") trans_dt, MONTHNAME("'.$month.'") month, YEAR("'.date("Y-m-d").'") year, t.emp_code, m.emp_name, `d`.`dept_name` `department`, `m`.`designation`, `m`.`phn_no`, `m`.`email`, `m`.`joining_date`, `t`.bank_name , `t`.bank_ac_no, `t`.location , `t`.pf_ac_no, `t`.esi_no , `t`.pan_no, `t`.base_or_eligibitity, `t`.ifsc, `t`.basic , `t`.da, `t`.hra , `t`.conveyance, `t`.others , `t`.pf, `t`.esi , `t`.p_tax, `t`.incentives, `t`.misc_ear, `t`.tds, `t`.lwf, `t`.accommodation, `t`.laundry, `t`.advance , `t`.misc, `t`.tot_earnings , `t`.tot_deduction, `t`.net_amount 
					FROM `md_employee` `m`, `md_departments` `d`, `td_pay_statement` `t`
					WHERE `m`.`department` = `d`.`sl_no` AND `m`.`emp_code` = `t`.`emp_code` AND `m`.`emp_status` = "A"
					GROUP BY m.emp_code';

			return $this->db->query($sql)->result();	
		}

		public function f_get_payment(){

			$date = $this->input->post('year').'-'.$this->input->post('month').'-01';
			$month= date('F', strtotime($date));
			
			if($this->input->post('emp_code')){

				$sql = "SELECT t1.emp_code, t1.emp_name, t1.absent, t2.leaves, (DAY(LAST_DAY('".$this->input->post('year')."-".$this->input->post('month')."-01')) - (ifnull(t1.absent, 0) + ifnull(t2.leaves, 0))) working_dayes, t1.`net_amount` 
						FROM
						(SELECT t.`emp_code`, t.`emp_name`, a.`absent`, t.`net_amount` 
						FROM `td_pay_slip` t LEFT JOIN
							(SELECT * FROM td_absents 
									WHERE month = ".$this->input->post('month')." 
									AND year = ".$this->input->post('year').") a
							ON t.emp_code = a.emp_code
							WHERE t.`month` = '$month' 
							AND t.`year` = ".$this->input->post('year').") t1 LEFT JOIN
						(SELECT emp_code, COUNT(1) leaves FROM td_leave_dates 
						WHERE month(leave_dt) = ".$this->input->post('month')."
						AND year(leave_dt) = ".$this->input->post('year')."
						AND td_leave_dates.status = 'A' GROUP BY emp_code) t2
						
						ON t1.emp_code = t2.emp_code
						WHERE t1.emp_code = ".$this->input->post('emp_code')."";

			}
			else{

				$sql = "SELECT t1.emp_code, t1.emp_name, t1.absent, t2.leaves, (DAY(LAST_DAY('".$this->input->post('year')."-".$this->input->post('month')."-01')) - (ifnull(t1.absent, 0) + ifnull(t2.leaves, 0))) working_dayes, t1.`net_amount` 
						FROM
						(SELECT t.`emp_code`, t.`emp_name`, a.`absent`, t.`net_amount` 
						FROM `td_pay_slip` t LEFT JOIN
							(SELECT * FROM td_absents 
									WHERE month = ".$this->input->post('month')." 
									AND year = ".$this->input->post('year').") a
							ON t.emp_code = a.emp_code
							WHERE t.`month` = '$month' 
							AND t.`year` = ".$this->input->post('year').") t1 LEFT JOIN
						(SELECT emp_code, COUNT(1) leaves FROM td_leave_dates 
						WHERE month(leave_dt) = ".$this->input->post('month')."
						AND year(leave_dt) = ".$this->input->post('year')."
						AND td_leave_dates.status = 'A' GROUP BY emp_code) t2
						
						ON t1.emp_code = t2.emp_code";

			}
			
			return $this->db->query($sql)->result();
		}

		public function f_get_payment_sum(){
			$date = $this->input->post('year').'-'.$this->input->post('month').'-01';
			$month= date('F', strtotime($date));
			
			if($this->input->post('emp_code')){
				
				$sql = "SELECT SUM(t3.net_amount) net_amount FROM
						(SELECT t1.emp_code, t1.emp_name, t1.absent, t2.leaves, (DAY(LAST_DAY('".$this->input->post('year')."-".$this->input->post('month')."-01')) - (ifnull(t1.absent, 0) + ifnull(t2.leaves, 0))) working_dayes, t1.`net_amount` 
						FROM
						(SELECT t.`emp_code`, t.`emp_name`, a.`absent`, t.`net_amount` 
						FROM `td_pay_slip` t LEFT JOIN
							(SELECT * FROM td_absents 
									WHERE month = ".$this->input->post('month')." 
									AND year = ".$this->input->post('year').") a
							ON t.emp_code = a.emp_code
							WHERE t.`month` = '$month' 
							AND t.`year` = ".$this->input->post('year').") t1 LEFT JOIN
						(SELECT emp_code, COUNT(1) leaves FROM td_leave_dates 
						WHERE month(leave_dt) = ".$this->input->post('month')."
						AND year(leave_dt) = ".$this->input->post('year')."
						AND td_leave_dates.status = 'A' GROUP BY emp_code) t2
						
						ON t1.emp_code = t2.emp_code WHERE t1.emp_code = ".$this->input->post('emp_code').") t3";

			}
			else{

				$sql = "SELECT SUM(t3.net_amount) net_amount FROM
						(SELECT t1.emp_code, t1.emp_name, t1.absent, t2.leaves, (DAY(LAST_DAY('".$this->input->post('year')."-".$this->input->post('month')."-01')) - (ifnull(t1.absent, 0) + ifnull(t2.leaves, 0))) working_dayes, t1.`net_amount` 
						FROM
						(SELECT t.`emp_code`, t.`emp_name`, a.`absent`, t.`net_amount` 
						FROM `td_pay_slip` t LEFT JOIN
							(SELECT * FROM td_absents 
									WHERE month = ".$this->input->post('month')." 
									AND year = ".$this->input->post('year').") a
							ON t.emp_code = a.emp_code
							WHERE t.`month` = '$month' 
							AND t.`year` = ".$this->input->post('year').") t1 LEFT JOIN
						(SELECT emp_code, COUNT(1) leaves FROM td_leave_dates 
						WHERE month(leave_dt) = ".$this->input->post('month')."
						AND year(leave_dt) = ".$this->input->post('year')."
						AND td_leave_dates.status = 'A' GROUP BY emp_code) t2
						
						ON t1.emp_code = t2.emp_code) t3";

			}
			
			return $this->db->query($sql)->row();
		}

	}
	

?>
