<style>
    .toggle-off{
        background: darkgrey;
        color: white;
    }
    .row {
    display:flex;
    flex-direction:row;
    margin-top: 12px;
}
    .input-group {
    flex:1;  
    display:flex;
    flex-direction:column; 
    margin: 10px 5px;
    margin-top: -8px;

}
/*label {
    color:#1BBA93;
    font-size: 17px;
    font-weight: 500;
}*/

input[type="text"] {
  font-size: 18px;
  height: 29px;
  padding-left: 10px;
  padding-right: 10px;
  color: black;
  border: 0.5px solid gray;
  border-radius: 4px;
  background: white;
  outline: none;
  width: 241px;
  margin-bottom: 8px;
  font-family: math;
}

#desig_id,#store_id,#billing_id{
 
  height: 29px;
  padding-left: 10px;
  padding-right: 10px;
  color: black;
  border: 0.5px solid gray;
  border-radius: 4px;
  background: white;
  outline: none;
  width: 241px;
  margin-bottom: 8px;
 
}
 
 label {
  /*display: flex;
  flex-direction: row;*/
  /*justify-content: flex-end;
  text-align: right;*/
  width: 120;
  line-height: 26px;
  /*margin-bottom: 10px;*/
}

.modal-content {
    margin-top: -15px;
    width: 80%; /* Adjust width as needed */
    margin-left: auto;
    margin-right: auto;
    height: auto !important;
  }
  
  .modal-header {
    background-color:darkcyan !important; /* Change to your preferred color */
    border: none !important;
    padding-bottom: 5px !important;
    color: white;
  }
  
  .modal-title {
    font-size: 25px;
    margin-top: -5px;
    margin-bottom: 10px;
    font-weight: bold;
  }
#store_button{
  margin-left: 207px;
  margin-top: -36px;
  padding: 3px;
  font-size: 13px;
}

#dept_button{
  margin-left: 208px;
  margin-top: -40px;
  padding: 3px;
  font-size: 13px;
}

#engineer_button{
  margin-left: 208px;
  margin-top: -40px;
  padding: 3px;
  font-size: 13px;
}


#badiha{
  transition: background-color 1s, color 2s;
  /*  */
   /*box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15); ani magtest sa shadow then ibalhin sa hover ,horizontal, vertical, blur rgba means red,green, blue, opacity ang a*/
}

#badiha:hover{
  background-color: blue;
  color: black;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
  /*box-shadow: inset 5px 5px 10px rgba(0, 0, 0, 0.15); inside shadow*/
 /*opacity: 0.8;*/
}

#badiha:active{
  background-color: yellow;
 /*opacity: 0.4;*/
}

.vertical-menu {
    width: 220px;
    height: 100px;
    overflow-y: auto;
    box-shadow: 5px 5px 10px rgba(127 183 109 /  60%);
}
#area_show{display: none;}
#billing_show{display: none;}
#hide_store{display: none;}
#show_store{display: none;}

#searchSuggestionContainer {
  position: absolute;
  z-index: 9999;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-top: -9px;
  margin-left:36px;
  width: 379px;
}

.suggestion {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
        }
        .suggestion:hover {
            background-color: #f0f0f0;
        }
  
</style>
<div id="table_style">
    <div class="form-body"> 
			<div class="table-responsive" id="admin_user_form">
			</div>
        </div>
</div>

<script type="text/javascript">
    display_table_users_js();
</script>

