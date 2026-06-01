<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
</style> 
<?php 
      $year =  date('Y');
?>
            <div class="form-inline">
                <div class="form-group mr-3">
                    <input value="" id="bu_id" hidden>
                   <label class="mr-2"><strong>MONTH&nbsp;</strong></label>
                      <select class="form-control mr-2" name="employee_name" id="month_id" onchange="select_month_year_js_v2()">
                            <?php
                                if(!empty($years && $months))
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
                    <label class="mr-2"><strong> YEAR&nbsp;</strong></label>
                      <select class="form-control mr-2" id="year_id" onchange="select_month_year_js_v2()">
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
               </div>
               <hr class="custom-hr">
             <div class="table-responsive"  id="hrd_employees_table">
    
             </div>
<script type="text/javascript">
  display_table_employees();
  // select_month_year_js_v2();
 

</script>