<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
</style>
<div class="form-inline">
              <div class="form-group mr-3">
                  <label class="mr-2"><strong>Select Year</strong></label>
                      <select name="desig" id="year_id" class="form-control mr-2" onchange="select_monitor_expense_js()">
                        <?php 
                            $year=date("Y");
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
                 <label class="mr-2"><strong>Select Month</strong></label>
                     <select name="desig" id="month_id" class="form-control mr-2" onchange="select_monitor_expense_js()">
                         <option selected value="0" readonly>All Months</option>
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
     <span hidden id="select_all"></span>
     <div class="table-responsive" id="table_monitor_expense">

    </div>

<script type="text/javascript">
  select_monitor_expense_js();
</script>