<style>
.table-container {
    overflow: auto;
    max-height: 400px; /* Add a max height for the scrollable container */
}

#display_account th {
    position: sticky;
    top: 0;
    background-color:#17a2b8 !important;
    z-index: 1; /* Ensure the headers are on top of the table content */
}
</style>

<div class="table-responsive" id="account_code_table">

</div>
<script type="text/javascript">
    display_bookkeeper_table_js();
</script>

<div class="modal fade" id="add_account_code_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-cart-plus"></span>&nbsp;Add New Account Code</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <form>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label"><strong>Account Code</strong></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="code">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label"><strong>Account Name</strong></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="expense">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-4 col-form-label"><strong>Allocation Type</strong></label>
                        <div class="col-sm-8">
                          <select name="type" class="form-control" id="type">
                      </select>
                        </div>
                      </div>
                     
                    </form>
                </div>
            </div>
              <div class="modal-footer" style="margin-bottom: -10px; margin-top: -8px; padding-top: 10px;">
                <button type="button" class="btn btn-primary" onclick="validate_account_code_js()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  get_allocation_type_js();
</script>

<div class="modal fade" id="edit_account_code_modal">
    <div class="modal-dialog modal-dialog-top"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span>&nbsp;Edit Account Codes</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                        <form>
                        <div>
                          <input type="number" id="ssd_account_id" style="display:none;">
                        </div>
                          <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><strong>Account Code</strong></label>
                           <div class="col-sm-8">
                           <input class="form-control" type="text" disabled onkeypress="if(!event.key.match(/[0-9...]/)) event.preventDefault()" id="edit_account_code">
                          </div>
                        </div>

                           <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><strong >Account Name</strong></label>
                           <div class="col-sm-8">
                           <input class="form-control" type="text" id="edit_account_name" >
                          </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-sm-4 col-form-label"><strong >Allocation Type</strong></label>
                           <div class="col-sm-8">
                          <select name="type" class="form-control" style="height:35px; font-size:15px;" id="edit_type">
                              </select>
                          </div>
                        </div>
                          </form>
                </div>
            </div>
                      <div class="modal-footer" style="margin-bottom: -10px; margin-top: -8px; padding-top: 10px;">
                         <button type="button" class="btn btn-primary" id="badiha" onclick="update_account_code_js()">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
                      </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  edit_allocation_name_js();
</script>