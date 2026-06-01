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
        <input id="user_id" type="text" value ="<?php echo $_SESSION['id']; ?>" style="display: none;">
        <div class="form-group mr-3">
            <label class="mr-2"><strong> Agency &nbsp;</strong></label>
                <select class="form-control mr-2" id="agency_sel" onchange="select_date_agency_js()">
                   <option value=""></option>
                <?php 
                         $year =  date('Y');   
                   if($agent_ids == 'Cydem')
                   { 
                       echo'<option selected value="Cydem">Cydem</option>';  
                       echo'<option value="Entech">Entech</option>'; 
                       echo'<option value="Nemplex">Nemplex</option>';
                   }
                   else if($agent_ids == 'Entech')
                   {
                       echo'<option value="Cydem">Cydem</option>';  
                       echo'<option selected value="Entech">Entech</option>'; 
                       echo'<option value="Nemplex">Nemplex</option>';
                   } 
                   else if($agent_ids == 'Nemplex')
                   {
                       echo'<option value="Cydem">Cydem</option>';  
                       echo'<option value="Entech">Entech</option>'; 
                       echo'<option selected value="Nemplex">Nemplex</option>';
                   }
                   else
                   {
                       echo'<option value="Cydem">Cydem</option>';  
                       echo'<option value="Entech">Entech</option>'; 
                       echo'<option value="Nemplex">Nemplex</option>';
                   }

                ?>
                </select>  
            </div>

            <div class="form-group mr-3">
                <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
                  <select class="form-control mr-2" id="year_id" onchange="select_date_agency_js()">
                    <!-- <option value=""></option> -->
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
                  
                  <select>
            </div>
               
            <div class="form-group mr-3">
                <label class="mr-2"><strong>Select Month&nbsp;</strong></label>
                    <select name="employee_name" class="form-control mr-2" id="month_id" onchange="select_date_agency_js()"> 
                     <!-- <option value=""></option> -->
                    <?php
                         echo'<option selected value="'.$months.'">'.date('F',strtotime(date($years.'-'.$months.'-01'))).'</option>';
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
           <a class="nav-item nav-link active" id="agency_add_tab" data-toggle="tab" href="#agency_add" role="tab" aria-controls="agency_add" aria-selected="true">Add Data</a>
           <a class="nav-item nav-link" id="agency_record_list_table_tab" data-toggle="tab" href="#agency_record_list_table" role="tab" aria-controls="agency_record_list_table" aria-selected="false">Edit Record</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="agency_add" role="tabpanel" aria-labelledby="agency_add_tab">
                <div class="table" id="agency_record_table"></div>
                <div style="float: right;">
                    <button type="button" class="btn btn-primary" id="save_agency_button" onclick="save_agency_js()" style="cursor: pointer; ">Save</button>
                </div>
                 
        </div>
               
        
            <div class="tab-pane fade" id="agency_record_list_table" role="tabpanel" aria-labelledby="agency_record_list_table_tab">

            </div>
    </div>
    <div id="hidden_input">
    </div>
</div>


<script type="text/javascript">
  select_date_agency_js();
</script>

<div class="modal fade" id="edit_agency_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span> &nbsp; Edit Agency Employee's</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                        <input type="number" id="agency_id_edit" style="display:none;">

                    <form>
                        <div class="form-group">
                            <h3 class="modal-title" id="edit_dept"></h3>
                        </div>
                        <hr class="custom-hr">
                        <div class="form-group">
                            <label id="edit_month" style="font-size:20px;"></label>&nbsp;
                            <label id="edit_year" style="font-size:20px;"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label id="edit_type" style="font-size:20px;"></label>
                        </div>
                        <div class="form-group">
                            <label ><strong>Beginning&nbsp;&nbsp;</strong></label>
                            <input  type="number" id="edit_beg" min="1" max="50" step="1"  style="text-align: right;" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label ><strong>End&nbsp;&nbsp;</strong></label>
                                <input  type="number" id="edit_end" min="1" max="50" step="1"  style="text-align: right;" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))" >
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="badiha" onclick="update_agency_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>