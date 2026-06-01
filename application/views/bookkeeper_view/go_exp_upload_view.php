<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
    .table-container {
        overflow: auto;
        max-height: 400px; /* Add a max height for the scrollable container */
    }

    #display_expense_year_month th {
        position: sticky;
        top: 0;
        background-color:#17a2b8 !important;
        z-index: 1; /* Ensure the headers are on top of the table content */
    }
</style>
<div>
<div class="form-inline">
        <div class="form-group mr-3">
       <label for="year_id" class="mr-2"><strong>Select Year</strong></label>
      <select name="desig" id="year_id" class="form-control mr-2" onchange="selects_month_year_expense_js()">
      <option value="" readonly selected>Select</option>
      
        <?php 
            $year =  date('Y');
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
            <input id="les_rec_id" type="text" class="form-control mr-2"  value ="" style="display: none;">
       <label for="month_id" class="mr-2"><strong>Select Month</strong></label>
       <select name="desig" id="month_id" class="form-control mr-2" onchange="selects_month_year_expense_js()">
        <option value="" readonly selected>Select</option>
      
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

        <div class="form-group mr-3">
       <label for="month_id" class="mr-2"><strong>Select Allo Type</strong></label>
       <select name="allo type" id="select_allo_type" class="form-control mr-2">
      </select>
        </div>

     <div class="form-group mr-3">
       <label for="status_expense_id" class="mr-2"><strong>Status</strong></label>
       <select  id="status_expense_id" class="form-control mr-2" onchange="selects_month_year_expense_js()" >
                       <?php 
                       
                       if($pendings == 'Pending')
                       { 
                           echo'<option value="">All Status</option>';  
                           echo'<option value="Approved">Approved</option>'; 
                           echo'<option selected value="Pending">Pending</option>';
                           echo'<option value="Dissapproved">Disapproved</option>';
                       }
                       else
                       {
                           echo'<option value="">All Status</option>';  
                           echo'<option value="Approved">Approved</option>'; 
                           echo'<option value="Pending">Pending</option>';
                           echo'<option value="Dissapproved">Disapproved</option>';
                       }

                    ?>
                       </select> 
            </div>
        </div>

        <div id="hide_expense_button">
            <div class="form-inline mt-3">
               <div class="form-group mr-3">
                   <label class="mr-2"><strong>Select File </strong></label>        
                         <input type="file" name="files[]" multiple="multiple" class="form-control mr-2" id="upload_expense_file" required>
              </div>
                    <button type="button" class="btn btn-primary mr-2" onclick="validate_store_expense_js()" style="font-size: 14px; background-color:darkcyan;"><i class="fa fa-upload"></i>Upload File</button>
             
            </div>
        </div>

        <hr class="custom-hr">

        <div class="table-responsive" id="table_store_expense">
        </div>
</div>
<script type="text/javascript">
  selects_month_year_expense_js();
</script>

<div class="modal fade" id="edit_store_expense_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span> &nbsp; Edit Store GO Expense</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <form>
                         <input type="number" id="expense_id" style="display:none;">
                        
                        <div class="form-group ">
                            <label id="code_id" class="col-sm-12 col-form-label ehh" style="font-size: 23px;"></label>
                            <label id="expense_name" class="col-sm-12 col-form-label ehh" style="font-size: 20px;"></label>
                            <hr class="custom-hr">
                        </div>
                        <div class="form-group row" style="margin-bottom: -2px;">
                            <label for="inputEmail3" class="col-sm-4 col-form-label" style="font-weight: bold; font-size: 15px;">Amount</label>
                            <div class="col-sm-8">
                              <input type="text" oninput="cal_nav_v2(this)"  class="form-control" id="amount_id" style="text-align: right;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="manager_key_expense_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="managers_key_expense_modal">
    <div class="modal-dialog modal-dialog-top modal-sm"> 
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-key"></span> &nbsp;Manager's Key</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="form-body">
                           <div class="row">
                                  <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" ><i class="fa fa-user" style="color: darkgreen; font-size: 28px;"></i></span>
                                    </div>
                                    <input type="text" name="username" class="form-control" id="users" placeholder="Username" autocomplete="off">
                                  </div>

                                  <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" ><i class="fa fa-key" style="color: darkgreen; font-size: 24px;"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" id="pass" placeholder="Password" autocomplete="off">
                                  </div>
                           </div>
                        </div>
                </div>
            </div>

                <div class="modal-footer" style="margin-bottom: -10px; margin-top: -8px;">
                     <button type="button" class="btn btn-primary" id="badiha" onclick="verify_password_expense_js()" style="font-size:14px; cursor: pointer;">ENTER</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal" style="font-size: 14px;cursor: pointer;"> CANCEL</button>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
            var input = document.getElementById("pass");
            input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("badiha").click();
            }
          });

</script>