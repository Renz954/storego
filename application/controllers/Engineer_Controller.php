<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Engineer_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Engineer_Model');
        $this->load->model('Login_model');
    }

    public function engineer_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Store Engineer")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Engineer_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('engineer_view/templates/engineer_header', $data);
            $this->load->view('engineer_view/engineer_body');
            $this->load->view('engineer_view/templates/engineer_footer');
        }
        
    }

    public function engineer_home_ctrl()
    {
        $this->load->view('engineer_view/engineer_home');
    }

    public function engineer_dashboard_ctrl()
    {
        $buHandle = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
        $lacking_water = $this->Engineer_Model->lacking_data_engineering($buHandle,'water');
          $lacking_wat = '
                                    <div><h2><span id="show_hides" 
                        data-toggle="collapse" data-target="#lackingWaterCollapse"
                        class="cursor-pointers">🚫 Water Expense Lacking Data&nbsp&nbsp<i class="fa fa-chevron-down"></i>
                        <div class="badge progress-bar-danger badge-custom">' . count($lacking_water) . '</div>
                        <span id="hintTexts" style="color: #999; font-size: 12px;" class="hint-texts">Click to show</span></span> 
                                    </h2>
                                    </div>
                                    <hr class="custom-hr">
                                    <div id="lackingWaterCollapse" class="collapse">
                                    <div class="row">'; 
          if (count($lacking_water) > 0)
          {
            foreach ($lacking_water as $l) 
            {
                $lacking_wat.='
                                <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                        <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Engineer_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                        <div class="tile-link"><div class="tile-link-overlay"></div>
                                            <div class="tile-link-content"><a href="#" onclick="approve_water_is('.$l['month'].', '.$l['year'].')">
                                             <button type="button" class="btn btn-success btn-lg">📤&nbsp;Submit Data</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
          }
          else 
          {
            $lacking_wat .= '<center><h4>No Data</h4></center>';
          }
          $lacking_wat .= '</div></div></div></div><br /><br />';
          $lacking_wat.='<script type="text/javascript"> 
                         $(document).ready(function() {
                                $("#show_hides").on("click", function() {
                                    $("#hintTexts").hide(); // Hide the hint text when the toggle button is clicked
                                });

                                $("#lackingWaterCollapse").on("hidden.bs.collapse", function () {
                                    $(".cursor-pointers").addClass("show-hints");
                                });

                                $("#lackingWaterCollapse").on("shown.bs.collapse", function () {
                                    $(".cursor-pointers").removeClass("show-hints");
                                });
                            });
                    </script>
          ';
        //=============================== electric code ===============================================================
          $lacking_electric = $this->Engineer_Model->lacking_data_engineering($buHandle,'electric');
          $lacking_elect = '
                                    <div><h2><span id="show_hider" 
                        data-toggle="collapse" data-target="#lackingElectricCollapse"
                        class="cursor-pointerz">🚫 Electric Expense Lacking Data&nbsp&nbsp<i class="fa fa-chevron-down"></i>
                        <div class="badge progress-bar-danger badge-custom">' . count($lacking_electric) . '</div>
                        <span id="hintTextz" style="color: #999; font-size: 12px;" class="hint-texts">Click to show</span></span>
                                    </h2>
                                    </div>
                                    <hr class="custom-hr">
                                    <div id="lackingElectricCollapse" class="collapse">
                                    <div class="row">'; 
          if (count($lacking_electric) > 0)
          {
            foreach ($lacking_electric as $l) 
            {
                $lacking_elect.='
                                <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                        <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Engineer_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                        <div class="tile-link"><div class="tile-link-overlay"></div>
                                            <div class="tile-link-content"><a href="#" onclick="approve_electric_js('.$l['month'].', '.$l['year'].')">
                                             <button type="button" class="btn btn-success btn-lg">📤&nbsp;Submit Data</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
          }
          else 
          {
            $lacking_elect .= '<center><h4>No Data</h4></center>';
          }
          $lacking_elect .= '</div></div></div> </div>';

          $lacking_elect.='<script type="text/javascript"> 
                         $(document).ready(function() {
                                $("#show_hider").on("click", function() {
                                    $("#hintTextz").hide(); // Hide the hint text when the toggle button is clicked
                                });

                                $("#lackingElectricCollapse").on("hidden.bs.collapse", function () {
                                    $(".cursor-pointerz").addClass("show-hintz");
                                });

                                $("#lackingElectricCollapse").on("shown.bs.collapse", function () {
                                    $(".cursor-pointerz").removeClass("show-hintz");
                                });
                            });
                    </script>
          ';
          $data['lacking_wat'] = $lacking_wat;
          $data['lacking_elect'] = $lacking_elect;
          echo json_encode($data);
    }

    public function engineer_water_ctrl()
    {
        $month = $this->input->get('month'); // retrieve the month value
        $year = $this->input->get('year'); // retrieve the year value
        $data['years'] = $year;
        $data['months'] = $month;
        $data['user_id']= $_SESSION['id'];
        $this->load->view('engineer_view/water_consumption_view', $data);
    }

    public function engineer_electric_ctrl()
    {
        $month = $this->input->get('month'); // retrieve the month value
        $year = $this->input->get('year'); // retrieve the year value
        $data['years'] = $year;
        $data['months'] = $month;
        $data['user_id']= $_SESSION['id'];
        $this->load->view('engineer_view/electric_consumption_view', $data);
    }

    public function select_date_water_ctrl()
        {
         $year =  date('Y');   
         $month_select = '';

              if(date('Y') == $_POST['year_id'])
              {
                      $month_select.=' <option value=""></option>';
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
                 $month_select.=' <option value=""></option>';
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
          $month_id=$_POST['month_id'];
          $year_id=$_POST['year_id'];
            // var_dump($year_id,$month_id);

          $previous_date =  date('Y-m-d', strtotime('-1 month', strtotime(date($year_id."-".$month_id.'-01'))));

          $previous_year  =  date('Y',strtotime(date($previous_date))); 
          $previous_month =  date('m',strtotime(date($previous_date))); 

             $eng_msfl=$this->Engineer_Model->get_engr_msfl_v2($_POST['id']);
             $rate=0;
             if(!empty($eng_msfl))
             {
                $rate=$eng_msfl->unit_cost;
             }

           $buHandle = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
              $department_data= $this->Engineer_Model->get_depts_model($buHandle);
          $admin_data= $this->Engineer_Model->get_admin_model($buHandle);
          // var_dump($buHandle);
          $user_id=$_SESSION['id'];
          $dept_list='<table  id= "display_employees_id"  class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="10" style="font-size: 20px;"><center><span id="water_type">Water</span> 
                            &nbsp;Reading</center></th>                                                                 
                  </tr>

                 <tr style="background-color: white; text-align:center;">
                            <th style="width: 250px;">Department</th>
                            <th style="width: 80px;">Present</th>
                            <th style="width: 80px;">Previous</th>                                                                          
                            <th style="width: 80px;">Consumption</th>
                            <th style="width: 80px;">Rate</th>
                            <th style="width: 80px;">Amount</th>
                          
                  </tr>
                  </thead>

                  <tbody id="display_depts">';
                     $admin_list= '';
                      $old_amount=0;
                      $existing='';
                       $button_hide='EMPTY';
          foreach($admin_data as $admin)
          {
              $get_old_meter= $this->Engineer_Model->get_old_meter_model($admin['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meter))
              {
                $date_startss = $get_old_meter[0]['date_start'];
                $date_endss = $get_old_meter[0]['date_end'];
                  $year_start = date('Y', strtotime($date_startss));
                  $month_start = date('F', strtotime($date_startss));
                  $day_start = date('d', strtotime($date_startss));
                  $day_end = date('d', strtotime($date_endss));
                  $dept_list.='<div><tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$admin['dept_name'].'<small><i><span style="color: blue; float: right;">Old Meter - '.number_format($get_old_meter[0]['amount'], 2).'('.$month_start.'&nbsp;'.$day_start. '-' .$day_end.','.$year_start.')</span></i></small></td>
                            <td style="width: 80px;"><input type="text" id="user_id" hidden value="'.$user_id.'">';
              }else
              {
                   $dept_list.=' <div><tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$admin['dept_name'].'</td>
                            <td style="width: 80px;">
                            <input type="text" id="user_id" hidden value="'.$user_id.'">';
              }

              $billing_data= $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
          $get_old_meters= $this->Engineer_Model->get_old_meter_model($admin['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
             
              if(!empty($get_old_meters))
              {
                 $old_amount =  $get_old_meters[0]['amount'];  
              }

          if(!empty($billing_data))
          {
              $rate   =  number_format($billing_data[0]['rate'],2);  
              $amount =  number_format($billing_data[0]['amount'],2);  
              if(!empty($get_old_meters))
                  {
                    $dept_list.=  '<input type="text" disabled value="'.$amount.'" style="width: 80px; text-align:right;" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','".$get_old_meters[0]['amount']."'".')" class="present" style="width:71px;"></td>';
                  }
                  else
                  {
                    $dept_list.=  '<input type="text" disabled value="'.$amount.'" style="width: 80px; text-align:right;" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','0'".')" class="present" style="width:71px;"></td>';
                  }

              $existing ="yes";
          }
          else
          {
              $existing ="no";
              if(!empty($get_old_meters))
              {
                $dept_list.=  '<input type="text" style="width: 80px; text-align:right;" oninput="calc_consumption_js(this)" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','".$get_old_meters[0]['amount']."'".')" class="present" style="width:71px;"></td>';
              }
              else
              {
                $dept_list.=  '<input type="text" style="width: 80px; text-align:right;" oninput="calc_consumption_js(this)" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','0'".')" class="present" style="width:71px;"></td>';
              }

          }

                            
              $dept_list.= '<td style="width: 80px;" id="amount_id_'.$user_id.'"></td>
                            <td style="width: 80px;"id="consumption_id_'.$user_id.'"></td>                     
                            <td style="width: 80px;" id="rate_id_'.$user_id.'">'.$rate.'</td>
                            <td style="width: 80px;"id="tot_amount_id"></td>
                  </tr>
                  <tr>                   
                            <th colspan="10" style="background-color: white; height:37px;"></th>                                                                 

                  </tr>
              ';

              $billing_data= $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
            
              if(!empty($billing_data))
              {
                    $button_hide='NOT EMPTY';
              }
         
            if(!empty($year_id) && $month_id != 0)
            {

              $store_admin_billing = $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$previous_year,$previous_month,$_POST['type'],$_POST['id']);

                if(empty($store_admin_billing))
              {
               
                  $admin_list= '0.00';
                
              }
              else 
              {
                $admin_list= number_format($store_admin_billing[0]['amount'], 2);                
              }
            }   
          }
         
          $hidden_admin = '';
            foreach($admin_data as $admin)
            {
               $hidden_admin .="^".$admin['dcode'];
            }
               
           $hidden_input_admin='<input value ="'.$hidden_admin.'"  hidden id="admin_bu_id">';

          
                
                foreach($department_data as $dept)
            {
             
                $get_old_meter= $this->Engineer_Model->get_old_meter_model($dept['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meter))
              {
                $date_startss = $get_old_meter[0]['date_start'];
                $date_endss = $get_old_meter[0]['date_end'];
                  $year_start = date('Y', strtotime($date_startss));
                  $month_start = date('F', strtotime($date_startss));
                  $day_start = date('d', strtotime($date_startss));
                  $day_end = date('d', strtotime($date_endss));
                  $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'<small><i><span style="color: blue; float: right;">Old Meter - '.number_format($get_old_meter[0]['amount'], 2).'('.$month_start.'&nbsp;'.$day_start. '-' .$day_end.','.$year_start.')</span></i></small></td>
                            <td style="width: 80px;">';
              }else
              {
                   $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'</td>
                            <td style="width: 80px;">';
              }

              $billing_data= $this->Engineer_Model->get_billing_msfl($dept['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
              $billing_data_v2= $this->Engineer_Model->get_billing_msfl($dept['dcode'],$user_id,$previous_year,$previous_month,$_POST['type'],$_POST['id']);
              $get_old_meters= $this->Engineer_Model->get_old_meter_model($dept['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meters))
              {
                    $old_amounts = $get_old_meters[0]['amount']; 
                  
                      $dept_list.='<input type="text" value="'.$old_amounts.'" hidden id="old_id_'.$dept['dcode'].'">';
              }
              if(!empty($billing_data))
              {
                  $amount =  number_format($billing_data[0]['amount'],2); 
                  
                      $dept_list.='<input type="text" value="'.$amount.'" disabled style="text-align:right; width: 80px;"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
              }
              else
              {
                  if(!empty($get_old_meters))
                  {
                     $dept_list.='<input type="text" oninput="calc_consumption_js(this)" style="text-align:right; width: 80px;" onkeyup="cacl_consumption('."'#present_id_".$dept['dcode']."^#previous_".$dept['dcode']."^#consumption_id_".$dept['dcode']."^#def_consumption_".$dept['dcode']."^'".','."'_'".",'".$get_old_meters[0]['amount']."'".')"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
                  }
                  else
                  {
                      $dept_list.='<input type="text" oninput="calc_consumption_js(this)" style="text-align:right; width: 80px;" onkeyup="cacl_consumption('."'#present_id_".$dept['dcode']."^#previous_".$dept['dcode']."^#consumption_id_".$dept['dcode']."^#def_consumption_".$dept['dcode']."^'".','."'_'".','."'0'".')"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
                  }
              }
                
                            
                            
              $dept_list.=' <td style="width: 80px;" id="previous_'.$dept['dcode'].'">';
                
              if(empty($billing_data_v2))
              {
                $dept_list.= '0.00';
              }
              else 
              {
                $dept_list.=number_format($billing_data_v2[0]['amount'],2);  


              }

               $dept_list.='</td>
                            <td style="width: 80px;" id="consumption_id_'.$dept['dcode'].'"></td>                     
                            <td style="width: 80px;">------</td>
                            <td style="width: 80px;" id="def_consumption_'.$dept['dcode'].'"></td>
                    
                  </tr>';
            }

             
            
            $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td colspan="3" style="text-align:left;"><strong>Total</strong></td>
                            <td style="width: 80px;" id="total_con"></td>
                            <td style="width: 80px;">------</td>
                            <td style="width: 80px;" id="total_amount"></td>
                  </tr></div>';

            $dept_list.='</tbody></table>';

            $hidden_input = '';
            foreach($department_data as $dept)
            {
               $hidden_input .="^".$dept['dcode'];
            }
               
           $hidden_input_val='<input value ="'.$hidden_input.'"  hidden id="bu_id">';   


           $month_id=$_POST['month_id'];
          $year_id=$_POST['year_id'];


            $water_list =' <table id="engineering_tables_waters" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                 <tr>
                             <th style="width: 200px;">Department</th>
                            <th style="width: 80px; text-align:center">Electric Company</th>
                            <th style="width: 50px; text-align:center">Present</th>                                                                        
                            <th style="width: 60px; text-align:center">Action</th>                                                                          
                            

                  </tr>
                  </thead>';

          $present_date =  date('Y-m-d', strtotime('+0 month', strtotime(date($year_id."-".$month_id.'-01'))));
                        $present_year  =  date('Y',strtotime(date($present_date))); 
                        $present_month =  date('m',strtotime(date($present_date))); 

            $buHandle = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
          $tbl_water_list= $this->Engineer_Model->get_billing_list_model_v2($_SESSION['id'],$buHandle,$present_year,$present_month,$_POST['id'],'Water');

                  foreach($tbl_water_list as $wat)
                  {
                        $present_date =  date('Y-m-d', strtotime('+0 month', strtotime(date($wat['year']."-".$wat['month'].'-01'))));
                        $present_year  =  date('Y', strtotime($present_date)); 
                        $present_month =  date('F', strtotime($present_date)); 

                        $prevs_date = date('Y-m-d', strtotime('-1 month', strtotime(date($wat['year'] . "-" . $wat['month'] . '-01'))));
                        $prevs_year  = date('Y', strtotime(date($prevs_date)));
                        $prevs_month = date('m', strtotime(date($prevs_date)));

                        $store_dept_water= $this->Engineer_Model->get_billing_msfl($wat['company_code'].$wat['bunit_code'].$wat['dept_code'],$user_id,$prevs_year,$prevs_month,$_POST['type'],$_POST['id']);
                      
                        $dept_name=$this->Engineer_Model->get_dept_name_model($wat['company_code'].$wat['bunit_code'].$wat['dept_code']);
                        $water_name=$this->Engineer_Model->get_engr_msfl($wat['engr_id']);
                        
                        if(!empty($dept_name))
                          {
                            $water_list.= '<tr><td class="a-left" style="vertical-align:middle;">'.$dept_name[0]['dept_name'].' </td>';
                          } 

                         $water_list.='<td class="a-left" style="vertical-align:middle;">' .$water_name[0]['company_name'].'
                         </td><td style="text-align:center; vertical-align:middle;">' .number_format($wat['amount'], 2).'
                         </td>';
                         $validate_approved= $this->Engineer_Model->status_approved_model($buHandle,$wat['month'],$wat['year']);
                   if(empty($validate_approved))
                   {
                $validate_old_meter=$this->Engineer_Model->get_old_meter_model($wat['company_code'].$wat['bunit_code'].$wat['dept_code'],$wat['year'],$wat['month'],$wat['type'],$wat['engr_id']); 
                    
                      $store_dept_water_amount = isset($store_dept_water[0]['amount']) ? $store_dept_water[0]['amount'] : '';
                      if(!empty($validate_old_meter))
                      {
                          $water_list.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px;width: 73.025px;" id="modal_edit2_btn" onclick="edit_water_amount_js('."'".$wat['bill_id']."','".$present_month."&nbsp;".$present_year."','".$dept_name[0]['dept_name']."','".$water_name[0]['company_name']."','".number_format($wat['amount'], 2)."','".$store_dept_water_amount."','".$validate_old_meter[0]['amount']."'".')"> <i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                      }
                      else
                      {
                          $water_list.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px;width: 73.025px;" id="modal_edit2_btn" onclick="edit_water_amount_js('."'".$wat['bill_id']."','".$present_month."&nbsp;".$present_year."','".$dept_name[0]['dept_name']."','".$water_name[0]['company_name']."','".number_format($wat['amount'], 2)."','".$store_dept_water_amount."','0'".')"> <i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                      }
                           
                  }
                  else
                  {
                     $water_list.='<td> <center><label style="font-size: 14px; vertical-align:middle;" id="modal_edit2_btn" ><strong>Approved</strong></label></center>';
                  }

                  }

                      $water_list.= '
                      </tbody>
                        </table>
                                  <script>
                                           $(document).ready(function(){
                                             $("#engineering_tables_waters").DataTable();
                                           });
                                  </script> 
                              ';
                              
           $data['water_list']          = $water_list;
           $data['hidden_input']        = $hidden_input_val;      
           $data['hidden_input_admin']  = $hidden_input_admin;      
           $data['admin_list']          = $admin_list;
           $data['user_id']             = $user_id;
           $data['dept_list']           = $dept_list;
           $data['rate']                = $rate;
           $data['old_amount']          = $old_amount;
           $data['existing']            = $existing ;
           $data['bu_id']               = $hidden_input ;
           $data['button_hide']         = $button_hide ;

               echo json_encode($data);
        }

    public function save_water_billing_ctrl()
    {
        $save_engr_user='success';
       $this->Engineer_Model->save_billing_model($_POST['company_code'],$_POST['bunit_code'],$_POST['dept_code'],$_POST['user_id'],$_POST['year'],$_POST['month'],$_POST['amount'],$_POST['type'],$_POST['rate'],$_POST['engr_id']);  
        echo json_encode($save_engr_user);
    }

    public function update_water_ctrl()
      {
        $update="success";
        $this->Engineer_Model->update_billing_model($_POST['id'],$_POST['wat_bill']);
        echo json_encode($update);
      }

    public function select_date_electric_ctrl()
        {
         $year =  date('Y');   
         $month_select = '';

              if(date('Y') == $_POST['year_id'])
              {
                      $month_select.=' <option value=""></option>';
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
                 $month_select.=' <option value=""></option>';
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
          $month_id=$_POST['month_id'];
          $year_id=$_POST['year_id'];
            // var_dump($year_id,$month_id);

          $previous_date =  date('Y-m-d', strtotime('-1 month', strtotime(date($year_id."-".$month_id.'-01'))));

          $previous_year  =  date('Y',strtotime(date($previous_date))); 
          $previous_month =  date('m',strtotime(date($previous_date))); 

             $eng_msfl=$this->Engineer_Model->get_engr_msfl_v2($_POST['id']);
             $rate=0;
             if(!empty($eng_msfl))
             {
                $rate=$eng_msfl->unit_cost;
             }

           $buHandle = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
              $department_data= $this->Engineer_Model->get_depts_model($buHandle);
          $admin_data= $this->Engineer_Model->get_admin_model($buHandle);
          // var_dump($buHandle);
          $user_id=$_SESSION['id'];
          $dept_list='<table  id= "display_employees_id"  class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="10" style="font-size: 20px;"><center><span id="electric_type">Electric</span> 
                            &nbsp;Reading</center></th>                                                                 
                  </tr>

                 <tr style="background-color: white; text-align:center;">
                            <th style="width: 250px;">Department</th>
                            <th style="width: 80px;">Present</th>
                            <th style="width: 80px;">Previous</th>                                                                          
                            <th style="width: 80px;">Consumption</th>
                            <th style="width: 80px;">Rate</th>
                            <th style="width: 80px;">Amount</th>
                          
                  </tr>
                  </thead>

                  <tbody id="display_depts">';
                     $admin_list= '';
                      $old_amount=0;
                      $existing='';
                       $button_hide='EMPTY';
          foreach($admin_data as $admin)
          {
              $get_old_meter= $this->Engineer_Model->get_old_meter_model($admin['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meter))
              {
                $date_startss = $get_old_meter[0]['date_start'];
                $date_endss = $get_old_meter[0]['date_end'];
                  $year_start = date('Y', strtotime($date_startss));
                  $month_start = date('F', strtotime($date_startss));
                  $day_start = date('d', strtotime($date_startss));
                  $day_end = date('d', strtotime($date_endss));
                  $dept_list.='<div><tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$admin['dept_name'].'<small><i><span style="color: blue; float: right;">Old Meter - '.number_format($get_old_meter[0]['amount'], 2).'('.$month_start.'&nbsp;'.$day_start. '-' .$day_end.','.$year_start.')</span></i></small></td>
                            <td style="width: 80px;"><input type="text" id="user_id" hidden value="'.$user_id.'">';
              }else
              {
                   $dept_list.=' <div><tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$admin['dept_name'].'</td>
                            <td style="width: 80px;">
                            <input type="text" id="user_id" hidden value="'.$user_id.'">';
              }

              $billing_data= $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
          $get_old_meters= $this->Engineer_Model->get_old_meter_model($admin['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
             
              if(!empty($get_old_meters))
              {
                 $old_amount =  $get_old_meters[0]['amount'];  
              }

          if(!empty($billing_data))
          {
              $rate   =  number_format($billing_data[0]['rate'],2);  
              $amount =  number_format($billing_data[0]['amount'],2);  
              if(!empty($get_old_meters))
                  {
                    $dept_list.=  '<input type="text" disabled value="'.$amount.'" style="width: 80px; text-align:right;" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','".$get_old_meters[0]['amount']."'".')" class="present" style="width:71px;"></td>';
                  }
                  else
                  {
                    $dept_list.=  '<input type="text" disabled value="'.$amount.'" style="width: 80px; text-align:right;" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','0'".')" class="present" style="width:71px;"></td>';
                  }

              $existing ="yes";
          }
          else
          {
              $existing ="no";
              if(!empty($get_old_meters))
              {
                $dept_list.=  '<input type="text" style="width: 80px; text-align:right;" oninput="calc_consumption_js(this)" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','".$get_old_meters[0]['amount']."'".')" class="present" style="width:71px;"></td>';
              }
              else
              {
                $dept_list.=  '<input type="text" style="width: 80px; text-align:right;" oninput="calc_consumption_js(this)" id="present_id_'.$user_id.'" onkeyup="cacl_consumption('."'#present_id_".$user_id."^#amount_id_".$user_id."^#consumption_id_".$user_id."' , '".$rate."','0'".')" class="present" style="width:71px;"></td>';
              }

          }

                            
              $dept_list.= '<td style="width: 80px;" id="amount_id_'.$user_id.'"></td>
                            <td style="width: 80px;"id="consumption_id_'.$user_id.'"></td>                     
                            <td style="width: 80px;" id="rate_id_'.$user_id.'">'.$rate.'</td>
                            <td style="width: 80px;"id="tot_amount_id"></td>
                  </tr>
                  <tr>                   
                            <th colspan="10" style="background-color: white; height:37px;"></th>                                                                 

                  </tr>
              ';

              $billing_data= $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
            
              if(!empty($billing_data))
              {
                    $button_hide='NOT EMPTY';
              }
         
            if(!empty($year_id) && $month_id != 0)
            {

              $store_admin_billing = $this->Engineer_Model->get_admin_billing_msfl($admin['dcode'],$user_id,$previous_year,$previous_month,$_POST['type'],$_POST['id']);

                if(empty($store_admin_billing))
              {
               
                  $admin_list= '0.00';
                
              }
              else 
              {
                $admin_list= number_format($store_admin_billing[0]['amount'], 2);                
              }
            }   
          }
         
          $hidden_admin = '';
            foreach($admin_data as $admin)
            {
               $hidden_admin .="^".$admin['dcode'];
            }
               
           $hidden_input_admin='<input value ="'.$hidden_admin.'"  hidden id="admin_bu_id">';

          
                
                foreach($department_data as $dept)
            {
             
                $get_old_meter= $this->Engineer_Model->get_old_meter_model($dept['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meter))
              {
                $date_startss = $get_old_meter[0]['date_start'];
                $date_endss = $get_old_meter[0]['date_end'];
                  $year_start = date('Y', strtotime($date_startss));
                  $month_start = date('F', strtotime($date_startss));
                  $day_start = date('d', strtotime($date_startss));
                  $day_end = date('d', strtotime($date_endss));
                  $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'<small><i><span style="color: blue; float: right;">Old Meter - '.number_format($get_old_meter[0]['amount'], 2).'('.$month_start.'&nbsp;'.$day_start. '-' .$day_end.','.$year_start.')</span></i></small></td>
                            <td style="width: 80px;">';
              }else
              {
                   $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'</td>
                            <td style="width: 80px;">';
              }

              $billing_data= $this->Engineer_Model->get_billing_msfl($dept['dcode'],$user_id,$year_id,$month_id,$_POST['type'],$_POST['id']); 
              $billing_data_v2= $this->Engineer_Model->get_billing_msfl($dept['dcode'],$user_id,$previous_year,$previous_month,$_POST['type'],$_POST['id']);
              $get_old_meters= $this->Engineer_Model->get_old_meter_model($dept['dcode'],$year_id,$month_id,$_POST['type'],$_POST['id']); 
              if(!empty($get_old_meters))
              {
                    $old_amounts = $get_old_meters[0]['amount']; 
                  
                      $dept_list.='<input type="text" value="'.$old_amounts.'" hidden id="old_id_'.$dept['dcode'].'">';
              }
              if(!empty($billing_data))
              {
                  $amount =  number_format($billing_data[0]['amount'],2); 
                  
                      $dept_list.='<input type="text" value="'.$amount.'" disabled style="text-align:right; width: 80px;"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
              }
              else
              {
                  if(!empty($get_old_meters))
                  {
                     $dept_list.='<input type="text" oninput="calc_consumption_js(this)" style="text-align:right; width: 80px;" onkeyup="cacl_consumption('."'#present_id_".$dept['dcode']."^#previous_".$dept['dcode']."^#consumption_id_".$dept['dcode']."^#def_consumption_".$dept['dcode']."^'".','."'_'".",'".$get_old_meters[0]['amount']."'".')"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
                  }
                  else
                  {
                      $dept_list.='<input type="text" oninput="calc_consumption_js(this)" style="text-align:right; width: 80px;" onkeyup="cacl_consumption('."'#present_id_".$dept['dcode']."^#previous_".$dept['dcode']."^#consumption_id_".$dept['dcode']."^#def_consumption_".$dept['dcode']."^'".','."'_'".','."'0'".')"  class="present " style="width: 71px;" id="present_id_'.$dept['dcode'].'"></td>';
                  }
              }
                
                            
                            
              $dept_list.=' <td style="width: 80px;" id="previous_'.$dept['dcode'].'">';
                
              if(empty($billing_data_v2))
              {
                $dept_list.= '0.00';
              }
              else 
              {
                $dept_list.=number_format($billing_data_v2[0]['amount'],2);  


              }

               $dept_list.='</td>
                            <td style="width: 80px;" id="consumption_id_'.$dept['dcode'].'"></td>                     
                            <td style="width: 80px;">------</td>
                            <td style="width: 80px;" id="def_consumption_'.$dept['dcode'].'"></td>
                    
                  </tr>';
            }

             
            
            $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td colspan="3" style="text-align:left;"><strong>Total</strong></td>
                            <td style="width: 80px;" id="total_con"></td>
                            <td style="width: 80px;">------</td>
                            <td style="width: 80px;" id="total_amount"></td>
                  </tr></div>';

            $dept_list.='</tbody></table>';

            $hidden_input = '';
            foreach($department_data as $dept)
            {
               $hidden_input .="^".$dept['dcode'];
            }
               
           $hidden_input_val='<input value ="'.$hidden_input.'"  hidden id="bu_id">';   


           $month_id=$_POST['month_id'];
          $year_id=$_POST['year_id'];


            $electric_list =' <table id="engineering_tables_electric" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                 <tr>
                             <th style="width: 200px;">Department</th>
                            <th style="width: 80px; text-align:center">Electric Company</th>
                            <th style="width: 50px; text-align:center">Present</th>                                                                        
                            <th style="width: 60px; text-align:center">Action</th>                                                                          
                            

                  </tr>
                  </thead>';

          $present_date =  date('Y-m-d', strtotime('+0 month', strtotime(date($year_id."-".$month_id.'-01'))));
                        $present_year  =  date('Y',strtotime(date($present_date))); 
                        $present_month =  date('m',strtotime(date($present_date))); 

            $buHandle = $this->Engineer_Model->getBU_Handle($_SESSION['id']);
          $tbl_electric_list= $this->Engineer_Model->get_billing_list_model_v2($_SESSION['id'],$buHandle,$present_year,$present_month,$_POST['id'],'Electric');

                  foreach($tbl_electric_list as $elect)
                  {
                        $present_date =  date('Y-m-d', strtotime('+0 month', strtotime(date($elect['year']."-".$elect['month'].'-01'))));
                        $present_year  =  date('Y', strtotime($present_date)); 
                        $present_month =  date('F', strtotime($present_date)); 

                        $prevs_date = date('Y-m-d', strtotime('-1 month', strtotime(date($elect['year'] . "-" . $elect['month'] . '-01'))));
                        $prevs_year  = date('Y', strtotime(date($prevs_date)));
                        $prevs_month = date('m', strtotime(date($prevs_date)));

                        $store_dept_electric= $this->Engineer_Model->get_billing_msfl($elect['company_code'].$elect['bunit_code'].$elect['dept_code'],$user_id,$prevs_year,$prevs_month,$_POST['type'],$_POST['id']);
                      
                        $dept_name=$this->Engineer_Model->get_dept_name_model($elect['company_code'].$elect['bunit_code'].$elect['dept_code']);
                        $electric_name=$this->Engineer_Model->get_engr_msfl($elect['engr_id']);
                        
                        if(!empty($dept_name))
                          {
                            $electric_list.= '<tr><td class="a-left" style="vertical-align:middle;">'.$dept_name[0]['dept_name'].' </td>';
                          } 

                         $electric_list.='<td class="a-left" style="vertical-align:middle;">' .$electric_name[0]['company_name'].'
                         </td><td style="text-align:center; vertical-align:middle;">' .number_format($elect['amount'], 2).'
                         </td>';
                         $validate_approved= $this->Engineer_Model->status_approved_model($buHandle,$elect['month'],$elect['year']);
                   if(empty($validate_approved))
                   {
                $validate_old_meter=$this->Engineer_Model->get_old_meter_model($elect['company_code'].$elect['bunit_code'].$elect['dept_code'],$elect['year'],$elect['month'],$elect['type'],$elect['engr_id']); 
                    
                      $store_dept_electric_amount = isset($store_dept_electric[0]['amount']) ? $store_dept_electric[0]['amount'] : '';
                      if(!empty($validate_old_meter))
                      {
                          $electric_list.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px;width: 73.025px;" id="modal_edit2_btn" onclick="edit_electric_amount_js('."'".$elect['bill_id']."','".$present_month."&nbsp;".$present_year."','".$dept_name[0]['dept_name']."','".$electric_name[0]['company_name']."','".number_format($elect['amount'], 2)."','".$store_dept_electric_amount."','".$validate_old_meter[0]['amount']."'".')"> <i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                      }
                      else
                      {
                          $electric_list.='<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 14px;width: 73.025px;" id="modal_edit2_btn" onclick="edit_electric_amount_js('."'".$elect['bill_id']."','".$present_month."&nbsp;".$present_year."','".$dept_name[0]['dept_name']."','".$electric_name[0]['company_name']."','".number_format($elect['amount'], 2)."','".$store_dept_electric_amount."','0'".')"> <i class="fa fa-edit"></i>&nbsp;Edit</button> </center>';
                      }
                           
                  }
                  else
                  {
                     $electric_list.='<td> <center><label style="font-size: 14px; vertical-align:middle;" id="modal_edit2_btn" ><strong>Approved</strong></label></center>';
                  }

                  }

                      $electric_list.= '
                      </tbody>
                        </table>
                                  <script>
                                           $(document).ready(function(){
                                             $("#engineering_tables_electric").DataTable();
                                           });
                                  </script> 
                              ';
                              
           $data['electric_list']       = $electric_list;
           $data['hidden_input']        = $hidden_input_val;      
           $data['hidden_input_admin']  = $hidden_input_admin;      
           $data['admin_list']          = $admin_list;
           $data['user_id']             = $user_id;
           $data['dept_list']           = $dept_list;
           $data['rate']                = $rate;
           $data['old_amount']          = $old_amount;
           $data['existing']            = $existing ;
           $data['bu_id']               = $hidden_input ;
           $data['button_hide']         = $button_hide ;

               echo json_encode($data);
        }

        public function save_electric_billing_ctrl()
        {
            $save_engr_user='success';
           $this->Engineer_Model->save_billing_model($_POST['company_code'],$_POST['bunit_code'],$_POST['dept_code'],$_POST['user_id'],$_POST['year'],$_POST['month'],$_POST['amount'],$_POST['type'],$_POST['rate'],$_POST['engr_id']);  
            echo json_encode($save_engr_user);
        }

        public function update_electric_ctrl()
        {
            $update="success";
            $this->Engineer_Model->update_billing_model($_POST['id'],$_POST['elect_bill']);
            echo json_encode($update);
        }



}
?>