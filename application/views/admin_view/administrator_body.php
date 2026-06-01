 <style>
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
        background: linear-gradient(45deg, #3498db, #8e44ad);
        transition: background-color 0.3s ease;
    }

    .card-net-profit {
       background: linear-gradient(45deg, #e67e22, #d35400);
       transition: background-color 0.3s ease;
    }

    .card-new-customers {
       background: linear-gradient(45deg, #00bcd4, #0097a7);
       transition: background-color 0.3s ease;
    }

    .card-customer-satisfaction {
        background: linear-gradient(45deg, #f1c40f, #f39c12);
        transition: background-color 0.3s ease;
    }
    .card-products-sold:hover {
    background: linear-gradient(45deg, #8e44ad,#3498db); /* Change the gradient colors on hover */
    cursor: pointer;
    }
    .card-net-profit:hover {
    background: linear-gradient(45deg, #d35400, #e67e22); /* Change the gradient colors on hover */
    cursor: pointer;
    }
    .card-new-customers:hover {
    background: linear-gradient(45deg, #0097a7, #00bcd4); /* Change the gradient colors on hover */
    cursor: pointer;
    }
    .card-customer-satisfaction:hover {
    background: linear-gradient(45deg, #f39c12, #f1c40f); /* Change the gradient colors on hover */
    cursor: pointer;
    }

</style>

<?php 
      // $this->load->view('Administrator_View/templates/admin_footer');
?>

                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-products-sold" id="users_hover" onclick="admin_user_js()" style="width: auto;text-align: left; height: 120px;">
                                        <h6 class="card-title">Store Users<span class="float-right card-icon" style="font-size: 24px;">👤</span></h6>
                                        <hr style="margin-top: -5px; border-width: 2px; background-color: darkcyan; margin-bottom: 9px;">
                                        <div>
                                            <h1 id="count_user"></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-net-profit" onclick="load_finance_incharge()" style="width: auto;text-align: left; height: 120px;">
                                        <h6 class="card-title">Finance In Charge<span class="float-right card-icon" style="font-size: 24px;">👤</span></h6>
                                        <hr style="margin-top: -5px; border-width: 2px; background-color: orange; margin-bottom: 9px;">
                                        <div>
                                            <h1 id="count_finance"></h1>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-new-customers" onclick="billing_js()" style="width: auto;text-align: left; height: 120px;">
                                        <h6 class="card-title">Billing Unit Cost <span class="float-right card-icon" style="font-size: 24px;">🛒</span></h6>
                                        <hr style="margin-top: -5px; border-width: 2px; background-color: darkcyan; margin-bottom: 9px;">
                                        <div>
                                            <h1 id="count_billing"></h1>
                                        </div>  
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-customer-satisfaction" onclick="meter_js()" style="width: auto;text-align: left; height: 120px;">
                                        <h6 class="card-title">Old Meter Data<span class="float-right card-icon" style="font-size: 24px;">🛒</span></h6>
                                        <hr style="margin-top: -5px; border-width: 2px; background-color: yellow; margin-bottom: 9px;">
                                        <div>
                                            <h1 id="count_meter"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                          
                            
<script>
    admin_count_home_js();
</script>