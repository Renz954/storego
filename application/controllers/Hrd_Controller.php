<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hrd_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Hrd_Model');
        $this->load->model('Login_model');
         $this->load->helper('url');

    // Disable caching
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    }

    public function hrd_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Hrd")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Hrd_Model->get_profile($_SESSION['id']);
            $this->load->view('hrd_view/templates/hrd_header', $data);
            $this->load->view('hrd_view/hrd_body');
            $this->load->view('hrd_view/templates/hrd_footer');
        }
        
    }

    public function hrd_home_ctrl()
    {
        $this->load->view('hrd_view/hrd_home');
    }

    public function reports_ctrl()
    {
        $this->load->view('hrd_view/hrd_reports_view');
    }

    public function hrd_dashboard_ctrl()
    {
        $buHandle = $this->Hrd_Model->getBU_Handle($_SESSION['id']);
        $lacking = $this->Hrd_Model->lacking_data_hrd($buHandle);
          $lacking_hrd = '
                                    <div><h2>Employee Lacking Data
                                        <div class="badge progress-bar-danger badge-custom">' . count($lacking) . '</div>
                                    </div>
                                    <hr class="custom-hr">

                                    <div class="row">'; 
          if (count($lacking) > 0)
          {
            foreach ($lacking as $l) 
            {
                $lacking_hrd.='
                                <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                        <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Hrd_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                        <div class="tile-link"><div class="tile-link-overlay"></div>
                                            <div class="tile-link-content"><a href="#" onclick="approve_hrd_js('.$l['month'].', '.$l['year'].')">
                                             <button type="button" class="btn btn-success btn-lg">📤&nbsp;Submit Data</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            }
          }
          else 
          {
            $lacking_hrd .= '<center><h4>No Data</h4></center>';
          }
          $lacking_hrd .= '</div></div></div> </div>';

          $data['lacking_hrd'] = $lacking_hrd;
          echo json_encode($data);
    }

    public function records_ctrl()
    {
        $month = $this->input->get('month');
        $year = $this->input->get('year');
        $data['years'] = $year;
        $data['months'] = $month;   
        $this->load->view('hrd_view/records_view', $data);
    }

    public function display_table_employees_ctrl()
        {
            
         $html='<div id="loader">
                </div>
            <table  id= "display_employees_data" style="width:100%;" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="10" style="font-size: 20px;"><center>Active Employees of the Month</center></th>                                                                 
                  </tr>';
                        $design='style="text-align:center;"';
                        $design2='text-align:center;';
                   $html.='<tr style="background-color:white; text-align:center;">
                            <th colspan="1"></th>
                            <th colspan="2" '.$design.'><b id="m_start"></b></th>
                            <th colspan="2" '.$design.'><b id="m_end"></b></th>
                            <th colspan="2" '.$design.'>Average</th>                                                                          
                  </tr>
                           
                 <tr style="background-color: white; text-align:center;">
                        <th style="width: 250px;">Department</th>
                        <th style="width: 80px;'.$design2.'">AE</th>
                                                                                                  
                        <th style="width: 80px;'.$design2.'">NESCO</th>
                        <th style="width: 80px;'.$design2.'">AE</th>
                        
                        <th style="width: 80px;'.$design2.'">NESCO</th>
                        <th style="width: 80px;'.$design2.'">AE</th>
                       
                        <th style="width: 80px;'.$design2.'">NESCO</th>

                  </tr>
                  </thead>

                  <tbody id="display_dept">

                  </tbody>
                
                    </table>
                    <script>
                       $(document).ready(function(){
                          $("#display_employees_data").DataTable({
                                searching: false
                            });
                       });
                    </script>
                    ';
                    $buHandle = $this->Hrd_Model->getBU_Handle($_SESSION['id']);
                    $data["bu_id"] =  $buHandle;
                    $data["html"] =  $html;
                    echo json_encode($data);
        }

        // public function display_table_reports_ctrl()
        // {
        
        //     $html='<table  id= "display_employees_id" style="width:100%;" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
        //            <thead class="bg-info">
        //            <tr>                   
        //                     <th class="column-title" colspan="10" style="font-size: 20px;"><center>TOTAL AVERAGE</center></th>                                                                 
        //           </tr>      
        //             <tr style="background-color: white; text-align:center;">
        //                     <th style="width: 200px;">MONTH</th>
        //                     <th style="width: 80px;">AE</th>
        //                     <th style="width: 80px;">NICO</th>                                                                          
        //                     <th style="width: 80px;">NESCO</th>
        //             </tr>
        //           </thead>
        //           ';
        //     $html.='</table>
        //           <script>
        //             $(document).ready(function(){  
        //                  $("#display_employees_id")DataTable({                                               
        //                                             "order": [
        //                                               [0, "ASC"]
        //                                             ] 
        //                                           });
        //             });
        //           </script>
        //         ';
        //         $data["html"] =  $html;
        //         echo json_encode($data);
        // }

        public function select_year_ctrl()
      {   

          $rec ='<table  id= "display_employees_id"  style="width:100%;" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
               <thead class="bg-info">
               <tr>                   
                        <th class="column-title" colspan="10" style="font-size: 20px;"><center>TOTAL AVERAGE</center></th>                                                                 
              </tr>      
                <tr style="background-color: white; text-align:center;">
                        <th style="width: 200px;">MONTH</th>
                        <th style="width: 80px; text-align:center">AE</th>                                                                         
                        <th style="width: 80px; text-align:center">NESCO</th>
                </tr>
              </thead>
              ';
           $buHandle = $this->Hrd_Model->getBU_Handle($_SESSION['id']);
          $department_data= $this->Hrd_Model->get_record_model($buHandle,$_POST['year_id']);
           
            foreach($department_data as $dept)
            {
                $total_average_data= $this->Hrd_Model->get_record_model_v2($dept['month'],$dept['year'],$buHandle);

                   $ae = 0;
                 // $nico = 0;
                $nesco = 0;
                foreach($total_average_data as $data)
                {
                    if($data['emp_type']=='AE')
                    {
                        $ae+=$data['average'];
                    }
                    // elseif($data['emp_type']=='NICO')
                    // {
                    //   $nico+=$data['average'];
                    // }
                        elseif($data['emp_type']=='NESCO')
                    {
                      $nesco+=$data['average'];
                    }
                }
                    $present_date =  date('Y-m-d', strtotime('+0 month', strtotime(date($dept['year']."-".$dept['month'].'-01'))));
                    $month =  date('F',strtotime(date($present_date)));

                     $rec.=' <tr style="background-color:white; text-align:center;">
                                <td style="width:250px; text-align:left; ">'.$month.'</td>
                                <td style="width: 80px; color:orange;">'.$ae.'</td>
                                
                                <td style="width: 80px;">'.$nesco.'</td>
                            </tr>
                    ';
            }

                    $rec.='</table>
                     <script type="text/javascript">
                                           $(document).ready(function(){
                                             $("#display_employees_id").DataTable({                                               
                                                "order": [
                                                  [2, "ASC"]
                                                ] 
                                              });
                                            });
                     </script>
                    ';

            $data['rec'] = $rec;
            echo json_encode($data);
      }

}
?>