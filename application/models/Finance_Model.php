<?php

class Finance_Model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->db2 = $this->load->database('pis', TRUE);
       
    }


        public function get_profile($profile)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $profile);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function getBU_Handle($id)
        {
            $query = $this->db->query("select bu_id from users where id=?;", array($id));
            $row = $query->row_array();
            if(isset($row)){
                    return $row["bu_id"];
            }

            return 0;
        }

        public function month_name($month)
        {
            return date("F", mktime(0, 0, 0, $month, 1, 2000));
        }

        public function setup_store_model_v2()
        {
            $this->db->select('*');
            $this->db->from('all_business_unit');
            $this->db->where('status', 'ACTIVE');
            $this->db->order_by('bu_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function select_pending_home_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bcode', $bcode);
            $this->db->where('status','Pending');
            $this->db->group_by('bcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_approved_home_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bcode', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM department_data WHERE year = $year AND month = '$month' AND bcode = '$bcode' AND status != 'Approved')");
            $this->db->group_by('bcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_pending_expense_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bu_id', $bcode);
            $this->db->where('status','Pending');
            $this->db->group_by('bu_id');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_approved_expense_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bu_id', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $this->db->group_by('bu_id');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_pending_nav_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bcode', $bcode);
            $this->db->where('status','Pending');
            $this->db->group_by('bcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_approved_nav_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bcode', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM department_data WHERE year = $year AND month = '$month' AND bcode = '$bcode' AND status != 'Approved')");
            $this->db->group_by('bcode');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function setup_store_model($id)
        {
            $this->db->select('*');
            $this->db->from('finance_record');
            $this->db->where('user_id', $id);
            $this->db->where('month_end', null); 
            $this->db->where('year_end', null); 
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_all_bu_model()
        {
            $this->db->select('*');
            $this->db->from('all_business_unit');
            $this->db->where('status', 'ACTIVE'); 
            $this->db->order_by('bu_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_bu_id_model_v2($bu_id)
        {
            $this->db->select('*');
            $this->db->from('all_business_unit');
            $this->db->where('bcode',$bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function select_date_nav_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bcode', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM department_data WHERE year = $year AND month = '$month' AND bcode = '$bcode' AND status != 'Approved')");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function finance_store_name_model($dcode)
        {
            $this->db->select('*');
            $this->db->from('all_department');
            $this->db->where('dcode',$dcode);
            // $this->db->where_not_in('dept_name', 'ADMIN');
            $this->db->where('allow_dept', 1);
            $this->db->where('status', 'ACTIVE');
            $this->db->order_by('dept_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function select_pending_exp_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bu_id', $bcode);
            $this->db->where('status','Pending');
            $this->db->group_by('bu_id');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_approved_exp_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('bu_id', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function select_date_exp_finance_model($year, $month, $bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup as setup');
            $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
            $this->db->where('setup.year', $year);
            $this->db->where('setup.month', $month);
            $this->db->where('setup.bu_id', $bcode);
            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_dept_name_model($store_id)
        {
            $this->db->select('*');
            $this->db->from('all_department');
            $this->db->where('left(dcode,4)',$store_id);
            $this->db->where('allow_dept !=', 0);
            $this->db->order_by('dept_name', 'asc');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_dept_code_model($year,$month,$store)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('left(dcode,4)',$store);
            $this->db->order_by('code', 'asc');
            $this->db->group_by('code');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_dept_data_model($year,$month,$store,$code_name)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('left(dcode,4)',$store);
            $this->db->where('code_name',$code_name);
            $this->db->order_by('dept_name', 'asc');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_dept_data_modelv2($year,$month,$store)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('left(dcode,4)',$store);
            $this->db->order_by('dept_name', 'asc');
            $this->db->group_by('dcode');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_dept_code_modelv2($year,$month,$dcode)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('dcode',$dcode);
            $this->db->order_by('code', 'asc');
            $query= $this->db->get();
            return $query->result_array();
        }







}
?>