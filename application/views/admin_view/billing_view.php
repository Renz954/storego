<div id="table_style">
        <div class="form-body"> 
            <div class="table-responsive" id="unit_cost_setup">
            </div>
        </div>
    </div>
<script type="text/javascript">
     display_table_unit_cost();
</script>

<div class="modal fade" id="add_default_amount_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-cart-plus"></span>&nbsp;Add Billing Company</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form>
                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><strong>Company Name</strong></label>
                             <div class="col-sm-8">
                                 <input class="form-control" type="text" id="company_id">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label"><strong>Type</strong></label>
                             <div class="col-sm-8">
                                <select class="form-control" name="type" id="type_id">
                                  <option></option>
                                  <option>Water</option>
                                  <option>Electric</option>
                                </select>
                             </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><strong>Unit Cost</strong></label>
                               <div class="col-sm-8">
                                  <input class="form-control" style="text-align: right;" type="text" oninput="cacl_reading(this)" id="unit_id" >
                               </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" style="margin-bottom: -8px;">
                <button type="button" class="btn btn-primary" onclick="val_bill_amount_js()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_billingc_company_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span>&nbsp;Edit Billing Company</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                        <input type="number" id="engr_id_edit" style="display:none;">
                    <form>
                        <div class="form-group row">
                             <label class="col-sm-4 col-form-label"><strong>Company Name</strong></label>
                               <div class="col-sm-8">
                                  <input class="form-control" type="text" id="edit_company_id">
                              </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><strong>Type</strong></label>
                                 <div class="col-sm-8">
                                    <select class="form-control" name="type" id="edit_type_id">
                                      <option></option>
                                      <option>Water</option>
                                      <option>Electric</option>
                                    </select>
                                 </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"><strong>Unit Cost</strong></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" style="text-align:right;" oninput="cacl_reading(this)" id="edit_unit_id">
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" style="margin-bottom: -8px;">
                <button type="button" class="btn btn-primary" onclick="update_bill_cost_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>