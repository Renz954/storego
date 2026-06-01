<style>
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }
    input[type="checkbox"] {
 
      width: 18px;
      height: 18px;
      border: 2px solid #ccc;
    }

    .table-container {
        overflow: auto;
        max-height: 400px; /* Add a max height for the scrollable container */
    }

    #display_id_v2 th {
        position: sticky;
        top: 0;
        background-color:#17a2b8 !important;
        z-index: 1; /* Ensure the headers are on top of the table content */
    }
</style>
<div class="form-inline">
            <div class="form-group mr-3">
       <label class="mr-2"><strong>Select Year</strong></label>
      <select name="desig" id="year_id" class="form-control mr-2" onchange="select_nav_data_js()">
      <option value="" readonly>Select</option>
      
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
            <input id="les_rec_id" type="text" class="form-control"  value ="" style="display: none;">
       <label class="mr-2"><strong>Select Month</strong></label>
       <select name="desig" id="month_id" class="form-control mr-2" onchange="select_nav_data_js()">
        <option value="" readonly>Select</option>
      
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
                <label class="mr-2"><strong>Select Store</strong></label> 
                <select name="store_id" id="store_id" class="form-control mr-2" onchange="select_nav_data_js()"> 
                    <option value="" readonly>Select</option>
                    <?php
                    $bu_id = $this->Supervisor_Model->getBU_Handle($_SESSION['id']);
                    $get_store_name = $this->Supervisor_Model->get_bu_id_model($bu_id);
                    if (!empty($bu_ids)) {               
                        $get_name = $this->Supervisor_Model->get_bu_id_model_v2($bu_ids);
                        echo '<option selected value="'.$bu_ids.'">'.$get_name[0]['bu_name'].'</option>';
                    }
                    foreach($get_store_name as $name) {
                        if($bu_ids!= $name['bcode'])
                        {                
                             echo '<option value="'.$name['bcode'].'">'.$name['bu_name'].'</option>';
                        }
                    }
                    ?>
                </select>
             </div>

        <div class="form-group mr-3">
       <label class="mr-2"><strong>Status</strong></label>
       <select  id="status_id" class="form-control mr-2" onchange="select_nav_data_js()" >
                       <?php 
                       
                       if($pendings == 'Pending')
                       { 
                           echo'<option value="">All Status</option>';  
                           echo'<option value="Approved">Approved</option>'; 
                           echo'<option selected value="Pending">Pending</option>';
                           echo'<option value="Disapproved">Disapproved</option>';
                       }
                       else
                       {
                           echo'<option value="">All Status</option>';  
                           echo'<option value="Approved">Approved</option>'; 
                           echo'<option value="Pending">Pending</option>';
                           echo'<option value="Disapproved">Disapproved</option>';
                       }

                    ?>
                       </select> 
        </div>
      </div>

      <span hidden id="select_all"></span>
            <div class="table-responsive" id="table_accounting_store_data" >
            </div>
        <script type="text/javascript">
  select_nav_data_js();
</script>