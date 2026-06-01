<?php

class Supervisor_Model extends CI_Model
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

        public function get_bu_id_model($bu_id)
        {
            $bu_id_arr =  explode(';',$bu_id);
            $this->db->where_in('bcode',$bu_id_arr);
            $this->db->order_by('bu_name','ASC');
            $query= $this->db->get('all_business_unit');
            return $query->result_array();
        }

        public function pending_model($bu_id,$pending)
        {
                
             $this->db->where('bcode',$bu_id);
             $this->db->where('status',$pending);
             $this->db->order_by('month','ASC');
            $query= $this->db->get('department_data');
            return $query->result_array();
        }

        public function lacking_data($bu_id)
            {
                $lacking = array();

                $data = $this->db->select('*')
                 ->from('department_data')
                 ->where(array('bcode' => $bu_id, 'status' => 'Approved'))
                 ->or_where('status', 'Pending')
                 ->get()
                 ->result_array();


                for ($y = 2020; $y <= date('Y'); $y++) 
                {
                    $em = 12;
                        
                    if ($y == date('Y'))
                    {
                        $em = date('n') - 1;
                    }

                    for ($m = 1; $m <= $em; $m++)
                    {
                        $bu =  $this->db->select('*')->from('department_data')
                                  ->where("CAST(CONCAT(`year`,'-',`month`,'-1') AS DATE) <= '" . $y . "-" . $m . "-1'"
                                                    . " AND `bcode` = " . $bu_id . " ")->get()->result_array();
                        if(count($bu) > 0)
                        {
                            $found = FALSE;
                            foreach ($data as $d) 
                            {
                                if ($d['month'] == $m && $d['year'] == $y)
                                {
                                    $found = TRUE;
                                }
                            }
                            if (! $found)
                            {
                                $lacking[] = array('month' => $m, 'year' => $y);
                            }
                        }
                        
                    }
                }       
                return $lacking;
            }

        public function pending_expense_model($bu_id,$pending)
        {
             $this->db->where('bu_id',$bu_id);
             $this->db->where('status',$pending);
             $this->db->order_by('month','ASC');
             $query= $this->db->get('store_expense_setup');
             return $query->result_array();
        }

        public function lacking_expense_data($bu_id)
            {
                $lacking = array();

                $data = $this->db->select('*')
                 ->from('store_expense_setup')
                 ->where(array('bu_id' => $bu_id, 'status' => 'Approved'))
                 ->or_where('status', 'Pending')
                 ->get()
                 ->result_array();

                for ($y = 2020; $y <= date('Y'); $y++) 
                {
                    $em = 12;
                        
                    if ($y == date('Y'))
                    {
                        $em = date('n') - 1;
                    }

                    for ($m = 1; $m <= $em; $m++)
                    {
                        $bu =  $this->db->select('*')->from('store_expense_setup')
                                  ->where("CAST(CONCAT(`year`,'-',`month`,'-1') AS DATE) <= '" . $y . "-" . $m . "-1'"
                                                    . " AND `bu_id` = " . $bu_id . " ")->get()->result_array();
                        if(count($bu) > 0)
                        {
                            $found = FALSE;
                            foreach ($data as $d) 
                            {
                                if ($d['month'] == $m && $d['year'] == $y)
                                {
                                    $found = TRUE;
                                }
                            }
                            if (! $found)
                            {
                                $lacking[] = array('month' => $m, 'year' => $y);
                            }
                        }
                        
                    }
                }       
                return $lacking;
            }

        public function get_bu_id_model_v2($bu_id)
        {
            $this->db->select('*');
            $this->db->from('all_business_unit');
            $this->db->where('bcode',$bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function display_accounting_model_v2($year,$month,$bcode,$status)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('bcode',$bcode);
            if(!empty($status))
            {               
                 $this->db->where('status',$status);
            }
            $query= $this->db->get();
            return $query->result_array();
        }

        public function accounting_store_name_model($dcode)
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

        public function nav_status_model($id,$status)
        {
            $this->db->set('status',$status);
            $this->db->where('id',$id);
            $this->db->update('department_data');
        }

        public function display_expense_model_v2($year,$month,$bcode,$status)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            // $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('bu_id',$bcode);
            if(!empty($status))
            {               
                 $this->db->where('status',$status);
            }
            $query= $this->db->get();
            return $query->result_array();
        }

        public function expense_status_model($id,$status)
        {
             $this->db->set('status',$status);
             $this->db->where('id',$id);
             $this->db->update('store_expense_setup');
        }



}
?>