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
        <input id="user_id" type="text" class="form-control"  value ="<?php echo $_SESSION['id'] ?>" style="display: none;">
        <div class="form-group mr-3">
            <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
                <select class="form-control mr-2" id="year_id" onchange="select_expense_agency_js()">
                      <?php 
                          $year =  date('Y');    
                          echo '<option selected value="" >Select</option>';
                          for($a=0; $a<3; $a++)
                          {
                           
                                echo '<option value="'.$year.'" >'.$year.'</option>';
                            
                                $year-=1;
                          }
                      ?> 
                <select>
        </div>

        <div class="form-group mr-3">      
            <label class="mr-2"><strong>Select Month&nbsp;</strong></label>
                <select class="form-control mr-2" id="month_id" onchange="select_expense_agency_js()"> 
                    <?php
                        echo '<option selected value="" >Select</option>';
                        for($a=1;$a<13;$a++)
                              {
                                   if(date('m')>=$a)
                                  {
                                     echo'<option value="'.$a.'">'.date('F',strtotime(date($year.'-'.$a.'-01'))).'</option>';
                                  }            
                              }
                    ?> 
                </select>
        </div>
    </div>
    <hr class="custom-hr">
    <div class="table-responsive" id="agency_expense_table">
    </div>
        <div  style="float:right;">
                   <button type="button" class="btn btn-primary" id="save_agency_button" onclick="save_agency_expense_js()" style="font-size:12px; cursor: pointer; float: right;">Save</button>
        </div>

        <div id="hidden_input">
        </div>

        <div id="agent_expense">
        </div>
</div>

<script type="text/javascript">
  // display_agency_expense_table_js();
  select_expense_agency_js();

</script>