<div id="add_user_modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding-top: 18px;">
          <div class="text-white">
             <h5 class="modal-title"><span class="fa fa-user-plus"></span>&nbsp;Add User Access</h5>
          </div>
        </div>
      <div class="modal-body" style="box-shadow: inset 0px 0px 4px rgb(3 52 0);">

    <div class="form-body">
      <div class="row">
      <div class="input-group">
      <div class="col-sm-12 form-inline">
       <label><strong>SEARCH &nbsp;&nbsp;</label>
        <div class="input-group-addon" style="padding: 7px 9px; font-size: 20px; font-weight: 400; line-height: 1; color: #555; text-align: center; background-color: #eee; border: 1px solid darkgrey; border-radius: 4px; width: 9%; white-space: nowrap; vertical-align: middle;  height:35px; display:inline-block; margin-top:-1px;"><i class="fa fa-binoculars"></i></div>
       <input type="text" id="search_emp"  style="width:379px; height:35px; display: inline-block; border-radius: 0%; margin-left: -6px;" placeholder="Search Name">
    <center><input type="hidden" name="emp_id"></center>
    <div id="searchSuggestionContainer"></div>
      </div>
    </div>
    </div>
    <div class="box">
        <center>
         <div class="imgBx">
            <img  style ="height:100px; width:120px;" src="http://172.16.161.100/storego/storeallocation//assets/uploads/users/Ailleen/1701402868.gif" alt="Profile Photo" class="img-fluid">
         </div>
        </center>
    </div>
   <div class="row">

   <!--  <div class="input-group">
      <div class="col-sm-6 form-inline">
       <label><strong>Search</strong></label>
       <input type="text" id="search_term">
       <datalist id="name_list"></datalist>
      </div>
    </div>
 -->
 
    <div class="input-group">
      <div class="col-sm-6 form-inline">
       <label><strong>First Name</strong></label>
       <input type="text" id="first_name" disabled placeholder="Enter your first name">
      </div>
    </div>

     <div class="input-group">
      <div class="col-sm-6 form-inline">
       <label><strong>Last Name</strong></label>
       <input type="text" id="last_name" disabled placeholder="Enter your last name">
      </div>
     </div>

       <div class="input-group">
         <div class="col-sm-6 form-inline">
       <label><strong>Username</strong></label>
       <input type="text" id="user_name" disabled placeholder="Enter your username">
        </div>
       </div>

      <div class="input-group">
        <div class="col-sm-6 form-inline">
       <label><strong>Designation</strong></label>
      <select name="desig" id="desig_id">
      </select>
        </div>
      </div>

      <div class="input-group" id="show_store">
      <div class="col-sm-6 form-inline">       
       <label><strong>Store Name</strong></label>
         <input id="bu_id" type="text" class="form-control" style="display:none">
       <select name="type" id="store_id">
     </select>
     <div id="hide_store" style="margin-top: -12px;">
     <a type="button" class="btn btn-success" id="store_button" style="margin-bottom: 3px; margin-left: 248px;" onclick="add_store()">Add</a>
         <label for="bu id" style="width: 279px; margin-right: -36px; margin-top: -20px; margin-left: -105px;">Store List:</label>
         <div class="vertical-menu" id="store_names" style="border-style: solid; border-width: 1px;     margin-right: -72px; border-color: green; padding-right: 8px; padding-top: 5px; padding-left: 7px;width: 203px;"></div>
      </div>
        </div>
     </div>

  <div class="input-group" id="billing_show" style="margin-bottom: -46px;">
      <div class="col-sm-9 form-inline">       
       <label><strong>Company Name</strong></label>
         <input id="com_id" type="text" class="form-control" style="display:none">
       <select name="type" id="billing_id" style="width:202px;">
     </select>
     <a type="button" class="btn btn-success" id="engineer_button" style="margin-bottom: 5px; margin-left: 207;" onclick="add_company()">Add</a>
         <label for="bu id" style="width: 279px; margin-right: -36px; margin-top: -8px; margin-left: -90px">Company List:</label>
         <div class="vertical-menu" id="company_names" style="border-style: solid; border-width: 1px; border-color: green; padding-right: 8px; padding-top: 5px; padding-left: 7px;width: 184px;"></div>
     </div>
     </div>

   </div>
    </div>
      <div style="margin-top: 50px;">
        <small class="form-text text-muted"><span class="fa fa-exclamation-circle text-info"></span> NOTE: Default Password: Storego@2023<br>Alphanumeric with special characters. Should have atleast 1 character of upper and lowercase.<br> Minimum of 8 characters.</small>
      </div>
  

      <div class="modal-footer" style="padding-top: 16px; padding-bottom: 1px; margin-right: 8px;">
         <button type="button" class="btn btn-primary" id="badiha" onclick="save_admin_user_js()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
      </div>
    </div>
  </div>
  </div>
