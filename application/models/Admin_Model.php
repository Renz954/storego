<?php

class Admin_Model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
        // $this->db2 = $this->load->database('pis', TRUE);
       
    }

        public function display_table_users_model()
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->order_by('firstname','ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_store_list_model($bcode)
        {
            $store_id_arr = explode(';',$bcode);
            $this->db2->where_in('bcode',$store_id_arr);
            $this->db2->order_by('business_unit','ASC');
            $query= $this->db2->get('locate_business_unit');
            return $query->result_array();
        }

        public function count_users_model()
        {
            $this->db->select('*');
            $this->db->from('users');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function count_finance_model()
        {
            $this->db->select('*');
            $this->db->from('finance_record');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function count_billing_model()
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function count_meter_model()
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function display_table_unit_model()
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function display_old_meter_model()
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_bu_name_model($bcode)
        {
            $this->db2->select('bcode,business_unit');
            $this->db2->from('locate_business_unit');
            $this->db2->where('bcode',$bcode);
            $this->db2->order_by('business_unit', 'ASC');
            $query= $this->db2->get();
            return $query->result_array();
        }

        public function get_dept_name_model_v2($dcode)
        {
            $this->db2->select('*');
            $this->db2->from('locate_department');
            $this->db2->where('dcode',$dcode);
            $query= $this->db2->get();
            return $query->result_array();
        }

        public function new_dept_name_model_v2($dcode)
        {
            $this->db->select('*');
            $this->db->from('new_departments');
            $this->db->where('dcode', $dcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_company_name_model($engr_id)
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $this->db->where('engr_id', $engr_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_profile($profile)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $profile);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function val_bill_amount_model($c_name)
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $this->db->where('company_name',$c_name);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function save_default_amount_model($comp_id,$unit_id,$type_id)
        {
            $data = array(
               'company_name'  => $comp_id,
               'unit_cost'     => $unit_id,
               'type'          => $type_id
            );
            $this->db->insert('engineering_msfl' ,$data);
        }

        public function update_bill_cost_model($id,$edit_com,$edit_unit,$edit_type)
        {
            $data = array(           
             'engr_id'          => $id,
             'company_name'     => $edit_com,
             'unit_cost'        => $edit_unit,
             'type'             => $edit_type
             );
            $this->db->where('engr_id',$id);
            $this->db->update('engineering_msfl' ,$data);
        }

        public function get_dept_name_model($bcode)
        {
            $this->db2->select('*');
            $this->db2->from('locate_department');
            $this->db2->where('concat(company_code,bunit_code)',$bcode);
            if($bcode == '0203')
            {
                $this->db2->where_in('dcode', array('020314','020301', '020302', '020305', '020303', '020304', '020306', '020309')); // ICM
            }
            else if($bcode == '0201')
            {
                $this->db2->where_in('dcode', array('020109','020101', '020102', '020103', '020104', '020105', '020106', '020107', '020111'));  // ALTURAS          
            }
            else if($bcode == '0202')
            {
                $this->db2->where_in('dcode', array('020209','020201', '020202', '020204', '020205', '020206', '020207', '020208')); // TALIBON
            }
            else if($bcode == '0223')
            {
                $this->db2->where_in('dcode', array('022301','022302', '022303', '022304'));    // ALTACITTA            
            }
            else if($bcode == '0301')
            {
                $this->db2->where_in('dcode', array('030109','030101', '030103', '030104', '030105', '030106', '030107', '030110', '030108')); //PLAZA MARCELA
            }
            $this->db2->order_by('dcode', 'ASC');
            $query= $this->db2->get();
            return $query->result_array();
            // 020209', '022301', '020109', '020314', '030109
        }

        public function new_dept_name_model($bcode)
        {
            $this->db->select('*');
            $this->db->from('new_departments');
            $this->db->where('left(dcode,4)', $bcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_comp_name_model($type)
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $this->db->where('type', $type);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_old_reading_model($d_from,$d_to,$dept_id,$comp_id)
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $this->db->where('date_start',$d_from);
            $this->db->where('date_end',$d_to);
            $this->db->where('dcode',$dept_id);
            $this->db->where('comp_id',$comp_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function save_old_reading_model($d_from,$d_to,$store_id,$dept_id,$type,$comp_id,$reading)
        {
                $data = array( 

                    'date_start'=> $d_from,
                    'date_end'  => $d_to,
                    'bcode'     => $store_id,
                    'dcode'     => $dept_id,
                    'type'      => $type,
                    'comp_id'   => $comp_id,
                    'amount'    => $reading
            );

            $this->db->insert('old_meter_data',$data);
        }

        public function get_department_name_model($bcode,$dcode)
        {
            $this->db2->select('*');
            $this->db2->from('locate_department');
            $this->db2->where('concat(company_code,bunit_code)',$bcode);
            $this->db2->where('dcode <>',$dcode);
            if($bcode == '0203')
            {
                $this->db2->where_in('dcode', array('020301', '020302', '020305', '020303', '020304', '020306', '020309')); // ICM
            }
            else if($bcode == '0201')
            {
                $this->db2->where_in('dcode', array('020101', '020102', '020103', '020104', '020105', '020106', '020107', '020111'));   // ALTURAS          
            }
            else if($bcode == '0202')
            {
                $this->db2->where_in('dcode', array('020201', '020202', '020204', '020205', '020206', '020207', '020208')); // TALIBON
            }
            else if($bcode == '0223')
            {
                $this->db2->where_in('dcode', array('022302', '022303', '022304')); // ALTACITTA            
            }
            else if($bcode == '0301')
            {
                $this->db2->where_in('dcode', array('030101', '030103', '030104', '030105', '030106', '030107', '030110', '030108')); //PLAZA MARCELA
            }
            $this->db2->order_by('dcode', 'ASC');
            $query= $this->db2->get();
            return $query->result_array();

        }

        public function new_department_name_model($bcode,$dcode)
        {
            $this->db->select('*');
            $this->db->from('new_departments');
            $this->db->where('left(dcode,4)', $bcode);
            $this->db->where('dcode <>', $dcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_store_model_v2($bcode)
        {
            $this->db2->select('bcode,business_unit');
            $this->db2->from('locate_business_unit');
            $this->db2->where('bcode <>',$bcode);
            $this->db2->where_in('bcode', array('0223','0203','0301','0201','0202'));
            $this->db2->order_by('business_unit', 'ASC');
            $query= $this->db2->get();
            return $query->result_array();
        }

        public function get_company_name_model_v2($type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('engineering_msfl');
            $this->db->where('type', $type);
            $this->db->where('engr_id <>', $engr_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_old_meter_model($edit_from,$edit_to,$edit_store,$edit_dept,$edit_type,$edit_comp,$edit_reading)
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $this->db->where('date_start',$edit_from);
            $this->db->where('date_end',$edit_to);
            $this->db->where('bcode',$edit_store);
            $this->db->where('dcode',$edit_dept);
            $this->db->where('type',$edit_type);
            $this->db->where('comp_id',$edit_comp);
            $this->db->where('amount',$edit_reading);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function update_old_meter_model($id,$d_from,$d_to,$store_id,$dept_id,$type,$comp_id,$reading)
        {
                $data = array( 

                    'date_start'=> $d_from,
                    'date_end'  => $d_to,
                    'bcode'     => $store_id,
                    'dcode'     => $dept_id,
                    'type'      => $type,
                    'comp_id'   => $comp_id,
                    'amount'    => $reading
            );
            $this->db->where('id', $id);
            $this->db->update('old_meter_data',$data);
        }

        public function get_desig_model()
        {
            $this->db->order_by('designation', 'ASC');
            $query= $this->db->get('users_type');
            return $query->result_array();
        }

        public function get_store_model()
        {
            $this->db2->select('bcode,business_unit');
            $this->db2->from('locate_business_unit');
            $this->db2->where_in('bcode', array('0223','0203','0301','0201','0202'));
            $this->db2->order_by('business_unit', 'ASC');
            $query= $this->db2->get();
            return $query->result_array();
        }

        public function get_area_model()
        {
            $this->db->order_by('area_name','ASC');
            $query= $this->db->get('area_type');
            return $query->result_array();
        }

        public function get_billing_model()
        {
            $this->db->order_by('company_name','ASC');
            $query= $this->db->get('engineering_msfl');
            return $query->result_array();
        }

        public function validate_save_list_model($u_name)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('username',$u_name);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function new_user_model($f_name,$l_name,$u_name,$d_id,$s_id,$s_name,$bu_id,$engr)
        {
 
            if($d_id == 'Accounting Supervisor')
            {
                $data = array(           
                 'firstname'     => $f_name,
                 'lastname'      => $l_name,
                 'username'      => $u_name,
                 'designation'   => $d_id,
                 'bu_id'         => $s_id,
                 'store_name'    => $s_name,
                 'bu_id'         => $bu_id,
                 'engr_id'       => $engr,
                 'status'       => '1'
                
                );
            }
            else
            {
                $data = array(           
                 'firstname'     => $f_name,
                 'lastname'      => $l_name,
                 'username'      => $u_name,
                 'designation'   => $d_id,
                 'bu_id'         => $bu_id,
                 'bu_id'         => $s_id,
                 'store_name'    => $s_name,
                 'engr_id'       => $engr,
                 'status'       => '1'
                
                );
            }
            $this->db->insert('users' ,$data);
        }
}
?>