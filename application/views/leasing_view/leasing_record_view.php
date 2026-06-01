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
            <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
            <input id="user_id_ssd" type="text" class="form-control"  value ="<?php echo $user_id_ssd; ?>" style="display: none;" >
              <select class="form-control mr-2" id="year" onchange="select_date_area_js()" >
                <option value="0"></option>
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
                    <select class="form-control mr-2" id="month" onchange="select_date_area_js()" > 
                         <option value="0"></option>
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
            <div class="table-responsive" id="floor_area_table">

            </div>
             <div style="margin-bottom: 12px; float:right;">
                 <button type="button" class="btn btn-primary" id="save_guard_button" onclick="save_floor_js()" >Save</button>
             </div> 
        </div>

        <div id="hidden_input">  
        </div>

</main>

<script type="text/javascript">
    // display_floor_area_table_js();
    select_date_area_js();      
</script>