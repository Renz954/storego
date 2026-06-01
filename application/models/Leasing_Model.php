<?php

class Leasing_Model extends CI_Model
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

        public function lacking_data_leasing($bu_id)
        {
            $lacking = array();

            $data = $this->db->select('*')->from('leasing_record')
                ->where("LEFT(dcode, 4) = '$bu_id'")->get()->result_array();

            for ($y = 2020; $y <= date('Y'); $y++) 
            {
                $em = 12;
                
                if ($y == date('Y'))
                {
                    $em = date('n') - 1;
                }

                for ($m = 1; $m <= $em; $m++)
                {
                    $bu = $this->db->select('*')->from('leasing_record')
                        ->where("CAST(CONCAT(`year`, '-', `month`, '-1') AS DATE) <= '" . $y . "-" . $m . "-1' " 
                            . "AND LEFT(dcode, 4) = '" . $bu_id . "'")->get()->result_array();
                    
                    if (count($bu) > 0)
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

        public function get_floor_area_model($user_id,$dcode,$month,$year)
        {
            $this->db->select('*');
            $this->db->from('leasing_record');
            $this->db->where('user_id',$user_id);
            $this->db->where('dcode',$dcode);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function save_floor_model($user_id,$month,$year,$dcode,$b1,$b2,$gf,$mez,$second,$third,$fourth,$fifth)
        {
            $data= array(

                'user_id'       => $user_id, 
                'month'         => $month, 
                'year'          => $year, 
                'dcode'         => $dcode, 
                'basement_1'    => $b1, 
                'basement_2'    => $b2,
                'ground_floor'  => $gf,
                'mezzanine'     => $mez,
                'second_floor'  => $second,
                'third_floor'   => $third,
                'fourth_floor'  => $fourth,
                'fifth_floor'   => $fifth
            );

             $this->db->insert('leasing_record' ,$data);
        }

        public function profile_pic($empid)
        { 
            $this->db2->select("emp.name, emp.position, emp.emp_id, appl.lastname, appl.firstname, appl.home_address, appl.photo");
            $this->db2->from("pis.employee3 as emp");
            $this->db2->join("pis.applicant as appl","emp.emp_id = appl.app_id");
            $this->db2->where("emp.emp_id =", $empid);
            $this->db2->limit(1);       
            $result = $this->db2->get();
            return $result->row_array();
        }


}
?>