<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SSD_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('SSD_Model');
        $this->load->model('Login_model');
    }

    public function ssd_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="SSD")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->SSD_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->SSD_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('ssd_view/templates/ssd_header', $data);
            $this->load->view('ssd_view/ssd_body');
            $this->load->view('ssd_view/templates/ssd_footer');
        }
        
    }

    public function ssd_home_ctrl()
    {
        $this->load->view('ssd_view/ssd_home');
    }

    public function select_ssd_week_ctrl()
    {
        $buHandle = $this->SSD_Model->getBU_Handle($_SESSION['id']);
        $lacking = $this->SSD_Model->lacking_data($buHandle,$_POST['week_id']);
        $badge_id = count($lacking);
          $lacking_ssd = '<div class="row">'; 

          if (count($lacking) > 0)
          {
            foreach ($lacking as $l) 
            {
                $lacking_ssd.='
                                <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                        <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->SSD_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                        <div class="tile-link"><div class="tile-link-overlay"></div>
                                            <div class="tile-link-content"><a href="#" onclick="approve_ssd_Data('."'".$l['month']."', '".$l['year']."', '".$_POST['week_id']."'".')">
                                             <button type="button" class="btn btn-success btn-lg">📤&nbsp;Submit Data</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
          }
          else 
          {
            $lacking_ssd .= '</div><center><h4>No Data</h4></center>';
          }
          $lacking_ssd .= ' </div>';

          $data['lacking_ssd'] = $lacking_ssd;
          $data['badge_id'] = $badge_id;
          echo json_encode($data);
    }

    public function ssd_record_ctrl()
    {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $week_id = $this->input->get('week_id');
        $data['years'] = $year;
        $data['months'] = $month;
        $data['week_ids'] = $week_id;
        $this->load->view('ssd_view/ssd_records_view', $data);
    }

    public function ssd_select_date_ctrl()
    {
        $year=$_POST['year_id_list'];
          $month_select = '';
              if(date('Y') == $_POST['year_id_list'])
              {
                      // $month_select.=' <option value="0"></option>';
                      for($a=1;$a<13;$a++)
                      {
                          if(date('m')>$a)
                          {
                              if($_POST['month_id_list'] == $a)
                              {
                                 $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                              $month_select.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date($year.'-'.$a.'-01'))).'</option>';
                          }
                      }    
              }
              else 
              {
                  // $month_select.=' <option value="0"></option>';
                   for($a=1;$a<13;$a++)
                   {
                        if($_POST['month_id_list'] == $a)
                              {
                                 $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                              $month_select.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date($year.'-'.$a.'-01'))).'</option>';
                   }
              }

        $buHandle = $this->SSD_Model->getBU_Handle($_SESSION['id']);
        $ssd_data= $this->SSD_Model->get_depts_model($buHandle);  
        $user_id=$_SESSION['id'];
      
        $dept_list = ' <table id="display_ssd_table" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="10" style="font-size: 20px;"><center>SSD Employee Record </center></th>                                                                 
                  </tr>

                 <tr style="background-color: white; text-align:left;">
                             <th style="width: 250px;">Department</th>
                            <th style="width: 80px; text-align:center">No. of Guards</th>
                            <th style="width: 80px; text-align:center">No. of Reliever</th>                                                                          
                            

                  </tr>
                  </thead>';

        $total_rec_guard='';
        $total_rec_reliever='';
        foreach($ssd_data as $dept)
        {
        $dept_list.='<tr style="background-color: white; text-align:center;">
                    <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'</td>
                    <td style="width: 80px;"> 
                    <input type="text" id="user_id" hidden value="'.$user_id.'">';

         //var_dump($user_id,$dept['dcode'],$_POST['date_from'],$_POST['date_to']); 
         $ssd_employee_data= $this->SSD_Model->get_ssd_employee_model($user_id,$dept['dcode'],$_POST['month_id_list'],$_POST['year_id_list'],$_POST['week_list_sel']);
          if(!empty($ssd_employee_data))
          {
            $dept_list.='<input type="text" value="'.$ssd_employee_data[0]['guard'].'" disabled class="guard" style="width: 70px; text-align:center;"></td>
                        <td style="width: 80px;"> ';
            $dept_list.='<input type="text"  value="'.$ssd_employee_data[0]['reliever'].'" disabled class="reliever" style="width: 70px; text-align:center;"></td>';
            $total_rec_guard+=$ssd_employee_data[0]['guard'];
            $total_rec_reliever+=$ssd_employee_data[0]['reliever'];
          }
          else{

            $dept_list.='
            <input type="number" min="0" max="50" step="1" class="guard" id="guard_'.$dept['dcode'].'" onkeyup="cacl_consumption('."'#guard_".$dept['dcode']."'".')"oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" style="width: 70px; text-align:center;"></td>
                      <td style="width: 80px;"> ';
          $dept_list.='<input type="number"  min="0" max="50" step="1" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" class="guard" id="reliever_'.$dept['dcode'].'" onkeyup="cacl_consumption('."'#reliever_".$dept['dcode']."'".')" style="width: 70px; text-align:center;"></td>';
          }
        }

         $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="text-align:left;"><strong>Total</strong></td>
                            <td style="width: 80px;" id="total_guard">'.$total_rec_guard.'</td>
                            <td style="width: 80px;" id="total_reliever">'.$total_rec_reliever.'</td>      
                  </tr>';

        $dept_list.='</tbody>
                    </table>
                   
                    ';

        
        $button_hide='EMPTY';
              if(!empty($ssd_employee_data))
              {
                    $button_hide='NOT EMPTY';
              }

        $ssd_data_save= $this->SSD_Model->get_depts_model($buHandle); 
        $save_list = '';
            foreach($ssd_data_save as $save)
            {
               $save_list .="^".$save['dcode'];
            }
               
           $dept_list_val='<input value ="'.$save_list.'" id="bu_id" style="display:none;">'; 

         $list=' <table  id="display_account_v2"  class="table table-bordered table-sm  table-hover" "table-layout:fixed;>
                  <thead class="bg-info text-white">
                  <tr>                   
                            <th style="width: 220px; text-align:left">Department</th>                                                                          
                            <th style="width: 60px; text-align:center">Guards</th>                                                                          
                            <th style="width: 60px; text-align:center">Reliever</th>  
                            <th class="column-title" style="width:40px; text-align:center;">Action</th>  

                  </tr>
                 </thead>
                ';

             $tbl_list_guard=$this->SSD_Model->display_account_list_model_v2($buHandle,$_SESSION['id'],$_POST['month_id_list'],$_POST['year_id_list'],$_POST['week_list_sel']);
             
          
              foreach ($tbl_list_guard as $guard) 
                {
                  $from_d = $guard['month'];
                  $month_name= date('F', strtotime($from_d));
                  $to_d = $guard['date_to'];
                  $date_to= date('F d, Y', strtotime($to_d));
                  
                  $department= $this->SSD_Model->get_department_model($guard['dcode']);
                  
                        $list.= '<tr><td class="a-left">' .$department[0]['dept_name'].'</td>';
                        $list.='<td style="text-align:center;">' .$guard['guard'].'</td>
                                <td style="text-align:center;">' .$guard['reliever'].'</td>';

                    $validate_approved= $this->SSD_Model->validate_approved_model($this->session->userdata('bu_id'),$_POST['month_id_list'],$_POST['year_id_list']);
                   if(empty($validate_approved))
                   {
                            $list.='<td> <center><button  type="button"  title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 12px; width: 73.025px; margin-bottom:0px;" id="modal_edit2_btn" onclick="edit_guard_amount_js('."'".$guard['id']."','".$month_name."','".$guard['year']."','".'Week &nbsp;'.$guard['week']."','".$department[0]['dept_name']."','".$guard['guard']."','".$guard['reliever']."'".')"><i class="fa fa-edit"></i>Update</button> </center></tr>';
                   }
                   else
                   {
                        $list.='<td><center><strong><label>Approved</label></strong></center></tr>';
                   }
                        
                }
        
            
                    $list.='
                            </table> 
                            <script type="text/javascript">
                                              
                                                 $("#display_account_v2").DataTable();
                                             
                                               </script>
                                               ';

              $data["list"] = $list;   

               $data['hidden_input'] = $dept_list_val;
               $data["html"] = $dept_list;
               $data["button_hide"] = $button_hide;
               $data['month_select'] =$month_select;
               echo json_encode($data);
    }

    public function save_guard_ctrl()
    {
        $save_ssd="success";
            $this->SSD_Model->save_guard_model($_POST['user_id'],$_POST['month_id'],$_POST['year_id'],$_POST['week_id'],$_POST['dcode'],$_POST['guard'],$_POST['reliever']);
        echo json_encode($save_ssd);

    }

    public function update_ssd_employee_ctrl()
    {
        $update="success";
        $this->SSD_Model->update_guard_model($_POST['edit_id'],$_POST['edit_guard'],$_POST['edit_reliever']);
        echo json_encode($update);
    }

    public function ssd_report_ctrl()
    {
        $this->load->view('ssd_view/ssd_reports_view');
    }

    public function ssd_month_year_v2_ctrl()
      {
          $year=$_POST['year_id'];
          $month_select = '';
              if(date('Y') == $_POST['year_id'])
              {
                     $month_select.='<option></option>';
                      for($a=1;$a<13;$a++)
                      {
                          if(date('m')>$a)
                          {
                              if($_POST['month_id'] == $a)
                              {
                                 $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                              $month_select.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date($year.'-'.$a.'-01'))).'</option>';
                          }
                      }    
              }
              else 
              {
                   $month_select.='<option></option>';
                   for($a=1;$a<13;$a++)
                   {
                        if($_POST['month_id'] == $a)
                              {
                                 $selected = 'selected';
                              }
                              else
                              {
                                $selected = '';
                              }
                              $month_select.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date($year.'-'.$a.'-01'))).'</option>';
                   }
              }


              $data['month_select'] =$month_select;


         $html='<table id= "display_ssd_id" style="width:100%" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="100" style="font-size: 20px;"><center>Active Guards of the Month</center></th>                                                                 
                  </tr> 
                  <tr style="background-color: white; text-align:center;">
                  <th style="vertical-align:middle; width: 140px; text-align:center;" rowspan="2" >Department</th>
                  <th style="vertical-align:middle; width: 140px; text-align:center;" colspan="2" >Week 1</th>
                  <th style="vertical-align:middle; width: 140px; text-align:center;" colspan="2" >Week 2</th>
                  <th style="vertical-align:middle; width: 140px; text-align:center;" colspan="2" >Week 3</th>
                  <th style="vertical-align:middle; width: 140px; text-align:center;" colspan="2" >Week 4</th>
                  </tr>
                  <tr style="background-color: white; text-align:center;">
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Guard</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Reliever</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Guard</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Reliever</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Guard</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Reliever</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Guard</th>
                    <th style="vertical-align:middle; width: 140px; text-align:center;" >Reliever</th>
                  </tr>
                  </thead>
                  ';
        $bu_id = $this->SSD_Model->getBU_Handle($_SESSION['id']);
       $department_data = $this->SSD_Model->get_guard_models_v2($_SESSION['id'], $bu_id, $_POST['year_id'], $_POST['month_id']);

          $user_id = $_SESSION['id'];

        $current_date = '';
        $all_data = array(); // Initialize the all_data array to store data for all departments

        foreach ($department_data as $data) {
            // Extract week from data
            $week = $data['week'];

            if ($current_date != $data['month'] . $data['year'] . $data['dcode']) {
                // New entry encountered, update $current_date and store the week_data for the previous department
                if (!empty($week_data)) {
                    $week_data['dcode'] = $current_dcode; // Store the 'dcode' value for the department
                    $all_data[] = $week_data;
                }
                $current_date = $data['month'] . $data['year'] . $data['dcode'];

                // Initialize week_data for the new entry
                $week_data = array_fill(1, 4, ['guard' => 'n/a', 'reliever' => 'n/a']);
                $current_dcode = $data['dcode']; // Store the 'dcode' value for the department

                // Fill in the data for the corresponding week
                $week_data[$week] = ['guard' => $data['guard'], 'reliever' => $data['reliever']];
            } else {
                // If the current date is the same, update the existing week_data
                $week_data[$week] = ['guard' => $data['guard'], 'reliever' => $data['reliever']];
            }
        }

        // Store the week_data for the last department entry
        if (!empty($week_data)) {
            $week_data['dcode'] = $current_dcode; // Store the 'dcode' value for the last department
            $all_data[] = $week_data;
        }

        // Now, use $all_data to fill the table with the accumulated data for each department
        foreach ($all_data as $department_week_data) {
            $html .= '<tr>';
              $depart_data = $this->SSD_Model->get_department_model($department_week_data['dcode']);
              $html .= '<td style="text-align:center;">' . $depart_data[0]['dept_name'] . '</td>';
          
            unset($department_week_data['dcode']); // Remove the 'dcode' from week data array
            foreach ($department_week_data as $week_info) {
                $html .= '<td style="text-align:center; color:orange;">' . $week_info['guard'] . '</td>
                          <td style="text-align:center; color:blue;">' . $week_info['reliever'] . '</td>';
            }
            $html .= '</tr>';
        }

               $html.='

                  
                      </table>';

                  $html.='<script>
                                           $(document).ready(function(){
                                               $("#display_ssd_id").DataTable();
                                             });
                                             </script> 
                      ';

                
                   $data['guard'] = $html; 
                   echo json_encode($data);
              }


}
?>