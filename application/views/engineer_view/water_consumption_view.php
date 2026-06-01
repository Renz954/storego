<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
</style>

<div>
    <div class="form-inline">
        <div class="form-group mr-3">
                <label class="mr-2"><strong> Water Company &nbsp;</strong></label>
                <input id="user_billing_id" type="text" class="form-control"  value ="<?php echo $user_id; ?>" style="display: none;">
                  <select class="form-control mr-2" id="comp_engr" onchange="select_date_water_js()">
                   <!-- <option value="0"></option>    -->
                      <?php
                           $year =  date('Y');
                           $get_engr_id= $this->Engineer_Model->get_engr_id_model($_SESSION['id']);
                           $get_eng_msfl=$this->Engineer_Model->get_company_msfl($get_engr_id,'water');
                          foreach($get_eng_msfl as $get_eng)
                          {
                            echo'<option value="'.$get_eng['engr_id'].'|'.$get_eng['type'].'" >'.$get_eng['company_name'].'</option>';
                          }
                      ?>
                </select>
        </div>

        <div class="form-group mr-3">
                 <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
                 <select class="form-control mr-2" id="year_id" onchange="select_date_water_js()">
                       <!-- <option></option> -->
                          <?php
                               if(!empty($years && $months))
                               {               
                                echo '<option selected value="'.$years.'" >'.$years.'</option>';
                               }
                                for($a=0; $a<3; $a++)
                                {
                                  if($year != $years)
                                  {
                                      echo '<option value="'.$year.'" >'.$year.'</option>';
                                  }
                                      $year-=1;
                                }
                          ?>
                </select>
        </div>

        <div class="form-group mr-3">
              <label class="mr-2"><strong>Select Month&nbsp;</strong></label>
              <select class="form-control mr-2" id="month_id" onchange="select_date_water_js()">
                 <!-- <option value="0"></option> -->
                     <?php
                     if(!empty($months))
                     {                        
                                     echo'<option selected value="'.$months.'">'.date('F',strtotime(date($years.'-'.$months.'-01'))).'</option>';
                     }
                        for($a=1;$a<13;$a++)
                              {
                                   if(date('m')>=$a)
                                  {
                                     echo'<option value="'.$a.'">'.date('F',strtotime(date($years.'-'.$a.'-01'))).'</option>';
                                  }            
                              }
                        ?>    
              </select>
        </div>
    </div>

    <hr class="custom-hr">

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
           <a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">Add Data</a>
           <a class="nav-item nav-link" id="water_list_table-tab" data-toggle="tab" href="#water_list_table" role="tab" aria-controls="water_list_table" aria-selected="false">Edit Record</a>
        </div>
    </nav>
     <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
            <div class="table" id="water_consumption_table"></div>
            <div class="store_engineer_button" style="float: right;">
               <button type="button" class="btn btn-primary" id="water_button_save"  onclick="save_water_billing_js()">Save</button>      
            </div>
        </div>
        <div class="tab-pane fade" id="water_list_table" role="tabpanel" aria-labelledby="water_list_table-tab">
           
        </div>
     </div>
            <div id="hidden_input"></div>

            <div id="hidden_input_admin"></div>
</div>

<script type="text/javascript">
  select_date_water_js();
</script>

<div class="modal fade" id="edit_water_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span> &nbsp; Edit Water Bill's</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="number" id="wat_id_edit" style="display:none;">
                            <input type="number" id="wat_admin" style="display:none;">
                            <input type="number" id="old_meter_water" style="display:none;">
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <h3 class="modal-title" id="edit_dept"></h3>
                        </div>
                        <hr class="custom-hr">
                        <div class="form-group">
                            <label id="edit_date_wat" style="font-size:20px;"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label id="edit_wat_com" style="font-size:20px;"></label>
                        </div>
                        <div class="form-group">
                            <label style="font-size:20px;"><strong>Amount</strong></label>&nbsp;&nbsp;
                            <input style="font-size:20px; text-align: right;"type="text" id="edit_wat_bill" oninput="calc_consumption_js(this)" >
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="badiha" onclick="update_water_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
