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
                  <select name="desig" id="year_ids" class="form-control mr-2" onchange="select_go_expense_js()">
                      <!-- <option value="" readonly>Select</option> -->
                      
                        <?php 
                        $year=date("Y");
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
                     <label class="mr-2"><strong>Select Month </strong></label>
                        <select name="desig" id="month_ids" class="form-control mr-2" onchange="select_go_expense_js()">
                             <!-- <option value="" readonly>Select</option> -->
              
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

               <div class="form-group mr-3">
                    <label class="mr-2"><strong>Select Store</strong></label> 
                        <select name="store_ids" id="store_ids" class="form-control mr-2" onchange="select_go_expense_js()"> 
                            <!-- <option value="" readonly>Select</option> -->
                                <?php
                                    // $get_store_name = $this->Finance_Model->setup_store_model($this->session->userdata('id'));
                                    $get_all_bu = $this->Finance_Model->get_all_bu_model();
                                    foreach($get_all_bu as $bu)
                                     {           
                                            // $get_name = $this->Finance_Model->get_bu_id_model_v2($name['bu_handle']);
                                             echo '<option value="'.$bu['bcode'].'">'.$bu['bu_name'].'</option>';
                                    }
                                ?>
                        </select>
                </div>
    </div>

            <hr class="custom-hr">
            <span hidden id="select_all"></span>
            <div class="table-responsive" id="table_fin_exp_data">
            </div>
<script type="text/javascript">
    select_go_expense_js();
</script>