</div>

<script type="text/javascript">
        $('#desig_id').change(function(){
  var myID = $('#desig_id').val();
 
 if(myID == 'Store Engineer')
 {
  $('#area_show').each(function(){
      $(this).hide();
  });
   $('#billing_show').each(function(){
      $(this).show();
  });
   $('#show_store').each(function(){
      $(this).show();
  });
    $('#hide_store').each(function(){
        $(this).hide();
      });
 }
   else if(myID =='Administrator' || myID =='Finance')
   {
    $('#show_store').each(function(){
      $(this).hide();
  });
     $('#billing_show').each(function(){
      $(this).hide();
  });
  }
  else if(myID == 'Accounting Supervisor')
   {
      $('#hide_store').each(function(){
        $(this).show();
      });
       $('#show_store').each(function(){
      $(this).show();
      });
       $('#billing_show').each(function(){
       $(this).hide();
  });
   }
 else{
  $('#hide_store').each(function(){
        $(this).hide();
      });
  $('#show_store').each(function(){
      $(this).show();
  });
  $('#area_show').each(function(){
      $(this).hide();
  });
  $('#billing_show').each(function(){
      $(this).hide();
  });
 }
});

 $(document).on('keypress', '#first_name,#last_name,#user_name', function (event) {
    var regex = new RegExp("^[a-zA-Z-. ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

 $(document).ready(function() {
    var suggestionContainer = document.getElementById('searchSuggestionContainer');

    $('#search_emp').on('keyup', function() {
        var query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: "http://172.16.161.100/storego/API_PIS/API_Controller/search_employee_ctrl",
                type: 'POST',
                dataType: "json",
                data: { search: query },
                success: function(data) {
                    var suggestionHTML = data.map(function(suggestion) {
                        return '<div class="suggestion" data-emp-id="' + suggestion.emp_id + '">' + suggestion.emp_id + '|' + suggestion.value + '</div>';
                    }).join('');
                    suggestionContainer.innerHTML = suggestionHTML;

                    // Add click event listener to the suggestion elements
                    $('.suggestion').on('click', function() {
                        var selectedEmpId = $(this).data('emp-id');
                        $.ajax({
                            url: "http://172.16.161.100/storego/API_PIS/API_Controller/personnel_info_ctrl",
                            type: 'POST',
                            dataType: "json",
                            data: { search: selectedEmpId },
                            success: function(data) {
                                $("#first_name").val(data.info[0]['firstname']); 
                                $("#last_name").val(data.info[0]['lastname']); 
                                $("#user_name").val(data.info[0]['emp_id']);
                                $("#search_emp").val(data.info[0]['name']); 
                                $('#searchSuggestionContainer').hide();
                                if (data.info[0]['photo'] !== '') {
                                    $(".imgBx img").attr("src", "../../../hrms/" + data.info[0]['photo'].split("../").join(""));
                                }
                            }
                        });
                    });
                }
            });
        } else {
            suggestionContainer.innerHTML = '';
        }
    });
});

$('#search_emp').keyup(function() {
    var inputText = $(this).val();
    if (inputText.length > 0) {
        $('#searchSuggestionContainer').show();
    } else {
        $('#hiddesearchSuggestionContainernDiv').hide();
    }
});

$('#searchSuggestionContainer').on('mouseenter', '.suggestion', function() {
    $(this).css('background-color', 'skyblue');
}).on('mouseleave', '.suggestion', function() {
    $(this).css('background-color', '');
});

</script>
