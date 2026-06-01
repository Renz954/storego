<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finance_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Finance_Model');
        $this->load->model('Login_model');
    }

    public function finance_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Finance")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Finance_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->Finance_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('finance_view/templates/finance_header', $data);
            $this->load->view('finance_view/finance_body');
            $this->load->view('finance_view/templates/finance_footer');
        }
        
    }

    public function finance_home_ctrl()
    {
        $this->load->view('finance_view/finance_home');
    }

    public function finance_dashboard_ctrl()
    {
        $html = '<div><h2><span id="show_hides" 
                        data-toggle="collapse" data-target="#nav_allo_data_collapse"
                        class="cursor-pointers">🖥️ Navision Allocation Data
                        <span id="hintTexts" style="color: #999; font-size: 12px;" class="hint-texts">Click to show</span></span> 
                                    </h2>
                                    </div>
                                    <hr class="custom-hr">
        <div id="nav_allo_data_collapse" class="collapse">
        <div class="row" >';
    
            for ($y = 2021; $y <= date('Y'); $y++) 
            {
                for ($m = 1; $m <= 12; $m++) 
                {
                    $required = $this->Finance_Model->setup_store_model_v2();
                    $pendingCount = 0; 
                    $approvedCount= 0;
                    $pendingData = array();
                    foreach ($required as $req) 
                    {
                        $pending = $this->Finance_Model->select_pending_home_finance_model($y, $m, $req['bcode']);
                        $pendingCount += count($pending); 
                        $approved = $this->Finance_Model->select_approved_home_finance_model($y, $m, $req['bcode']);
                        $approvedCount += count($approved); 

                        foreach ($approved as $item) {
                            $pendingData[] = $item['bcode'];
                        }
                    }
                         $total_count=$pendingCount + $approvedCount;
                         $no_dataCount = count($required) - $total_count;   

                    $html .= '<div class="dashboard-tile col-lg-3 col-md-6 col-sm-6">
                                 <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 210px;">
                                    <div class="tile-link">
                                            <div class="tile-link-overlay">
                                            </div>
                                        <div class="tile-link-content"><a href="#" onclick="finance_home_details_js('."'".$m."', '".$y."'".')">
                                            <button type="button" class="btn btn-success btn-lg">👁️&nbspView Data</button></a>
                                        </div>
                                    </div>
                                         <div class="x_title"><h2>📅&nbsp' . date('F', strtotime(date('Y-' . $m . '-01'))). ' ' . $y . '</h2>
                                         </div>';

                    
                    $html .= '<hr>
                                <div class="x_content">
                                    <div class="dashboard-widget-content">
                                            <div class="x_title"><i class="fa fa-database"></i><b>&nbsp;BU Data</b>
                                            </div>
                                            <hr>
                                            <ul class="quick-list" style=" width: 95%;">';
                                
                                                 $html .= '<li style="font-size:14px;margin-bottom:6px;"><span class="badge badge-danger">'.$no_dataCount.'</span><b>&nbsp&nbsp&nbspNo Data</b></li>';
                                                 $html .= '<li style="font-size:14px;margin-bottom:6px;"><span class="badge badge-warning">'.$pendingCount.'</span><b>&nbsp&nbsp&nbspPending</b><td></li>';                   
                                                 $html .= '<li style="font-size:14px;"><span class="badge badge-info">'.$approvedCount.'</span><b>&nbsp&nbsp&nbspApproved</b></span></li>';
                                 $html .= '</ul>
                                    </div>
                                </div>
                              </div>
                            </div>';
                }       
            }           
                    $html .= '</div></div><br /><br />';
                    $html.='<script type="text/javascript"> 
                         $(document).ready(function() {
                                $("#show_hides").on("click", function() {
                                    $("#hintTexts").hide(); // Hide the hint text when the toggle button is clicked
                                });

                                $("#nav_allo_data_collapse").on("hidden.bs.collapse", function () {
                                    $(".cursor-pointers").addClass("show-hints");
                                });

                                $("#nav_allo_data_collapse").on("shown.bs.collapse", function () {
                                    $(".cursor-pointers").removeClass("show-hints");
                                });
                            });
                    </script>';


            $expense_html = '<div><h2><span id="show_hider" data-toggle="collapse" data-target="#go_expense_collapse" 
                                class="cursor-pointerz">🕹️ Store Expense Data <span id="hintTextz" style="color: #999; font-size: 12px;" class="hint-texts">Click to show</span></span> </h2>
                             </div>
                                    <hr class="custom-hr">
                                <div id="go_expense_collapse" class="collapse">
                                     <div class="row">';
            
            for ($y = 2022; $y <= date('Y'); $y++) 
            {
                for ($m = 1; $m <= 12; $m++) 
                {
                    $required = $this->Finance_Model->setup_store_model_v2();
                    $pendingCount = 0; 
                    $approvedCount= 0;
                    $pendingData = array();
                    foreach ($required as $req) {
                        $pending = $this->Finance_Model->select_pending_expense_finance_model($y, $m, $req['bcode']);
                        $pendingCount += count($pending); 
                        $approved = $this->Finance_Model->select_approved_expense_finance_model($y, $m, $req['bcode']);
                        $approvedCount += count($approved); 

                        foreach ($approved as $item) {
                            $pendingData[] = $item['bu_id'];
                        }
                    }

                    $total_count=$pendingCount + $approvedCount;
                    $no_dataCount = count($required) - $total_count;   

                    $expense_html .= '<div class="dashboard-tile col-lg-3 col-md-6 col-sm-6">
                                            <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 210px;">
                                                    <div class="tile-link">
                                                        <div class="tile-link-overlay">
                                                        </div>
                                                        <div class="tile-link-content"><a href="#" onclick="finance_expense_details_js('."'".$m."', '".$y."'".')">
                                                            <button type="button" class="btn btn-success btn-lg">👁️&nbspView Data</button></a>
                                                        </div>
                                                    </div>
                                                <div class="x_title"><h2>📅&nbsp'. date('F', strtotime(date('Y-' . $m . '-01'))) . ' ' . $y . '</h2>
                                                </div>';   
                    
                    $expense_html .= '<hr>
                                    <div class="x_content">
                                         <div class="dashboard-widget-content">
                                            <div class="x_title"><i class="fa fa-database"></i><b>&nbsp;BU Data</b>
                                            </div><hr>
                                           <ul class="quick-list" style=" width: 95%;">';
                                
                                                $expense_html .= '<li style="font-size:14px;margin-bottom:6px;"><span class="badge badge-danger">'.$no_dataCount.'</span><b>&nbsp&nbsp&nbspNo Data</b></li>';
                                                $expense_html .= '<li style="font-size:14px;margin-bottom:6px;"><span class="badge badge-warning">'.$pendingCount.'</span><b>&nbsp&nbsp&nbspPending</b><td></li>';                   
                                                $expense_html .= '<li style="font-size:14px;"><span class="badge badge-info">'.$approvedCount.'</span><b>&nbsp&nbsp&nbspApproved</b></span></li>';
                         $expense_html .= '</ul>
                                         </div>
                                    </div>
                                  </div>
                              </div>';
                }       
            }           
                 $expense_html .= '</div></div><br /><br />';
                 $expense_html.='<script type="text/javascript"> 
                         $(document).ready(function() {
                                $("#show_hider").on("click", function() {
                                    $("#hintTextz").hide(); // Hide the hint text when the toggle button is clicked
                                });

                                $("#go_expense_collapse").on("hidden.bs.collapse", function () {
                                    $(".cursor-pointerz").addClass("show-hintz");
                                });

                                $("#go_expense_collapse").on("shown.bs.collapse", function () {
                                    $(".cursor-pointerz").removeClass("show-hintz");
                                });
                            });
                    </script>';

                 $data['html'] = $html;
                 $data['expense_html'] = $expense_html;
                 echo json_encode($data);
    }

    public function finance_nav_data_ctrl()
    {
        $month = $this->input->get('month'); // retrieve the month value
        $year = $this->input->get('year');
        $data['months'] = $month;
        $data['years'] = $year;
        $this->load->view('finance_view/nav_allo_basis_view', $data);
    }

    public function select_monitor_allo_ctrl()
    {
        $select_month = '<option value="0">All Months</option>';

          if(date('Y') == $_POST['year_id'])
          {
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
                          $select_month.=' <option value="'.$a.'" '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                      } 
                  }    
          }
          else 
          {
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
                          $select_month.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
               }        
          }
             if($_POST['month_id'] == 0)
            {
                $get_style= 'table-responsive';
            }
            else
            {
                $get_style='';
            }
              $tbl_html = '<table id="display_id_v2" class="table table-bordered table-sm table-hover '.$get_style.' " style="max-width:100%">

                              <thead class="bg-info text-white">
                                <tr>
                                    <th style="text-align:left; position: sticky; left: 0; z-index: 3; background-color: darkcyan;width:80%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
            
        
        if($_POST['month_id'] == '0')
        {
            for ($a = 1; $a <= 12; $a++) 
            {
                $tbl_html .= '<th style="background-color:darkcyan;">&nbsp;&nbsp;' . date('F', strtotime(date('Y-' . $a . '-01'))) . '&nbsp;&nbsp;</th>';
            }
        }
        else
        {
            $tbl_html .= '<th style="background-color:darkcyan; text-align:center; width:200px;">&nbsp;&nbsp;' . date('F', strtotime(date('Y-' . $_POST['month_id'] . '-01'))) . '&nbsp;&nbsp;</th>';
        }

        $tbl_html .= '</tr>
                </thead>';

        $required = $this->Finance_Model->setup_store_model_v2();
        foreach ($required as $req) {
         $tbl_html .= '<tr><td style="position: sticky; left: 0; z-index: 3; background-color: white;">' . $req['bu_name'] . '</td>';
        if($_POST['month_id'] == '0')
        {
            for ($month = 1; $month <= 12; $month++) {
                $pending = $this->Finance_Model->select_pending_nav_finance_model($_POST['year_id'], $month, $req['bcode']);
                $approved = $this->Finance_Model->select_approved_nav_finance_model($_POST['year_id'], $month, $req['bcode']);

               if(!empty($pending))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: orange; color: white; padding: 5px 10px; border-radius: 20px;">Pending</span></td>';
               }
              else
               if(!empty($approved))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: green; color: white; padding: 5px 10px; border-radius: 20px;">Approved</span></td>';
               }
              else
               if(empty($pending && $approved))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: brown; color: white; padding: 5px 10px; border-radius: 20px;">None</span></td>';
               }
            }
        }
        else
        {
                $pending = $this->Finance_Model->select_pending_nav_finance_model($_POST['year_id'],$_POST['month_id'], $req['bcode']);
                $approved = $this->Finance_Model->select_approved_nav_finance_model($_POST['year_id'],$_POST['month_id'],$req['bcode']);

               if(!empty($pending))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: orange; color: white; padding: 5px 10px; border-radius: 5px;">Pending</span></td>';
               }
              else
               if(!empty($approved))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Approved</span></td>';
               }
              else
               if(empty($pending && $approved))
               {
                    $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: brown; color: white; padding: 5px 10px; border-radius: 5px;">None</span></td>';
               }
        }
        
            $tbl_html .= '</tr>';
        }

                      $tbl_html.= '</table> 
                                     <script>
                                           $(document).ready(function(){
                                             $("#display_id_v2").DataTable();
                                           });  

                                       </script>                                                                                  
                                     ';
                                 
          $data['tbl_html'] = $tbl_html;
          $data['select_month'] = $select_month;
          echo json_encode($data);
        }

        public function finance_nav_allo_ctrl()
        {
            $this->load->view('finance_view/nav_data_view');
        }

        public function select_nav_data_ctrl()
        {
            $select_month = '';

                if(date('Y') == $_POST['year_id'])
                {
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
                            $select_month.=' <option value="'.$a.'" '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                        } 
                    }    
                }
                else 
                {
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
                        $select_month.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                   }        
                }

              $tbl_html='<div class="table-container">
              <table  id="display_id_v2" class="table table-striped">
                                   <thead class="bg-info text-white">
                                    <tr>                   
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">Department</th>
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle; text-align:right;">Gross Sales</th>
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle; text-align:right;">Net Sales</th>                               
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle; text-align:right;">GP+MTI</th>     
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle; text-align:right;">MTO</th>                    
                                          <th class="column-title" rowpsan="2" style="vertical-align: middle; text-align:right;">Gross Profit</th>                                             
                                          <th class="column-title"  rowpsan="2"style="width:230px; vertical-align: middle; text-align:center;">Submitted by <br>D/T Submitted</th>              
                                    </tr>
                                    </thead>
                                    <tbody>
                        ';
              $tbl_finance = $this->Finance_Model->select_date_nav_finance_model($_POST['year_id'],$_POST['month_id'],$_POST['store_id']);
             
                foreach ($tbl_finance as $finance) 
                {
                    $bu_name= $this->Finance_Model->finance_store_name_model($finance['dcode']);
                    $tbl_html   .= '<tr>';
                    if(!empty($bu_name))
                    {
                        $tbl_html   .= '<td class="a-left" style="vertical-align: middle;">'.$bu_name[0]['dept_name'].'</td>';
                    }
                    
                    $tbl_html.='<td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($finance['gross_sales'],2).' 
                                </td><td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($finance['net_sales'],2).'                  
                                </td><td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($finance['purchases_mti'],2).'
                                </td><td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($finance['mto'],2).'
                                </td><td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($finance['gross_profit'],2).'
                                </td><td style="vertical-align: middle; text-align:center;">' .$finance['submitted_by'].'<br>'.$finance['date_submitted'].'</td>';
                                  
                             
                }
                      $tbl_html   .= '</tbody>
                      </table>
                      </div> 
                                     <script>
                                           $(document).ready(function(){
                                             $("#display_id_v2").DataTable();
                                           });  

                                       </script>                                                                                  
                                     ';
                                 
          $data['tbl_html'] = $tbl_html;
          $data['select_month'] = $select_month;
          echo json_encode($data);
        }

        public function exp_monitor_data_ctrl()
        {
            $month = $this->input->get('month'); // retrieve the month value
            $year = $this->input->get('year');
            $data['months'] = $month;
            $data['years'] = $year;
            $this->load->view('finance_view/exp_monitor_view',$data);
        }

        public function select_monitor_expense_ctrl()
        {
            $select_month = '<option value="0">All Months</option>';

              if(date('Y') == $_POST['year_id'])
              {
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
                              $select_month.=' <option value="'.$a.'" '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                          } 
                      }    
              }
              else 
              {
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
                              $select_month.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                   }        
              }

        if($_POST['month_id'] == 0)
        {
            $get_style= 'table-responsive';
        }
        else
        {
            $get_style='';
        }
        $tbl_html = '<table id="display_expense_monitoring" style="max-width:100%" class="table '.$get_style.' table-bordered table-sm table-hover" table-layout:auto;>
                     <thead class="bg-info text-white">
                        <tr>
                            <th style="text-align:left; position: sticky; left: 0; z-index: 3; background-color: darkcyan;width:80%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
                            if($_POST['month_id'] == '0')
                            {
                                for ($a = 1; $a <= 12; $a++) 
                                {
                                    $tbl_html .= '<th style="background-color:darkcyan;">&nbsp;&nbsp;' . date('F', strtotime(date('Y-' . $a . '-01'))) . '&nbsp;&nbsp;</th>';
                                }
                            }
                            else
                            {
                                $tbl_html .= '<th style="background-color:darkcyan; text-align:center; width:200px;">&nbsp;&nbsp;' . date('F', strtotime(date('Y-' . $_POST['month_id'] . '-01'))) . '&nbsp;&nbsp;</th>';
                            }

        $tbl_html .= '</tr></thead>';

            $required = $this->Finance_Model->setup_store_model_v2();
            foreach ($required as $req)
            {
                $tbl_html .= '<tr><td style="position: sticky; left: 0; z-index: 3; background-color: white;">' . $req['bu_name'] . '</td>';
                    if($_POST['month_id'] == '0')
                    {
                        for ($month = 1; $month <= 12; $month++) {
                            $pending = $this->Finance_Model->select_pending_exp_finance_model($_POST['year_id'], $month, $req['bcode']);
                            $approved = $this->Finance_Model->select_approved_exp_finance_model($_POST['year_id'], $month, $req['bcode']);

                           if(!empty($pending))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: orange; color: white; padding: 5px 10px; border-radius: 20px;">Pending</span></td>';
                           }
                          else
                           if(!empty($approved))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: green; color: white; padding: 5px 10px; border-radius: 20px;">Approved</span></td>';
                           }
                          else
                           if(empty($pending && $approved))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: brown; color: white; padding: 5px 10px; border-radius: 20px;">None</span></td>';
                           }
                        }
                    }
                    else
                    {
                            $pending = $this->Finance_Model->select_pending_exp_finance_model($_POST['year_id'],$_POST['month_id'], $req['bcode']);
                            $approved = $this->Finance_Model->select_approved_exp_finance_model($_POST['year_id'],$_POST['month_id'],$req['bcode']);

                           if(!empty($pending))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: orange; color: white; padding: 5px 10px; border-radius: 5px;">Pending</span></td>';
                           }
                          else
                           if(!empty($approved))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">Approved</span></td>';
                           }
                          else
                           if(empty($pending && $approved))
                           {
                                $tbl_html .= '<td style="vertical-align:middle; text-align:center;"><span class="legend-badge" style=" font-size:12px; background-color: brown; color: white; padding: 5px 10px; border-radius: 5px;">None</span></td>';
                           }
                    }
                    
                        $tbl_html .= '</tr>';
                }
                              $tbl_html.= '</table> 
                                             <script>
                                                   $(document).ready(function(){
                                                     $("#display_expense_monitoring").DataTable();
                                                   });  

                                               </script>                                                                                  
                                             ';
                                         
                  $data['tbl_html'] = $tbl_html;
                  $data['select_month'] = $select_month;
                  echo json_encode($data);
        }

        public function go_expense_ctrl()
        {
            $this->load->view('finance_view/go_expense_data_view');
        }

        public function select_go_expense_ctrl()
        {
            $select_month = '';

              if(date('Y') == $_POST['year'])
              {
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
                              $select_month.=' <option value="'.$a.'" '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                          } 
                      }    
              }
              else 
              {
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
                              $select_month.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                   }        
              }

              $tbl_html='<div class="table-container">
                          <table  id="display_expense_id"  class="table table-striped">
                                   <thead class="bg-info text-white">
                                    <tr>               
                                          <th class="column-title">Account Code</th>
                                          <th class="column-title">Account Name</th>
                                          <th class="column-title">Allocation Type</th>
                                          <th class="column-title"style="text-align:right;">Amount</th>
                                  </tr>
                                    </thead>
                                    ';
           
              $tbl_expense = $this->Finance_Model->select_date_exp_finance_model($_POST['year'],$_POST['month'],$_POST['store']);

              foreach ($tbl_expense as $expense) 
                    {
                       $tbl_html.= '<tr>
                                   </td><td class="a-left">'.$expense['code'].'
                                   </td><td class="a-left">' .$expense['description'].'                                                        
                                   </td><td class="a-left">' .$expense['allocation_name'].'                                                        
                                   </td><td style="text-align:right;">' .number_format($expense['amount'],2).'</td>';
                       
                    }
                       $tbl_html.= '</table> 
                                    </div>
                                     <script>
                                           $(document).ready(function(){
                                             $("#display_expense_id").DataTable();
                                           });  
                                     </script>                                                                                  
                                     ';

          $data['tbl_html'] = $tbl_html;
          $data['select_month'] = $select_month;
          echo json_encode($data);
        }

        public function report_menu_ctrl()
        {
            $this->load->view('finance_view/finance_allo_report_view');
        }

        public function select_finance_report_ctrl()
        {
            $month_select = '<option value="">Select</option>';

              if(date('Y') == $_POST['year'])
              {
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
                            $month_select.=' <option value="'.$a.'" '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                        } 
                      }    
              }
              else 
              {
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
                        $month_select.=' <option value="'.$a.'"  '.$selected.'>'.date('F',strtotime(date('Y-'.$a.'-01'))).'</option>';
                   }        
              }

                $html='
                    <div id="loader"></div>

                    <table id="display_reports_id" class="table table-bordered table-sm table-hover" table-layout:auto;>
                    <thead class="bg-info">
                    <tr style="text-align:center;">
                    <th style="vertical-align:middle; text-align:center; position: sticky; left: 0 !important; z-index: 100; background-color: darkcyan; width:101px !important;">Account Code</th>
                    <th style="vertical-align:middle;  text-align:center; position: sticky; width:170px;left: 115px !important; z-index: 100; background-color: darkcyan; ">Account Name</th>';

                $get_bu_name_header=$this->Finance_Model->get_dept_name_model($_POST['store_ids']);
                foreach($get_bu_name_header as $header)
                {
                    $html.='<th style="vertical-align: middle; text-align:center; background-color: darkcyan;width:160px;" scope="colgroup">'.$header['dept_name'].'</th>';
                }
                $html.='<th style="vertical-align:middle; text-align:right; position: sticky; top: 0 ; right: 17px !important; z-index: 100; background-color: darkcyan; width:100px !important;">Total</th>
                        </tr></thead>';
                    $get_dept_code=$this->Finance_Model->get_dept_code_model($_POST['year'],$_POST['month'],$_POST['store_ids']);

                    $total_overall_amount=0;
                    foreach($get_dept_code as $dept_code)
                    {
                        $html.='<tr>';
                            $html.='<td style="position: sticky; left: 0; z-index: 3; background-color: white;">'.$dept_code['code'].'</td>';
                            $html.='<td style="position: sticky; left: 115px; z-index: 3;background-color: white;width:170px;">'.$dept_code['code_name'].'</td>';
                            $get_dept_data=$this->Finance_Model->get_dept_data_model($_POST['year'],$_POST['month'],$_POST['store_ids'],$dept_code['code_name']);
                            $total_row_amount=0;
                            foreach($get_dept_data as $dept_data)
                            {
                                $html .= '<td style="text-align:right;">';
                                    if (is_numeric($dept_data['amount'])) {
                                        $html .= number_format($dept_data['amount'], 2);
                                        $total_row_amount += $dept_data['amount'];

                                    } else {
                                        $html .= $dept_data['amount']; // or handle it in another way depending on your needs
                                    }
                                $html .= '</td>';
                            }
                            $total_overall_amount += $total_row_amount;
                        $html.='<td style="position: sticky; right: 0; z-index: 3;background-color: white;text-align:right;">'.number_format($total_row_amount,2).'</td>';  
                        $html.='</tr>';
                    }
                    // var_dump($total_column_amount);

                $html.='
                            <tfoot>
                                <tr>
                                    <th colspan="2" style="position: sticky; left: 0; z-index: 3; background-color: white;">Total Amount</th>';
                                    $get_dept_data=$this->Finance_Model->get_dept_data_modelv2($_POST['year'],$_POST['month'],$_POST['store_ids']);
                                    foreach($get_dept_data as $dept_dat)
                                    {
                                        $total_column_amt=0;

                                        for($a=0; $a<count($dept_dat['dcode']); $a++)
                                        {
                                            $get_dept_code=$this->Finance_Model->get_dept_code_modelv2($_POST['year'],$_POST['month'],$dept_dat['dcode']);
                                            foreach($get_dept_code as $get_cod)
                                            {
                                                $total_column_amt += $get_cod['amount'];
                                            }
                                        }

                                            $html.='<th style="white-space: nowrap;"><span style="margin-left: 77px;"></span>'.number_format($total_column_amt, 2).'</th>';
                                    }
                                            $html.='<th style=" text-align: right; position: sticky; right: 0; z-index: 3; background-color: white; right: 17px !important; width:100px !important;">'.number_format($total_overall_amount,2).'</th>
                                </tr>
                            </tfoot>
                         </table>';

                $html.='<script>
                        $(document).ready(function() {
                                $("#display_reports_id").DataTable({
                                    "scrollX": true, // Enable horizontal scrolling
                                    "scrollY": "50vh", // Adjust the height as needed
                                    "paging": true, // Disable pagination if needed
                                    
                                });
                            });
                    </script>';
            $data['month_select']=$month_select;
            $data['html']=$html;
            echo json_encode($data);
        }





}
?>