<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supervisor_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Supervisor_Model');
        $this->load->model('Login_model');
    }

    public function supervisor_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Accounting Supervisor")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Supervisor_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->Supervisor_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('supervisor_view/templates/supervisor_header', $data);
            $this->load->view('supervisor_view/supervisor_body');
            $this->load->view('supervisor_view/templates/supervisor_footer');
        }
        
    }

    public function supervisor_home_ctrl()
    {
        $this->load->view('supervisor_view/supervisor_home');
    }

    public function account_home_ctrl()
    {
        $pending = $this->Supervisor_Model->pending_model($_POST['store_id'],'Pending');
            $badge_count= count($pending);
                $html = '<div class="row">';

                if (count($pending) > 0)
                {
                    for ($y = 2020; $y <= date('Y'); $y++) 
                    {
                        for ($m = 1; $m <= 12; $m++)
                        {
                            $count = 0;
                            foreach ($pending as $p) 
                            {
                                if ($p['month'] == $m && $p['year'] == $y)
                                {
                                    $count++;
                                }
                            }
                                $monthNum  =$m;
                                $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); 
                            if ($count > 0)
                            {
                                $html .= '<div class="dashboard-tile col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 170px;background: linear-gradient(178deg, lightblue, white)"><div class="tile-link" ><div class="tile-link-overlay"></div>                            
                                        <div class="tile-link-content">'; 
                            
                                    $html.='<a href="#" onclick="approveData('."'".$m."','".$y."','".$_POST['store_id']."','".'Pending'."'".')">
                                        <span class="btn btn-success btn-sm">
                                        👍&nbsp;Approve Data
                                        </span>
                                    </a></div></div><div class="x_title">
                                        <h2 style="font-size:20px;"> 📅&nbsp' 
                                        . $monthName. ' ' . $y . '</h2>
                                        <div class="clearfix"></div></div><div class="x_content">
                                        <center><hr class="custom-hr"><div class="dashboard-count btn-warning" style="border-radius: 50%; behavior: url(PIE.htc); width: 70px; height: 70px; padding: 10px; text-align: center; font-size: 32px;">' 
                                        . $count . '</div></center></div></div></div>';
                            }
                        }
                    }
                }
                else 
                {
                    $html .= '</div></div></div></div>';
                    $html .= '<div class="row justify-content-center">
                            <div class="col-12 text-center">
                                <h4>No Data</h4>
                            </div>
                        </div>
                        ';
                }
                $html .= '</div></div></div></div>';

                $lack_badge_nav = $this->Supervisor_Model->lacking_data($_POST['store_id']);
                    $lacking_nav = '<div class="row">'; 

                      if (count($lack_badge_nav) > 0)
                      {
                        foreach ($lack_badge_nav as $lack) 
                        {
                            $lacking_nav.='
                                            <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                                <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                                    <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Supervisor_Model->month_name($lack['month']), 0, 3) . ' '. $lack['year'] .'</h6>
                                                    <div class="tile-link"><div class="tile-link-overlay"></div>
                                                        <div class="tile-link-content"><a href="#" onclick="approveData('."'".$lack['month']."', '".$lack['year']."', '".$_POST['store_id']."'".')">
                                                         <button type="button" class="btn btn-success btn-lg">👁️&nbspView Data</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                        }
                      }
                      else 
                      {
                        $lacking_nav .= '</div><div class="row justify-content-center">
                                        <div class="col-12 text-center">
                                            <h4>No Data</h4>
                                        </div>
                                    </div>';
                      }
                      $lacking_nav .= ' </div>';

                    $pending_expense = $this->Supervisor_Model->pending_expense_model($_POST['store_id'],'Pending');
                $badge_expense_count= count($pending_expense);
                $expense = ' <div class="row">';
                if (count($pending_expense) > 0)
                {
                    for ($y = 2020; $y <= date('Y'); $y++) 
                    {
                        for ($m = 1; $m <= 12; $m++)
                        {
                            $count = 0;
                            foreach ($pending_expense as $p) 
                            {
                                if ($p['month'] == $m && $p['year'] == $y)
                                {
                                    $count++;
                                }
                            }
                                $monthNum  =$m;
                                $monthName = date('F', mktime(0, 0, 0, $monthNum, 10)); 
                            if ($count > 0)
                            {
                                $expense .= '<div class="dashboard-tile col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 170px;background: linear-gradient(178deg, lightblue, white)"><div class="tile-link" ><div class="tile-link-overlay"></div>                            
                                        <div class="tile-link-content">'; 
                            
                                    $expense.='<a href="#" onclick="approve_expense_Data('."'".$m."','".$y."','".$_POST['store_id']."','".'Pending'."'".')">
                                        <span class="btn btn-success btn-sm">
                                        👍&nbsp;Approve Data
                                        </span>
                                    </a></div></div><div class="x_title">
                                        <h2 style="font-size:20px;"> 📅&nbsp' 
                                        . $monthName. ' ' . $y . '</h2>
                                        <div class="clearfix"></div></div><div class="x_content">
                                        <center><hr class="custom-hr"><div class="dashboard-count btn-warning" style="border-radius: 50%; behavior: url(PIE.htc); width: 70px; height: 70px; padding: 10px; text-align: center; font-size: 32px;">' 
                                        . $count . '</div></center></div></div></div>';
                            }
                        }
                    }
                }
                else 
                {
                     $expense .= '</div></div></div></div>';
                     $expense .= '<div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <h4>No Data</h4>
                                    </div>
                                </div>';
                }
                $expense .= '</div></div></div></div>';

                $lacking_exp = $this->Supervisor_Model->lacking_expense_data($_POST['store_id']);

                    $lacking_expense = '<div class="row">'; 
                    
                    if (count($lacking_exp) > 0)
                      {
                        foreach ($lacking_exp as $l) 
                        {
                            $lacking_expense.='
                                            <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                                <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                                    <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Supervisor_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                                    <div class="tile-link"><div class="tile-link-overlay"></div>
                                                        <div class="tile-link-content"><a href="#" onclick="approve_expense_Data('."'".$l['month']."', '".$l['year']."', '".$_POST['store_id']."'".')">
                                                         <button type="button" class="btn btn-success btn-lg">👁️&nbspView Data</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                        }
                      }
                      else 
                      {
                        $lacking_expense .= '</div><div class="row justify-content-center">
                                                <div class="col-12 text-center">
                                                    <h4>No Data</h4>
                                                </div>
                                            </div>';
                      }
                      $lacking_expense .= ' </div>';

                  $data['html'] = $html;
                  $data['badge_count'] = $badge_count;
                  $data['lacking_nav'] = $lacking_nav;
                  $data['lack_badge_nav'] = count($lack_badge_nav);
                  $data['expense'] = $expense;
                  $data['badge_expense_count'] = $badge_expense_count;
                  $data['lacking_expense'] = $lacking_expense;
                  $data['lack_badge_exp'] = count($lacking_exp);
                  echo json_encode($data);
    }

    public function supervisor_nav_data_ctrl()
    {
        $month = $this->input->get('month'); // retrieve the month value
        $year = $this->input->get('year'); // retrieve the year value
        $bu_id = $this->input->get('bu_id'); // retrieve the year value
        $pending = $this->input->get('pending'); // retrieve the year value
        $data['years'] = $year;
        $data['months'] = $month;
        $data['bu_ids'] = $bu_id;
        $data['pendings'] = $pending;
        $this->load->view('supervisor_view/nav_data_view', $data);
    }

    public function select_acct_nav_data_ctrl()
    {
        $select_month = '<option value="">Select</option>';

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

         $tbl_html = '<hr class="custom-hr">
                <div class="row">
                    <div class="col-md-12">
                        <div class="legend-container d-inline-flex p-3" style="border: 2px solid darkgrey;border-radius:5px;margin-bottom:10px;height:49px;" id="header_design">
                            <label class="legend-label">Legend:</label>&nbsp;&nbsp;&nbsp;

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-warning">P</span> Pending &nbsp;&nbsp;&nbsp;
                            </div>

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-success">A</span> Approved &nbsp;&nbsp;&nbsp;
                            </div>

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-secondary">D</span> Disapproved
                            </div>
                        </div>
                    </div>
                </div>
           

           

                <div class="table-container">
                <table  id="display_id_v2" class="table table-striped table-hover">
                   <thead class="bg-info text-white">
                    <tr>                   
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">Department</th>
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">Gross Sales</th>
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">Net Sales</th>                               
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">GP+MTI</th>                                             
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">MTO</th>
                          <th class="column-title" rowpsan="2" style="vertical-align: middle;">Gross Profit</th>
                          <th class="column-title"  rowpsan="2"style="width:116px; vertical-align: middle; text-align:center;">Submitted by <br>D/T Submitted</th>
                          <th class="column-title" rowpsan="2"style="vertical-align: middle;"></th>
                          <th class="column-title" colspan="2" style="width:60px; text-align: center;">Action<br> Approved | Disapproved</th>
                    </tr>';
                   
              $tbl_accounting = $this->Supervisor_Model->display_accounting_model_v2($_POST['year_id'],$_POST['month_id'],$_POST['store_id'],$_POST['status_id']);
              if(count($tbl_accounting) > 0)
              {
                    $tbl_html.='<tr style="background-color: white; color: black;">
                        <td colspan="8"></td>
                        <td style="width: 79px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_app"> Select All </td>
                        <td style="width: 75px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_dis"> Select All </td>
                    </tr>
                    </thead>
                    ';
              }
              else
              {
                    $tbl_html.='<tr style="background-color: white; color: black;">
                        <td colspan="8"></td>
                        <td style="width: 79px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_app" disabled> Select All </td>
                        <td style="width: 75px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_dis" disabled> Select All </td>
                    </tr>
                    </thead>
                    ';
              }
                    
              $checkbox_counter=0;
              $approved_disable='';
              $status_disable='';
              foreach ($tbl_accounting as $accounting) 
                    {
                         $status_disable=$accounting['status'];
                         $bu_name= $this->Supervisor_Model->accounting_store_name_model($accounting['dcode']);
                            if(!empty($bu_name))
                            {
                                $tbl_html   .= '<tr><td class="a-left" style="vertical-align: middle;">'  .$bu_name[0]['dept_name'].'</td>';
                            }
                                $tbl_html.='<td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($accounting['gross_sales'],2).'</td>
                                            <td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($accounting['net_sales'],2).'</td>
                                            <td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($accounting['purchases_mti'],2).'</td>
                                            <td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($accounting['mto'],2).'</td>
                                            <td class="a-left" style="vertical-align: middle; text-align:right;">' .number_format($accounting['gross_profit'],2).'</td>
                                            <td style="vertical-align: middle; text-align:center;">' .$accounting['submitted_by'].'<br>'.$accounting['date_submitted'].'</td>';

                                  if($accounting['status'] == 'Pending')
                                  {
                                        $tbl_html.=' <td class="a-left" style="vertical-align: middle;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: orange; padding: 5px; color: white;">P</span> </td>';
                                  }
                                  else if($accounting['status'] == 'Approved')
                                  {
                                        $tbl_html.=' <td class="a-left" style="vertical-align: middle;"><span class="badge badge-pill rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: green; padding: 5px; color: white;">A</span> </td>';
                                  }
                                  else
                                  {
                                        $tbl_html.=' <td class="a-left" style="vertical-align: middle;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: grey; padding: 5px; color: white;">D</span> </td>';
                                  }

                                  $checkbox_counter+=1;
                                  if($accounting['status'] == 'Approved')
                                  { 
                                      $approved_disable=$accounting['status'];
                                     
                                      $tbl_html.='<td style="vertical-align: middle;"><input type="checkbox" disabled name="checkbox[]" class="td_checkbox_app checkbox_select" onclick="approve_check_js('.$checkbox_counter.')" id="approved_id_check_'.$checkbox_counter.'" value="'.$accounting['id']."|Approved".'"></td> 
                                                  <td style="vertical-align: middle;"><input type="checkbox" disabled name="checkbox[]" class="td_checkbox_dis checkbox_select" onclick="disapprove_check_js('.$checkbox_counter.')" id="disapproved_id_check_'.$checkbox_counter.'" value="'.$accounting['id']."|Disapproved".'"></td>';
                                  }
                                  else
                                  {

                                        $tbl_html.='<td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" class="td_checkbox_app checkbox_select" onclick="approve_check_js('.$checkbox_counter.')" id="approved_id_check_'.$checkbox_counter.'" value="'.$accounting['id']."|Approved".'"></td> 
                                                  <td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" class="td_checkbox_dis checkbox_select" onclick="disapprove_check_js('.$checkbox_counter.')" id="disapproved_id_check_'.$checkbox_counter.'" value="'.$accounting['id']."|Disapproved".'"></td>';
                                  }

                    }
                      $tbl_html   .= '</table>
                                       </div> 
                                       <script>
                                            $(function() {
                                              if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                            });
 
                                            var dataTable = $("#display_id_v2").DataTable();

                                            $("#th_checkbox_app").on("click", function() {
                                                var checked = this.checked;

                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("checked", checked);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("disabled", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("checked", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("disabled", true);
                                            });

                                            $("#th_checkbox_dis").on("click", function() {
                                                var checked = this.checked;

                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("checked", checked);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("disabled", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("checked", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("disabled", true);
                                            });

                                           $(document).on("click", ".td_checkbox_app", function() {
                                            $("#th_checkbox_app").prop( "checked", false );
                                            if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                    
                                        });

                                        $(document).on("click", ".td_checkbox_app", function() {
                                            if ($(".td_checkbox_app:checked").length == $(".td_checkbox_app").length) {
                                                $("#th_checkbox_app").prop( "checked", true );
                                                $("#th_checkbox_dis").prop( "checked", false );
                                                $("#th_checkbox_dis").prop( "disabled", true );
                                            }
                                            else
                                            {
                                                $("#th_checkbox_dis").prop( "disabled", false );
                                                if($("#select_all").text() == "Approved")
                                                  {
                                                    $("#th_checkbox_app").prop("disabled", true);
                                                    $("#th_checkbox_dis").prop("disabled", true);
                                                  }

                                            }
                                        });
                                    
                                        $("#th_checkbox_app").click(function(){
                                            thrc_checked_js();
                                        }); 


                                        // $(".td_checkbox_dis").click(function(){
                                            $(document).on("click", ".td_checkbox_dis", function() {
                                            $("#th_checkbox_dis").prop( "checked", false );
                                            if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                        });

                                        $(document).on("click", ".td_checkbox_dis", function() {
                                            if ($(".td_checkbox_dis:checked").length == $(".td_checkbox_dis").length) {
                                                $("#th_checkbox_dis").prop( "checked", true );
                                                $("#th_checkbox_app").prop( "checked", false );
                                                $("#th_checkbox_app").prop( "disabled", true );
                                            }
                                            else
                                            {
                                                $("#th_checkbox_app").prop( "disabled", false );
                                                if($("#select_all").text() == "Approved")
                                                  {
                                                    $("#th_checkbox_app").prop("disabled", true);
                                                    $("#th_checkbox_dis").prop("disabled", true);
                                                  }
                                            }
                                        });
                                
                                        $("#th_checkbox_dis").click(function(){
                                            thrc_check_dis_js();
                                        }); 
                                       </script>                                                                                 
                                     ';
                                 $hideButton = true;
                            foreach ($tbl_accounting as $accounting) {
                                if ($accounting['status'] != 'Approved') {
                                    $hideButton = false;
                                }
                            }

                            if (!$hideButton) {
                                $tbl_html .= '<div  style="position: relative; margin-bottom: 27px;"><button type="submit" class="btn btn-primary" style="float: right; margin-top:15px;" onclick="nav_status_js()">Submit</button></div>';
                            } else {
                                $tbl_html .= '<div hidden style="position: relative; margin-bottom: 27px;"><button type="submit" class="btn btn-primary" style="float: right; margin-top:15px;" onclick="nav_status_js()">Submit</button></div>';
                            }

          $data['tbl_html'] = $tbl_html;
          $data['select_month'] = $select_month;
          $data['approved_disable'] = $approved_disable;
          echo json_encode($data);
        }

        public function nav_status_ctrl()
        {
            $approve='success';
            for($a=0; $a<count($_POST['checkboxes']); $a++)
            {
                $checkbox_data=explode("|", $_POST['checkboxes'][$a]);
                $this->Supervisor_Model->nav_status_model($checkbox_data[0],$checkbox_data[1]);
            }
            
            echo json_encode($approve);
        }

        public function supervisor_store_expense_ctrl()
        {
            $month = $this->input->get('month'); 
            $year = $this->input->get('year'); 
            $bu_id = $this->input->get('bu_id'); 
            $pending = $this->input->get('pending');
            $data['years'] = $year;
            $data['months'] = $month;
            $data['bu_ids'] = $bu_id;
            $data['pendings'] = $pending;
            $this->load->view('supervisor_view/expense_data_view', $data); 
        }

        public function select_exp_data_ctrl()
        {
            $select_month = '<option value="">Select</option>';

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

              $tbl_html = '<hr class="custom-hr">
                <div class="row">
                    <div class="col-md-12">
                        <div class="legend-container d-inline-flex p-3" style="border: 2px solid darkgrey;border-radius:5px;margin-bottom:10px;height:49px;" id="header_design">
                            <label class="legend-label">Legend:</label>&nbsp;&nbsp;&nbsp;

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-warning">P</span> Pending &nbsp;&nbsp;&nbsp;
                            </div>

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-success">A</span> Approved &nbsp;&nbsp;&nbsp;
                            </div>

                            <div class="legend-item">
                                <span class="legend-badge badge badge-pill badge-secondary">D</span> Disapproved
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="table-container">
                    <table  id="display_expense_id"  class="table table-striped table-hover">
                       <thead class="bg-info text-white">
                        <tr>               
                              <th class="column-title" style="vertical-align:middle;text-align:center;">Account Code</th>
                              <th class="column-title" style="vertical-align:middle;text-align:center;">Account Name</th>
                              <th class="column-title" style="vertical-align:middle;text-align:center;">Amount</th>                                    
                              <th class="column-title" style="vertical-align:middle;text-align:center;">Status</th>                              
                              <th class="column-title" colspan="2" style="width:60px; text-align: center;">Action<br> Approved | Disapproved</th>                          
                        </tr>';

              $tbl_expense = $this->Supervisor_Model->display_expense_model_v2($_POST['year_id'],$_POST['month_id'],$_POST['store_id'],$_POST['store_exp_id']);
              if(count($tbl_expense) > 0)
              {
                    $tbl_html.='<tr style="background-color: white; color: black;">
                            <td colspan="4"></td>
                            <td style="width: 79px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_app"> Select All </td>
                            <td style="width: 75px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_dis"> Select All </td>
                        </tr>
                        </thead>
                        ';
              }
              else
              {
                    $tbl_html.='<tr style="background-color: white; color: black;">
                            <td colspan="4"></td>
                            <td style="width: 79px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_app" disabled> Select All </td>
                            <td style="width: 75px; font-size: 12px; vertical-align: middle;"> <input type="checkbox" id="th_checkbox_dis" disabled> Select All </td>
                        </tr>
                        </thead>
                        ';
              }
                        
           
               $checkbox_counter=0;
               $approved_disable='';
              foreach ($tbl_expense as $expense) 
                    {
                       $tbl_html   .= '<tr>
                                   </td><td class="a-left">'.$expense['code'].'
                                   </td><td class="a-left">' .$expense['description'].'                                                        
                                   </td><td style="text-align:center;">' .number_format($expense['amount'],2).'
                                   </td>';
                                   if($expense['status'] == 'Pending')
                                  {
                                        $tbl_html.=' <td  style="vertical-align: middle; text-align:center;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: orange; padding: 5px; color: white; ">P</span> </td>';
                                  }
                                  else if($expense['status'] == 'Approved')
                                  {
                                        $tbl_html.=' <td  style="vertical-align: middle; text-align:center;"><span class="badge badge-pill rounded-circle mr-2" id="approved_id_disable" style="width: 20px; height: 20px; line-height: 12px; background-color: green; padding: 5px; color: white; ">A</span> </td>';
                                  }
                                  else
                                  {
                                        $tbl_html.=' <td  style="vertical-align: middle; text-align:center;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: grey; padding: 5px; color: white; ">D</span> </td>';
                                  }

                                   $checkbox_counter+=1;
                                   if($expense['status'] == 'Approved')
                                   {
                                      $approved_disable=$expense['status'];

                                      $tbl_html.='<td style="vertical-align: middle;"><input type="checkbox" disabled name="checkbox[]" class="td_checkbox_app checkbox_select" onclick="approve_check_js('.$checkbox_counter.')" id="approved_id_check_'.$checkbox_counter.'" value="'.$expense['id']."|Approved".'"></td> 
                                                  <td style="vertical-align: middle;"><input type="checkbox" disabled name="checkbox[]" class="td_checkbox_dis checkbox_select" onclick="disapprove_check_js('.$checkbox_counter.')" id="disapproved_id_check_'.$checkbox_counter.'" value="'.$expense['id']."|Dissapproved".'"></td>';
                                   }
                                   else
                                   {
                                        $tbl_html.='<td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" class="td_checkbox_app checkbox_select" onclick="approve_check_js('.$checkbox_counter.')" id="approved_id_check_'.$checkbox_counter.'" value="'.$expense['id']."|Approved".'"></td> 
                                                  <td style="vertical-align: middle;"><input type="checkbox" name="checkbox[]" class="td_checkbox_dis checkbox_select" onclick="disapprove_check_js('.$checkbox_counter.')" id="disapproved_id_check_'.$checkbox_counter.'" value="'.$expense['id']."|Dissapproved".'"></td>';
                                   }
                    }
                      $tbl_html   .= '</table> 
                                        </div>
                                     <script>
                                            $(function() {
                                              if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                            });


                                          
                                          
                                            var dataTable = $("#display_expense_id").DataTable();

                                            $("#th_checkbox_app").on("click", function() {
                                                var checked = this.checked;

                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("checked", checked);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("disabled", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("checked", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("disabled", true);
                                            });

                                            $("#th_checkbox_dis").on("click", function() {
                                                var checked = this.checked;

                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("checked", checked);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_dis").prop("disabled", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("checked", false);
                                                dataTable.rows().nodes().to$().find(".td_checkbox_app").prop("disabled", true);
                                            });

                                           $(document).on("click", ".td_checkbox_app", function() {
                                            $("#th_checkbox_app").prop( "checked", false );
                                            if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                    
                                        });

                                        $(document).on("click", ".td_checkbox_app", function() {
                                            if ($(".td_checkbox_app:checked").length == $(".td_checkbox_app").length) {
                                                $("#th_checkbox_app").prop( "checked", true );
                                                $("#th_checkbox_dis").prop( "checked", false );
                                                $("#th_checkbox_dis").prop( "disabled", true );
                                            }
                                            else
                                            {
                                                $("#th_checkbox_dis").prop( "disabled", false );
                                                if($("#select_all").text() == "Approved")
                                                  {
                                                    $("#th_checkbox_app").prop("disabled", true);
                                                    $("#th_checkbox_dis").prop("disabled", true);
                                                  }

                                            }
                                        });
                                    
                                        $("#th_checkbox_app").click(function(){
                                            thrc_checked_js();
                                        }); 


                                        // $(".td_checkbox_dis").click(function(){
                                            $(document).on("click", ".td_checkbox_dis", function() {
                                            $("#th_checkbox_dis").prop( "checked", false );
                                            if($("#select_all").text() == "Approved")
                                              {
                                                $("#th_checkbox_app").prop("disabled", true);
                                                $("#th_checkbox_dis").prop("disabled", true);
                                              }
                                        });

                                        $(document).on("click", ".td_checkbox_dis", function() {
                                            if ($(".td_checkbox_dis:checked").length == $(".td_checkbox_dis").length) {
                                                $("#th_checkbox_dis").prop( "checked", true );
                                                $("#th_checkbox_app").prop( "checked", false );
                                                $("#th_checkbox_app").prop( "disabled", true );
                                            }
                                            else
                                            {
                                                $("#th_checkbox_app").prop( "disabled", false );
                                                if($("#select_all").text() == "Approved")
                                                  {
                                                    $("#th_checkbox_app").prop("disabled", true);
                                                    $("#th_checkbox_dis").prop("disabled", true);
                                                  }
                                            }
                                        });
                                
                                        $("#th_checkbox_dis").click(function(){
                                            thrc_check_dis_js();
                                        }); 
                                       </script>                                                                                  
                                     ';
                        

                        $hideButton = true;
                            foreach ($tbl_expense as $expense) {
                                if ($expense['status'] != 'Approved') {
                                    $hideButton = false;
                                }
                            }

                            if (!$hideButton) {
                                $tbl_html.=' <div style="position: relative; margin-bottom: 27px;"><button type="submit" class="btn btn-primary" style="float:right; margin-top:15px;" onclick="expense_status_js(dataTable)">Submit</button></div>';
                            } else {
                               $tbl_html.=' <div hidden style="position: relative; margin-bottom: 27px;"><button type="submit" class="btn btn-primary" style="float:right; margin-top:15px;" onclick="expense_status_js(dataTable)">Submit</button></div>';
                            }

          $data['tbl_html'] = $tbl_html;
          $data['select_month'] = $select_month;
          $data['approved_disable'] = $approved_disable;
          echo json_encode($data);
        }

        public function expense_status_ctrl()
        {
            $approve='success';
            for($a=0; $a<count($_POST['checkboxes']); $a++)
            {
                $checkbox_data=explode("|", $_POST['checkboxes'][$a]);
                $this->Supervisor_Model->expense_status_model($checkbox_data[0],$checkbox_data[1]);
            }
            
            echo json_encode($approve);
        }

        


}
?>