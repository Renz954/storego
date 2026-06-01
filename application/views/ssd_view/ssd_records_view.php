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
        <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
        <input id="user_id_ssd" type="text" class="form-control"  value ="<?php echo $_SESSION['id']; ?>" style="display: none;" >
        <select class="form-control mr-2" id="year_list" onchange="ssd_select_date()">
            <?php $year =  date('Y'); ?>
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
        <select class="form-control mr-2" id="month_list" onchange="ssd_select_date()"> 
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

    <div class="form-group mr-3">  
        <label class="mr-2"><strong> Select Week &nbsp;</strong></label>
        <select class="form-control mr-2" id="week_list" onchange="ssd_select_date()">   
            <?php 
                if(!empty($week_ids))
                {
                    echo '<option selected value="'.$week_ids.'" >Week '.$week_ids.'</option>';
                }
                for($a=1; $a<5; $a++)
                {
                    $weekss=$a;
                    if($week_ids!= $weekss)
                    {
                        echo '<option value="'.$weekss.'" >Week '.$weekss.'</option>';
                    }
                    $weekss+=1;
                }
            ?>
        </select>  
    </div>
</div>
<hr class="custom-hr">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
           <a class="nav-item nav-link active" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="true">Add Data</a>
           <a class="nav-item nav-link" id="ssd_employee_list_table-tab" data-toggle="tab" href="#ssd_employee_list_table" role="tab" aria-controls="ssd_employee_list_table" aria-selected="false">Edit Record</a>
        </div>
    </nav>
     <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">
            <div class="table-responsive " id="ssd_employee_table"></div>
            <div style="float: right;">
                <button type="button" class="btn btn-primary" id="save_guard_button" onclick="save_guard_js()" >Save</button>
            </div>
        </div>
        <div class="tab-pane fade" id="ssd_employee_list_table" role="tabpanel" aria-labelledby="ssd_employee_list_table-tab">
           
        </div>
     </div>
</div>


<div id="edit_guard_amount_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #095a5a;">
                <h3 class="modal-title text-white"><span class="fa fa-edit"></span>&nbsp;Edit SSD Employee's</h3>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <input type="number" id="ssd_id_edit" style="display:none;">
                    <form>
                        <div class="form-group form-inline">
                            <h3 class="modal-title" id="edit_dept"></h3>
                        </div>
                        <hr>
                        <div class="form-group form-inline">
                            <label id="edit_month" style="font-size: 22px;"></label>&nbsp;
                            <label id="edit_year" style="font-size: 22px;"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label id="edit_week" style="font-size: 22px;"></label>
                        </div>
                        <div class="form-group form-inline">
                            <label style="font-size: 18px;"><strong>Guards&nbsp;</strong></label>
                            <input type="number" style="font-size: 14px; text-align:right;"class="form-control" id="edit_guard" min="1" max="50" step="1" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <label style="font-size: 18px;"><strong>Reliever&nbsp;</strong></label>
                            <input type="number" style="font-size: 14px; text-align:right;"class="form-control" id="edit_reliever" min="1" max="50" step="1" oninput="this.value = Math.floor(Math.min(50, Math.abs(this.value)))">
                        </div>
                        <div class="form-group form-inline">
                            
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="badiha" onclick="update_ssd_employee_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    ssd_select_date();
  function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
// ssd_select_date();
</script>
