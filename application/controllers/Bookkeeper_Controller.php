<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bookkeeper_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Bookkeeper_Model');
        $this->load->helper('text');
        $this->load->library('ppdf');
        $this->load->model('Login_model');
    }

    public function bookkeeper_homepage()   
    {
        if($_SESSION['id'] == NULL || $this->Login_model->getUserType($_SESSION['id'])!="Store Bookkeeper")
        {
            // unset($_SESSION['id']);
            redirect(base_url('Login_controller/index'));
        }
        else
        {
            $data['profile'] = $this->Bookkeeper_Model->get_profile($_SESSION['id']);
            $data['bu_id'] = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $this->load->view('bookkeeper_view/templates/bookkeeper_header', $data);
            $this->load->view('bookkeeper_view/bookkeeper_body');
            $this->load->view('bookkeeper_view/templates/bookkeeper_footer');
        }
        
    }

    public function my_profile_ctrl()
    {

        $this->load->view('my_profile_view');
    }

    public function updatePhoto_ctrl()
    {
        define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB

        // Define allowed file types
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Check if file was uploaded and password was provided
        if (isset($_FILES['file1']) && isset($_POST['password'])) {
            $file = $_FILES['file1'];
            $password = $_POST['password'];

            // Check password (replace with actual password checking logic)
            $get_password = $this->Bookkeeper_Model->get_profile_name($_SESSION['id']);
            $storedPasswordHash = $get_password['password']; // Example hash, replace with actual hash
            if (!password_verify($password, $storedPasswordHash)) {
                echo json_encode(['status' => 'error', 'message' => 'Password is incorrect.']);
                exit;
            }

            // Validate file size
            if ($file['size'] > MAX_FILE_SIZE) {
                echo json_encode(['status' => 'error', 'message' => 'File size must be less than 2MB.']);
                exit;
            }

            // Validate file type
            if (!in_array($file['type'], $allowedTypes)) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid file type.']);
                exit;
            }

            // Define upload directory
            $uploadDir = 'assets/images/';

            // Get the user ID from session or other source
            $id = $_SESSION['id'];

            // Retrieve the current photo filename from the database
            $currentPhoto = $this->Bookkeeper_Model->get_profile_name($id);
            $currentPhoto = $currentPhoto['profile'];

            // If the user already has a photo, delete the existing file
            if ($currentPhoto) {
                $existingFile = $uploadDir . $currentPhoto;
                if (file_exists($existingFile)) {
                    unlink($existingFile);
                }
            }

            // Generate a unique numeric filename
            $uniqueName = time() . rand(1000, 9999); // e.g., 16265498431234
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION); // Get file extension
            $numericFilename = $uniqueName . '.' . $fileExtension;

            $uploadFile = $uploadDir . $numericFilename;

            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Update profile in the database with the numeric filename
                $this->Bookkeeper_Model->update_photo($id, $numericFilename);

                echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully!']);
            } 
            else 
            {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file.']);
            }
        } 
        else 
        {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    }

    function updatePassword_ctrl() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get POST data
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            // Get the current logged-in user's ID (assuming it's stored in a session)
            $id = $_SESSION['id']; // Adjust this based on your session management

            // Validate the old password
            $user = $this->Bookkeeper_Model->getUserById($id); // Retrieve user data by ID
            if (password_verify($old_password, $user['password'])) {
                // Hash the new password
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password in the database
                if ($this->Bookkeeper_Model->updateUserPassword($id, $hashedPassword)) {
                    echo json_encode(['success' => true]);
                } 
                else 
                {
                    echo json_encode(['success' => false, 'message' => 'Failed to update the password.']);
                }
            } 
            else 
            {
                echo json_encode(['success' => false, 'message' => 'Old password is incorrect.']);
            }
        } 
        else 
        {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function bookkeeper_home_ctrl()
    {
        $this->load->view('bookkeeper_view/bookkeeper_home');
    }

    public function book_home_ctrl()
    {
        $pending = $this->Bookkeeper_Model->pending_model($_POST['store_id'],'Pending');
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
                            
                                    $html.='<a href="#" onclick="approve_nav_book_js('."'".$m."','".$y."','".'Pending'."'".')">
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
                              </div>';
                }
                $html .= '</div></div></div></div>';

                $lack_badge_nav = $this->Bookkeeper_Model->lacking_data($_POST['store_id']);
                    $lacking_nav = '<div class="row">'; 

                      if (count($lack_badge_nav) > 0)
                      {
                        foreach ($lack_badge_nav as $lack) 
                        {
                            $lacking_nav.='
                                            <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                                <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                                    <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Bookkeeper_Model->month_name($lack['month']), 0, 3) . ' '. $lack['year'] .'</h6>
                                                    <div class="tile-link"><div class="tile-link-overlay"></div>
                                                        <div class="tile-link-content"><a href="#" onclick="approve_nav_book_js('.$lack['month'].', '.$lack['year'].')">
                                                         <button type="button" class="btn btn-success btn-lg">📤&nbspSubmit Data</button></a>
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

                    $pending_expense = $this->Bookkeeper_Model->pending_expense_model($_POST['store_id'],'Pending');
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
                            
                                    $expense.='<a href="#" onclick="approve_expense_book_js('."'".$m."','".$y."','".'Pending'."'".')">
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

                $lacking_exp = $this->Bookkeeper_Model->lacking_expense_data($_POST['store_id']);

                    $lacking_expense = '<div class="row">'; 
                    
                    if (count($lacking_exp) > 0)
                      {
                        foreach ($lacking_exp as $l) 
                        {
                            $lacking_expense.='
                                            <div class="dashboard-tile col-lg-4 col-md-6 col-sm-6">
                                                <div class="card card-products-sold" id="users_hover" style="width: auto;text-align: left; height: 120px;">
                                                    <h6 style ="font-size:40px;" class="card-title">📅&nbsp'. substr($this->Bookkeeper_Model->month_name($l['month']), 0, 3) . ' '. $l['year'] .'</h6>
                                                    <div class="tile-link"><div class="tile-link-overlay"></div>
                                                        <div class="tile-link-content"><a href="#" onclick="approve_expense_book_js('.$l['month'].', '.$l['year'].')">
                                                         <button type="button" class="btn btn-success btn-lg">📤&nbspSubmit Data</button></a>
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

    public function book_agency_ctrl()
    {
        $month = $this->input->get('month'); 
        $year = $this->input->get('year'); 
        $agent_id = $this->input->get('agent_id'); 
        $data['years'] = $year;
        $data['months'] = $month;
        $data['agent_ids'] = $agent_id;
        $this->load->view('bookkeeper_view/agency_record_view', $data);
    }

    public function select_date_agency_ctrl()
      {
         $year=$_POST['year_id'];
          $month_select = '';
              if(date('Y') == $_POST['year_id'])
              {
                      // $month_select.=' <option value=""></option>';
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
                  // $month_select.=' <option value=""></option>';
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

        $bu_ids = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
        $ssd_data= $this->Bookkeeper_Model->get_depts_model($bu_ids);  
        $user_id=$_SESSION['id'];
      
        $dept_list='<table  id= "display_employees_id"  class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                 <tr style="text-align:center;">
                            <th class="column-title" rowspan="2" style="width: 250px; vertical-align:middle;">Department</th>
                            <th class="column-title" colspan="2"style="width: 80px;">No. of Employees</th> 
                  </tr>

                  <tr style="text-align:center;">
                            <th class="column-title" style="width: 80px;">Beginning</th> 
                            <th class="column-title" style="width: 80px;">End</th> 
                  </tr>
                  </thead>

                  <tbody id="display_agent">';
        $total_rec_beginning='';
        $total_rec_end='';
        foreach($ssd_data as $dept)
        {
        $dept_list.='<tr style="background-color: white; text-align:center;">
                    <td style="width: 250px; text-align:left;" >'.$dept['dept_name'].'</td>
                    <td style="width: 80px;"> 
                    <input type="text" id="user_id" hidden value="'.$user_id.'">';

         $agency_employee_data= $this->Bookkeeper_Model->select_date_agency_model($user_id,$dept['dcode'],$_POST['month_id'],$_POST['year_id'],$_POST['type']);
          if(!empty($agency_employee_data))
          {
            $dept_list.='<input type="text" value="'.$agency_employee_data[0]['beginning'].'" disabled class="beginning"  style="width: 70px; text-align:center;"></td>
                        <td style="width: 80px;"> ';
            $dept_list.='<input type="text"  value="'.$agency_employee_data[0]['end'].'" disabled class="end" style="width: 70px; text-align:center;"></td>';
            $total_rec_beginning+=$agency_employee_data[0]['beginning'];
            $total_rec_end+=$agency_employee_data[0]['end'];
          }
          else{

            $dept_list.='
            <input type="number" min="0" max="50" step="1" class="beginning" id="beginning_'.$dept['dcode'].'" onkeyup="calc_agency_employee('."'#beginning_".$dept['dcode']."'".')"  oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" style="width: 70px; text-align:center;"></td>
                      <td style="width: 80px;"> ';
          $dept_list.='<input type="number"  min="0" max="50" step="1" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" class="beginning" id="end_'.$dept['dcode'].'" onkeyup="calc_agency_employee('."'#end_".$dept['dcode']."'".')" style="width: 70px; text-align:center;"></td>';
          }
        }

         $dept_list.='<tr style="background-color: white; text-align:center;">
                            <td style="text-align:left;"><strong>Total</strong></td>
                            <td style="width: 80px;" id="total_beginning">'.$total_rec_beginning.'</td>
                            <td style="width: 80px;" id="total_end">'.$total_rec_end.'</td>
                  </tr>
                  </tbody>
                
                    </table>';

        
        $button_hide='EMPTY';
              if(!empty($agency_employee_data))
              {
                    $button_hide='NOT EMPTY';
              }

        $ssd_data_save= $this->Bookkeeper_Model->get_depts_model($bu_ids); 
        $save_list = '';
            foreach($ssd_data_save as $save)
            {
               $save_list .="^".$save['dcode'];
            }
               
           $dept_list_val='<input value ="'.$save_list.'" id="bu_id" style="display:none;">'; 

        $list='
    <table id="display_agency_table" class="table table-bordered table-sm table-hover" style="width: -webkit-fill-available !important;">
        <thead class="bg-info text-white">
            <tr>                   
                <th style="width: 150px; text-align:center; vertical-align:middle;" rowspan="2">Department</th>  
                <th style="width: 90px; text-align:center; vertical-align:middle;" colspan="2">No. of Employees</th>        
                <th class="column-title" style="width:30px; text-align:center; vertical-align:middle;" rowspan="2">Action</th>  
            </tr>
            <tr>
                <th style="width: 45px; text-align:center;">Beginning</th>
                <th style="width: 45px; text-align:center;">End</th>
            </tr>
        </thead>
        <tbody>';

            $tbl_list_agency=$this->Bookkeeper_Model->display_agency_list_model($bu_ids,$_SESSION['id'],$_POST['type'],$_POST['year_id'],$_POST['month_id']);

            foreach ($tbl_list_agency as $agency) {
                $month_id = $agency['month_id'];
                $month_name= date('F', strtotime($month_id));

                $department= $this->Bookkeeper_Model->get_department_model_v2($agency['dcode']);
                if(!empty($department)) {
                    $list .= '<tr><td class="a-left">' .$department[0]['dept_name'].'</td>';
                }
                $list .= '<td style="text-align:center;">' .$agency['beginning'].'</td><td style="text-align:center;">' .$agency['end'].'</td>';

                $cydem_approved= $this->Bookkeeper_Model->cydem_approved_model($bu_ids,$_POST['month_id'],$_POST['year_id']);
                if(!empty($cydem_approved)) {
                    $list .= '<td><center><strong><label>Approved</label></strong></center></td>';
                } else {
                    $list .= '<td> <center><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 12px; width: 73.025px;margin-bottom: 0px;" onclick="edit_agency_amount_js('."'".$agency['id']."','".$month_name."','".$agency['year_id']."','".$agency['agency_type']."','".$department[0]['dept_name']."','".$agency['beginning']."','".$agency['end']."'".')"><i class="fa fa-edit"></i>&nbsp;Edit</button> </center></td>';
                }
            }

            $list .= '</tr></tbody>
                 </table> 
                        <script>
                            $(document).ready(function() {
                                $("#display_agency_table").DataTable();  
                                $("#display_agency_table").removeAttr("style");
                            });
                        </script>';


           $data["list"] = $list;
           $data['hidden_input'] = $dept_list_val; 
           $data["html"] = $dept_list;
           $data["button_hide"] = $button_hide;
           echo json_encode($data);
      }

      public function calc_agency_employee_ctrl()
      {
         $beginnings = $_POST['beginnings'];
          $end = $_POST['end'];

          $beginnings_ = 0; 
          $end_ = 0;
          for($a=0;$a<count($beginnings);$a++)
          {
              $beginnings_ += $beginnings[$a];
              $end_ += $end[$a];
          }
          
         $data['beginnings']  = $beginnings_;
         $data['end']  = $end_;  
         echo json_encode($data); 
      }

    public function save_agency_ctrl()
    {
        $save_agency="success";
             $this->Bookkeeper_Model->save_agency_model($_POST['user_id'],$_POST['month_id'],$_POST['year_id'],$_POST['agency_id'],$_POST['dcode'],$_POST['beginning'],$_POST['end']);
        echo json_encode($save_agency);
    }

    public function update_agency_ctrl()
    {
        $update="success";
        $this->Bookkeeper_Model->update_agency_model($_POST['edit_id'],$_POST['edit_beg'],$_POST['edit_end']);
        echo json_encode($update);
    }

    public function book_agency_report_ctrl()
    {
        $this->load->view('bookkeeper_view/agency_report_view');
    }

    public function agency_month_year_ctrl()
      {
          $year=$_POST['year_id'];
          $month_select = '';
              if(date('Y') == $_POST['year_id'])
              {
                    // $month_select.=' <option value=""></option>';
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
                  // $month_select.=' <option value=""></option>';
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


         $html='<table id= "display_agency_id" style="width:100%" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                   <tr>                   
                            <th class="column-title" colspan="9" style="font-size: 20px; position: sticky;  z-index: 0;"><center>Active Agency Employees of the Month</center></th>                                                                 
                  </tr> 
                  <tr style="background-color: white; text-align:center;"> 
                  <th style="background-color: white; text-align:left;">Department</th>
                  <th style="background-color: white; text-align:center; width:170px;">Begin</th>
                  <th style="background-color: white; text-align:center; width:170px;">End</th> 
                  </tr></thead>';
         $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
         $department_data= $this->Bookkeeper_Model->get_agents_model($_SESSION['id'],$bu_id,$_POST['year_id'],$_POST['month_id'],$_POST['agency_id']);

         $current_date = '';
         foreach($department_data as $dept)
         {
              $ssd_depart= $this->Bookkeeper_Model->get_department_model_v2($dept['dcode']);  
                       
              $html .= '<tr>';
                            if(!empty($ssd_depart))
                            {
                                $html.='<td>'.$ssd_depart[0]['dept_name'].'</td>';
                            }
                            
                                $html.='<td style="text-align:center; color:orange;">'.$dept['beginning'].'</td> 
                                        <td style="text-align:center; color:blue;">'.$dept['end'].'</td>';
       }

       $html.='
              </table>';

          $html.='<script>
                                   $(document).ready(function(){
                                       $("#display_agency_id").DataTable();
                                     });
                                     </script> 
              ';

           $data['agency'] = $html; 
           echo json_encode($data);
      }

    public function book_nav_allo_ctrl()
    {
        $month = $this->input->get('month'); 
        $year = $this->input->get('year'); 
        $pending = $this->input->get('pending');
        // var_dump($month,$year,$pending);
        $data['years'] = $year;
        $data['months'] = $month;
        $data['pendings'] = $pending;
        $this->load->view('bookkeeper_view/nav_allo_upload_view', $data);
    }

    public function selects_month_year_book_ctrl()
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

                <div id="loader">
                 </div>  
                 <div class="table-container">
                    <table  id= "display_years_months_id" class="table table-striped table-hover">
                       <thead class="bg-info text-white">
                        <tr>
                              <th class="column-title">Department</th>
                              <th class="column-title" style="text-align:right;">Gross Sales</th>
                              <th class="column-title" style="text-align:right;">Net Sales</th>
                              <th class="column-title" style="text-align:right;">GP+MTI</th>
                              <th class="column-title" style="text-align:right;">MTO</th>
                              <th class="column-title" style="text-align:right;">Gross Profit</th>
                              <th class="column-title"></th>
                              <th class="column-title">D/T Submitted</th>
                              <th class="column-title">Action</th>
                                          
                        </tr>
                        </thead>
                        ';
            
                             
              $user_id= $_SESSION['id'];  
              $bu_id= $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);  
              $tbl_bookkeeper=$this->Bookkeeper_Model->display_table_book_model($_POST['year'],$_POST['month'],$bu_id,$_POST['status_id']);
              // var_dump($_POST['year'],$_POST['month'],$user_id,$bu_id,$_POST['status_id']);

              foreach ($tbl_bookkeeper as $book) 
                    {
                        $edit_style='vertical-align: middle; text-align:right;';
                        $dept_name= $this->Bookkeeper_Model->get_dept_name_model($book['dcode']);
                        if(!empty($dept_name))
                        {
                             $html   .= '<tr><td class="a-left" style="vertical-align: middle;">'  .$dept_name[0]['dept_name'].'</td>';

                        }
                                   $html.='<td style="'.$edit_style.'">' .number_format($book['gross_sales'],2).'                                                          
                                   </td><td style="'.$edit_style.'">' .number_format($book['net_sales'],2).'                   
                                   </td><td style="'.$edit_style.'">' .number_format($book['purchases_mti'],2).'
                                   </td><td style="'.$edit_style.'">' .number_format($book['mto'],2).'
                                   </td><td style="'.$edit_style.'">' .number_format($book['gross_profit'],2).'
                                   </td>';
                                   if($book['status'] == 'Pending')
                                  {
                                        $html.=' <td  style="'.$edit_style.'"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: orange; padding: 5px; color: white;">P</span> </td>';
                                  }
                                  else if($book['status'] == 'Approved')
                                  {
                                        $html.=' <td  style="'.$edit_style.'"><span class="badge badge-pill rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: green; padding: 5px; color: white;">A</span> </td>';
                                  }
                                  else
                                  {
                                        $html.=' <td  style="'.$edit_style.'"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: grey; padding: 5px; color: white;">D</span> </td>';
                                  }
                                        $html.='<td style="'.$edit_style.'">' .$book['date_submitted'].'</td>';
                                   if($book['status'] == 'Approved')
                                   {
                                        $html.='<td></td>';
                                   }
                                   else
                                   {
                                        $html.='<td class="a-left"><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 12px; width: 70.025px;" id="dept_edit_btn" onclick="edit_navision_allocation_js('."'".$book['id']."','".$dept_name[0]['dept_name']."','".number_format($book['gross_sales'], 2)."','".number_format($book['net_sales'], 2)."','".number_format($book['purchases_mti'], 2)."','".number_format($book['mto'], 2)."','".number_format($book['gross_profit'], 2)."'".')">📝 Edit</button></td>';
                                   }
                                   
                    }
                      $html   .= '</table>
                                    </div> 
                                     <script>
                                           $(document).ready(function(){
                                             $("#display_years_months_id").DataTable();
                                           });                                                                                    
                                     ';

                        $validate_date=$this->Bookkeeper_Model->validate_date_model($_POST['year'],$_POST['month'],$bu_id);
                        $valid_date='empty';
                        if(!empty($validate_date))
                        {
                            $valid_date='not empty';
                        }

          $data['month_select'] = $month_select;
          $data['valid_date'] = $valid_date;
          $data['html'] = $html;
          echo json_encode($data);
        }

        public function download_csv_format_ctrl()
        {
            $file_name= $this->Bookkeeper_Model->get_store_name($_SESSION['id']); 
            $bu_id= $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
            $dept_data   = $this->Bookkeeper_Model->get_department_model($bu_id);
            $year=$_POST['year_id'];
            $month=$_POST['month_id'];
            $month_name= date('F',strtotime(date($year.'-'.$month.'-01')));
            $date=$month_name.'_'.$year;

            
            header('Content-Type:  text/csv');
            header('Content-Disposition: attachment; filename="'.$file_name.'_NAVISION_FORMAT.csv"');
            
                $data = array(
                        '',
                        ''.$file_name,
                        'Navision Data',
                        'For the month of:,'.$date,
                        '',
                        'Department Name,Gross Sales,Net Sales,Gross Purchases + MTI,MTO,Gross Profit',         
                );

                $dept_array=array();
                foreach($dept_data as $dept)
                {
                    if(!in_array($dept['dcode'],$dept_array))
                    {
                        array_push($data,''.$dept['dept_name'].'|'.$dept['dcode']);
                        array_push($dept_array,$dept['dcode']);
                    }
                }   

                array_push($data,'');
                // array_push($data,'Total Area');

                // $fp = fopen('php://output', 'wb');
                // foreach ( $data as $line )
                // {
                //     $val = explode(",", $line);
                //     fputcsv($fp, $val);
                // }

                // fclose($fp);

                 $fp = fopen('php://output', 'wb');
                
                foreach ( $data as $line )
                {
                    $val  = explode(",", $line);
                    fputcsv($fp, $val);
                
                }
                fclose($fp);  
        }

        public function validate_navision_file_ctrl()
        {
            $user_id=$_SESSION['id'];
            $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $validate_record=$this->Bookkeeper_Model->validate_navision_file_model($_POST['month'],$_POST['year'],$user_id,$bu_id);
            $data['validate_nav']=$validate_record;
            echo json_encode($data);
        }

        public function upload_navision_file_ctrl()
        {
            $dt = new DateTime();
            $date_path=date_format($dt,'Y-m-d');

            $bu_id    = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
            $get_name = $this->Bookkeeper_Model->get_full_name($_SESSION['id']); 
            $full_name = $get_name['firstname'].' '.$get_name['lastname']; 
                $file_counter = '';
            for($i=0; $i<count($_FILES['files']['name']); $i++)
            {
                if (count($_FILES['files']['name']) == 1) // validate file selected limit only 1 file selected because uploading it takes a lot of time.
                {
                    
                    $pop_up = "";
                    unset($RESS2);  /*clear ang sulod sa array para inig loop sa sunod textfile dili mu sumpay ang sulod*/
                    if(!empty($_FILES['files']['tmp_name'])):
                        
                        $fileName = $_FILES['files']['tmp_name'][$i];
                
                        $file = fopen($fileName,"r") or exit("Unable to open file!");
                    
                        while(!feof($file)) {
                            @$RESS2 .= fgets($file). "";
                        }
                    endif;
                    // var_dump($RESS2);
                    $ress_sanitize =explode('"',$RESS2);
                    $string_res ='';
                    for($a=0;$a<count($ress_sanitize);$a++)
                    {
                        $rep=preg_replace('/,/', "", $ress_sanitize[$a]);                                     
                        $rep_ = (float)$rep;

                    // var_dump($rep);
                        if($rep_ != 0)
                        {
                            $string_res .= $rep.",";
                        }
                        else 
                        {
                            $string_res .= $ress_sanitize[$a];  
                        }
                        
                    }

                    $string_res = explode(PHP_EOL, $string_res);
                    $validate_bu=$get_name['store_name']; 
                    $validate_file= explode(',',$string_res[1]);
                    // var_dump($string_res[1],$validate_bu);

                    if($validate_bu == $validate_file[0])
                    {
                        for($a=5;$a<count($string_res);$a++)
                        {
                            $explode_row = explode(",",$string_res[$a]);
                                        
                            $id_explode_row= explode("|",$explode_row[0]);
                             
                             $id=$_SESSION['id'];
                             
                                if(isset($id_explode_row[1]))
                                {
                                    $dcode = '';
                                     if(is_numeric($id_explode_row[1]))
                                     {
                                         $dcode = $id_explode_row[1];
                                     }
                                       $this->Bookkeeper_Model->get_data_navision_model($id,$bu_id,$_POST['yearss'],$_POST['monthss'],$dcode,$explode_row[1],$explode_row[2],$explode_row[3],$explode_row[4],$explode_row[5],$full_name,'Pending');
                                }                           
                        }
                            $val_file='success';
                    }
                    else
                    {
                        $val_file='INVALID';
                    }
              
                }
                else
                {
                    $file_counter = "MULTIPLE FILE";
                }
            }
            if($file_counter != "MULTIPLE FILE")
            {
                $data['val_file']=$val_file;
            }
            $data['file_counter']=$file_counter;
            echo json_encode($data);
        }

        public function verfiy_password_ctrl()
        {
            $validate_pass=$this->Bookkeeper_Model->verfiy_password_model($_POST['user'],$_POST['pass']);
            $message = 'EMPTY';
            if(!is_null($validate_pass))
            {
                $message = 'NOT EMPTY';
                $manager_bu_id=explode(';',$validate_pass['bu_id']);
                for($a=0; $a<count($manager_bu_id); $a++)
                {
                    $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                    if($manager_bu_id[$a] == $bu_id)
                    {
                        $message= 'OKAY';
                    }
                }
                
            }
            $data['message']=$message;
            echo json_encode($data);
        }

        public function update_navision_allocation_ctrl()
        {
            $message='success';
            $this->Bookkeeper_Model->update_navision_allocation_model($_POST['edit_id'],$_POST['edit_gross_sales'],$_POST['edit_net_sales'],$_POST['edit_mti'],$_POST['edit_mto'],$_POST['edit_gross_profit'],$_POST['edit_status']);
            echo json_encode($message);
        }

        public function book_go_exp_ctrl()
        {
            $month = $this->input->get('month'); 
            $year = $this->input->get('year'); 
            $pending = $this->input->get('pending');
            $data['years'] = $year;
            $data['months'] = $month;
            $data['pendings'] = $pending;
            $this->load->view('bookkeeper_view/go_exp_upload_view', $data);
        }

        public function selects_month_year_expense_ctrl()
        {
            //var_dump($_POST['year'],$_POST['month']);
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

              $html='  <div class="row">
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
                <div id="loader" >
             
                 </div> 
                 <div class="table-container">
                    <table  id= "display_expense_year_month" class="table table-striped table-hover">
                       <thead class="bg-info text-white">
                        <tr>                   
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title">Code</th>
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title">Name</th>
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title">Allocation Type</th>
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title" style="text-align:right;">Amount</th>                                                                          
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title"></th>                                                                           
                              <th style="position: sticky; top: 0 ; z-index: 3; background-color: #17a2b8 !important;" class="column-title"style="width: 55px;">Action</th>        
                        </tr>
                        </thead>
                        ';
            
                             
              $user_id= $_SESSION['id'];  
              $bu_id= $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);  
              $tbl_expense=$this->Bookkeeper_Model->display_table_expense_model($_POST['year'],$_POST['month'],$bu_id,$_POST['status_expense_id']);
              $total_exp=0;
              foreach ($tbl_expense as $expense) 
                    {
                        $total_exp+=$expense['amount'];
                       $html   .= '<tr><td class="a-left">'  .$expense['code'].'
                                   </td><td class="a-left">' .$expense['description'].'                                                        
                                   </td><td class="a-left">' .$expense['allocation_name'].'                                                        
                                   </td><td style="text-align:right;">' .number_format($expense['amount'],2).'
                                   </td>';

                                   if($expense['status'] == 'Pending')
                                  {
                                        $html.=' <td class="a-left" style="vertical-align: middle; text-align:right;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: orange; padding: 5px; color: white;">P</span> </td>';
                                  }
                                  else if($expense['status'] == 'Approved')
                                  {
                                        $html.=' <td class="a-left" style="vertical-align: middle; text-align:right;"><span class="badge badge-pill rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: green; padding: 5px; color: white;">A</span> </td>';
                                  }
                                  else
                                  {
                                        $html.=' <td class="a-left" style="vertical-align: middle; text-align:right;"><span class="badge rounded-circle mr-2" style="width: 20px; height: 20px; line-height: 12px; background-color: grey; padding: 5px; color: white;">D</span> </td>';
                                  }

                                if($expense['status'] == 'Approved')
                                {
                                    $html.='<td><div hidden></div></td>';
                                } 
                                else
                                {
                                    $html.='<td class="a-left"><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 12px; width: 70.025px;" id="dept_edit_btn" onclick="edit_store_expense_js('."'".$expense['setup_id']."','".$expense['code']."','".$expense['description']."','".number_format($expense['amount'], 2)."'".')"><i class="fa fa-edit"></i>Edit</button></td>';
                                }
                       
                    }
                    // var_dump($total_exp);
                      $html   .= '<tfoot>
                                  <th colspan="2">Overall Total<th>
                                  <th style="text-align:right">'.number_format($total_exp, 2).'</th>
                                  <th><th>
                                  </tfoot>

                                  </table>
                                     </div> 
                                        <script>
                                           $(document).ready(function(){
                                             $("#display_expense_year_month").DataTable({                                               
                                                "order": [
                                                  [0, "ASC"]
                                                ] 
                                              });
                                           }); 

                                                                $(document).ready(function() {
                                                var table = $("#display_expense_year_month").DataTable();

                                                // Add a filter for the "Allo Type" column (index 1)
                                                table.columns(2).search("").draw();

                                                // Get unique values from the "Allo Type" column
                                                var alloTypeValues = table.column(2).data().unique().toArray();

                                                // Populate the combobox with unique values
                                                var alloTypeFilter = $("#select_allo_type");
                                                alloTypeFilter.empty(); // Clear existing options
                                                alloTypeFilter.append($("<option>", {
                                                    value: "",
                                                    text: "All Allocation Types"
                                                }));
                                                alloTypeValues.forEach(function(value) {
                                                    alloTypeFilter.append($("<option>", {
                                                        value: value,
                                                        text: value
                                                    }));
                                                });

                                                // Event handler for combobox change
                                                alloTypeFilter.on("change", function() {
                                                    var selectedValue = $(this).val();
                                                    table.columns(2).search(selectedValue).draw();
                                                });
                                            });                                                                                  
                                      ';
                    $validate_expense=$this->Bookkeeper_Model->valid_expense_model($_POST['year'],$_POST['month'],$bu_id);
                        $valid_expense='empty';
                        if(!empty($validate_expense))
                        {
                            $valid_expense='not empty';
                        }

          $data['month_select'] = $month_select;
          $data['valid_expense'] = $valid_expense;
          $data['html'] = $html;
          echo json_encode($data);
        }

        public function validate_store_expense_ctrl()
        {
            $user_id=$_SESSION['id'];
            $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $validate_expense=$this->Bookkeeper_Model->validate_store_expense_model($_POST['month'],$_POST['year'],$user_id,$bu_id);
            $data['validate_expense']=$validate_expense;
            echo json_encode($data);
        }

        public function upload_store_expense_ctrl()
        {
            $dt = new DateTime();
            $date_path = date_format($dt, 'Y-m-d');

            $file_counter = '';
            
            foreach ($_FILES['files']['name'] as $i => $file) 
            {
                if (count($_FILES['files']['name']) == 1)
                {
                   
                    // $val_file='';
                    $fileExtension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
                    if ($fileExtension === 'html' || $fileExtension === 'htm') 
                    {
                        // $val_file = 'success';
                        $fileContent = file_get_contents($_FILES['files']['tmp_name'][$i]);

                        // Create a DOMDocument and load the HTML content
                        $doc = new DOMDocument();
                        libxml_use_internal_errors(true); // Disable HTML5 warnings
                        $doc->loadHTML($fileContent);
                        libxml_clear_errors();

                        // Get the HTML content as an array of lines
                        $htmlLines = explode(PHP_EOL, $doc->saveHTML());
                        $desiredBlocks = [];
                        $currentBlock = [];

                      
                        foreach ($htmlLines as $line) {
                            // Trim any leading/trailing whitespace and HTML tags
                            
                            
                            $cleanedLine = strip_tags(trim($line));
                            if (preg_match('/^L\d+\s*/i', $cleanedLine)) {
                                if (!empty($currentBlock)) {
                                    $desiredBlocks[] = $currentBlock;
                                }
                                $currentBlock = [];
                                $currentBlock[] = $cleanedLine;
                            } else {
                                if (!empty($currentBlock)) {
                                    $currentBlock[] = $cleanedLine;
                                }
                            }
                        }
                        $dataFromLine9 = ''; // Initialize a variable to store data from line 9
                        $lineNumber = 0; // Initialize a line number counter
                       foreach($htmlLines as $lines)
                       {
                            $lineNumber++;
                            $cleanedLines = strip_tags(trim($lines));
                            if ($lineNumber === 9) {
                                    // Store the cleaned line data
                                    $dataFromLine9 = $cleanedLines;
                                    break; // Exit the loop, as we found the desired data
                                }
                       }
                       // var_dump($dataFromLine9);
                        $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
                        if($bu_id == '0201' && substr($dataFromLine9, 0, 8) == 'ASC_MAIN')
                        {       
                            if (!empty($currentBlock))
                            {
                                $desiredBlocks[] = $currentBlock;
                            }

                                for($a=0; $a<count($desiredBlocks); $a++)
                                {
                                    
                                    $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                    
                                    $get_data_expenses=$this->Bookkeeper_Model->get_store_expenses_model($bu_id,$desiredBlocks[$a][0],$desiredBlocks[$a][2]);
                                    foreach($get_data_expenses as $get_data)
                                    {
                                         $id = $_SESSION['id'];
                                         // var_dump($get_data['name']);
                                        $this->Bookkeeper_Model->insert_html_upload_expense_model($id,$get_data['bu_id'],$_POST['year'],$_POST['month'],$get_data['account_code'],$get_data['name'],$desiredBlocks[$a][4],'Pending');
                                    }
                                }
                            $val_file = 'success';  
                        }
                        else if ($bu_id == '0202' && substr($dataFromLine9, 0, 11) == 'ASC TALIBON')
                        {
                            if (!empty($currentBlock))
                            {
                                $desiredBlocks[] = $currentBlock;
                            }

                                for($a=0; $a<count($desiredBlocks); $a++)
                                {
                                    
                                    $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                    
                                    $get_data_expenses=$this->Bookkeeper_Model->get_store_expenses_model($bu_id,$desiredBlocks[$a][0],$desiredBlocks[$a][2]);
                                    foreach($get_data_expenses as $get_data)
                                    {
                                         $id = $_SESSION['id'];
                                         // var_dump($get_data['name']);
                                        $this->Store_Bookkeeper_Model->insert_html_upload_expense_model($id,$get_data['bu_id'],$_POST['year'],$_POST['month'],$get_data['account_code'],$get_data['name'],$desiredBlocks[$a][4],'Pending');
                                    }
                                }
                            $val_file = 'success';  
                        }
                        else if ($bu_id == '0203' && substr($dataFromLine9, 0, 8) == 'ICM MAIN')
                        {
                            if (!empty($currentBlock))
                            {
                                $desiredBlocks[] = $currentBlock;
                            }

                                for($a=0; $a<count($desiredBlocks); $a++)
                                {
                                    
                                    $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                    
                                    $get_data_expenses=$this->Bookkeeper_Model->get_store_expenses_model($bu_id,$desiredBlocks[$a][0],$desiredBlocks[$a][2]);
                                    foreach($get_data_expenses as $get_data)
                                    {
                                         $id = $_SESSION['id'];
                                         // var_dump($get_data['name']);
                                        $this->Store_Bookkeeper_Model->insert_html_upload_expense_model($id,$get_data['bu_id'],$_POST['year'],$_POST['month'],$get_data['account_code'],$get_data['name'],$desiredBlocks[$a][4],'Pending');
                                    }
                                }
                            $val_file = 'success';
                        }
                        else if ($bu_id == '0223' && substr($dataFromLine9, 0, 10) == 'ALTA CITTA')
                        {
                            // var_dump($currentBlock);
                            if (!empty($currentBlock))
                            {
                                $desiredBlocks[] = $currentBlock;
                            }

                                for($a=0; $a<count($desiredBlocks); $a++)
                                {
                                    
                                    $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
                                    
                                    $get_data_expenses=$this->Store_Bookkeeper_Model->get_store_expenses_model($bu_id,$desiredBlocks[$a][0],$desiredBlocks[$a][2]);
                                    foreach($get_data_expenses as $get_data)
                                    {
                                         $id = $_SESSION['id'];
                                         // var_dump($get_data['name']);
                                        $this->Store_Bookkeeper_Model->insert_html_upload_expense_model($id,$get_data['bu_id'],$_POST['year'],$_POST['month'],$get_data['account_code'],$get_data['name'],$desiredBlocks[$a][4],'Pending');
                                    }
                                }
                            $val_file = 'success';
                        }
                        else if ($bu_id == '0301' && substr($dataFromLine9, 0, 13) == 'Plaza Marcela')
                        {
                            if (!empty($currentBlock))
                            {
                                $desiredBlocks[] = $currentBlock;
                            }

                                for($a=0; $a<count($desiredBlocks); $a++)
                                {
                                    
                                    $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
                                    
                                    $get_data_expenses=$this->Store_Bookkeeper_Model->get_store_expenses_model($bu_id,$desiredBlocks[$a][0],$desiredBlocks[$a][2]);
                                    foreach($get_data_expenses as $get_data)
                                    {
                                         $id = $_SESSION['id'];
                                         // var_dump($get_data['name']);
                                        $this->Store_Bookkeeper_Model->insert_html_upload_expense_model($id,$get_data['bu_id'],$_POST['year'],$_POST['month'],$get_data['account_code'],$get_data['name'],$desiredBlocks[$a][4],'Pending');
                                    }
                                }
                            $val_file = 'success';
                        }
                        else
                        {
                             $val_file='INVALID';
                        }
                        

                        
                    }
                    else if($fileExtension === 'csv' || $fileExtension === 'CSV')
                    {
                        unset($RESS2);  /*clear ang sulod sa array para inig loop sa sunod textfile dili mu sumpay ang sulod*/
                    if(!empty($_FILES['files']['tmp_name'])):
                        
                        $fileName = $_FILES['files']['tmp_name'][$i];
                
                        $file = fopen($fileName,"r") or exit("Unable to open file!");
                            
                        while(!feof($file)) {
                            @$RESS2 .= fgets($file). "@";
                        }
                    endif;
                    
                    $ress_sanitize =explode('"',$RESS2);
                  
                    $string_res ='';
                    for($a=0;$a<count($ress_sanitize);$a++)
                    {
                        $rep=preg_replace('/,/', "", $ress_sanitize[$a]);                                     
                        $rep_ = (float)$rep;

                        if($rep_ != 0)
                        {
                            $string_res .= $rep.",";
                        }
                        else 
                        {
                            $string_res .= $ress_sanitize[$a];  
                        }
                        
                    }
                     $string_res = explode(PHP_EOL, $string_res);
                     $validate_bu=$this->Bookkeeper_Model->get_store_name($_SESSION['id']); 
                        $validate_file= explode(',',$string_res[0]);
                        
                        if($validate_bu == $validate_file[0])
                        {
                            for ($a = 2; $a < count($string_res); $a++)
                            {
                                $id = $_SESSION['id'];
                                $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
                             
                                $explode_row = explode(",", $string_res[$a]);

                                $descript = '';
                                $dcode = '';
                                $cod = '';

                                if (isset($explode_row[2])) {
                                    // Trim and remove any whitespace characters from the value
                                    $cod = trim($explode_row[2]);

                                    // Check if the trimmed value is numeric
                                    if (is_numeric($cod)) {
                                        // If it's numeric, remove any commas if present
                                        $cod = str_replace(',', '', $cod);
                                    } else {
                                        // If it's not numeric, set $cod to an empty string
                                        $cod = '';
                                    }

                                }

                                if (!empty($explode_row[1])) {
                                    $descript = $explode_row[1];
                                }

                                if (isset($explode_row[0])) {
                                    $dcode = $explode_row[0];
                                    $dcode = str_replace('@', '', $dcode);
                                }
                                   
                                if ($dcode !== '' || $descript !== '') {
                                    if(empty($cod))
                                    {
                                        $cod= 0;
                                    }
                                    $this->Bookkeeper_Model->insert_expense_model($id, $bu_id,$_POST['year'],$_POST['month'], $cod, $descript, $dcode, 'Pending');
                                }
                            }
                                $val_file='success';
                        }
                        else
                        {
                            $val_file='INVALID';
                        }

                        
                    }
                }
                else 
                {
                   $file_counter = "MULTIPLE FILE";
                }
            }
            if($file_counter != "MULTIPLE FILE")
            {
                $data['val_file']=$val_file;
            }
            $data['file_counter']=$file_counter;
            echo json_encode($data);
        }

        public function update_date_expense_ctrl()
        {
            $user_id=$_SESSION['id'];
            $this->Bookkeeper_Model->update_date_expense_model($user_id,$_POST['year'],$_POST['month']);
        }

        public function update_store_expense_ctrl()
        {
            $message='success';
            $validate_code=$this->Bookkeeper_Model->update_store_expense_model($_POST['edit_id'],$_POST['edit_amount']);
            echo json_encode($message);
        }

        public function book_agency_exp_ctrl()
        {
            $this->load->view('bookkeeper_view/agency_expense_view');
        }

        public function select_expense_agency_ctrl()
      {
          $year=$_POST['year_id'];
          $month_select = '';
              if(date('Y') == $_POST['year_id'])
              {
                      $month_select.=' <option value="">Select</option>';
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
                  $month_select.=' <option value="">Select</option>';
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

                $agency_list= $this->Bookkeeper_Model->get_agency_model();  
                $user_id=$_SESSION['id'];
                $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                $agent_list = '<table  id= "display_employees_id"  class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                 <tr style="text-align:center;">
                            <th class="column-title" style="width: 250px;text-align:left;">Agency</th>
                            <th class="column-title"style="width: 80px;">Amount</th> 
                  </tr>

                  </thead>

                  <tbody id="expense_agent">';
                $total_expense = 0;

                foreach ($agency_list as $list) {
                    $agency_expense_data= $this->Bookkeeper_Model->select_expense_agency_model($bu_id,$_SESSION['id'],$_POST['month_id'],$_POST['year_id'],$list['id']);
                    // var_dump($agency_expense_data);
                    if (!empty($agency_expense_data)) {
                        $agent_list .= '<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;">' . $list['agency_name'] . '</td>
                            <td style="width: 80px;"> 
                                <input type="text" id="user_id" hidden value="' . $user_id . '">
                                <input type="text" value="' . number_format($agency_expense_data[0]['amount'], 2) . '" disabled class="beginning" style="width: 118px;text-align: right; margin-right: -120px; margin-left: -119px;">
                            </td>
                        </tr>';
                        $total_expense += $agency_expense_data[0]['amount'];
                    } else {
                        $agent_list .= '<tr style="background-color: white; text-align:center;">
                            <td style="width: 250px; text-align:left;">' . $list['agency_name'] . '</td>
                            <td style="width: 80px;"> 
                                <input type="text" id="user_id" hidden value="' . $user_id . '">
                                <input type="text" class="tanan" id="agent_' . $list['id'] . '" oninput="calc_breakdown_employee(this)" style="width: 118px;text-align: right; margin-right: -120px; margin-left: -119px;">
                            </td>
                        </tr>';
                    }
                }

               
                    $formatted_total_expense = number_format($total_expense, 2); // Format total expense
                

                $agent_list .= '<tr style="background-color: white; text-align:center;">
                    <td style="text-align:left;"><strong>Total</strong></td>
                    <td style="width: 80px; text-align:center;" id="total_expense"><span>' .$formatted_total_expense. '</span></td>   
                </tr>';
               
               $agent_list.=' </tbody>
                                </table>
                                <script type="text/javascript">
                                    $("#display_employees_id").DataTable();
                                </script>';

                $get_agency_expense=$this->Bookkeeper_Model->validate_store_expense_model_v2($_POST['month_id'],$_POST['year_id'],$_SESSION['id'],$bu_id);
                
                if(!empty($get_agency_expense))
                {
                    $expense_amount = $get_agency_expense[0]['amount'];
                    $formatted_amount = number_format($expense_amount, 2);
                    $get_agent_expense = '<input value="' . $formatted_amount . '" id="agent_get_expense" style="display:none;">'; 
                }
                else
                 {
                    $get_agent_expense = '<input value="" id="agent_get_expense" style="display:none;">'; 
                 }

                $button_hide='EMPTY';
              if(!empty($agency_expense_data))
              {
                    $button_hide='NOT EMPTY';
              }
                $agent_save= $this->Bookkeeper_Model->get_agency_model(); 
                $save_list = '';
                    foreach($agent_save as $save)
                    {
                       $save_list .="^".$save['id'];
                    }
                       
                $agent_val='<input value ="'.$save_list.'" id="agents_id" style="display:none;">'; 


                $list=' <table  id="display_agency_expense_table"  class="table table-bordered table-sm  table-hover" "table-layout:fixed;>
                  <thead class="bg-info text-white">
                  <tr>                   
                            <th style="width: 150px; text-align:center;">Agency Name</th>  
                            <th style="width: 90px; text-align:center;">Amount</th>        
                            <th style="width:30px; text-align:center;">Action</th>  
                  </tr>
                 </thead>
                ';

        $tbl_agent_expense=$this->Bookkeeper_Model->select_expense_agency_model_v2($bu_id,$_SESSION['id'],$_POST['month_id'],$_POST['year_id']);
       
          foreach ($tbl_agent_expense as $agent) 
            {
              $agent_name= $this->Bookkeeper_Model->get_agency_model_v2($agent['agency_id']);
                     
                    $list.= '<tr><td class="a-left">' .$agent_name[0]['agency_name'].'</td>';             
                    $list.=' <td style="text-align:center;">' .number_format($agent['amount'], 2).'
                         </td>';
               }
                $list.='
                        </table> 
                        <script type="text/javascript">
                                          
                                             $("#display_agency_expense_table").DataTable();
                                         
                                           </script>
                                           ';

              $data["list"] = $list;
              $data['hidden_input'] = $agent_val;   
              $data['agent_expense'] = $get_agent_expense;   
              $data['month_select'] =$month_select;
              $data['agent_list'] =$agent_list;
              $data['button_hide'] =$button_hide;
              echo json_encode($data);
      }

      public function save_agency_expense_ctrl()
      {
          $save_expense_agency="success";
          $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $this->Bookkeeper_Model->save_agency_expense_model($_POST['user_id'],$bu_id,$_POST['month_id'],$_POST['year_id'],$_POST['agent'],$_POST['amount']);
         echo json_encode($save_expense_agency);
      }

        public function save_agency_expense_model($user_id,$bu_id,$month,$year,$agent,$amount)
        {
            $data= array(

            'user_id'       => $user_id, 
            'bcode'         => $bu_id, 
            'month'         => $month, 
            'year'          => $year, 
            'agency_id'     => $agent, 
            'amount'        => $amount
            );
             $this->db->insert('agency_breakdown' ,$data);
         }

        public function book_code_setup_ctrl()
        {
            $this->load->view('bookkeeper_view/account_setup_table_view');
        }

         public function display_bookkeeper_table_ctrl()
        {
            $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $tbl_account_code=$this->Bookkeeper_Model->display_table_unit_model($bu_id);
                $html=' <button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-info btn-sm rounded-0" style="font-size: 16px;font-weight: bold;width: auto; margin-bottom: 17px;" id="modal_edit2_btn" onclick="add_account_code_modal_js()"><i class="fa fa-plus"></i>&nbsp;Add Account Code</button>
                    <div class="table-container">
                        <table  id= "display_account" class="table table-striped table-hover">
                        <thead class="bg-info text-white">
                        <tr>                   
                          <th class="column-title">Account Codes</th>
                          <th class="column-title">Expenses</th>                                                              
                          <th class="column-title">Allocation Type</th>                                                              
                          <th class="column-title" style="width:100px;">Action</th> 
                        </tr>
                        </thead>
                        <tbody class="bg-light">
                        ';
              
             foreach ($tbl_account_code as $code) 
                    {
                        $allocation_type=$this->Bookkeeper_Model->get_allocation_type_name($code['allocation_id']);
                        $html  .= '<tr><td class="a-left">' .$code['account_code'].' 
                                   </td><td class="a-left">' .$code['name'].'
                                   </td><td class="a-left">' .$allocation_type[0]['allocation_name'].'
                                   </td><td class="a-left"><button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-sm rounded-0" style="font-size: 12px; width: 62.025px;" id="modal_edit2_btn" onclick="edit_account_code_js('."'".$code['id']."','".$code['account_code']."','".$code['name']."','".$code['allocation_id']."'".')"><i class="fa fa-edit"></i>&nbsp;Edit</button>'
                                  ;

                   }
                     $html .= '
                                     </tbody>
                                                </table> 
                                                </div>
                                                 <script>
                                                       $(document).ready(function(){
                                                         $("#display_account").DataTable({                                               
                                                            "order": [
                                                              [0, "ASC"]
                                                            ] 
                                                          });
                                                       }); 
                                                   </script>                                                                                
                                                 ';
                        
                $data["html"] =  $html;
                echo json_encode($data);
        }

        public function get_allocation_type_ctrl()
        {   
            $get_type=$this->Bookkeeper_Model->get_allocation_type_model();
            $html=' 
                <option value="" readonly>--Select--</option>
            ';
            foreach ($get_type as $type)
            {
                $html.=' 
                <option value="'.$type['id'].'">'.$type['allocation_name'].'</option>
                ';
            }
            $data['allocation_type']=$html;
            echo json_encode($data);
        }

        public function validate_account_code_ctrl()
        {
            $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $validate_code=$this->Bookkeeper_Model->validate_account_code_model($bu_id,$_POST['code']);
            $code='empty';
            if(!empty($validate_code))
            {
                $code='not empty';
            }
            $data['code']=$code;
            echo json_encode($data);
        }

        public function save_account_code_ctrl()
        {
            $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $message='success';
            $this->Bookkeeper_Model->save_account_code_model($bu_id,$_POST['code'],$_POST['expense'],$_POST['type']);
            echo json_encode($message);
        }

        public function update_account_code_ctrl()
        {
            $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $update_account_code="success";
            $this->Bookkeeper_Model->update_account_code_model($_POST['id'],$_POST['edit_code'],$_POST['edit_name'],$_POST['edit_type'],$bu_id);
            echo json_encode($update_account_code);
        }

        public function book_report_ctrl()
        {
            $this->load->view('bookkeeper_view/report_allocation_view');
        }

        public function display_report_allocation_ctrl()
        {
            $html='
            <div id="loader">
            </div>
            <table id="display_report_allocation_table"  class="table table-bordered table-sm table-hover" >
                   <thead class="bg-info">
                  <tr style="text-align:center;">
                  <th style="vertical-align:middle; text-align:center; position: sticky; left: 0 !important; z-index: 100; background-color: darkcyan; width:101px !important;">Account Code</th>
                  <th style="vertical-align:middle;  text-align:center; position: sticky; left: 139px !important; z-index: 100; background-color: darkcyan; width:170px !important;">Account Name</th>';

            $report_html='<table  id= "display_report_allocation_table" class="table table-bordered table-sm  table-hover" table-layout:fixed;>
                   <thead class="bg-info">
                  <tr style="text-align:center;">
                 <th style="vertical-align:middle; text-align:center; position: sticky; left: 0 !important; z-index: 100; background-color: darkcyan; width:101px !important;">Account Code</th>
                  <th style="vertical-align:middle;  text-align:center; position: sticky; left: 139px !important; z-index: 100; background-color: darkcyan; width:170px !important;">Account Name</th>';
                $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                $report_depart= $this->Bookkeeper_Model->get_depts_model($bu_id);   
                $user_id=$_SESSION['id'];
                $dept_array=array();
                foreach($report_depart as $dept)
                {
                    if(!in_array('<th scope="colgroup">'.$dept['dept_name'].'</th>', $dept_array))
                    {
                        array_push($dept_array,'<th style="vertical-align:middle; text-align:center; position: sticky; top: 0 ; z-index: 3; background-color: darkcyan;width:160px !important;" scope="colgroup">'.$dept['dept_name'].'</th>');
                    }
                }
                      $dept_array=implode("", $dept_array);

                
                      
                      $html.=' 
                               '.$dept_array.'
                               <th style="vertical-align:middle; text-align:center; position: sticky; right: 0 !important; z-index: 100; background-color: darkcyan; width:100px !important;">Total</th>
                            </tr></thead></table>
                            ';
                      $report_html.=' 
                               '.$dept_array.'
                               <th style="vertical-align:middle; text-align:center; position: sticky; right: 0 !important; z-index: 100; background-color: darkcyan; width:100px !important;">Total</th>
                            </tr></thead></table>
                            ';

                  $html.='<script>
                               
                               
                                $("#display_report_allocation_table").DataTable({
                                    "scrollX": true,
                                    "scrollY": "10vh",
                                    "paging": true 
                                });
                            

                          </script> 
                      ';
                      $data["html"] =  $html;
                      $data["report_html"] =  $report_html;
                      echo json_encode($data);
        }

        public function select_date_reports_ctrl()
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
                  <div id="loader">
                  </div>
                  
                <div class="table-container">
                    <table id="display_reports_id"  class="table table-bordered table-sm table-hover" table-layout:auto;>
                        <thead class="bg-info">
                            <tr style="text-align:center;">
                                 <th style="vertical-align:middle; text-align:center; position: sticky; top: 0 ; left: 0 !important; z-index: 100; background-color: darkcyan; width:101px !important;">Account Code</th>
                                 <th style="vertical-align:middle;  text-align:center; position: sticky; top: 0 ; left: 139px !important; z-index: 100; background-color: darkcyan; width:170px !important;">Account Name</th>';  
            $report_html='
                <div style="text-align: center; font-size: 14px;">
                    <label style="font-weight: bold; font-size: 18px; ">Store Allocation Report</label><br>
                </div>
                    <table border="1" cellpadding="4" cellspacing="0" width="100%" style="border-collapse: collapse;" id="display_reports_id">
                        <thead style="background-color: #1e90ff; color: #fff; text-align: center;">
                            <tr style="text-align:center;">
                                <th style="text-align:center;  background-color: darkcyan;">Account Code</th>
                                <th style="text-align:center; background-color: darkcyan;">Account Name</th>';
                                // <th style="text-align:center; background-color: darkcyan;">Allo Type</th>';

                $months_name=date("F", strtotime('Y-'.$_POST['month'].'-01'));
                $store_name=$this->Bookkeeper_Model->get_store_name($_SESSION['id']);
            $excel_html='
                <div style="text-align:center; font-size:14px;"><label>Store Allocation Report</label></div>
                    <table border="1" cellpadding="2" id="display_reports_id" class="table table-bordered table-sm table-hover" table-layout:auto;>
                        <thead class="bg-info">
                          <tr>
                                <th>'.$store_name.'</th>
                                <th>'.$months_name.'&nbsp;'.$_POST['year'].'</th>
                          </tr>
                          <tr style="text-align:center;">
                                <th style="vertical-align:middle; text-align:center; position: sticky; left: 0 !important; z-index: 100; background-color: darkcyan; width:101px !important;">Account Code</th>
                                <th style="vertical-align:middle;  text-align:center; position: sticky; left: 139px !important; z-index: 100; background-color: darkcyan; width:170px !important;">Account Name</th>';
                                // <th style="vertical-align:middle; text-align:center; position: sticky; left: 347px !important; z-index: 100; background-color: darkcyan; width:130px !important;">Allo Type</th>';
                $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                $report_depart= $this->Bookkeeper_Model->get_depts_model($bu_id);  
                $user_id=$_SESSION['id'];
                $dept_array=array();
                $dcode_array=array();
                foreach($report_depart as $dept)
                {
                    if(!in_array('<th scope="colgroup">'.$dept['dept_name'].'</th>', $dept_array))
                    {
                        array_push($dept_array,'<th style="vertical-align:middle; text-align:center; position: sticky; top: 0 ; z-index: 3; background-color: darkcyan;width:160px !important;"scope="colgroup">'.$dept['dept_name'].'<span hidden>'.'|'.$dept['dcode'].'|'.$_POST['year'].'|'.$_POST['month'].'</span></th>');
                        if(!in_array($dept['dcode'], $dcode_array)){
                            array_push($dcode_array, $dept['dcode']);
                        }
                    }
                }

                      $dept_array=implode("", $dept_array);

                $report_dept_array=array();
                $report_dcode_array=array();
                foreach($report_depart as $dept)
                {
                    if(!in_array('<th >'.$dept['dept_name'].'</th>', $report_dept_array))
                    {
                        array_push($report_dept_array,'<th style="vertical-align:middle; text-align:center;  background-color: darkcyan;">'.$dept['dept_name'].'</th>');
                        array_push($report_dcode_array, $dept['dcode']);
                    }
                }
                      $report_dept_array=implode("", $report_dept_array);
                      
                $excel_dept_array=array();
                $excel_dcode_array=array();
                foreach($report_depart as $dept)
                {
                    if(!in_array('<th >'.$dept['dept_name'].'</th>', $excel_dept_array))
                    {
                        array_push($excel_dept_array,'<th style="vertical-align:middle; text-align:center; position: sticky; top: 0 ; z-index: 3; background-color: darkcyan;width:160px !important;">'.$dept['dept_name'].'</th>');
                        array_push($excel_dcode_array, $dept['dcode']);
                    }
                }

                      $excel_dept_array=implode("", $excel_dept_array);
                      
                      $html.=' 
                               '.$dept_array.'
                               <th style="vertical-align:middle; text-align:right; position: sticky; top: 0 ; right: 17px !important; z-index: 100; background-color: darkcyan; width:100px !important;">Total</th>
                            </tr></thead>';
                      $report_html.=' 
                               '.$report_dept_array.'
                               <th style="text-align:right; background-color: darkcyan;">Total</th>
                            </tr></thead>';
                      $excel_html.=' 
                               '.$excel_dept_array.'
                               <th style="vertical-align:middle; text-align:right; width:100px !important;">Total</th>
                            </tr></thead>';
              $validation_empty=array();
              $user_id= $_SESSION['id'];  
              $bu_id= $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']); 
              $tbl_expense=$this->Bookkeeper_Model->display_table_expense_model_v2($_POST['year'],$_POST['month'],$user_id,$bu_id,'Approved');
              // var_dump(count($tbl_expense));
              $sum_overall_dept=0;
              $column_total = array();
              
              $overall_totalss=0;
              foreach ($tbl_expense as $expense) 
                    {
                        $allocation_type=$this->Bookkeeper_Model->allocation_type_model($expense['code'],$bu_id);
                        if (!empty($allocation_type))
                        {
                            $department_total=$this->Bookkeeper_Model->department_total_model($expense['user_id'],$expense['bu_id'],$expense['month'],$expense['year'],$dcode_array);
                            $total_dept=0;
                            $total_sales=0;
                            $total_mti=0;
                            $number_dept=0;
                            if(!empty($department_total))
                            {
                                $total_dept=$department_total->gross_profit;
                                $total_sales=$department_total->gross_sales;
                                $total_mti=$department_total->purchases_mti;
                                $number_dept=$department_total->dcode_total;
                            }

                            $hrd_total=$this->Bookkeeper_Model->hrd_total_model($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_hrd=0;
                            if(!empty($hrd_total))
                            {
                                $total_hrd=$hrd_total->average;
                            }

                            $hrd_total_v2=$this->Bookkeeper_Model->hrd_total_model_v2($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_hrd_v2=0;
                            if(!empty($hrd_total_v2))
                            {
                                $total_hrd_v2=$hrd_total_v2->average;
                            }

                            $cydem_total=$this->Bookkeeper_Model->cydem_total_model($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_cydem=0;
                            if(!empty($cydem_total))
                            {
                                $total_cydem=$cydem_total->beginning + $cydem_total->end;
                                $total_cydem=$total_cydem / 2;
                            }

                            $cydem_total_v2=$this->Bookkeeper_Model->cydem_total_model_v2($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_cydem_v2=0;
                            if(!empty($cydem_total_v2))
                            {
                                $total_cydem_v2=$cydem_total_v2->beginning + $cydem_total_v2->end;
                                $total_cydem_v2=$total_cydem_v2 / 2;
                            }

                            $floor_total=$this->Bookkeeper_Model->floor_total_model($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_floor=0;
                            if(!empty($floor_total))
                            {
                                $total_floor=$floor_total->basement_1 + $floor_total->basement_2 + $floor_total->ground_floor + $floor_total->mezzanine + $floor_total->second_floor + $floor_total->third_floor + $floor_total->fourth_floor + $floor_total->fifth_floor;
                            }

                            $entech_total=$this->Bookkeeper_Model->entech_total_model($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_entech=0;
                            if(!empty($entech_total))
                            {
                                $total_entech=$entech_total->beginning + $entech_total->end;
                                $total_entech=$total_entech / 2;
                            }

                            $nemplex_total=$this->Bookkeeper_Model->nemplex_total_model($expense['bu_id'],$expense['month'],$expense['year']);
                            $total_nemplex=0;
                            if(!empty($nemplex_total))
                            {
                                $total_nemplex=$nemplex_total->beginning + $nemplex_total->end;
                                $total_nemplex=$total_nemplex / 2;
                            }

                            $week1_total = $this->Bookkeeper_Model->ssd_total_model($expense['bu_id'], $expense['month'], $expense['year'], '1');
                            $week4_total = $this->Bookkeeper_Model->ssd_total_model($expense['bu_id'], $expense['month'], $expense['year'], '4');
                            $total_ssd=0;
                            if (!empty($week1_total) && !empty($week4_total)) {
                                $weeks1_total = $week1_total->guard + $week1_total->reliever;
                                $weeks4_total = $week4_total->guard + $week4_total->reliever;
                                $total_ssd = $weeks4_total + $weeks1_total;
                                $total_ssd = $total_ssd / 2;
                            }

                            $week1_total_v2 = $this->Bookkeeper_Model->ssd_total_model_v2($expense['bu_id'], $expense['month'], $expense['year'], '1');
                            $week4_total_v2 = $this->Bookkeeper_Model->ssd_total_model_v2($expense['bu_id'], $expense['month'], $expense['year'], '4');
                            $total_ssd_v2=0;
                            if (!empty($week1_total_v2) && !empty($week4_total_v2)) {
                                $weeks1_total_v2 = $week1_total_v2->guard + $week1_total_v2->reliever;
                                $weeks4_total_v2 = $week4_total_v2->guard + $week4_total_v2->reliever;
                                $total_ssd_v2 = $weeks4_total_v2 + $weeks1_total_v2;
                                $total_ssd_v2 = $total_ssd_v2 / 2;
                            }

                            $pres_total=$this->Bookkeeper_Model->engr_total_model($expense['bu_id'], $expense['month'],$expense['year'],'Water');
                                                $prevs_total = date('Y-m-d', strtotime('-1 month', strtotime(date($expense['year'] . "-" . $expense['month'] . '-01'))));
                                                $prevs_year  = date('Y', strtotime(date($prevs_total)));
                                                $prevs_month = date('m', strtotime(date($prevs_total)));
                            $prev_total=$this->Bookkeeper_Model->engr_total_model($expense['bu_id'],$prevs_month,$prevs_year,'Water');
                            $water_total=0;
                            if(!empty($pres_total))
                            {
                                $water_total= $pres_total->amount - $prev_total->amount;
                                $water_total= $water_total;
                            }

                            $pres_elect_total=$this->Bookkeeper_Model->engr_total_model($expense['bu_id'], $expense['month'],$expense['year'],'Electric');
                                                $prevs_total = date('Y-m-d', strtotime('-1 month', strtotime(date($expense['year'] . "-" . $expense['month'] . '-01'))));
                                                $prevs_year  = date('Y', strtotime(date($prevs_total)));
                                                $prevs_month = date('m', strtotime(date($prevs_total)));
                            $prev_elect_total=$this->Bookkeeper_Model->engr_total_model($expense['bu_id'],$prevs_month,$prevs_year,'Electric');
                            $electric_total=0;
                            if(!empty($pres_total))
                            {
                                $electric_total= $pres_elect_total->amount - $prev_elect_total->amount;
                                $electric_total= $electric_total;
                            }

                        $total_array = array();
                        $total_array_water = array();
                        for($a=0; $a<count($dcode_array); $a++)
                        {
                            if($allocation_type[0]['allocation_name'] == 'Kwh Consumption')
                            {
                                $get_engr_ids=$this->Bookkeeper_Model->get_engr_id_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric');
                                foreach($get_engr_ids as $engr_ids)
                                {
                                    $electric_expensess=$this->Bookkeeper_Model->engr_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric',$engr_ids['engr_id']);
                                    // var_dump($dcode_array[$a]);
                                    foreach($electric_expensess as $expensesss)
                                    {
                                        $prevs_datesss = date('Y-m-d', strtotime('-1 month', strtotime(date($expensesss['year'] . "-" . $expensesss['month'] . '-01'))));
                                        $prevs_year_dept  = date('Y', strtotime(date($prevs_datesss)));
                                        $prevs_month_dept = date('m', strtotime(date($prevs_datesss)));
                                        $previous_expense_dept=$this->Bookkeeper_Model->engr_dept_expense_model($prevs_month_dept,$prevs_year_dept,$dcode_array[$a],'Electric',$expensesss['engr_id']);
                                        $dept_prev_amount=0;
                                        if(count($previous_expense_dept) > 0)
                                        {
                                            $dept_prev_amount = $previous_expense_dept->amount;
                                        }

                                        $get_old_electric=$this->Bookkeeper_Model->dept_old_meter_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric',$expensesss['engr_id']);

                                        if(count($get_old_electric) > 0)
                                        {
                                            $dept_pres_amount = $expensesss['amount'] + $get_old_electric[0]['amount'];
                                        }
                                        else
                                        {
                                            $dept_pres_amount = $expensesss['amount'];
                                        }

                                        $dept_consump = $dept_pres_amount - $dept_prev_amount;
                                        array_push($total_array, $expensesss['engr_id'].'|'.$dept_consump);
                                    }
                                }
                            }

                            if($allocation_type[0]['allocation_name'] == 'Cubic Meter Consumption')
                            {
                                $get_engr_ids=$this->Bookkeeper_Model->get_engr_id_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Water');
                                foreach($get_engr_ids as $engr_ids)
                                {
                                    $water_expensess=$this->Bookkeeper_Model->engr_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Water',$engr_ids['engr_id']);
                                    // var_dump($dcode_array[$a]);
                                    foreach($water_expensess as $expensesss_water)
                                    {
                                        $prevs_datesss = date('Y-m-d', strtotime('-1 month', strtotime(date($expensesss_water['year'] . "-" . $expensesss_water['month'] . '-01'))));
                                        $prevs_year_dept  = date('Y', strtotime(date($prevs_datesss)));
                                        $prevs_month_dept = date('m', strtotime(date($prevs_datesss)));
                                        $previous_expense_dept=$this->Bookkeeper_Model->engr_dept_expense_model($prevs_month_dept,$prevs_year_dept,$dcode_array[$a],'Water',$expensesss_water['engr_id']);
                                        $dept_prev_amount=0;
                                        if(count($previous_expense_dept) > 0)
                                        {
                                            $dept_prev_amount = $previous_expense_dept->amount;
                                        }
                                        $get_old_water=$this->Bookkeeper_Model->dept_old_meter_model($expense['month'],$expense['year'],$dcode_array[$a],'Water',$expensesss_water['engr_id']);

                                        if(count($get_old_water) > 0)
                                        {
                                            $dept_pres_amount = $expensesss_water['amount'] + $get_old_water[0]['amount'];
                                        }
                                        else
                                        {
                                            $dept_pres_amount = $expensesss_water['amount'];
                                        }
                                        $dept_consump = $dept_pres_amount - $dept_prev_amount;
                                        array_push($total_array_water, $expensesss_water['engr_id'].'|'.$dept_consump);
                                    }
                                }
                            }
                        }

                        $groupedArray = [];
                        foreach ($total_array as $item) {
                            $firstChar = $item[0];
                            if (!isset($groupedArray[$firstChar])) {
                                $groupedArray[$firstChar] = [];
                            }
                            $groupedArray[$firstChar][] = $item;
                        }
                        $total_all_perdept=array();
                        if (count($groupedArray) > 0) {
                            foreach ($groupedArray as $value) {
                                $overall_total=0;
                                $id='';
                                for ($i=0; $i < count($value); $i++) { 
                                    $total_consump= explode('|', $value[$i]);
                                    $overall_total += $total_consump[1];
                                    $id=$total_consump[0];
                                }
                                array_push($total_all_perdept, $id.'|'.$overall_total);
                            }
                        // var_dump($total_all_perdept);
                        }

                        $groupedArray_water = [];
                        foreach ($total_array_water as $items) {
                            $firstChar = $items[0];
                            if (!isset($groupedArray_water[$firstChar])) {
                                $groupedArray_water[$firstChar] = [];
                            }
                            $groupedArray_water[$firstChar][] = $items;
                        }
                        $total_all_perdept_water=array();
                        if (count($groupedArray_water) > 0) {
                            foreach ($groupedArray_water as $value) {
                                $overall_total=0;
                                $id='';
                                for ($i=0; $i < count($value); $i++) { 
                                    $total_consump= explode('|', $value[$i]);
                                    $overall_total += $total_consump[1];
                                    $id=$total_consump[0];
                                }
                                array_push($total_all_perdept_water, $id.'|'.$overall_total);
                            }
                        }


                        $dept_html='';
                        $dept_htmls='';
                        $dept_htmls2=0;
                        $overall_total_dept=0;
                        $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                        $get_data_html=array();
                        for($a=0; $a<count($dcode_array); $a++)
                        {           
                            $allo_type_array=array('Gross Sales','Gross Profit','No. of Employees','No. of Security Guards Assigned','Kwh Consumption','Floor Area','Equal','Gross Purchase + MTI','Cubic Meter Consumption','No. of Employees employed in the Agency','No. of Personnel Assigned');    
                            if(in_array($allocation_type[0]['allocation_name'], $allo_type_array))
                            {       
                                
                                    $validation_nav=$this->Bookkeeper_Model->validation_nav_model($expense['user_id'],$bu_id,$expense['month'],$expense['year']);
                                    // var_dump(count($validation_nav));
                                    if(!empty($validation_nav))
                                    {
                                        $department_expense=$this->Bookkeeper_Model->department_expense_model($expense['user_id'],$bu_id,$expense['month'],$expense['year'],$dcode_array[$a]);
                                        // var_dump(count($department_expense));
                                        if(!empty($department_expense))
                                        {
                                            if($allocation_type[0]['allocation_name'] == 'Gross Sales')
                                            {
                                                // $gross_sales_allo=$department_expense->gross_sales + $total_sales;
                                                $gross_sales_allo=$department_expense->gross_sales / $total_sales;

                                                $gross_sales_allo=$gross_sales_allo * $expense['amount'];

                                                $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($gross_sales_allo, 2).'</td>';
                                                $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$gross_sales_allo.'</td>';
                                                // var_dump($gross_sales_allo);

                                                $dept_htmls2.=number_format($gross_sales_allo, 2);
                                            }
                                            else if($allocation_type[0]['allocation_name'] == 'Gross Profit')
                                            {
                                                // $gross_profit_allo=$department_expense->gross_profit + $total_dept;
                                                $gross_profit_allo=$department_expense->gross_profit / $total_dept;
                                                // var_dump($gross_profit_allo);
                                                $gross_profit_allos=$gross_profit_allo * $expense['amount'];
                                                $gross_profit_allo= number_format($gross_profit_allos, 2);
                                                // $gross_profit_allos= $gross_profit_allo;
                                                $dept_html.='<td style="text-align: right; white-space: nowrap;">'.$gross_profit_allo.'</td>';
                                                $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$gross_profit_allos.'</td>';
                                                $dept_htmls2=$gross_profit_allos;
                                            }
                                            else if($allocation_type[0]['allocation_name'] == 'Gross Purchase + MTI')
                                            {
                                                // $purchases_mti_allo=$department_expense->purchases_mti + $total_mti;
                                                $purchases_mti_allo=$department_expense->purchases_mti / $total_mti;
                                                $purchases_mti_allo=$purchases_mti_allo * $expense['amount'];
                                                $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($purchases_mti_allo, 2).'</td>';
                                                $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$purchases_mti_allo.'</td>';
                                                $dept_htmls2=$purchases_mti_allo;
                                            }
                                            elseif ($allocation_type[0]['allocation_name'] == 'Equal')
                                            {
                                                if($expense['amount'] == 0 || $number_dept == 0)
                                                {
                                                    $equal_allo=0;
                                                }
                                                else
                                                {   
                                                    $equal_allo=$expense['amount'] / $number_dept;
                                                }
                                                    $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($equal_allo, 2).'</td>';                                
                                                    $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$equal_allo.'</td>';                              
                                                    $dept_htmls2=$equal_allo;                                
                                            }
                                            else if(!in_array($allocation_type[0]['allocation_name'], array('Equal','No. of Employees', 'No. of Personnel Assigned', 'No. of Security Guards Assigned', 'Cubic Meter Consumption','Kwh Consumption','Gross Sales','Gross Profit','Gross Purchase + MTI','Floor Area','No. of Employees employed in the Agency')))
                                            {
                                                $dept_html.='<td></td>';
                                                $dept_htmls.='<td></td>';
                                                $dept_htmls2.= 0.00;
                                            }
                                        }
                                    }
                                    else
                                    {
                                        if(!in_array('NO DATA IN NAVISION BASIS',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN NAVISION BASIS');
                                        }
                                    }
                                
                                
                                $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                $hrd_expense = $this->Bookkeeper_Model->hrd_expense_model($bu_id,$expense['month'],$expense['year'],$dcode_array[$a]);
                                // var_dump($hrd_expense->average);
                                $noDataMessage = 'NO DATA IN HRD EMPLOYEES';

                                if ($hrd_expense->average !== null) {
                                    if ($allocation_type[0]['allocation_name'] == 'No. of Employees') {
                                        $hrd_allo = $total_hrd;

                                        if ($hrd_allo == 0) {
                                            $hrd_allo = 0;
                                        } else {
                                            $hrd_allo = $hrd_expense->average / $hrd_allo;
                                        }

                                        $hrd_allo = $expense['amount'] * $hrd_allo;
                                        $dept_html .= '<td style="text-align: right; white-space: nowrap;">' . number_format($hrd_allo, 2) . '</td>';
                                        $dept_htmls .= '<td hidden style="text-align: right; white-space: nowrap;">' .$hrd_allo. '</td>';
                                        $dept_htmls2= $hrd_allo;
                                    }
                                } 
                                else 
                                {
                                    if (!in_array($noDataMessage, $validation_empty)) {
                                        array_push($validation_empty, $noDataMessage);
                                    }
                                }


                                $cydem_expense=$this->Bookkeeper_Model->cydem_expense_model($expense['month'],$expense['year'],$dcode_array[$a]);
                                if(!empty($cydem_expense))
                                {
                                    if($allocation_type[0]['allocation_name'] == 'No. of Personnel Assigned')
                                    {
                                        $cydem_allo=$cydem_expense->beginning + $cydem_expense->end;
                                        $cydem_allo=$cydem_allo / 2 ;
                                        $total_ave_allo=$total_cydem;
                                        if($total_ave_allo == 0)
                                        {
                                            $cydem_allo == 0;
                                        }
                                        else
                                        {                                           
                                            $cydem_allo=$cydem_allo / $total_ave_allo;
                                        }
                                        $cydem_allo=$expense['amount']*$cydem_allo;
                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($cydem_allo, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$cydem_allo.'</td>';
                                        $dept_htmls2=$cydem_allo;
                                    }
                                }
                                else
                                    {
                                        if(!in_array('NO DATA IN CYDEM EMPLOYEES',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN CYDEM EMPLOYEES');
                                        }
                                    }

                                $floor_expense=$this->Bookkeeper_Model->floor_expense_model($expense['month'],$expense['year'],$dcode_array[$a]);
                   
                                if(!empty($floor_expense))
                                {
                                    if($allocation_type[0]['allocation_name'] == 'Floor Area')
                                    {
                                        $floor_allo=$floor_expense->basement_1 + $floor_expense->basement_2 + $floor_expense->ground_floor + $floor_expense->mezzanine + $floor_expense->second_floor + $floor_expense->third_floor + $floor_expense->fourth_floor + $floor_expense->fifth_floor;
                                            $floor_allo=$floor_allo / $total_floor; 
                                        $floor_allo=$expense['amount']*$floor_allo;
                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($floor_allo, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$floor_allo.'</td>';
                                        $dept_htmls2=$floor_allo;
                                    }
                                }
                                else
                                    {
                                        if(!in_array('NO DATA IN LEASING',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN LEASING');
                                        }
                                    }

                                $ssd_week1=$this->Bookkeeper_Model->ssd_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'1');
                                $ssd_week4=$this->Bookkeeper_Model->ssd_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'4');
                                if (!empty($ssd_week1) && !empty($ssd_week4)) {
                                
                                    if($allocation_type[0]['allocation_name'] == 'No. of Security Guards Assigned')
                                    {
                                        $ssd_weeks1=$ssd_week1[0]['guard'] + $ssd_week1[0]['reliever'];
                                        $ssd_weeks4=$ssd_week4[0]['guard'] + $ssd_week4[0]['reliever'];
                                        $ssd_allo=$ssd_weeks1 + $ssd_weeks4;
                                        $ssd_allo=$ssd_allo / 2;
                                        // $total_ssd_allo = $ssd_allo + $total_ssd;
                                        $ssd_allo= $ssd_allo / $total_ssd;                                      
                                        $ssd_allo= $expense['amount']*$ssd_allo;

                                        // var_dump($ssd_allo);
                                        
                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($ssd_allo, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$ssd_allo.'</td>';
                                        $dept_htmls2=$ssd_allo;
                                    }
                                }
                                else
                                    {
                                        if(!in_array('NO DATA IN SSD EMPLOYEES',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN SSD EMPLOYEES');
                                        }
                                    }

                                if($allocation_type[0]['allocation_name'] == 'Cubic Meter Consumption')
                                {
                                    $get_engr_id_water=$this->Bookkeeper_Model->get_engr_id_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Water');
                                    if(!empty($get_engr_id_water))
                                    {
                                        $water_allocation_expense=0;
                                        $total_water_engr_id=0;
                                        $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                        foreach($get_engr_id_water as $engr_id_water)
                                        {
                                            $get_admin_water=$this->Bookkeeper_Model->get_engr_admin_model($expense['month'],$expense['year'],$bu_id,'Water',$engr_id_water['engr_id']); 
                                            $total_admin_water=0;
                                            foreach($get_admin_water as $admin_water)
                                            {
                                                    $prevs_date = date('Y-m-d', strtotime('-1 month', strtotime(date($admin_water['year'] . "-" . $admin_water['month'] . '-01'))));
                                                    $prevs_year_admin  = date('Y', strtotime(date($prevs_date)));
                                                    $prevs_month_admin = date('m', strtotime(date($prevs_date)));
                                                    $previous_expense=$this->Bookkeeper_Model->get_engr_admin_model($prevs_month_admin,$prevs_year_admin,$bu_id,'Water',$admin_water['engr_id']);
                                                    if($previous_expense == NULL)
                                                    {
                                                        $admin_prev_amount = 0.00;
                                                    }
                                                    else
                                                    {
                                                        $admin_prev_amount=$previous_expense[0]['amount'];
                                                    }
                                                    $get_admin_old_meter=$this->Bookkeeper_Model->get_admin_old_meter_model($expense['month'],$expense['year'],$bu_id,'Water',$engr_id_water['engr_id']); 
                                                    if(count($get_admin_old_meter) > 0)
                                                    {
                                                        $admin_pres_amount=$admin_water['amount'] + $get_admin_old_meter[0]['amount'];
                                                    }
                                                    else
                                                    {
                                                        $admin_pres_amount=$admin_water['amount'];
                                                    }
                                                    $admin_consump=$admin_pres_amount - $admin_prev_amount;
                                                    $total_admin_water= $admin_consump * $admin_water['rate'];

                                                    $get_admin_old_meter_val=$this->Bookkeeper_Model->get_admin_old_meter_model_v2($expense['month'],$expense['year'],$bu_id,'Water');
                                                    // var_dump($get_admin_old_meter_val);
                                                    if(count($get_admin_old_meter_val) > 1)
                                                    {
                                                        $get_admin_val="true";
                                                    }
                                                    else
                                                    {
                                                        $get_admin_val="false";
                                                    }
                                                    
                                            }

                                            $water_expensess=$this->Bookkeeper_Model->engr_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Water',$engr_id_water['engr_id']);
                                            foreach($water_expensess as $expensesss)
                                            {
                                                $prevs_datesss = date('Y-m-d', strtotime('-1 month', strtotime(date($expensesss['year'] . "-" . $expensesss['month'] . '-01'))));
                                                $prevs_year_dept  = date('Y', strtotime(date($prevs_datesss)));
                                                $prevs_month_dept = date('m', strtotime(date($prevs_datesss)));
                                                $previous_expense_dept=$this->Bookkeeper_Model->engr_dept_expense_model($prevs_month_dept,$prevs_year_dept,$dcode_array[$a],'Water',$expensesss['engr_id']);
                                                $dept_prev_amount=0;
                                                if(count($previous_expense_dept) > 0)
                                                {
                                                    $dept_prev_amount = $previous_expense_dept->amount;
                                                }
                                                $dept_old_meter=$this->Bookkeeper_Model->dept_old_meter_model($expense['month'],$expense['year'],$dcode_array[$a],'Water',$engr_id_water['engr_id']);
                                                if(count($dept_old_meter) > 0)
                                                {
                                                    $dept_pres_amount = $expensesss['amount'] + $dept_old_meter[0]['amount'];
                                                }
                                                else
                                                {
                                                    $dept_pres_amount = $expensesss['amount'];
                                                }
                                                $dept_consump = $dept_pres_amount - $dept_prev_amount;
                                                $water_allocation_expense = $dept_consump * $total_admin_water;
                                                for ($i=0; $i < count($total_all_perdept_water); $i++) { 
                                                    $explode_perdept= explode('|',$total_all_perdept_water[$i]);
                                                    if($explode_perdept[0] == $expensesss['engr_id'])
                                                    {
                                                        $water_allocation_expense = $water_allocation_expense / $explode_perdept[1];
                                                        $water_allocation_expense = $water_allocation_expense / $total_admin_water;
                                                        $total_water_engr_id += $water_allocation_expense;
                                                    }
                                                }
                                            }
                                        }
                                        if($get_admin_val == 'true')
                                        {
                                            $water_allocation_expense= $expense['amount'] * $total_water_engr_id;
                                            $water_allocation_expense=$water_allocation_expense/2;
                                        }
                                        else
                                        {
                                            $water_allocation_expense= $expense['amount'] * $total_water_engr_id;
                                        }
                                                        

                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($water_allocation_expense, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$water_allocation_expense.'</td>';
                                        $dept_htmls2=$water_allocation_expense;
                                    }
                                    else
                                    {
                                        if(!in_array('NO DATA IN CUBIC METER CONSUMPTION',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN CUBIC METER CONSUMPTION');
                                        }
                                        
                                    }

                                }
                                
                                if($allocation_type[0]['allocation_name'] == 'Kwh Consumption')
                                {
                                    $get_engr_ids=$this->Bookkeeper_Model->get_engr_id_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric');
                                    $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                    if(!empty($get_engr_ids))
                                    {
                                        $electric_allocation_expense=0;
                                        $total_amont_engr_id=0;
                                        foreach($get_engr_ids as $engr_ids)
                                        {
                                            $get_admin_electric=$this->Bookkeeper_Model->get_engr_admin_model($expense['month'],$expense['year'],$bu_id,'Electric',$engr_ids['engr_id']); 
                                            $total_admin=0;
                                            foreach($get_admin_electric as $admin)
                                            {
                                                    $prevs_date = date('Y-m-d', strtotime('-1 month', strtotime(date($admin['year'] . "-" . $admin['month'] . '-01'))));
                                                    $prevs_year_admin  = date('Y', strtotime(date($prevs_date)));
                                                    $prevs_month_admin = date('m', strtotime(date($prevs_date)));
                                                    $previous_expense=$this->Bookkeeper_Model->get_engr_admin_model($prevs_month_admin,$prevs_year_admin,$bu_id,'Electric',$admin['engr_id']);
                                                    // $get_admin_old_meter_prev=$this->Bookkeeper_Model->get_admin_old_meter_model($prevs_month_admin,$prevs_year_admin,$bu_id,'Electric',$admin['engr_id']);
                                                    if($previous_expense == NULL)
                                                    {
                                                        $admin_prev_amount = 0.00;
                                                    }
                                                    // else
                                                    // if(count($get_admin_old_meter_prev) > 0)
                                                    // {
                                                    //  $admin_prev_amount=$previous_expense[0]['amount'] + $get_admin_old_meter_prev[0]['amount'];
                                                    // }
                                                    else
                                                    {
                                                        $admin_prev_amount=$previous_expense[0]['amount'];
                                                    }

                                                    $get_admin_old_meter=$this->Bookkeeper_Model->get_admin_old_meter_model($expense['month'],$expense['year'],$bu_id,'Electric',$admin['engr_id']); 
                                                    if(count($get_admin_old_meter) > 0)
                                                    {
                                                        $admin_pres_amount=$admin['amount'] + $get_admin_old_meter[0]['amount'];
                                                    }
                                                    else
                                                    {
                                                        $admin_pres_amount=$admin['amount'];
                                                    }

                                                    $admin_consump=$admin_pres_amount - $admin_prev_amount;
                                                    $total_admin= $admin_consump * $admin['rate'];

                                                    $get_admin_old_meter_val=$this->Bookkeeper_Model->get_admin_old_meter_model_v2($expense['month'],$expense['year'],$bu_id,'Electric');
                                                    // var_dump($get_admin_old_meter_val);
                                                    if(count($get_admin_old_meter_val) > 1)
                                                    {
                                                        $get_admin_val="true";
                                                    }
                                                    else
                                                    {
                                                        $get_admin_val="false";
                                                    }
                                                    // var_dump($total_admin);
                                                    
                                            }

                                            $electric_expensess=$this->Bookkeeper_Model->engr_expense_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric',$engr_ids['engr_id']);
                                            foreach($electric_expensess as $expensesss)
                                            {
                                                $prevs_datesss = date('Y-m-d', strtotime('-1 month', strtotime(date($expensesss['year'] . "-" . $expensesss['month'] . '-01'))));
                                                $prevs_year_dept  = date('Y', strtotime(date($prevs_datesss)));
                                                $prevs_month_dept = date('m', strtotime(date($prevs_datesss)));
                                                $previous_expense_dept=$this->Bookkeeper_Model->engr_dept_expense_model($prevs_month_dept,$prevs_year_dept,$dcode_array[$a],'Electric',$expensesss['engr_id']);
                                                // $dept_old_meter_prev=$this->Bookkeeper_Model->dept_old_meter_model($prevs_month_dept,$prevs_year_dept,$dcode_array[$a],'Electric',$expensesss['engr_id']);
                                                $dept_prev_amount=0;
                                                if(count($previous_expense_dept) > 0)
                                                {
                                                    $dept_prev_amount = $previous_expense_dept->amount;
                                                }
                                                // else if(count($dept_old_meter_prev) > 0)
                                                // {
                                                //  $dept_prev_amount = $previous_expense_dept->amount + $dept_old_meter_prev[0]['amount'];
                                                // }
                                                
                                                $dept_old_meter=$this->Bookkeeper_Model->dept_old_meter_model($expense['month'],$expense['year'],$dcode_array[$a],'Electric',$expensesss['engr_id']);
                                                if(count($dept_old_meter) > 0)
                                                {
                                                    $dept_pres_amount = $expensesss['amount'] + $dept_old_meter[0]['amount'];
                                                }
                                                else
                                                {
                                                    $dept_pres_amount = $expensesss['amount'];
                                                }
                                                $dept_consump = $dept_pres_amount - $dept_prev_amount;
                                                $electric_allocation_expense = $dept_consump * $total_admin;
                                                for ($i=0; $i < count($total_all_perdept); $i++) { 
                                                    $explode_perdept= explode('|',$total_all_perdept[$i]);
                                                    if($explode_perdept[0] == $expensesss['engr_id'])
                                                    {
                                                        $electric_allocation_expense = $electric_allocation_expense / $explode_perdept[1];
                                                        $electric_allocation_expense = $electric_allocation_expense / $total_admin;
                                                        $total_amont_engr_id += $electric_allocation_expense;
                                                    }
                                                }
                                            }
                                        }
                                        // var_dump($get_admin_val);
                                        if($get_admin_val == 'true')
                                        {
                                            $electric_allocation_expense= $expense['amount'] * $total_amont_engr_id;
                                            $electric_allocation_expense=$electric_allocation_expense/2;
                                        }
                                        else
                                        {
                                            $electric_allocation_expense= $expense['amount'] * $total_amont_engr_id;
                                        }
                                        
                                                        

                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($electric_allocation_expense, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$electric_allocation_expense.'</td>';
                                        $dept_htmls2=$electric_allocation_expense;
                                    }
                                    else
                                    {
                                        if(!in_array('NO DATA IN KWH CONSUMPTION',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN KWH CONSUMPTION');
                                        }
                                        
                                    }

                                }


                                $cydem_expense_v2=$this->Bookkeeper_Model->cydem_expense_model_v2($expense['month'],$expense['year'],$dcode_array[$a]);
                                $entech_expense=$this->Bookkeeper_Model->entech_expense_model($expense['month'],$expense['year'],$dcode_array[$a]);
                                $nemplex_expense=$this->Bookkeeper_Model->nemplex_expense_model($expense['month'],$expense['year'],$dcode_array[$a]);

                                $validation_week1_v1=$this->Bookkeeper_Model->ssd_validation_model($expense['month'],$expense['year'],'1');
                                $validation_week4_v1=$this->Bookkeeper_Model->ssd_validation_model($expense['month'],$expense['year'],'4');

                                $ssd_week1_v2=$this->Bookkeeper_Model->ssd_expense_model_v2($expense['month'],$expense['year'],$dcode_array[$a],'1');
                                $ssd_week4_v2=$this->Bookkeeper_Model->ssd_expense_model_v2($expense['month'],$expense['year'],$dcode_array[$a],'4');

                                $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                                $hrd_expense_v2=$this->Bookkeeper_Model->hrd_expense_model_v2($bu_id,$expense['month'],$expense['year'],$dcode_array[$a]);
                                // var_dump($ssd_week1_v2[0]['dcode']);
                                if(!empty($validation_week1_v1) && !empty($validation_week4_v1) && !empty($cydem_expense_v2) && !empty($entech_expense) && !empty($nemplex_expense) && !empty($hrd_expense_v2))
                                {
                                    if($allocation_type[0]['allocation_name'] == 'No. of Employees employed in the Agency')
                                    {
                                        $cydem_allo=$cydem_expense_v2->beginning + $cydem_expense_v2->end;
                                        // $total_ave_allo=$cydem_allo + $total_cydem_v2;
                                        $cydem_allo=$cydem_allo / 2 ;
                                        // if($cydem_allo == 0)
                                        // {
                                        //  $cydem_allo=0;
                                        // }
                                        // else
                                        // {
                                        //  $cydem_allo=$cydem_allo / $total_cydem_v2;
                                        // }                                        
                                        // $cydem_allo=$expense['amount']*$cydem_allo;

                                        $entech_allo=$entech_expense->beginning + $entech_expense->end;
                                        // $total_entech_allo=$entech_allo + $total_entech;
                                        $entech_allo=$entech_allo / 2 ;
                                        // if($entech_allo == 0)
                                        // {
                                        //  $entech_allo = 0;
                                        // }
                                        // else
                                        // {
                                        //  $entech_allo=$entech_allo / $total_entech;
                                        // }                                        
                                        // $entech_allo=$expense['amount']*$entech_allo;

                                        $nemplex_allo=$nemplex_expense->beginning + $nemplex_expense->end;
                                        // $total_nemplex_allo=$nemplex_allo + $total_nemplex;
                                        $nemplex_allo=$nemplex_allo / 2 ;
                                        // if($nemplex_allo == 0)
                                        // {
                                        //  $nemplex_allo=0;
                                        // }
                                        // else
                                        // {
                                        //  $nemplex_allo=$nemplex_allo / $total_nemplex;
                                        // }                                        
                                        // $nemplex_allo=$expense['amount']*$nemplex_allo;

                                        $ssd_week1_guard = isset($ssd_week1_v2[0]['guard']) ? $ssd_week1_v2[0]['guard'] : 0;
                                        // var_dump($ssd_week1_guard);
                                        $ssd_week1_reliever = isset($ssd_week1_v2[0]['reliever']) ? $ssd_week1_v2[0]['reliever'] : 0;
                                        $ssd_week4_guard = isset($ssd_week4_v2[0]['guard']) ? $ssd_week4_v2[0]['guard'] : 0;
                                        $ssd_week4_reliever = isset($ssd_week4_v2[0]['reliever']) ? $ssd_week4_v2[0]['reliever'] : 0;

                                        $ssd_week1_total = $ssd_week1_guard + $ssd_week1_reliever;
                                        $ssd_week4_total = $ssd_week4_guard + $ssd_week4_reliever;
                                        $ssd_allo = ($ssd_week1_total + $ssd_week4_total) / 2;
                                        // $ssd_allo = $ssd_allo / $total_ssd_v2;
                                        // $ssd_allo = $expense['amount'] * $ssd_allo;
                                        // var_dump($expense['amount']);

                                        $hrd_allo=$hrd_expense_v2->average;
                                        // $total_hrd_v2;
                                        // if($hrd_allo == 0)
                                        // {
                                        //  $hrd_allo= 0;
                                        // }
                                        // else
                                        // {
                                        //  // $hrd_allo=$expense['amount'] * $hrd_allo;
                                        // }
                                        // var_dump($cydem_allo,$entech_allo,$nemplex_allo,$ssd_allo,$hrd_allo);
                                        $total_dept_allo=$cydem_allo+$entech_allo+$nemplex_allo+$ssd_allo+$hrd_allo;
                                        $total_all_dept_allo=$total_cydem_v2+$total_entech+ $total_nemplex+$total_hrd_v2+$total_ssd_v2; 
                                        $total_all_agency_allo= $total_dept_allo/$total_all_dept_allo;                  
                                        $total_all_agency_allo= $expense['amount'] * $total_all_agency_allo;

                                        $dept_html.='<td style="text-align: right; white-space: nowrap;">'.number_format($total_all_agency_allo, 2).'</td>';
                                        $dept_htmls.='<td hidden style="text-align: right; white-space: nowrap;">'.$total_all_agency_allo.'</td>';
                                        $dept_htmls2=$total_all_agency_allo;
                                    }
                                }
                                else
                                    {
                                        if(!in_array('NO DATA IN AGENCY EMPLOYEES',$validation_empty))
                                        {
                                            array_push($validation_empty, 'NO DATA IN AGENCY EMPLOYEES');
                                        }
                                    }

                                    
                                if($allocation_type[0]['allocation_name'] == 'Gross Sales')
                                {
                                    if($dcode_array[$a] == '020288' || $dcode_array[$a] == '022388' || $dcode_array[$a] == '020188' || $dcode_array[$a] == '020388' || $dcode_array[$a] == '030188')
                                    {                                       
                                        $dept_html.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls2=0.00;
                                    }
                                }

                                if($allocation_type[0]['allocation_name'] == 'Gross Profit')
                                {
                                    if($dcode_array[$a] == '020288' || $dcode_array[$a] == '022388' || $dcode_array[$a] == '020188' || $dcode_array[$a] == '020388' || $dcode_array[$a] == '030188')
                                    {                                       
                                        $dept_html.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls2=0.00;
                                    }
                                }

                                if($allocation_type[0]['allocation_name'] == 'Gross Purchase + MTI')
                                {
                                    if($dcode_array[$a] == '020288' || $dcode_array[$a] == '022388' || $dcode_array[$a] == '020188' || $dcode_array[$a] == '020388' || $dcode_array[$a] == '030188')
                                    {                                       
                                        $dept_html.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls2=0.00;
                                    }
                                }

                                if($allocation_type[0]['allocation_name'] == 'Equal')
                                {
                                    if($dcode_array[$a] == '020288' || $dcode_array[$a] == '022388' || $dcode_array[$a] == '020188' || $dcode_array[$a] == '020388' || $dcode_array[$a] == '030188')
                                    {                                       
                                        $dept_html.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls.='<td style="text-align:right;">0.00</td>';
                                        $dept_htmls2=0.00;
                                    }
                                }

                                // if($allocation_type[0]['allocation_name'] == 'No. of Employees employed in the Agency')
                                // {
                                //  if($dcode_array[$a] == '020288' || $dcode_array[$a] == '022388' || $dcode_array[$a] == '020188' || $dcode_array[$a] == '020388' || $dcode_array[$a] == '030188')
                                //  {                                       
                                //      $dept_html.='<td style="text-align:right;">0.00</td>';
                                //  }
                                // }

                                // if($allocation_type[0]['allocation_name'] == 'Cubic Meter Consumption')
                                // {                                    
                                //  $dept_html.='<td style="text-align:right;">0.00</td>';
                                // }
                            }
                            else
                            {
                                $dept_html.='<td></td>';
                                $dept_htmls2=0.00;
                            }
                            

                            if(!empty($column_total[$a]) )
                            {
                                $col_tot = $column_total[$a] ;     
                                                        
                            }
                            else 
                            {
                                $col_tot = 0 ;
                            }
                            
                                
                            // $overall_totalss += $col_tot;
                            // var_dump($overall_totalss);
                                // array_push($get_data_html, $dept_htmls2);
                           
                            
                           // var_dump($dept_htmls2);

                               if (preg_match_all('/<td[^>]*>([\d.,]+)<\/td>/', $dept_htmls, $matches)) {
                                    $numbers = $matches[1]; // Get all matched numbers
                                    foreach ($numbers as $number) {
                                        $number = str_replace(',', '', $number); // Remove commas if present
                                        $number = floatval($number); // Convert to float
                                    }
                                        // var_dump($number); // Process the extracted number (you can also store them in an array, etc.)
                                }

                                $column_total[$a] =  $col_tot+ $number;

                                array_push($get_data_html, $number);

                            // var_dump($number);

                                $overall_total_dept+=$number;
                                $sum_overall_dept+=$dept_htmls2;
                        }
                                

                    
                            // $dept_htmls2=PHP_EOL, $dept_htmls2;
                            //$dept_htmls2 = isset($dept_htmls2) ? $dept_htmls2 . ',|| ' : ''; // Initialize if not defined
                          // $dept_htmls2 .= PHP_EOL;
                            // var_dump($dept_htmls2);
                            // echo $result;
                        
                       $html   .= '<tr>
                                       <td  style="position: sticky; left: 0; z-index: 3; background-color: white; width: 101px !important;">'  .$expense['code'].'
                                       </td><td  style="position: sticky; left: 139px; z-index: 3;background-color: white;">' .$expense['description'].'
                                       </td>
                                       '.$dept_html.'
                                       <td style="position: sticky; right: 0; z-index: 3;background-color: white;text-align:right;">'.number_format($overall_total_dept, 2).'</td>
                                   </tr>';
                                       // <td style="position: sticky; left: 346px; z-index: 3;background-color: white;">'.$allocation_type[0]['allocation_name'].'</td>
                        for ($b = 0; $b < count($get_data_html); $b++) {
                            // var_dump($get_data_html);
                            $get_final_data = $get_data_html[$b]; // Assign each element to $get_final_data

                            $exp_code = $expense['code'];
                            $exp_desc = $expense['description'];
                            $dcodes= $dcode_array[$b];
                            $dcodes_name= $this->Bookkeeper_Model->get_department_model_v2($dcodes);
                            // var_dump($dcodes_name[0]['dept_name'],$exp_code, $exp_desc, $get_final_data);

                            $validate_report_allo= $this->Bookkeeper_Model->validate_report_allo_model($_POST['year'],$_POST['month'],$dcodes,$exp_code,$exp_desc);
                            // var_dump(count($validate_report_allo));
                            if(empty($validate_report_allo) && count($validation_empty)<=0)
                            {
                                 $this->Bookkeeper_Model->insert_report_allo($_POST['year'],$_POST['month'],$dcodes,$dcodes_name[0]['dept_name'],$exp_code, $exp_desc, $get_final_data);
                            }
                        }

                       $excel_html   .= '<tr>
                                       <td  style="position: sticky; left: 0; z-index: 3; background-color: white;">'  .$expense['code'].'
                                       </td><td  style="position: sticky; left: 139px; z-index: 3;background-color: white;">' .$expense['description'].'
                                       </td>
                                       '.$dept_html.'
                                       <td style="position: sticky; right: 0; z-index: 3;background-color: white;">'.number_format($overall_total_dept, 2).'</td>
                                   </tr>';
                                       // <td style="position: sticky; left: 347px; z-index: 3;background-color: white;">'.$allocation_type[0]['allocation_name'].'</td>

                        $report_html   .= '<tr style="page-break-inside: avoid;">
                                       <td  style="position: sticky; left: 0; z-index: 3; background-color: white;">'  .$expense['code'].'
                                       </td><td  style="position: sticky; left: 94px; z-index: 3;background-color: white;">' .$expense['description'].'
                                       </td>
                                       '.$dept_html.'
                                       <td style="position: sticky; right: 0; z-index: 3;background-color: white;">'.number_format($overall_total_dept, 2).'</td>
                                   </tr>';
                                       // <td style="position: sticky; left: 188px; z-index: 3;background-color: white;">'.$allocation_type[0]['allocation_name'].'</td>
                                   // var_dump($dept_htmls2);
                        
                                $overall_totalss += $overall_total_dept;
                        }
                    }
                                //    var_dump($column_total);


                      $report_html.='</table>';
                    //   var_dump($column_total);
                      $excel_html.='
                       
                        <tfoot>
                                <tr>
                                        <th colspan="2"  background-color: white;">Total Amount</th>';
                            // var_dump(count($column_total));

                                        for($a=0; $a<count($column_total); $a++)
                                        {
                                            // var_dump($column_total);
                                            $excel_html.='<th style="white-space: nowrap;"><span style="margin-left: 77px;">'.number_format($column_total[$a], 2).'</span></th>';
                                        }
                                    $excel_html.='
                                      <th style=" text-align: right; position: sticky; right: 0; z-index: 3; background-color: white; right: 17px !important; width:100px !important;">'.number_format($overall_totalss, 2).'</th>
                                </tr>
                        </tfoot>
                      </table>';
                      // var_dump($column_total);
                      $html   .= '
                      <tfoot>
                        <tr>
                            <th colspan="2" style="position: sticky; left: 0; z-index: 3; background-color: white;">Total Amount</th>';
                           

                                for($a=0; $a<count($column_total); $a++)
                                {
                                    $html.='<th style="white-space: nowrap;"><span style="margin-left: 77px;">'.number_format($column_total[$a], 2).'</span></th>';
                                }
                        $html.='
                              <th style=" text-align: right; position: sticky; right: 0; z-index: 3; background-color: white; right: 17px !important; width:100px !important;">'.number_format($overall_totalss, 2).'</th>
                         </tr>
                    </tfoot>
                      </table></div>
                                     <script>
                        $(document).ready(function() {
                            var dataTable = $("#display_reports_id").DataTable({
                                "scrollX": true,
                                "paging": true,
                                "scrollY": "50vh",
                                dom: "lfrtip",
                                buttons: [
                                    "copy", "csv", "excel", "pdf", "print"
                                ]
                            });

                            // Check if there are rows in the DataTable
                            if (dataTable.rows().count() > 0) {
                                // Get headers
                                var headers = dataTable.columns().header().toArray().map(function(col) {
                                    return $(col).text().trim(); // Trim to remove any leading or trailing spaces
                                });

                                // Get data
                                var data = dataTable.data().toArray();

                                // Organize data by headers
                                var organizedData = [];

                                for (var i = 2; i < headers.length - 1; i++) {
                                    var columnData;

                                    if (i < 2) {
                                        // For the first two columns, use the original data
                                        columnData = data.map(function(row) {
                                            return row[i];
                                        });
                                    } else {
                                        // For other columns, use the concatenated data
                                        columnData = data.map(function(row) {
                                            return headers[i] + "|" + row[0] + "|" + row[1] + "|" + row[i];
                                        });
                                    }

                                    organizedData.push({
                                        data: columnData
                                    });
                                }

                                // Call the function to process data
                                console.log(organizedData);
                                //process_data(organizedData);

                                // You can add any other code that should run when there is data displayed.
                            }
                        });




                     // $(document).ready(function() {
               //          var table = $("#display_reports_id").DataTable();

               //          // Add a filter for the "Allo Type" column (index 1)
               //          table.columns(2).search("").draw();

               //          // Get unique values from the "Allo Type" column
               //          var alloTypeValues = table.column(2).data().unique().toArray();

               //          // Populate the combobox with unique values
               //          var alloTypeFilter = $("#alloTypeFilter");
               //          alloTypeFilter.empty(); // Clear existing options
               //          alloTypeFilter.append($("<option>", {
               //              value: "",
               //              text: "All Allocation Types"
               //          }));
               //          alloTypeValues.forEach(function(value) {
               //              alloTypeFilter.append($("<option>", {
               //                  value: value,
               //                  text: value
               //              }));
               //          });

               //          // Event handler for combobox change
               //          alloTypeFilter.on("change", function() {
               //              var selectedValue = $(this).val();
               //              table.columns(2).search(selectedValue).draw();
               //          });
               //      });


                                     ';
                       
                    if(!empty($_POST['year']) && !empty($_POST['month']))
                    {
                        $validate_expenses=$this->Bookkeeper_Model->valid_expense_model($_POST['year'],$_POST['month'],$bu_id);
                        $valid_expenses='empty';
                        if(!empty($validate_expenses))
                        {
                            $valid_expenses='not empty';
                        }
                        $data['valid_expenses']=$valid_expenses;
                    }
                        
                        $bu_id=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                        $get_bu_name= $this->Bookkeeper_Model->get_bu_name_model($bu_id);
                        $return_bu_id = $get_bu_name[0]['bu_name'];

              $data['checking_empty']=count($validation_empty);
              $data['month_select']=$month_select;
              $data['html']=$html;
              $data['report_html']=$report_html;
              $data['return_bu_id']=$return_bu_id;
              $data['excel_html']=$excel_html;
              $data['validation_empty']=implode(', ', $validation_empty);
              echo json_encode($data);
        }

        public function generate_report_ctrl()
        {
            $month=$_POST['month_id'];
            $year=$_POST['year_id'];
            $bu_id= $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $this->ppdf = new TCPDF();
            $this->ppdf->SetTitle("Store Allocation Report");
            $this->ppdf->SetPrintHeader(false);
            $this->ppdf->SetFont('', '', 10, '', true);
            $this->ppdf->SetMargins(7, 10, 7);
            $this->ppdf->AddPage("L", "LETTER");
            $this->ppdf->SetFooterMargin(7);
            $this->ppdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
           // Example content, adjust as needed
                @$tbl = $this->populate_table($month,$year,$bu_id);
            $this->ppdf->writeHTML($tbl, true, false, false, false, '');
            ob_end_clean();
            $this->ppdf->Output();
                  
        }

        public function populate_table($month_id,$year_id,$bu_id)
        {
            $get_name = $this->Bookkeeper_Model->get_report_name_model($month_id,$year_id,$bu_id);

            $get_code = $this->Bookkeeper_Model->get_report_code_model($month_id,$year_id,$bu_id);

            // $number_of_loops=count($get_name)/4;

            $tbl = '<table > ';
                    $tbl .= '
                    <tr style="text-align:left;">';
                    $bu_ids=$this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
                    $store_name=$this->Bookkeeper_Model->get_store_name($_SESSION['id']);
                    if($bu_ids == '0201')
                    {
                        $image_logo='<img src="' . base_url('assets/store_logo/alturas.png') . '" style="height: 60px; width: 90px;">';
                    }
                    else if($bu_ids == '0202')
                    {
                        $image_logo='<img src="' . base_url('assets/store_logo/talibon.png') . '" style="height: 60px; width: 90px;">';
                    }
                    else if($bu_ids == '0203')
                    {
                        $image_logo='<img src="' . base_url('assets/store_logo/icm.png') . '" style="height: 60px; width: 90px;">';
                    }
                    else if($bu_ids == '0223')
                    {
                        $image_logo='<img src="' . base_url('assets/store_logo/altacitta.png') . '" style="height: 60px; width: 90px;">';
                    }
                    else if($bu_ids == '0301')
                    {
                        $image_logo='<img src="' . base_url('assets/store_logo/marcela.png') . '" style="height: 75px; width: 75px;">';
                    }
                    $tbl .= '<th style="border: none;">'.$image_logo.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;font-weight:bold">STORE ALLOCATION REPORT</label></th>';

                    $tbl .= ' </tr>';

                    $tbl .= ' <tr>'; 
                            $tbl .= '<th style="border: none;"><label style="font-size:12px;">Store Name: '.$store_name.'</label></th>';
                    $tbl .= ' </tr>'; 

                    $tbl .= ' <tr>'; 
                                    $monthName = date('F', mktime(0, 0, 0, $_POST['month_id'], 10)); 
                            $tbl .= '<th style="border: none;"><label style="font-size:12px;">Date: '.$monthName.'&nbsp;&nbsp;'.$_POST['year_id'].'</label></th>';
                    $tbl .= ' </tr></table>'; 
            $col_count = 1; 
            // $num_loop_count =1;
            // $bu   = array();
            $bu   = '';

            foreach($get_name as $name)
            {
                 $isLastIteration = $name['dept_name'];
            }


            foreach($get_name as $name)
            {
                 // Check if it's the last iteration
                // var_dump($get_name);



                // $isLastIteration = end($name['dept_name']) === $name['dept_name'];

                // var_dump(end($get_name));

                 
                 if($col_count == 1)
                 {
                     $style='border:1px solid black;text-align:center;font-size:10px;height:25px; background-color:darkcyan;font-weight:bold;color:black;';
                 
                     $tbl .= '<div ><table cellpadding="5" cellspacing="0" >
                                <thead>
                                <tr>
                                    <th style="width:105px;'.$style.'">Account Code</th>
                                    <th style="width:170px;'.$style.'">Account Name</th>
                            ';
                 }

                 if($col_count >=1 && $col_count < 5) 
                 {
                    $tbl .= '<th style="width:120px;'.$style.'">'.$name['dept_name'].'</th>';
                 }

                  if($col_count == 4)
                  {
                     $col_count =1;
                     // $num_loop_count +=1;
                     $tbl .= '</tr></thead>';
                     
                     // @array_push($bu,$name['dept_name']); 
                     $bu .='_'.$name['dept_name'];  
                     
                     $tbl .= $this->populate_row($_POST['month_id'], $_POST['year_id'], $bu_ids,$get_code,$bu); 

                     $bu = '';
                     // $bu = array();
                     $tbl.='</table></div><br />';

                  }
                  else 
                  if ($isLastIteration == $name['dept_name'] && $col_count < 4)
                  {
                      $col_count = 1;
                      $tbl .= '</tr></thead>';
                      // @array_push($bu,$name['dept_name']); 
                      $bu .='_'.$name['dept_name'];
                      
                      $tbl .= $this->populate_row($_POST['month_id'], $_POST['year_id'], $bu_ids,$get_code,$bu); 
                    
                      $bu = '';
                      $bu = array();
                       $tbl.='</table></div>';
                        
                  }             
                  else 
                  {

                     // @array_push($bu,$name['dept_name']); 
                     $bu .='_'.$name['dept_name'];
                     $col_count+=1;
                  }             
                    

                    
            }


            return $tbl;
        }

        function populate_row($month_id,$year_id,$bu_id,$get_code,$bu_arr)
        {
             $bu = explode("_",$bu_arr);
             $tbl = '';

             $style='border:.2px solid black;';
             foreach($get_code as $code)
             {
                      $tbl .= '<tr style="page-break-inside: avoid;">
                                    <td style="width:105px;text-align:left;'.$style.'">&nbsp;'.$code['code'].'</td>
                                    <td style="width:170px;text-align:left;'.$style.'">&nbsp;'.$code['code_name'].'</td>
                              ';
                      for($a=1;$a<count($bu);$a++)
                      {
                            $get_dept_amount = $this->Bookkeeper_Model->get_report_amount_model($month_id,$year_id,$bu_id,$code['code_name']);
                                          foreach($get_dept_amount as $amount)
                                          {  
                                             if($bu[$a] == $amount['dept_name'])
                                             {
                                                 $tbl .= '<td style="width:120px; height:20px ;text-align:right; border:.2px solid black;">' .number_format($amount['amount'], 2). '</td>';
                                             }
                                          }
                      }
                      $tbl .= '</tr>';
             }

             return $tbl;       

        }

    






}
?>