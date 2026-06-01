
 <style>

h2 {
    font-size: 18px;
    font-weight: 400;
}

.dashboard-tile:hover .tile-link {
    display: block;
}
.tile-link {
    position: absolute;
    display: none;
    z-index: 100;
}
#loading, .tile-link, .tile-link .tile-link-overlay {
    top: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
}
.tile-link .tile-link-overlay {
    position: absolute;
    background-color: #666;
    opacity: 0.5;
    filter: alpha(opacity=50);
    z-index: 10;
}
#loading, .tile-link, .tile-link .tile-link-overlay {
    top: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
}
.tile-link .tile-link-content {
    position: relative;
    width: 50%;
    margin: 0 auto;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
}


.dashboard-tile:hover .tile-link {
    display: block;
}

 .card {
    background-color: #fff; /* Set a background color */
    border-radius: 10px; /* Rounded corners */
    padding: 20px;
    margin: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }

    .card-title {
        color: #333; /* Title text color */
    }

    .card h6 {
        color: white; /* Subtitle text color */
    }

    .card-icon {
        color: #777; /* Icon color */
    }
    .bg-success {
        background-color: darkslategrey !important;
        padding-top: 1px;
        padding-bottom: 1px;
        border-radius: 4px;
        margin-left: 4px;
        margin-right: 4px;
        margin-top: -13px;
        margin-bottom: 4px;
    }
    .text-muted {
        color: white !important;
    }

   

    .card {
        position: relative;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .card-icon {
        position: absolute;
        top: -5px;
        right: 6px;
        color: white;
    }

    .card-title {
        margin-bottom: 15px;
    }

    h1 {
        font-size: 30px;
        color:white;
    }

     .card-products-sold {
         background: linear-gradient(45deg, #00bcd4, #0097a7);
         transition: background-color 0.3s ease;
    }

   
    .card-products-sold:hover {
   background: linear-gradient(45deg, #0097a7, #00bcd4); /* Change the gradient colors on hover */
    cursor: pointer;
    }
   

    .badge-custom {
        background-color: red;
        color: white;
        padding: 4px 7px;
        border-radius: 12px;
        font-size: 12px;
    }

    /* CSS for custom hr */
    .custom-hr {
        margin-top: 5px; /* Adjust margin top */
        border-width: 2px;
        background-color: darkcyan;
        margin-bottom: 9px;
    }

    #nav-tab {
        background-color: lightcyan;
        padding-top: 15px;
        margin-top: -32px;
        margin-left: -25px;
        margin-right: -25px;

    }

    .nav-link{
        font-size: 16px; 
        font-weight: 600;
        margin-top: -15px; 
        padding-top: 16px;
    }


</style>
            <div class="form-group">
        <?php
            $bu_id = $this->Bookkeeper_Model->getBU_Handle($_SESSION['id']);
            $get_store_name=$this->Bookkeeper_Model->get_bu_id_model($bu_id);
            if(count($get_store_name) > 1)
            {
                echo'<select class="form-control" name="bu_id" id="bu_ids" style="text-align:center;" onchange="book_home_js()">';
                
                    foreach($get_store_name as $name)
                    {
                        echo'<option value="'.$name['bcode'].'" >'.$name['bu_name'].'</option>';
                    }

                echo'</select>
                <div> <hr class="custom-hr"></div>';
            }
            else
            {
                 echo'<select class="form-control" hidden name="bu_id" id="bu_ids" style="text-align:center;" onchange="book_home_js()">';
                
                    foreach($get_store_name as $name)
                    {
                        echo'<option value="'.$name['bcode'].'" >'.$name['bu_name'].'</option>';
                    }

                echo'</select>';
                
            }
            
        ?>
</div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
           <a class="nav-item nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">⌛ Navision Pending Requests&nbsp;<div class="badge progress-bar-warning badge-custom" id="badge_id"></div></a>
           <a class="nav-item nav-link" id="nav_lacking-tab" data-toggle="tab" href="#nav_lacking" role="tab" aria-controls="nav_lacking" aria-selected="false">🚫 Navision Lacking Data&nbsp;<div class="badge progress-bar-warning badge-custom" id="lack_badge_id"></div></a>
           <a class="nav-item nav-link" id="expense-pending-tab" data-toggle="tab" href="#expense-pending" role="tab" aria-controls="expense-pending" aria-selected="false">⌛  Expense Pending Requests&nbsp;<div class="badge progress-bar-warning badge-custom" id="expense_badge_id"></div></a>
           <a class="nav-item nav-link" id="expense_lacking-tab" data-toggle="tab" href="#expense_lacking" role="tab" aria-controls="expense_lacking" aria-selected="false">🚫 Expense Lacking Data&nbsp;<div class="badge progress-bar-warning badge-custom" id="lack_badge_exp"></div></a>
        </div>
    </nav>
     <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
            
        </div>
        <div class="tab-pane fade" id="nav_lacking" role="tabpanel" aria-labelledby="nav_lacking-tab">
           
        </div>

        <div class="tab-pane fade" id="expense-pending" role="tabpanel" aria-labelledby="expense-pending-tab">
           
        </div>

        <div class="tab-pane fade" id="expense_lacking" role="tabpanel" aria-labelledby="expense_lacking-tab">
           
        </div>
     </div>
            

<script type="text/javascript">
  book_home_js();
</script>