<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leasing_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Leasing_Model');    
        $this->load->model('Login_model');
         $this->load->helper('url');

    // Disable caching
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    }

    public function leasing_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Leasing")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Leasing_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->Leasing_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('leasing_view/templates/leasing_header', $data);
            $this->load->view('leasing_view/leasing_body');
            $this->load->view('leasing_view/templates/leasing_footer');
        }
        
    }

    public function leasing_home_ctrl()
    {
        $this->load->view('leasing_view/leasing_home');
    }

    public function leasing_about_us_ctrl()
    {
        $data['profile']= $this->Leasing_Model->profile_pic('15799-2018');
        $this->load->view('about_us_view', $data);
    }

    public function leasing_record_ctrl()
    {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $user_id_ssd= $_SESSION['id'];
        $data['years'] = $year;
        $data['months'] = $month; 
        $data['user_id_ssd'] = $user_id_ssd; 
        $this->load->view('leasing_view/leasing_record_view', $data);
    }

    public function leasing_dashboard_ctrl()
    {
        $buHandle = $this->Leasing_Model->getBU_Handle($_SESSION['id']);
        $lacking = $this->Leasing_Model->lacking_data_leasing($buHandle);
          $lacking_leasing = '
                                    <div><h2>🚫Floor Area Lacking Data
                                        <div class="badge progress-bar-danger badge-custom">' . count($lacking) . '</div>
                                    </div>
                                    <hr class="custom-hr">

                                    <div class="row">'; 
          if (count($lacking) > 0)
          {
            foreach ($lacking as $l) 
            {
                $lacking_leasing.='
                                <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                        <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Leasing_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                        <div class="tile-link"><div class="tile-link-overlay"></div>
                                            <div class="tile-link-content"><a href="#" onclick="approve_leasing_js('.$l['month'].', '.$l['year'].')">
                                             <button type="button" class="btn btn-success btn-lg">📤&nbsp;Submit Data</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
          }
          else 
          {
            $lacking_leasing .= '<center><h4>No Data</h4></center>';
          }
          $lacking_leasing .= '</div></div></div> </div>';

          $data['lacking_leasing'] = $lacking_leasing;
          echo json_encode($data);
    }

    public function select_date_area_ctrl()
      {
            $year=$_POST['year'];
          $month_select = '';
              if(date('Y') == $_POST['year'])
              {
                      $month_select.=' <option value="0"></option>';
                      for($a=1;$a<13;$a++)
                      {
                          if(date('m')>$a)
                          {
                              if($_POST['month'] == $a)
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
                  $month_select.=' <option value="0"></option>';
                   for($a=1;$a<13;$a++)
                   {
                        if($_POST['month'] == $a)
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

        $buHandle = $this->Leasing_Model->getBU_Handle($_SESSION['id']);
        $ssd_data= $this->Leasing_Model->get_depts_model($buHandle);  
        $user_id=$_SESSION['id'];
      
        $dept_list = ' <table id="display_ssd_table_vvvv2" style="width:100%;" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                 <tr style="text-align:center;">
                             
                            <th style="font-size:25px; text-align:center" colspan="10">Floor Area</th>                                                                       
                  </tr>
                  <tr style="background-color: white; text-align:center;">
                            <th style="width: 150px;">Department</th>
                            <th style="width: 80px; text-align:center">B1</th>                                                                          
                            <th style="width: 80px; text-align:center">B2</th>                                                                          
                            <th style="width: 80px; text-align:center">GF</th>                                                                          
                            <th style="width: 80px; text-align:center">M</th>                                                                          
                            <th style="width: 80px; text-align:center">2F</th>                                                                          
                            <th style="width: 80px; text-align:center">3F</th>                                                                          
                            <th style="width: 80px; text-align:center">4F</th>                                                                          
                            <th style="width: 80px; text-align:center">5F</th>   
                            <th style="width: 80px; text-align:center">Total</th>   
                  </tr>
                  </thead>
                  <tbody>';

        $grand_total=0;
        foreach($ssd_data as $dept)
        {
        $dept_list.='<tr style="background-color: white; text-align:center;">
                    <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'</td>
                    <td style="width: 80px;"> 
                    <input type="text" id="user_id" hidden value="'.$user_id.'">';

         $floor_area_data= $this->Leasing_Model->get_floor_area_model($user_id,$dept['dcode'],$_POST['month'],$_POST['year']);
          if(!empty($floor_area_data))
          {
            $total_dept=$floor_area_data[0]['basement_1']+$floor_area_data[0]['basement_2']+$floor_area_data[0]['ground_floor']+$floor_area_data[0]['mezzanine']+$floor_area_data[0]['second_floor']+$floor_area_data[0]['third_floor']+$floor_area_data[0]['fourth_floor']+$floor_area_data[0]['fifth_floor'];
            $grand_total+=$total_dept;
            $dept_list.='
                <input type="text" value="'.number_format($floor_area_data[0]['basement_1'], 2).'" disabled style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['basement_2'], 2).'" disabled style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['ground_floor'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['mezzanine'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['second_floor'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['third_floor'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['fourth_floor'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" value="'.number_format($floor_area_data[0]['fifth_floor'], 2).'" disabled  style="width: 70px; text-align:right;"></td>
                <td style="text-align:right;"><span>'.number_format($total_dept, 2).'</span></td>
                 ';
          }
          else{

            $dept_list.='
                <input type="text" id="b1_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="b2_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="gf_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="mez_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="second_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="third_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="fourth_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="width: 80px;"><input type="text" id="fifth_'.$dept['dcode'].'" oninput="cacl_floor(this'.",'".$dept['dcode']."'".')" style="width: 70px; text-align:right;"></td>
                <td style="text-align:right;"><span id="total_row_'.$dept['dcode'].'" class="get_total"></span></td>
                 ';
          }
        }

        $dept_list .= '</tr>';
         $dept_list.='<tr style="background-color: white; text-align:right;">
                            <td style="text-align:left;" colspan="9"><strong>Total</strong></td>
                            <td style="width: 80px;"><span id="grand_total">'.number_format($grand_total, 2).'</span></td>      
                  </tr>
                  </tbody>
                            </table> 
                   ';
         // $dept_list.=' 
         //                    <script type="text/javascript">
         //                    $(document).ready(function() {
         //                        $("#display_ssd_table_vvvv2").DataTable();
         //                    });
         //                </script>';

        
        $button_hide='EMPTY';
              if(!empty($floor_area_data))
              {
                    $button_hide='NOT EMPTY';
              }

        $ssd_data_save= $this->Leasing_Model->get_depts_model($buHandle); 
        $save_list = '';
            foreach($ssd_data_save as $save)
            {
               $save_list .="^".$save['dcode'];
            }
               
           $dept_list_val='<input value ="'.$save_list.'" id="bu_id" style="display:none;">'; 
 

               $data['hidden_input'] = $dept_list_val;   
               $data["html"] = $dept_list;
               $data["button_hide"] = $button_hide;
               $data['month_select'] =$month_select;
               echo json_encode($data);

      }

      public function save_floor_ctrl()
      {
        $save_floor="success";
            $this->Leasing_Model->save_floor_model($_POST['user_id'],$_POST['month_id'],$_POST['year_id'],$_POST['dcode'],$_POST['b1'],$_POST['b2'],$_POST['gf'],$_POST['mez'],$_POST['second'],$_POST['third'],$_POST['fourth'],$_POST['fifth']);
        echo json_encode($save_floor);

      }



}
?>