<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
    /*.table-container {
    overflow: auto; 
    max-height: 500px;
  }*/

  .bg-info {
    background-color:darkcyan !important;
}
  
.dataTables_empty
{
    text-align: center !important;
}

/* Add this CSS to your stylesheet */

</style>
<div>
  <div class="form-inline" >
    <div class="form-group mr-3">
       <label class="mr-2"><strong>Select Year</strong></label>
        <select name="desig" id="year_id" class="form-control mr-2" onchange="select_date_reports_js()">
          <option value="" readonly>Select</option>
            <?php 
                  $year =  date('Y'); 
                  for($a=0; $a<3; $a++)
                  {
                    {
                      echo '<option value="'.$year.'" >'.$year.'</option>';
                    }
                      $year-=1;
                  }
            ?>
        </select>
    </div>

    <div class="form-group mr-3">
        <input id="les_rec_id" type="text" class="form-control"  value ="" style="display: none;">
          <label class="mr-2"><strong>Select Month&nbsp;</strong></label>
            <select name="desig" id="month_id" class="form-control mr-2" onchange="select_date_reports_js()">
              <option value="" readonly>Select</option>
                <?php
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

                    <span hidden id="hidden_html_report"></span>
                    <button type="button" class="btn btn-primary" id="disabled_report_id" onclick="generate_report_js()" ><i class="fa fa-download"></i>&nbsp;Generate Report</button>
                    <span hidden id="hidden_excel_report"></span>
                    <span hidden id="return_bu_id"></span>
                    <button type="button" class="btn btn-primary" id="disabled_excel_id" style="margin-left: 10px; background-color: darkgreen;" onclick="excel_report_js()" ><i class="fa fa-download"></i>&nbsp;Excel Report</button>
  </div>
  <hr class="custom-hr">

    <div class="table-responsive" id="table_report_allocation">
    </div>

</div>

<script type="text/javascript">
  display_report_allocation_js();
</script>
