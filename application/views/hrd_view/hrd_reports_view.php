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
                    <label class="mr-2"><strong> YEAR&nbsp;</strong></label>
                      <select class="form-control mr-2" id="year_id" onchange="select_year_js()" >
                        <?php
                          $year =  date('Y');
                          for($a=0; $a<3; $a++)
                          {                 
                                echo'<option value="'.$year.'" >'.$year.'</option>';
                                $year-=1;
                          }
                         ?> 
                      </select>
                </div>
            </div>
            <hr class="custom-hr">
             <div class="table-responsive" id="hrd_reports_table">
      
            </div>


   <script type="text/javascript">
  // display_table_reports_js();
    select_year_js();

</script>