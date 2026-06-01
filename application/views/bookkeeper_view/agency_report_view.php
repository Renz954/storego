<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
</style>
<div class="form-inline" >
  <div class="form-group mr-3">
      <label class="mr-2"><strong> Agency &nbsp;</strong></label>
        <select class="form-control mr-2" id="agency_list_sel" onchange="agency_month_year_js()">
         <option value=""></option>   
         <option value="Cydem">Cydem</option>   
         <option value="Entech">Entech</option>   
         <option value="Nemplex">Nemplex</option>
         </select>
  </div>  

  <div class="form-group mr-3">
      <label class="mr-2"><strong> Select Year&nbsp;</strong></label>
        <select class="form-control mr-2" id="year_id" onchange="agency_month_year_js()">
          <!-- <option value=""></option> -->
             <?php
             $year =  date('Y');
              for($a=0; $a<3; $a++)
              {                 
                     echo'<option value="'.$year.'" >'.$year.'</option>';
                    $year-=1;
              }
              ?>
        <select>
  </div>

  <div class="form-group mr-3">
      <label class="mr-2"><strong>Select Month&nbsp;</strong></label>
        <select class="form-control mr-2" name="employee_name" id="month_id" onchange="agency_month_year_js()"> 
          <!-- <option value=""></option> -->
           <?php
            for($a=1;$a<13;$a++)
            {

                if(date('m')>$a)
                {                                  

                          echo' <option value="'.$a.'">'.date('F',strtotime(date($year."-".$a.'-01'))).'</option>';
                }            
            }  
            ?>  
        </select>
  </div>
</div>

<hr class="custom-hr">

  <div class="table-responsive" id="agency_reports_table">
  </div>

<script type="text/javascript">
  agency_month_year_js();
</script>