<?php

class Bookkeeper_Model extends CI_Model
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

        public function get_profile_name($id)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row_array(); // This will return a single row as an associative array
        }

        public function update_photo($id,$photo)
        {
            $data= array( 
                'profile' => $photo
            );
            $this->db->where('id',$id);
            $this->db->update('users',$data);
        }

        public function getUserById($userId) 
        {
             $this->db->where('id', $userId);
             $query = $this->db->get('users');
             return $query->row_array();
        }

        public function updateUserPassword($userId, $hashedPassword) 
        {
            // Data to update
            $data = ['password' => $hashedPassword];

            // Update the password for the specified user ID
            $this->db->where('id', $userId);
            return $this->db->update('users', $data);
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

        public function get_full_name($id)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $id);
            $query= $this->db->get();
            return $query->row_array();
        }

        public function get_store_name($id)
        {
            $query = $this->db->query("select store_name from users where id=?;", array($id));
            $row = $query->row_array();
            if(isset($row)){
                    return $row["store_name"];
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

        public function select_date_agency_model($user_id,$dcode,$month,$year,$type)
        {
            $this->db->select('*');
            $this->db->from('agency_employee_list');
            $this->db->where('user_id',$user_id);
            $this->db->where('dcode',$dcode);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);  
            $this->db->where('agency_type',$type);  
            $query= $this->db->get();
            return $query->result_array();
        }

        public function display_agency_list_model($bu_id,$user_id,$agency,$year,$month)
        {
            $this->db->select('*');
            $this->db->from('agency_employee_list');
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('user_id',$user_id);
            $this->db->where('agency_type',$agency);
            $this->db->where('year_id',$year);
            $this->db->where('month_id',$month);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_department_model_v2($dcode)
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

        public function cydem_approved_model($bcode,$month,$year)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup as setup');
            $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
            $this->db->where('setup.year', $year);
            $this->db->where('setup.month', $month);
            $this->db->where('setup.bu_id', $bcode);
            $this->db->where('exp.allocation_id', '2');

            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query = $this->db->get();
            return $query->result_array();
        }

        public function save_agency_model($user_id,$month,$year,$agency,$dcode,$beginning,$end)
        {
            
            $data= array(

            'user_id'       => $user_id, 
            'month_id'      => $month, 
            'year_id'       => $year, 
            'agency_type'   => $agency, 
            'dcode'         => $dcode, 
            'beginning'     => $beginning,
            'end'           => $end
            );
            
            $this->db->insert('agency_employee_list' ,$data);
        }

        public function update_agency_model($id,$beg,$end)
        {
            $data= array( 
                'beginning' => $beg,
                'end'       => $end
            );
            $this->db->where('id',$id);
            $this->db->update('agency_employee_list',$data);
        }

        public function get_agents_model($id,$bu_id,$year,$month,$agent)
        {
            $this->db->select('*');
            $this->db->from('agency_employee_list');
            $this->db->where('user_id',$id);
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('agency_type',$agent);
            $this->db->order_by('dcode', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function display_table_book_model($year,$month,$bcode,$status)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            // $this->db->where('user_id',$user);
            $this->db->where('bcode',$bcode);
            if(!empty($status))
            {               
                 $this->db->where('status',$status);
            }
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_dept_name_model($dcode)
        {
            $this->db->select('*');
            $this->db->from('all_department');
            $this->db->where('dcode',$dcode);
            $this->db->where_not_in('dept_name', 'LEASING');
            $this->db->where('allow_dept', 1);
            $this->db->where('status', 'ACTIVE');
            $this->db->order_by('dept_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_date_model($year,$month,$bcode)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('bcode',$bcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_department_model($bcode)
        {
            $this->db->select('*');
            $this->db->from('all_department');
            $this->db->where("LEFT(dcode, 4) = '$bcode'", NULL, FALSE);
            $this->db->where_not_in('dept_name', 'LEASING');
            $this->db->where('allow_dept', 1);
            $this->db->where('status', 'ACTIVE');
            $this->db->order_by('dept_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_navision_file_model($month,$year,$id,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('user_id',$id);
            $this->db->where('bcode',$bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_data_navision_model($user_id,$bu_id,$year,$month,$dcode,$gross,$net,$mti,$mto,$profit,$name,$status)
        {
                if(empty($gross))
                {
                    $gross = 0;
                }
                elseif(empty($net))
                {
                    $net=0;
                }
                elseif(empty($mti))
                {
                    $mti=0;
                }
                elseif(empty($mto))
                {
                    $mto=0;
                }
                elseif(empty($profit))
                {
                    $profit=0;
                }
                $data = array(
                       'user_id'           => $user_id,
                       'bcode'             => $bu_id,
                       'year'              => $year,
                       'month'             => $month,
                       'dcode'             => $dcode,
                       'gross_sales'       => $gross,
                       'net_sales'         => $net,
                       'purchases_mti'     => $mti,
                       'mto'               => $mto,
                       'gross_profit'      => $profit,
                       'submitted_by'      => $name,
                       'status'            => $status
                             );
               $this->db->set('date_submitted', 'NOW()', FALSE);
               $this->db->insert('department_data',$data);
        }

        public function verfiy_password_model($user,$pass)
        {
            
            $uname = $user;
            $row = $this->check_username($uname); 
            if(isset($row))
             {
                if (password_verify($pass, $row['password'])) 
                {
                    return $row;
                } 
             }
        }

        private function check_username($uname)
        {
            $row = $this->db->select('*')->from('users')
                            ->where(array('username' => $uname, 'designation' => 'Accounting Supervisor'))
                            ->get()->row_array();
            return $row;
        }

        public function update_navision_allocation_model($id,$gross_sales,$net_sales,$mti,$mto,$gross_profit,$status)
        {
            $data= array( 
                'gross_sales'     => $gross_sales, 
                'net_sales'       => $net_sales,
                'purchases_mti'   => $mti,
                'mto'             => $mto,
                'gross_profit'    => $gross_profit,
                'status'          => $status
            );
            $this->db->where('id',$id);
            $this->db->update('department_data',$data);
        }

        public function display_table_expense_model($year,$month,$bcode,$status)
        {
            $this->db->select('setup.code as code, setup.description as description, setup.amount as amount, setup.id as setup_id, setup.status as status, types.allocation_name as allocation_name');
            $this->db->from('store_expense_setup as setup');
            $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
            $this->db->where('setup.year',$year);
            $this->db->where('setup.month',$month);
            // $this->db->where('setup.user_id',$user);
            $this->db->where('setup.bu_id',$bcode);
            if(!empty($status))
            {               
                 $this->db->where('setup.status',$status);
            }
            $query= $this->db->get();
            return $query->result_array();
        }

        public function valid_expense_model($year,$month,$bcode)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('bu_id',$bcode);
            // $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_store_expense_model($month,$year,$id,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('user_id',$id);
            $this->db->where('bu_id',$bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_store_expenses_model($bu_id,$row_code,$row_name)
        {
            $this->db->select('*');
            $this->db->from('store_expenses');
            $this->db->where('bu_id',$bu_id);
            $this->db->where('row_no',$row_code);
            if($row_code == 'L49')
            {
                $this->db->where('name',$row_name);
            }
            $this->db->order_by('name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function insert_html_upload_expense_model($id,$bu_id,$year,$month,$code,$description,$amount,$status)
        {
                 $amount = str_replace(',', '', $amount);
                $data = array(
                        'user_id'         => $id,
                        'bu_id'           => $bu_id,
                        'year'            => $year,
                        'month'           => $month,
                        'code'            => $code,
                        'description'     => $description,
                        'amount'          => $amount,
                        'status'          => $status
                );
                $this->db->insert('store_expense_setup',$data);
        }

        public function insert_expense_model($id,$bu_id,$year,$month,$amount,$descript,$coded,$status)
        {
                $data = array(
                        'user_id'         => $id,
                        'bu_id'           => $bu_id,
                        'year'            => $year,
                        'month'           => $month,
                        'code'            => $coded,
                        'description'     => $descript,
                        'amount'          => $amount,
                        'status'          => $status
                );
                $this->db->insert('store_expense_setup',$data);
        }

        public function update_date_expense_model($user_id,$year,$month)
        {
            $year2=$user_id.'Y';
             $month2=$user_id.'M';
            $this->db->set('year',$year);
            $this->db->set('month',$month);
            $this->db->where('year', $year2);
            $this->db->where('month', $month2);
            $this->db->update('store_expense_setup');
        }

        public function update_store_expense_model($id,$amount)
        {
            $data= array(
                'amount'  => $amount,
                'status'  => 'Pending'
            );
            $this->db->where('id',$id);
            $this->db->update('store_expense_setup', $data);
        }

        public function get_agency_model()
        {
            $this->db->select('*');
            $this->db->from('agency_expense');
            $this->db->order_by('agency_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        } 

        public function select_expense_agency_model($bu_id,$user_id,$month,$year,$id)
        {
            $this->db->select('*');
            $this->db->from('agency_breakdown');
            $this->db->where('user_id',$user_id);
            $this->db->where('bcode',$bu_id);
            $this->db->where('month',$month);
            $this->db->where('year',$year);         
            $this->db->where('agency_id',$id);          
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_store_expense_model_v2($month,$year,$id,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('user_id',$id);
            $this->db->where('bu_id',$bu_id);
            $this->db->where('description','Agency Fee/Management Fee');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function select_expense_agency_model_v2($bu_id,$user_id,$month,$year)
        {
            $this->db->select('*');
            $this->db->from('agency_breakdown');
            $this->db->where('user_id',$user_id);
            $this->db->where('bcode',$bu_id);
            $this->db->where('month',$month);
            $this->db->where('year',$year);             
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_agency_model_v2($agent_id)
        {
            $this->db->select('*');
            $this->db->from('agency_expense');
            $this->db->where('id',$agent_id);
            $this->db->order_by('agency_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        } 

        public function display_table_unit_model($bu_id)
        {
            $this->db->select('*');
            $this->db->from('store_expenses');
            $this->db->where('bu_id', $bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_allocation_type_name($allocation_id)
        {
            $this->db->select('*');
            $this->db->from('store_allocation_types');
            $this->db->where('id',$allocation_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_allocation_type_model()
        {
            $this->db->select('*');
            $this->db->from('store_allocation_types');
            $this->db->order_by('allocation_name', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validate_account_code_model($bu_id,$code)
        {
            $this->db->select('*');
            $this->db->from('store_expenses');
            $this->db->where('bu_id',$bu_id);
            $this->db->where('account_code',$code);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function save_account_code_model($bu_id,$code,$expense,$type)
        {
            $data= array(
                'bu_id'         => $bu_id,
                'account_code'  => $code,
                'name'          => $expense,
                'allocation_id' => $type
            );
            $this->db->insert('store_expenses',$data);
        }

        public function update_account_code_model($id,$code,$name,$type,$bu_id)
        {
            $data= array( 
                'account_code'     => $code, 
                'name'             => $name,
                'allocation_id'    => $type,
                'bu_id'            => $bu_id
            );
            $this->db->where('id',$id);
            $this->db->update('store_expenses',$data);
        }

        public function display_table_expense_model_v2($year,$month,$user,$bcode,$status)
        {
            $this->db->select('*');
            $this->db->from('store_expense_setup as setup');
            $this->db->join('store_expenses as exp', 'exp.account_code = setup.code AND exp.bu_id = setup.bu_id', 'inner');
            $this->db->join('store_allocation_types as types', 'types.id = exp.allocation_id', 'inner');
            $this->db->where('setup.year',$year);
            $this->db->where('setup.month',$month);
            $this->db->where('setup.user_id',$user);
            $this->db->where('setup.bu_id',$bcode);
            $this->db->order_by('exp.account_code', 'ASC');
            if(!empty($status))
            {               
                 $this->db->where('setup.status',$status);
            }
            $this->db->where("NOT EXISTS (SELECT 1 FROM store_expense_setup WHERE year = $year AND month = '$month' AND bu_id = '$bcode' AND status != 'Approved')");
            $query= $this->db->get();
            return $query->result_array();
        }

        public function allocation_type_model($code,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('store_expenses as expense');
            $this->db->join('store_allocation_types as type', 'type.id = expense.allocation_id','inner');
            $this->db->where('expense.account_code',$code);
            $this->db->where('expense.bu_id',$bu_id);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function department_total_model($user,$bu,$month,$year,$dcode)
        {
            $this->db->select('sum(gross_profit) as gross_profit, count(dcode) as dcode_total, sum(gross_sales) as gross_sales, sum(purchases_mti) as purchases_mti');
            $this->db->from('department_data');
            $this->db->where('user_id',$user);
            $this->db->where('bcode',$bu);
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where_in('dcode',$dcode);
            $query= $this->db->get();
            return $query->row();
        }

        public function hrd_total_model($bu,$month,$year)
        {
            $this->db->select('sum(average) as average');
            $this->db->from('hrd_employee_record');
            $this->db->where('concat(company_code,bunit_code)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('emp_type <>', 'NICO');
            $query= $this->db->get();
            return $query->row();
        }

        public function hrd_total_model_v2($bu,$month,$year)
        {
            $this->db->select('sum(average) as average');
            $this->db->from('hrd_employee_record');
            $this->db->where('concat(company_code,bunit_code)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('emp_type', 'NESCO');
            $query= $this->db->get();
            return $query->row();
        }

        public function cydem_total_model($bu,$month,$year)
        {
            $this->db->select('sum(beginning) as beginning, sum(end) as end');
            $this->db->from('agency_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('agency_type', 'Cydem');
            $query= $this->db->get();
            return $query->row();
        }

        public function cydem_total_model_v2($bu,$month,$year)
        {
            $this->db->select('sum(beginning) as beginning, sum(end) as end');
            $this->db->from('agency_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('agency_type', 'Cydem');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function floor_total_model($bu,$month,$year)
        {
            $this->db->select('sum(basement_1) as basement_1, sum(basement_2) as basement_2, sum(ground_floor) as ground_floor, sum(mezzanine) as mezzanine, sum(second_floor) as second_floor, sum(third_floor) as third_floor, sum(fourth_floor) as fourth_floor, sum(fifth_floor) as fifth_floor');
            $this->db->from('leasing_record');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $query= $this->db->get();
            return $query->row();
        }

        public function entech_total_model($bu,$month,$year)
        {
            $this->db->select('sum(beginning) as beginning, sum(end) as end');
            $this->db->from('agency_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('agency_type', 'Entech');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function nemplex_total_model($bu,$month,$year)
        {
            $this->db->select('sum(beginning) as beginning, sum(end) as end');
            $this->db->from('agency_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('agency_type', 'Nemplex');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function ssd_total_model($bu,$month,$year,$week)
        {
            $this->db->select('sum(guard) as guard, sum(reliever) as reliever');
            $this->db->from('ssd_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week', $week);
            $query= $this->db->get();
            return $query->row();
        }

        public function ssd_total_model_v2($bu,$month,$year,$week)
        {
            $this->db->select('sum(guard) as guard, sum(reliever) as reliever');
            $this->db->from('ssd_employee_list');
            $this->db->where('left(dcode,4)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week', $week);
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function engr_total_model($bu,$month,$year,$type)
        {
            $this->db->select('sum(amount) as amount');
            $this->db->from('engineering_billing');
            $this->db->where('concat(company_code,bunit_code)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('type', $type);
            $query= $this->db->get();
            return $query->row();
        }

        public function get_engr_id_expense_model($month,$year,$dcode,$type)
        {
            $this->db->select('*');
            $this->db->from('engineering_billing');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('type',$type);
            $this->db->where('concat(company_code,bunit_code,dept_code)',$dcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function engr_expense_model($month,$year,$dcode,$type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('engineering_billing');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('type',$type);
            $this->db->where('engr_id',$engr_id);
            $this->db->where('concat(company_code,bunit_code,dept_code)',$dcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function engr_dept_expense_model($month,$year,$dcode,$type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('engineering_billing');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('type',$type);
            $this->db->where('engr_id',$engr_id);
            $this->db->where('concat(company_code,bunit_code,dept_code)',$dcode);
            // $this->db->where_not_in('concat(company_code,bunit_code,dept_code)', array('020209', '022301', '020109', '020314', '030109'));
            $query= $this->db->get();
            return $query->row();
        }

        public function dept_old_meter_model($month,$year,$dcode,$type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $this->db->where('YEAR(date_start)', $year);
            $this->db->where('MONTH(date_start)',$month);
            $this->db->where('type',$type);
            $this->db->where('comp_id',$engr_id);
            $this->db->where('dcode',$dcode);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function validation_nav_model($user,$bu,$month,$year)
        {
                     
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('user_id',$user);
            $this->db->where('bcode',$bu);
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where("NOT EXISTS (SELECT 1 FROM department_data WHERE year = $year AND month = '$month' AND bcode = '$bu' AND status != 'Approved')");
            $this->db->order_by('dcode','ASC');
            $query= $this->db->get();
            return $query->row();
        }

        public function department_expense_model($user,$bu,$month,$year,$dcode)
        {
                     
            $this->db->select('*');
            $this->db->from('department_data');
            $this->db->where('user_id',$user);
            $this->db->where('bcode',$bu);
            $this->db->where('year',$year);
            $this->db->where('month',$month);
            $this->db->where('dcode',$dcode);
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $this->db->order_by('dcode','ASC');
            $query= $this->db->get();
            return $query->row();
        }

        public function hrd_expense_model($bu,$month,$year,$dcode)
        {
             if ($dcode === '020188' || $dcode === '020288' || $dcode === '020388' || $dcode === '022388' || $dcode === '030188') 
             {
                return (object) array('average' => '');
             }
            $this->db->select('sum(average) as average');
            $this->db->from('hrd_employee_record');
            $this->db->where('concat(company_code,bunit_code)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('concat(company_code,bunit_code,dept_code)',$dcode);
            $query= $this->db->get();
            return $query->row();
        }

        public function cydem_expense_model($month,$year,$dcode)
        {
            $this->db->select('sum(beginning) as beginning,sum(end)as end');
            $this->db->from('agency_employee_list');
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('dcode',$dcode);
            $this->db->where('agency_type', 'Cydem');
            $query= $this->db->get();
            return $query->row();
        }

        public function floor_expense_model($month,$year,$dcode)
        {
            $this->db->select('*');
            $this->db->from('leasing_record');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('dcode',$dcode);
            $query= $this->db->get();
            return $query->row();
        }

        public function ssd_expense_model($month,$year,$dcode,$week)
        {
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('dcode',$dcode);
            $this->db->where('week',$week);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_engr_admin_model($month,$year,$bcode,$type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('engineering_billing');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('type',$type);
            $this->db->where('concat(company_code,bunit_code)',$bcode);
            $this->db->where('engr_id',$engr_id);
            $this->db->where_in('concat(company_code,bunit_code,dept_code)', array('020209', '022301', '020109', '020314', '030109'));
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_admin_old_meter_model($month,$year,$bcode,$type,$engr_id)
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $this->db->where('YEAR(date_start)', $year);
            $this->db->where('MONTH(date_start)',$month);
            $this->db->where('type',$type);
            $this->db->where('bcode',$bcode);
            $this->db->where('comp_id',$engr_id);
            $this->db->where_in('dcode', array('020209', '022301', '020109', '020314', '030109'));
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_admin_old_meter_model_v2($month,$year,$bcode,$type)
        {
            $this->db->select('*');
            $this->db->from('old_meter_data');
            $this->db->where('YEAR(date_start)', $year);
            $this->db->where('MONTH(date_start)',$month);
            $this->db->where('type',$type);
            $this->db->where('bcode',$bcode);
            $this->db->where_in('dcode', array('020209', '022301', '020109', '020314', '030109'));
            $query= $this->db->get();
            return $query->result_array();
        }

        public function cydem_expense_model_v2($month,$year,$dcode)
        {
            $this->db->select('sum(beginning) as beginning,sum(end)as end, dcode');
            $this->db->from('agency_employee_list');
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('dcode',$dcode);
            $this->db->where('agency_type', 'Cydem');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function entech_expense_model($month,$year,$dcode)
        {
            $this->db->select('sum(beginning) as beginning,sum(end)as end');
            $this->db->from('agency_employee_list');
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('dcode',$dcode);
            $this->db->where('agency_type', 'Entech');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function nemplex_expense_model($month,$year,$dcode)
        {
            $this->db->select('sum(beginning) as beginning,sum(end)as end');
            $this->db->from('agency_employee_list');
            $this->db->where('month_id',$month);
            $this->db->where('year_id',$year);
            $this->db->where('dcode',$dcode);
            $this->db->where('agency_type', 'Nemplex');
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->row();
        }

        public function ssd_validation_model($month,$year,$week)
        {
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week',$week);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function ssd_expense_model_v2($month,$year,$dcode,$week)
        {
            $this->db->select('*');
            $this->db->from('ssd_employee_list');
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('week',$week);
            $this->db->where('dcode',$dcode);
            $this->db->where_not_in('dcode',array('020188', '020288', '020388', '022388', '030188'));
            $query= $this->db->get();
            return $query->result_array();
        }

        public function hrd_expense_model_v2($bu,$month,$year,$dcode)
        {
            $this->db->select('sum(average) as average');
            $this->db->from('hrd_employee_record');
            $this->db->where('concat(company_code,bunit_code)',$bu);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('concat(company_code,bunit_code,dept_code)',$dcode);
            $this->db->where('emp_type', 'NESCO');
            $query= $this->db->get();
            return $query->row();
        }

        public function validate_report_allo_model($year,$month,$dcode,$code,$code_name)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('year', $year);
            $this->db->where('month', $month);
            $this->db->where('dcode', $dcode);
            $this->db->where('code', $code);
            $this->db->where('code_name', $code_name);
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_bu_name_model($bcode)
        {
            $this->db->select('*');
            $this->db->from('all_business_unit');
            $this->db->where('bcode',$bcode);
            $query= $this->db->get();
            return $query->result_array();
        }  

        public function get_report_name_model($month,$year,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->order_by('dept_name', 'ASC');
            $this->db->group_by('dcode');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_report_code_model($month,$year,$bu_id)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->order_by('code', 'ASC');
            $this->db->group_by('code_name');
            $query= $this->db->get();
            return $query->result_array();
        }

        public function get_report_amount_model($month,$year,$bu_id,$code)
        {
            $this->db->select('*');
            $this->db->from('report_allocation');
            $this->db->where('left(dcode,4)',$bu_id);
            $this->db->where('month',$month);
            $this->db->where('year',$year);
            $this->db->where('code_name',$code);
            $this->db->order_by('code', 'ASC');
            $query= $this->db->get();
            return $query->result_array();
        }







}
?>