<?php

class Engineer_Model extends CI_Model
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

    public function get_engr_id_model($id)
    {
        $query = $this->db->query("select engr_id from users where id=?;", array($id));
        $row = $query->row_array();
        if(isset($row)){
                return $row["engr_id"];
        }

        return 0;
    }

    public function month_name($month)
    {
        return date("F", mktime(0, 0, 0, $month, 1, 2000));
    }

    public function lacking_data_engineering($bu_id, $type)
        {
            $lacking = array();

            $data = $this->db->select('*')
                ->from('engineering_billing')
                ->where(array('concat(company_code,bunit_code)' => $bu_id, 'type' => $type))
                ->get()
                ->result_array();

            for ($y = 2020; $y <= date('Y'); $y++) {
                $em = 12;

                if ($y == date('Y')) {
                    $em = date('n') - 1;
                }

                for ($m = 1; $m <= $em; $m++) {
                    $bu = $this->db->select('*')
                        ->from('engineering_billing')
                        ->where("CAST(CONCAT(`year`, '-', `month`, '-1') AS DATE) <= '" . $y . "-" . $m . "-1' " . "AND CONCAT(`company_code`, `bunit_code`) = '" . $bu_id . "' AND `type` = '" . $type . "'")
                        ->get()
                        ->result_array();

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

    public function get_company_msfl($engr_id,$type)
    {
        $engr_id_arr =  explode(';',$engr_id);
        $this->db->where_in('engr_id',$engr_id_arr);
        $this->db->where('type',$type);
        $this->db->order_by('company_name','ASC');
        $query= $this->db->get('engineering_msfl');
        return $query->result_array();
    }

    public function get_engr_msfl_v2($engr_id)
    {
        $this->db->select('unit_cost');
        $this->db->from('engineering_msfl');
        $this->db->where('engr_id', $engr_id);
        $query= $this->db->get();
        return $query->row();
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

    public function get_admin_model($bcode)
    {
        $this->db->select('*');
        $this->db->from('all_department');
        $this->db->where("LEFT(dcode, 4) = '$bcode'", NULL, FALSE);
        // $this->db->where_not_in('dept_name', 'ADMIN');
        $this->db->where('allow_dept', 0);
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by('dept_name', 'ASC');
        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_old_meter_model($dcode,$year,$month,$type,$engr_id)
    {
        $this->db->select('*');
        $this->db->from('old_meter_data');
        $this->db->where('dcode',$dcode);
        $this->db->where('YEAR(date_start)', $year);
        $this->db->where('MONTH(date_start)',$month);
        $this->db->where('type',$type);
        $this->db->where('comp_id',$engr_id);
        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_admin_billing_msfl($dept_code,$user_id,$year,$month,$type,$engr_id)
    {
        //echo $company_code."-->".$bunit_code."--->". $dept_code."---->".$user_id."---->".$year."---->".$month."<br>"  ;
        $this->db->select('*');
        $this->db->from('engineering_billing');
        $this->db->where('concat(company_code,bunit_code,dept_code)', $dept_code);
        $this->db->where('user_id',$user_id);
        $this->db->where('year',$year);
        $this->db->where('month',$month);
        $this->db->where('type',$type);
        $this->db->where('engr_id',$engr_id);
        $this->db->where_in('concat(company_code,bunit_code,dept_code)', array('020209', '022301', '020109', '020314', '030109'));
        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_billing_msfl($dept_code,$user_id,$year,$month,$type,$engr_id)
    {
        //echo $company_code."-->".$bunit_code."--->". $dept_code."---->".$user_id."---->".$year."---->".$month."<br>"  ;
        $this->db->select('*');
        $this->db->from('engineering_billing');
        $this->db->where('concat(company_code,bunit_code,dept_code)', $dept_code);
        $this->db->where('user_id',$user_id);
        $this->db->where('year',$year);
        $this->db->where('month',$month);
        $this->db->where('type',$type);
        $this->db->where('engr_id',$engr_id);

        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_billing_list_model_v2($user_id,$bu_id,$year,$month,$engr,$type)
    {
        $this->db->select('*');
        $this->db->from('engineering_billing');
        $this->db->where('user_id',$user_id);
        $this->db->where('concat(company_code,bunit_code)', $bu_id);
        $this->db->where('year',$year);
        $this->db->where('month',$month);
        $this->db->where('engr_id',$engr);
        $this->db->where('type',$type);
        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_dept_name_model($dcode)
    {
        $this->db->select('*');
        $this->db->from('all_department');
        $this->db->where('dcode',$dcode);
        // $this->db->where_not_in('dept_name', 'ADMIN');
        // $this->db->where('allow_dept', 0);
        // $this->db->where('status', 'ACTIVE');
        $this->db->order_by('dept_name', 'ASC');
        $query= $this->db->get();
        return $query->result_array();
    }

    public function get_engr_msfl($engr_id)
    {
        $this->db->select('*');
        $this->db->from('engineering_msfl');
        $this->db->where('engr_id', $engr_id);
        $query= $this->db->get();
        return $query->result_array();
    }

    public function status_approved_model($bcode,$month,$year)
    {
        $this->db->select('*');
        $this->db->from('store_expense_setup as setup');
        $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
        $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
        $this->db->where('setup.year', $year);
        $this->db->where('setup.month', $month);
        $this->db->where('setup.bu_id', $bcode);
        $this->db->where('exp.allocation_id', '3');

        $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_billing_model($company_code,$bunit_code,$dept_code,$user_id,$year,$month,$amount,$type,$rate,$engr_id)
    {

        $data = array(

       'company_code' => $company_code,
       'bunit_code'   => $bunit_code,
       'dept_code'    => $dept_code,
       'user_id'      => $user_id,
       'year'         => $year,
       'month'        => $month,
       'amount'       => $amount,
       'type'         => $type,
       'rate'         => $rate,
       'engr_id'      => $engr_id
       );
      $this->db->insert('engineering_billing' ,$data);
    }

    public function update_billing_model($id,$amount)
    {
        $data= array( 
            'amount'     => $amount
        );
        $this->db->where('bill_id',$id);
        $this->db->update('engineering_billing',$data);
    }


}
?>