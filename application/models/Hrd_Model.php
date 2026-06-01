<?php

class Hrd_Model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->db2 = $this->load->database('pis', TRUE);
         $this->load->helper('url');

    // Disable caching
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
       
    }


        public function get_profile($profile)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $profile);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function lacking_data_hrd($bu_id)
        {
            $lacking = array();

                $data = $this->db->select('*')->from('hrd_employee_record')
                              ->where(array('concat(company_code,bunit_code)' => $bu_id))->get()->result_array();

                for ($y = 2020; $y <= date('Y'); $y++) 
                {
                    $em = 12;
                        
                    if ($y == date('Y'))
                    {
                        $em = date('n') - 1;
                    }

                    for ($m = 1; $m <= $em; $m++)
                    {
                        $bu = $this->db->select('*') ->from('hrd_employee_record')
                        ->where("CAST(CONCAT(`year`, '-', `month`, '-1') AS DATE) <= '" . $y . "-" . $m . "-1' " 
                            . "AND CONCAT(`company_code`, `bunit_code`) = '" . $bu_id . "'") ->get() ->result_array();
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

            public function month_name($month)
            {
                return date("F", mktime(0, 0, 0, $month, 1, 2000));
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

            public function get_record_model($bcode,$year)
            {
                $this->db->select('*');
                $this->db->from('hrd_employee_record');
                $this->db->where('concat(company_code,bunit_code)',$bcode);
                $this->db->where('year',$year);
                $this->db->order_by('month');
                $this->db->group_by('month');
                $query= $this->db->get();
                return $query->result_array();
            }

            public function get_record_model_v2($month,$year,$bu_id)
            {
                $this->db->select('*');
                $this->db->from('hrd_employee_record');
                $this->db->where('concat(company_code,bunit_code)',$bu_id);
                $this->db->where('month',$month);
                $this->db->where('year',$year);
                $this->db->order_by('month');
                $query= $this->db->get();
                return $query->result_array();
            }



        
}
?>