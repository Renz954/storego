<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Admin_Model');
        $this->load->model('Login_model');
         $this->load->helper('url');

    // Disable caching
    // $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    // $this->output->set_header('Pragma: no-cache');
    }

    public function administrator_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Administrator")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Admin_Model->get_profile($_SESSION['id']);
            $this->load->view('admin_view/templates/header', $data);
            $this->load->view('admin_view/body');
            $this->load->view('admin_view/templates/footer');
        }
    }

    public function admin_homepage()   
    {
        $this->load->view('admin_view/administrator_body');
        echo 'PHP version: ' . PHP_VERSION;
    }

    public function admin_user_ctrl()
    {
        $this->load->view('admin_view/user_view');
    }

    public function billing_unit_cost_ctrl()
    {
        $this->load->view('admin_view/billing_view');
    }

    public function old_meter_menu_ctrl()
    {
        $this->load->view('admin_view/meter_view');
    }

    public function display_table_users_ctrl()
    {
        $datas=$this->Admin_Model->display_table_users_model();
        $html = '<button class="btn cur-p btn-primary" onclick="display_adduser_js()" ><i class="fa fa-plus-circle "></i>&nbsp;<span><strong> User</strong></span></button>
                    <table id="save_users_data_table" class="table table-striped table-hover">
                      <thead class="text-white" style="background-color: slategray;">                       
                        <tr>                   
                          <th class="column-title">First Name</th>
                          <th class="column-title">Last Name</th>
                          <th class="column-title">Username</th>                                                                          
                          <th class="column-title">Designation</th>                                                                          
                          <th class="column-title">Store Name</th>                                                                                                  
                          <th class="column-title" ><center>Action</center></th>   
                          <th class="column-title"><center>Status</center></th>   
                        </tr>
                      </thead>
                      <tbody class="bg-light"> 
                       ';
        foreach ($datas as $d) 
        {
            if(!empty($d['bu_id']))
            {
             $not_empty = $d['bu_id'];
            }


            $bu_name=$this->Admin_Model->get_store_list_model($not_empty);

           $not_empty = '';
                    foreach($bu_name as $bu)
                    {
                        $not_empty.= $bu['business_unit'].'<br>';
                     }

                    $html   .= '<tr><td class="a-left" style="vertical-align:middle;">' .$d['firstname'] 
                          . '</td><td class="a-left" style="vertical-align:middle;">' .$d['lastname']                     
                          . '</td><td class="a-left" style="vertical-align:middle;">' .$d['username']                     
                          . '</td><td class="a-left" style="vertical-align:middle;">' .$d['designation'].'</td>';
                      $html.='<td class="a-left" style="vertical-align:middle;">'.$not_empty.'</td>
                          <td style="vertical-align:middle;">
                           <center>
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" id="modal_edit2_btn" onclick="edit_user_js('."'".$d['id']."','".$d['designation']."','".$d['store_name']."','".$d['firstname']."','".$d['lastname']."','".$d['username']."','".$d['bu_id']."','".$d['engr_id']."', '".$d['profile']."'".')" style="font-size: 12px;"><i class="fa fa-edit"></i>&nbsp;Edit</button></center></td>';
                        if($d['status'] == 1)
                        {
                           $html.='<td style="vertical-align:middle;" onclick=update_toggle_js('."'".$d['id']."','".'0'."'".')><center><input type="checkbox"  value="1" checked data-toggle="toggle" class="check_unchecked" data-size="sm"></center></td>';
                        }
                        else
                        {
                            $html.='<td style="vertical-align:middle;" onclick=update_toggle_js('."'".$d['id']."','".'1'."'".')><center><input type="checkbox"  value="0" data-toggle="toggle" class="check_unchecked" data-size="sm"></center></td>';
                        }
        }
                    
                 $html .= '</tbody>
                                </table>
                                    <script>
                                       $(document).ready(function(){
                                        $(".check_unchecked").bootstrapToggle();
                                         $("#save_users_data_table").DataTable({   
                                          });
                                       });
                                   </script>  
                                                  
                 ';
                            
                    $data["html"] =  $html;
                    echo json_encode($data);
    }

    public function admin_count_home_ctrl()
    {
        $count_users=$this->Admin_Model->count_users_model();
        $userCount = count($count_users);

        $count_finance=$this->Admin_Model->count_finance_model();
        $financeCount = count($count_finance);

        $count_billing=$this->Admin_Model->count_billing_model();
        $billingCount = count($count_billing);

        $count_meter=$this->Admin_Model->count_meter_model();
        $meterCount = count($count_meter);

        $data['count_users'] = $userCount;
        $data['count_finance'] = $financeCount;
        $data['count_billing'] = $billingCount;
        $data['count_meter'] = $meterCount;

        echo json_encode($data);
    }

    public function backup_database_ctrl()
    {
        // Define the path where you want to save the backup file.
        $backupPath = FCPATH . 'backups/';

        // Create the backups directory if it doesn't exist.
        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        // Generate a filename for the backup file.
        $filename = 'storego.sql';

        // Define the full path to the backup file.
        $backupFile = $backupPath . $filename;

        // Use the mysqldump command to create a database backup. Make sure mysqldump is in your system's PATH.
        $command = "mysqldump -h localhost -u storego -pstorego2022 storego > '$backupFile'";
        exec($command);


        // Check if the backup was successful.
        if (file_exists($backupFile)) {
            // Set the appropriate headers to force download the file.
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($backupFile));

            // Output the backup file.
            readfile($backupFile);
        } else {
            // Handle the case where the backup failed.
            echo 'Backup failed';
        }
    }

    public function display_table_unit_ctrl()
    {
        $tbl_unit_cost=$this->Admin_Model->display_table_unit_model();
                    $html=' 
                    <button  class="btn cur-p btn-primary"  onclick="engineer_modal()"><i class="fa fa-plus-circle "></i>&nbsp;<span><strong> Company</strong></span></button> 
                    <table  id= "display_unit_table" class="table table-striped table-hover">
                        <thead class="text-white" style="background-color: slategray;">
                            <tr>                   
                                <th class="column-title">Company Name</th>
                                <th class="column-title">Type</th>
                                <th class="column-title">Unit Cost</th>                                                                  
                                <th class="column-title" style="width:40px;">Action</th> 

                            </tr>
                        </thead>
                        <tbody class="bg-light">
                    ';
              
        foreach ($tbl_unit_cost as $cost) 
        {
           $html   .= '<tr><td class="a-left" style="vertical-align:middle;">' .$cost['company_name'].' 
                       </td><td class="a-left" style="vertical-align:middle;">' .$cost['type'].'                       
                       </td><td class="a-left" style="vertical-align:middle;">₱&nbsp;'.number_format($cost['unit_cost'],2).'    
                       </td><td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px; width: 62.025px;" id="modal_edit2_btn" onclick="edit_unit_cost_js('."'".$cost['engr_id']."','".$cost['company_name']."', '".$cost['type']."','".number_format($cost['unit_cost'], 2)."'".')"><i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
        }
         $html .= '
                            </tbody>
                        </table> 
                            <script>
                                $(document).ready(function(){
                                    $("#display_unit_table").DataTable({                                               
                                    });
                                }); 
                            </script>                                                                                
                            ';
                
        $data["html"] =  $html;
        echo json_encode($data);
    }

    public function display_old_meter_ctrl()
    {
            $tbl_unit_cost=$this->Admin_Model->display_old_meter_model();
                    $html=' 
                    <button class="btn cur-p btn-primary" onclick="old_meter_modal()"> <i class="fa fa-plus-circle"></i>&nbsp;<span><strong> Old Meter</strong></span></button> 
                <table id= "display_old_meter_table" class="table table-striped table-hover">
                   <thead class="text-white" style="background-color: slategray;">
                   <tr>                   
                          <th class="column-title">Date Start</th>
                          <th class="column-title">Date End</th>
                          <th class="column-title">Business Unit</th>
                          <th class="column-title">Department</th>
                          <th class="column-title">Type</th>
                          <th class="column-title">Company Name</th>
                          <th class="column-title">Amount</th>                                                                  
                          <th class="column-title" style="width:40px;">Action</th> 

                    </tr>
                    </thead>
                    <tbody class="bg-light">
                    ';
              
        foreach ($tbl_unit_cost as $cost) 
        {
            $bu_name=$this->Admin_Model->get_bu_name_model($cost['bcode']);
            $dept_name=$this->Admin_Model->get_dept_name_model_v2($cost['dcode']);
            $new_dept_name=$this->Admin_Model->new_dept_name_model_v2($cost['dcode']);
            $comp_name=$this->Admin_Model->get_company_name_model($cost['comp_id']);
            $html.= '<tr>
                <td class="a-left" style="vertical-align:middle;">' .$cost['date_start'].' </td>
                <td class="a-left" style="vertical-align:middle;">' .$cost['date_end'].'</td>
                <td class="a-left" style="vertical-align:middle;">' .$bu_name[0]['business_unit'].'</td>';
                if(!empty($dept_name))
                {                               
                    $html.='<td class="a-left" style="vertical-align:middle;">' .$dept_name[0]['dept_name'].'</td>';
                }
                if(!empty($new_dept_name))
                {
                    $html.='<td class="a-left" style="vertical-align:middle;">' .$new_dept_name[0]['dept_name'].'</td>';
                }

                $html.='<td class="a-left" style="vertical-align:middle;">' .$cost['type'].'</td>
                <td class="a-left" style="vertical-align:middle;">' .$comp_name[0]['company_name'].'</td>
                <td class="a-left" style="vertical-align:middle; text-align:right;">'.number_format($cost['amount'],2).'  </td>';
                if(!empty($dept_name))
                {                               
                    $html.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px; width: 62.025px;" id="modal_edit2_btn" onclick="edit_old_meter_js('."'".$cost['id']."','".$cost['date_start']."','".$cost['date_end']."','".$cost['bcode']."','".$bu_name[0]['business_unit']."','".$cost['dcode']."','".$dept_name[0]['dept_name']."','".$cost['type']."','".$cost['comp_id']."','".$comp_name[0]['company_name']."','".number_format($cost['amount'], 2)."'".')"><i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                }    

                if(!empty($new_dept_name))
                {                               
                    $html.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px; width: 62.025px;" id="modal_edit2_btn" onclick="edit_old_meter_js('."'".$cost['id']."','".$cost['date_start']."','".$cost['date_end']."','".$cost['bcode']."','".$bu_name[0]['business_unit']."','".$cost['dcode']."','".$new_dept_name[0]['dept_name']."', '".$cost['type']."','".$cost['comp_id']."','".$comp_name[0]['company_name']."','".number_format($cost['amount'], 2)."'".')"><i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                }    

        }
         $html .= '
                         </tbody>
                                    </table> 
                                     <script>
                                           $(document).ready(function(){
                                             $("#display_old_meter_table").DataTable({
                                              });
                                           }); 
                                       </script>
                                     ';
            
        $data["html"] =  $html;
        echo json_encode($data);
    }

    public function val_bill_amount_ctrl()
    {
        $validate_record=$this->Admin_Model->val_bill_amount_model($_POST['c_name']);
        $data['validate_engr']=$validate_record;
        echo json_encode($data);
    }

    public function save_default_amount_ctrl()
    {
        $save_unit_cost='success';
            $this->Admin_Model->save_default_amount_model($_POST['company_id'],$_POST['unit_id'],$_POST['type_id']);    
        echo json_encode($save_unit_cost);
    }

    public function update_bill_cost_ctrl()
    {
        $update_unit_cost='success';
        $this->Admin_Model->update_bill_cost_model($_POST['edit_id'],$_POST['edit_com'],$_POST['edit_unit'],$_POST['edit_type']);   
        echo json_encode($update_unit_cost);
    }

    public function old_meter_modal_ctrl()
    {
        $dept_name=$this->Admin_Model->get_dept_name_model($_POST['store_id']);
        $dept_list = '<option selected value="select" readonly></option>
                      <option value="select" disabled>--Select--</option>';
        foreach ($dept_name as $name) 
        {
            $dept_list .= '<option value="'.$name['dcode'].'">'.$name['dept_name'].'</option>';
        }
        $new_dept_name=$this->Admin_Model->new_dept_name_model($_POST['store_id']);
        foreach ($new_dept_name as $new) 
        {
            $dept_list .= '<option value="'.$new['dcode'].'">'.$new['dept_name'].'</option>';
        }

        $data['dept_list']=$dept_list;
        echo json_encode($data);
    }

    public function select_type_ctrl()
    {
        $comp_name=$this->Admin_Model->get_comp_name_model($_POST['type_id']);
        $comp_list = '<option selected value="select" readonly></option>
                      <option value="select" disabled>--Select--</option>';
        foreach ($comp_name as $comp) 
        {
            $comp_list .= '<option value="'.$comp['engr_id'].'">'.$comp['company_name'].'</option>';
        }
        $data['comp_list']=$comp_list;
        echo json_encode($data);
    }

    public function validate_old_reading_ctrl()
    {
        $validate_record=$this->Admin_Model->validate_old_reading_model($_POST['d_from'],$_POST['d_to'],$_POST['dept_id'],$_POST['comp_id']);
            $data['validate_old']=$validate_record;
            echo json_encode($data);
    }

    public function save_old_reading_ctrl()
    {
        $message='success';
        $this->Admin_Model->save_old_reading_model($_POST['d_from'],$_POST['d_to'],$_POST['store_id'],$_POST['dept_id'],$_POST['type_id'],$_POST['comp_id'],$_POST['reading_id']);
        echo json_encode($message);
    }

    public function edit_type_ctrl()
    {
        $html='<option value="'.$_POST['type'].'">'.$_POST['type'].'</option>';
        if($_POST['type'] == 'Water')
        {
            $html.='<option value="Electric">Electric</option>';
        }
        else
        {
            $html.='<option value="Water">Water</option>';
        }

        $data['html']=$html;
        echo json_encode($data);
    }

    public function edit_dept_ctrl()
    {
        $dept_list=$this->Admin_Model->get_department_name_model($_POST['bcode'],$_POST['dcode']);
        $new_dept_list=$this->Admin_Model->new_department_name_model($_POST['bcode'],$_POST['dcode']);
        $html='<option value="'.$_POST['dcode'].'">'.$_POST['dept_name'].'</option>';
        foreach($dept_list as $depts)
        {
            $html.='<option value="'.$depts['dcode'].'">'.$depts['dept_name'].'</option>';
        }

        foreach($new_dept_list as $new)
        {
            $html.='<option value="'.$new['dcode'].'">'.$new['dept_name'].'</option>';
        }

        $data['html']=$html;
        echo json_encode($data);
    }

    public function edit_bu_ctrl()
    {
        $bu_list=$this->Admin_Model->get_store_model_v2($_POST['bcode']);
        $html='<option value="'.$_POST['bcode'].'">'.$_POST['bu_name'].'</option>';
        foreach($bu_list as $bu)
        {
            $html.='<option value="'.$bu['bcode'].'">'.$bu['business_unit'].'</option>';
        }

        $data['html']=$html;
        echo json_encode($data);
    }

    public function edit_comp_ctrl()
    {
        $comp_list=$this->Admin_Model->get_company_name_model_v2($_POST['type'],$_POST['comp_id']);
        $html='<option value="'.$_POST['comp_id'].'">'.$_POST['comp_name'].'</option>';
        foreach($comp_list as $comp)
        {
            $html.='<option value="'.$comp['engr_id'].'">'.$comp['company_name'].'</option>';
        }

        $data['html']=$html;
        echo json_encode($data);
    }

    public function validate_old_meter_ctrl()
    {
        $validate_record=$this->Admin_Model->validate_old_meter_model($_POST['edit_from'],$_POST['edit_to'],$_POST['edit_store'],$_POST['edit_dept'],$_POST['edit_type'],$_POST['edit_comp'],$_POST['edit_reading']);
        $data['validate']=$validate_record;
        echo json_encode($data);
    }

    public function update_old_meter_ctrl()
    {
        $message='success';
            $this->Admin_Model->update_old_meter_model($_POST['id'],$_POST['edit_from'],$_POST['edit_to'],$_POST['edit_store'],$_POST['edit_dept'],$_POST['edit_type'],$_POST['edit_comp'],$_POST['edit_reading']);
        echo json_encode($message);
    }

    public function display_adduser_ctrl()
    {
        $desig_data=$this->Admin_Model->get_desig_model();
        $desig_user = '<option value="select" readonly></option>
                       <option value="select" disabled>--Select--</option>';
        foreach ($desig_data as $desig) 
        {
            $desig_user .= '<option value="'.$desig['designation'].'">'.$desig['designation'].'</option>';
        }

        $store_data=$this->Admin_Model->get_store_model();
        $store_user = '<option value="select" readonly></option>
                       <option value="select" disabled>--Select--</option>';
        foreach ($store_data as $store) 
        {
            $store_user .= '<option value="'.$store['bcode'].'">'.$store['business_unit'].'</option>';
        }

        $area_data=$this->Admin_Model->get_area_model();
        $area_type='<option value="select" readonly ></option>
                    <option value="select" disabled >--Select--</option>';
        foreach ($area_data as $area)
        {
            $area_type.='<option value="'.$area['area_name'].'">'.$area['area_name'].'</option>';
        }

        $billing_data=$this->Admin_Model->get_billing_model();
        
        $billing_type='';
        foreach ($billing_data as $billing)
        {
            $billing_type.=' <option value="'.$billing['engr_id'].'">'.$billing['company_name'].'&nbsp;-&nbsp;'.$billing['unit_cost'].'</option>';
        }

        $data['desig']=$desig_user;
        $data['store']=$store_user;
        $data['areas']=$area_type;
        $data['billing']=$billing_type;
        echo json_encode($data);
    }

    public function validate_record_save_ctrl()
    {
        $validate_record=$this->Admin_Model->validate_save_list_model($_POST['u_name']);
        $data['validatesss']=$validate_record;
        echo json_encode($data);
    }

    public function record_admin_users_ctrl()
    {
        $this->Admin_Model->new_user_model($_POST['f_name'],$_POST['l_name'],$_POST['u_name'],$_POST['d_id'],$_POST['s_id'],$_POST['s_name'],$_POST['bu_id'],$_POST['engr_id']);    
    }








}
