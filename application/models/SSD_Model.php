<?php

class SSD_Model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db2 = $this->load->database('pis', TRUE);
       
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

        public function lacking_data($bu_id, $week_id)
        {
            $lacking = array();

            $data = $this->db->select('*')->from('ssd_employee_list')
                ->where(array(
                    'LEFT(dcode, 4) =' => $bu_id,
                    'week' => $week_id
                ))->get()->result_array();

            for ($y = 2020; $y <= date('Y'); $y++) {
                $em = 12;

                if ($y == date('Y')) {
                    $em = date('n') - 1;
                }

                for ($m = 1; $m <= $em; $m++) {
                    $bu =  $this->db->select('*')->from('ssd_employee_list')
                        ->where("CAST(CONCAT(`year`,'-',`month`,'-1') AS DATE) <= '" . $y . "-" . $m . "-1'"
                            . " AND LEFT(dcode, 4) = " . $bu_id . " "
                            . " AND week = " . $week_id)->get()->result_array();

                    if (count($bu) > 0) {
                        $found = FALSE;
                        foreach ($data as $d) {
                            if ($d['month'] == $m && $d['year'] == $y) {
                                $found = TRUE;
                            }
                        }
                        if (!$found) {
                            $lacking[] = array('month' => $m, 'year' => $y);
                        }
                    }
                }
            }
            return $lacking;
        }

        public function get_depts_model($bcode)
        {
            $this->db->select('*');
            $this->db->from('all_department');
            $this->db->where("LEFT(dcode, 4) = '$bcode'", NULL, FALSE);
            // $this->db->where_not_in('dept_name', 'ADMIN');
            $this->db->where('allow_dept', 1);
            $this->db->where('status', 'ACTIVE');
            $this->db->order_by('dept_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_ssd_employee_model($user_id,$dcode,$month,$year,$week)
        {
            //var_dump($user_id,$dcode,$date_from,$date_to);
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('user_id',$user_id);
            $this->db->where('dcode',$dcode);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week',$week);
            
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_department_model($dcode)
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

        public function validate_approved_model($bcode,$month,$year)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup as setup');
            $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
            $this->db->where('setup.year', $year);
            $this->db->where('setup.month', $month);
            $this->db->where('setup.bu_id', $bcode);
            $this->db->where('exp.allocation_id', '9');

            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function display_account_list_model_v2($bu_id,$bcode,$month,$year,$week)
        {
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('user_id',$bcode);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week',$week);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function save_guard_model($user_id,$month,$year,$week,$dcode,$guard,$reliever)
        {
            $data= array(

                'user_id'       => $user_id, 
                'month'         => $month, 
                'year'          => $year, 
                'week'          => $week, 
                'dcode'         => $dcode, 
                'guard'         => $guard,
                'reliever'      => $reliever
            );

             $this->db->insert('ssd_employee_list' ,$data);
        }

        public function update_guard_model($id,$guard,$reliever)
        {
            $data= array( 
                'guard'     => $guard,
                'reliever'  => $reliever
            );
            $this->db->where('id',$id);
            $this->db->update('ssd_employee_list',$data);
        }

        public function get_guard_models_v2($id,$bu_id,$year,$month)
        {
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('user_id',$id);
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            // $this->db->order_by('week', 'ASC');
            $this->db->order_by('dcode', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }




}
?>