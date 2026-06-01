<div id="table_style">
        <div class="form-body"> 
            <div class="table-responsive" id="old_meter_setup">
            </div>
        </div>
    </div>
<script type="text/javascript">
     display_old_meter_js();
</script>

<div class="modal fade" id="old_meter_modal">
    <div class="modal-dialog modal-dialog-top modal-lg"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-plus-square"></span>&nbsp;Add Old Meter</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>From</strong></label>
                                <input id="date_from" type="date" value="<?php echo date('Y-m-d'); ?>" onchange="select_date()"class="form-control form-control-date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>To</strong></label>
                                <input id="date_to" type="date" value="<?php echo date('Y-m-d'); ?>" onchange="select_date()"class="form-control form-control-date">
                            </div>
                        </div>
                    </div>
                         <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Business Unit</strong></label>
                                <select name="store_id" id="store_id" onchange="select_bu_dept()"class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Department</strong></label>
                                <select name="dept" id="dept_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Type</strong></label>
                                <select class="form-control" name="type" id="type_ids" onchange="select_type_js()">
                                    <option selected></option>
                                    <option value="Water">Water</option>
                                    <option value="Electric">Electric</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Company Name</strong></label>
                                <select name="comp" id="comp_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Reading</strong></label>
                                <input type="text" id="reading_id" oninput="cacl_reading(this)" style="text-align:right;" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" style="margin-bottom: -8px;">
                <button type="button" class="btn btn-primary" onclick="validate_old_reading_js()">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="edit_old_meter_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-lg"> <!-- Added modal-lg for large size -->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #095a5a;">
                <h4 class="modal-title" style="color: white;"><span class="fa fa-edit"></span>&nbsp;Edit Old Meter</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label hidden id="edited_id"></label>
                                <label><strong>From</strong></label>
                                <input id="edit_date_from" type="date" onchange="select_edit_date()" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>To</strong></label>
                                <input id="edit_date_to" type="date" onchange="select_edit_date()" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-date">
                            </div>
                        </div>
                    </div>
                         <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Business Unit</strong></label>
                                <select name="store_id" id="edit_store_id" onchange="select_edit_bu_dept()"class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Department</strong></label>
                                <select name="dept" id="edit_dept_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Type</strong></label>
                                <select class="form-control" name="type" id="edit_type_ids" onchange="select_edit_type_js()">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Company Name</strong></label>
                                <select name="comp" id="edit_comp_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Reading</strong></label>
                                <input type="text" id="edit_reading_id" oninput="cacl_reading(this)" style="text-align:right;" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-top: 14px; padding-bottom: 0px">
                <button type="button" class="btn btn-primary" id="badiha" onclick="validate_old_meter_js()">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>
</div>