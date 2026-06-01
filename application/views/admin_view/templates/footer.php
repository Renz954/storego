<div class="container-fluid">
                     <div class="footer" >
                        <p>Alturas Group of Companies © 2024 <br>Designed by html.design. All rights reserved.<br>
                        </p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.js"></script>
<script src="<?php echo base_url('assets/toggle/bootstrap4-toggle.min.js'); ?>"></script>
<!-- jQuery and jQuery-dependent Plugins -->

<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap-select.js"></script> -->

<!-- Other Scripts -->
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.min.js"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<script src="<?php echo base_url(); ?>assets/js/animate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/utils.js"></script>
<script src="<?php echo base_url(); ?>assets/js/analyser.js"></script>
<script src="<?php echo base_url(); ?>assets/js/calendar.js"></script>

<!-- Custom Scripts -->
<!-- <script src="<?php echo base_url(); ?>assets/js/chart_custom_style1.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>


<script src="<?php echo base_url('assets/css/jquery.dataTables.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/jquery.dataTables.min.css');?>" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/sweetalert2@11.js"></script>
      <!-- nice scrollbar -->
     
      <!-- custom js -->
   
<script>
   function homepage_js()
   { 
        document.querySelector('.users-menu').classList.remove('user-header-style');
        document.querySelector('.users-menu span').classList.remove('user-header-style-span');
        document.querySelector('.billing-menu').classList.remove('billing-menu-style');
        document.querySelector('.billing-menu span').classList.remove('billing-menu-style-span');
        document.querySelector('.old-meter-menu').classList.remove('old-meter-menu-style');
        document.querySelector('.old-meter-menu span').classList.remove('old-meter-menu-style-span');

        document.querySelector('.homepage-menu').classList.add('home-header-style');
        document.querySelector('.homepage-menu span').classList.add('home-header-style-span');

     
      $("#body_name").load('<?php echo base_url(); ?>admin_homepage');   
      $("#header_name").html("🧮DASHBOARD");   
   }

   function admin_user_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.billing-menu').classList.remove('billing-menu-style');
         document.querySelector('.billing-menu span').classList.remove('billing-menu-style-span');
         document.querySelector('.old-meter-menu').classList.remove('old-meter-menu-style');
         document.querySelector('.old-meter-menu span').classList.remove('old-meter-menu-style-span');

         document.querySelector('.users-menu').classList.add('user-header-style');
         document.querySelector('.users-menu span').classList.add('user-header-style-span');

      $("#body_name").load('<?php echo base_url(); ?>admin_user_route');   
      $("#header_name").html("🧑🏻‍💻User Access👩🏻‍💻"); 
   }

   function billing_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.users-menu').classList.remove('user-header-style');
         document.querySelector('.users-menu span').classList.remove('user-header-style-span');
         document.querySelector('.old-meter-menu').classList.add('old-meter-menu-style');
         document.querySelector('.old-meter-menu span').classList.add('old-meter-menu-style-span');
         document.querySelector('.old-meter-menu').classList.remove('old-meter-menu-style');
         document.querySelector('.old-meter-menu span').classList.remove('old-meter-menu-style-span');

         document.querySelector('.billing-menu').classList.add('billing-menu-style');
         document.querySelector('.billing-menu span').classList.add('billing-menu-style-span');

      $("#body_name").load('<?php echo base_url(); ?>billing_unit_cost_route');   
      $("#header_name").html("⚡Electric/🐋Water Company"); 
   }

   function meter_js()
   {
         document.querySelector('.homepage-menu').classList.remove('home-header-style');
         document.querySelector('.homepage-menu span').classList.remove('home-header-style-span');
         document.querySelector('.users-menu').classList.remove('user-header-style');
         document.querySelector('.users-menu span').classList.remove('user-header-style-span');
         document.querySelector('.billing-menu').classList.remove('billing-menu-style');
         document.querySelector('.billing-menu span').classList.remove('billing-menu-style-span');

         document.querySelector('.old-meter-menu').classList.add('old-meter-menu-style');
         document.querySelector('.old-meter-menu span').classList.add('old-meter-menu-style-span');

      $("#body_name").load('<?php echo base_url(); ?>old_meter_menu_route');   
      $("#header_name").html("📟Old Meter Data"); 
   }



   function display_table_users_js()
    {
        $.ajax({
                type:'post',
                url: '<?php echo base_url(); ?>display_table_users_route',
                dataType:'json',
                success: function(data){
                  $("#admin_user_form").html(data.html);
                }

        });
    }

    function admin_count_home_js()
    {

        $.ajax({ 
                type: 'POST',
                url: '<?php echo base_url(); ?>admin_count_home_route',
                dataType: 'json',
                success: function(data){
                $("#count_user").text(data.count_users);
                $("#count_finance").text(data.count_finance);
                $("#count_billing").text(data.count_billing);
                $("#count_meter").text(data.count_meter);
                }
        });
    }

    function display_table_unit_cost()
    {
       $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>display_table_unit_route',
              dataType: 'json',
              success: function(data) {
                 $("#unit_cost_setup").html(data.html); 
              }
            });
    }

    function display_old_meter_js()
    {
       $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>display_old_meter_route',
              dataType: 'json',
              success: function(data) {
              $("#old_meter_setup").html(data.html);    
              }
            });
    }

    function engineer_modal()
    {
       $("#add_default_amount_modal").modal({backdrop: 'static', keyboard: false}, 'show');
    }

    function cacl_reading(input)
    {
         // Remove non-numeric characters
        let value = input.value.replace(/[^\d.]/g, "");
        // Check if the input is negative
        let isNegative = false;
        if (value.startsWith("-")) {
            isNegative = true;
            value = value.substring(1);
        }
        // Split into whole number and decimal parts
        let parts = value.split(".");
        let whole = parts[0];
        let decimal = parts.length > 1 ? "." + parts[1].slice(0, 2) : "";
        // Add commas for thousands separator
        whole = whole.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        // Concatenate the whole number and decimal parts
        let formattedValue = isNegative ? "-" + whole + decimal : whole + decimal;
        // Update the input value
        input.value = formattedValue; 
    }

    function val_bill_amount_js()
    {
        $.ajax({
              type: 'post',
               url: '<?php echo base_url(); ?>val_bill_amount_route',
              data: {
                    'c_name': $('#company_id').val()
                    },
           dataType: 'json',
            success: function(data)
                {     
                    if(!data.validate_engr[0])
                    {
                        save_default_amount_js();
                    }
                    else
                    {
                        Swal.fire('Duplicate Record', '', 'error');
                    }                       
                }
        });
    }

    function save_default_amount_js()
    {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to save!',
            icon: 'info',
            showDenyButton: true,
            /* showCancelButton: true,*/
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
              actions: 'my-actions',
              /*  cancelButton: 'order-1 right-gap',*/
              confirmButton: 'order-2',
              denyButton: 'order-3',
            }
        }).then((result) => {
          if (result.isConfirmed)
          {
            if ($('#company_id').val() == '')
             {
              Swal.fire('Missing Company Name', 'Please enter company name', 'error');
             }
             else if ($('#unit_id').val() == '') 
             {
               Swal.fire('Missing amount', 'Please enter amount', 'error');
             }
             else if ($('#type_id').val() == '')
             {
              Swal.fire('Select type', 'Please select type of company', 'error');
             }
             else {
              $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>save_default_amount_route',
                data: {
                  'company_id': $('#company_id').val(),
                  'unit_id': $('#unit_id').val().split(',').join(''),
                  'type_id': $('#type_id option:selected').val()
                },

                dataType: 'json',
                success: function(data) {
                  Swal.fire('Submit Complete', '', 'success');
                  $('#add_default_amount_modal').modal('toggle');      
                 display_table_unit_cost();
                }
              });
            }

          } else if (result.isDenied) {
            Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
          }
        })
    }

    function edit_unit_cost_js(edit_id,company_name,type,unit_cost)
    {
        $("#edit_billingc_company_modal").modal({backdrop: 'static', keyboard: false}, 'show');
        $("#engr_id_edit").val(edit_id);
        $("#edit_company_id").val(company_name);
        $("#edit_unit_id").val(unit_cost);
        $("#edit_type_id").val(type);
    }

    function update_bill_cost_js()
    {
         Swal.fire({
          title: 'Are you sure?',
          text: 'You want to update!',
          icon: 'info',
          showDenyButton: true,
          /* showCancelButton: true,*/
          confirmButtonText: 'Yes',
          denyButtonText: 'No',
          customClass: {
            actions: 'my-actions',
            /*  cancelButton: 'order-1 right-gap',*/
            confirmButton: 'order-2',
            denyButton: 'order-3',
          }
        }).then((result) => {
          if (result.isConfirmed) {

            if ($('#edit_company_id').val() == '')
             {
              Swal.fire('Missing Company Name', 'Please enter company name', 'error');
             }

             else if ($('#edit_unit_id').val() == '') 
             {
               Swal.fire('Missing Unit Cost', 'Please enter amount', 'error');
             }

             else if ($('#edit_type_id').val() == '')
             {
              Swal.fire('Missing Type ', 'Please select type', 'error');
             }

             else {
              
              $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>update_bill_cost_route',
                data: {
                  'edit_id': $('#engr_id_edit').val(),
                  'edit_com': $('#edit_company_id').val(),
                  'edit_unit': $('#edit_unit_id').val().split(',').join(''),
                  'edit_type': $('#edit_type_id').val()
                },

                dataType: 'json',
                success: function(data) {
                  Swal.fire('Update Complete', '', 'success');
                  $('#edit_billingc_company_modal').modal('toggle');
                  display_table_unit_cost();
                }
              });
            }

          } else if (result.isDenied) {
            Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
          }
        })

    }

    function old_meter_modal()
    {
       $("#old_meter_modal").modal({backdrop: 'static', keyboard: false}, 'show');
       $.ajax({
                type: 'post',
                url: 'http://172.16.161.100/storego/API_PIS/API_Controller/display_adduser_ctrl',
                dataType: 'json',
                success: function(data) {
                    $("#store_id").html(data.store); 
                }
            });
    }

    function select_date() 
    {
        var from_date = $('#date_from').val();
        var to_date = $('#date_to').val();

        // Calculate present date
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        var present_date = yyyy + '-' + mm + '-' + dd;

        // Set the minimum and maximum attributes of both input fields
        $('#date_from').attr('max', to_date); // Set max of date_from to selected to_date
        $('#date_to').attr('min', from_date);
        $('#date_to').attr('max', present_date);

        // Ensure that selected dates don't exceed present date
        if (from_date > present_date) {
            $('#date_from').val(present_date);
        }

        if (to_date > present_date) {
            $('#date_to').val(present_date);
        }

        // Ensure #date_from is not greater than selected #date_to
        if (from_date > to_date) {
            $('#date_from').val(to_date);
        }
    }

    function select_bu_dept()
    {
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>old_meter_modal_route',
                 data: {
                  'store_id': $('#store_id option:selected').val()
                },
                dataType: 'json',
                success: function(data) {
                $("#dept_id").html(data.dept_list);
                }
              });
    }

    function select_type_js()
    {
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>select_type_route',
                 data: {
                  'type_id': $('#type_ids option:selected').val()
                },
                dataType: 'json',
                success: function(data) {
                $("#comp_id").html(data.comp_list);
                }
              });
    }

    function validate_old_reading_js()
    {
        $.ajax({
              type: 'post',
               url: '<?php echo base_url(); ?>validate_old_reading_route',
              data: {
                    'd_from' : $('#date_from').val(),
                    'd_to'   : $('#date_to').val(),
                    'dept_id': $('#dept_id').val(),
                    'comp_id': $('#comp_id').val()
                    },
           dataType: 'json',
            success: function(data)
                                   {     
                                     if(!data.validate_old[0])
                                     {
                                         save_old_reading_js();
                                                        }else {

                                                                Swal.fire('Duplicate Record', '', 'error');
                                                              }                       
                                             }
       });
    }

    function save_old_reading_js()
    {
      Swal.fire({
      title: 'Are you sure?',
      text: 'You want to save!',
      icon: 'info',
      showDenyButton: true,
      /* showCancelButton: true,*/
      confirmButtonText: 'Yes',
      denyButtonText: 'No',
      customClass: {
        actions: 'my-actions',
        /*  cancelButton: 'order-1 right-gap',*/
        confirmButton: 'order-2',
        denyButton: 'order-3',
      }
    }).then((result) => {
      if (result.isConfirmed) {

        if ($('#date_from').val() == '')
         {
          Swal.fire('Missing Date', 'Please select date', 'error');
         }

         else if ($('#date_to').val() == '') 
         {
           Swal.fire('Missing Date', 'Please select date', 'error');
         }

         else if ($('#store_id').val() == 'select')
         {
          Swal.fire('Select Store', 'Store is required', 'error');
         }
         else if ($('#dept_id').val() == 'select')
         {
          Swal.fire('Select Department', 'Department is required', 'error');
         }
         else if ($('#type_ids').val() == '')
         {
          Swal.fire('Select type', 'Type is required', 'error');
         }
         else if ($('#comp_id').val() == 'select')
         {
          Swal.fire('Select Company', 'Company is required', 'error');
         }
         else if ($('#reading_id').val() == '')
         {
          Swal.fire('Input Amount', 'Amount is required', 'error');
         }
         else {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>save_old_reading_route',
            data: {
                  'd_from': $('#date_from').val(),
                    'd_to': $('#date_to').val(),
                'store_id': $('#store_id option:selected').val(),
                 'dept_id': $('#dept_id option:selected').val(),
                 'type_id': $('#type_ids option:selected').val(),
                 'comp_id': $('#comp_id option:selected').val(),
              'reading_id': $('#reading_id').val().split(',').join('')
            },

            dataType: 'json',
            success: function(data) {
              Swal.fire('Submit Complete', '', 'success');
             setTimeout(function() {   
             location.reload();
               }, 1000);
            }
          });
        }

      } else if (result.isDenied) {
        Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
      }
    })
 }

    function edit_old_meter_js(id,d_start,d_end,bcode,bu_name,dcode,dept_name,type,comp_id,comp_name,amount)
    {
            $("#edit_old_meter_modal").modal({backdrop: 'static', keyboard: false}, 'show');

            $("#edited_id").text(id);
            $("#edit_date_from").val(d_start);
            $("#edit_date_to").val(d_end);
            $("#edit_comp_id").html(comp_id);
            $("#edit_reading_id").val(amount);

        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>edit_type_route',
              data:{'type' : type 
            },
              dataType: 'json',
              success: function(data) 
              {
                  $("#edit_type_ids").html(data.html);  
              }
            });

        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>edit_dept_route',
              data:{'bcode' : bcode,
                    'dept_name' :dept_name,
                    'dcode' : dcode  
            },
              dataType: 'json',
              success: function(data) 
              {
                  $("#edit_dept_id").html(data.html);  
              }
            });

        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>edit_bu_route',
              data:{'bcode' : bcode,
                    'bu_name' :bu_name
            },
              dataType: 'json',
              success: function(data) 
              {
                  $("#edit_store_id").html(data.html);  
              }
            });

        $.ajax({
              type: 'post',
              url: '<?php echo base_url(); ?>edit_comp_route',
              data:{
                    'type' : type,
                    'comp_id' : comp_id,
                    'comp_name' :comp_name
            },
              dataType: 'json',
              success: function(data) 
              {
                  $("#edit_comp_id").html(data.html);  
              }
            });
    }

     function select_edit_date() 
     {
        var from_date = $('#edit_date_from').val();
        var to_date = $('#edit_date_to').val();

        // Calculate present date
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        var present_date = yyyy + '-' + mm + '-' + dd;

        // Set the minimum and maximum attributes of both input fields
        $('#edit_date_from').attr('max', to_date); // Set max of edit_date_from to selected to_date
        $('#edit_date_to').attr('min', from_date);
        $('#edit_date_to').attr('max', present_date);

        // Ensure that selected dates don't exceed present date
        if (from_date > present_date) {
            $('#edit_date_from').val(present_date);
        }

        if (to_date > present_date) {
            $('#edit_date_to').val(present_date);
        }

        // Ensure #edit_date_from is not greater than selected #date_to
        if (from_date > to_date) {
            $('#edit_date_from').val(to_date);
        }
    }

    function select_edit_bu_dept()
    {
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>old_meter_modal_route',
                 data: {
                  'store_id': $('#edit_store_id option:selected').val()
                },
                dataType: 'json',
                success: function(data) {
                $("#edit_dept_id").html(data.dept_list);
                }
              });
    }

    function select_edit_type_js()
    {
        $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>select_type_route',
                 data: {
                  'type_id': $('#edit_type_ids option:selected').val()
                },
                dataType: 'json',
                success: function(data) {
                $("#edit_comp_id").html(data.comp_list);
                }
              });
    }

    function validate_old_meter_js()
    {
        $.ajax({
                  type: 'post',
                   url: '<?php echo base_url(); ?>validate_old_meter_route',
                  data: {
                        'edit_from'   : $('#edit_date_from').val(),
                        'edit_to'     : $('#edit_date_to').val(),
                        'edit_store'  : $('#edit_store_id option:selected').val(),
                        'edit_dept'   : $('#edit_dept_id option:selected').val(),
                        'edit_type'   : $('#edit_type_ids option:selected').val(),
                        'edit_comp'   : $('#edit_comp_id option:selected').val(), 
                        'edit_reading': $('#edit_reading_id').val().split(',').join('')
                        },
               dataType: 'json',
                success: function(data)
                                       {
                                       if(!data.validate[0])
                                       {
                                          update_old_meter_js();
                                       }else{
                                          Swal.fire('Duplicate Record', '', 'error');
                                       }    
                                       }
                                     });

    }

    function update_old_meter_js()
    {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You want to update!',
          icon: 'info',
          showDenyButton: true,
          /* showCancelButton: true,*/
          confirmButtonText: 'Yes',
          denyButtonText: 'No',
          customClass: {
            actions: 'my-actions',
            /*  cancelButton: 'order-1 right-gap',*/
            confirmButton: 'order-2',
            denyButton: 'order-3',
          }
        }).then((result) => {
          if (result.isConfirmed) {

            if ($('#edit_date_from').val() == '')
             {
              Swal.fire('Missing Date', 'Please select date', 'error');
             }

             else if ($('#edit_date_to').val() == '') 
             {
               Swal.fire('Missing Date', 'Please select date', 'error');
             }

             else if ($('#edit_store_id').val() == 'select')
             {
              Swal.fire('Select Store', 'Store is required', 'error');
             }
             else if ($('#edit_dept_id').val() == 'select')
             {
              Swal.fire('Select Department', 'Department is required', 'error');
             }
             else if ($('#edit_type_ids').val() == '')
             {
              Swal.fire('Select type', 'Type is required', 'error');
             }
             else if ($('#edit_comp_id').val() == 'select')
             {
              Swal.fire('Select Company', 'Company is required', 'error');
             }
             else if ($('#edit_reading_id').val() == '')
             {
              Swal.fire('Input Amount', 'Amount is required', 'error');
             }
             else {
              
              $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>update_old_meter_route',
                data: {
                          'id'  : $('#edited_id').text(),
                    'edit_from' : $('#edit_date_from').val(),
                      'edit_to' : $('#edit_date_to').val(),
                   'edit_store' : $('#edit_store_id').val(),
                    'edit_dept' : $('#edit_dept_id').val(),
                    'edit_type' : $('#edit_type_ids').val(),
                    'edit_comp' : $('#edit_comp_id').val(),
                  'edit_reading': $('#edit_reading_id').val().split(',').join('')
                },
                dataType: 'json',

              });

               Swal.fire('Update Complete', '', 'success'); 
                  $('#edit_old_meter_modal').modal('toggle');
                  display_old_meter_js(); 
            }

          } else if (result.isDenied) {
            Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error')
          }
        })
    }

    function display_adduser_js()
    {
        $("#add_user_modal").modal({backdrop: 'static', keyboard: false}, 'show');
       var myID = $('#desig_id').val();
         if(myID == 'Leasing')
         {
          $('#area_show').each(function(){
              $(this).hide();
          });
         }else
         if(myID == 'Store Engineer')
         {
           $('#billing_show').each(function(){
              $(this).hide();
          });
         }
         $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>display_adduser_route',
                dataType: 'json',
                success: function(data) {
                  $("#desig_id").html(data.desig);
                        // $("#store_id").html(data.store); 
                  $("#area_id").html(data.areas);                    
                  $("#billing_id").html(data.billing); 
                }
              });

        $.ajax({
                type: 'post',
                url: 'http://172.16.161.100/storego/API_PIS/API_Controller/display_adduser_ctrl',
                dataType: 'json',
                success: function(data) {
                    $("#store_id").html(data.store); 
                }
            });

    }

    function add_store() 
     {
       var bu_id=$("#bu_id").val();
       bu_id=bu_id.split(";");
       
       if($("#store_id").val()!='select')
       {  
        var arraycontainsturtles = (bu_id.indexOf($("#store_id").val()) > -1);
        if(arraycontainsturtles== false)
        {
          if($("#bu_id").val()=="")
          {
            var bu_id=$("#store_id").val();
          } 
          else
          {
            var bu_id=$("#bu_id").val()+";"+$("#store_id").val();
          } 
           
           $("#bu_id").val(bu_id);
           var e = document.getElementById("store_id");
           var s_name=e.options[e.selectedIndex].text;
           var bu_name = document.getElementById('store_names').innerHTML;
           $("#store_names").html('<a id="'+$("#store_id").val()+'" style="cursor:pointer font-size: 11px;" class="w3-animate-left">'+s_name+'<button id="dell'+$("#store_id").val()+'" onclick="delete_store('+"'"+$("#store_id").val()+"'"+')" class="fa fa-trash float-right btn-danger"></button></a><br>'+bu_name);
           var removeClass = $("#bu_id").val().split(";");            
           for(count=0;count<removeClass.length;count++)
           {
                $("#"+removeClass[count]).removeAttr("class"); 
           }              
        } 
        else
        {         
          Swal.fire(
          {
            title: 'opps?',
            text: "The area is already added!",
            icon: 'error'
          })

        }       
       }   
          else
       {         
         Swal.fire(
          {
            title: 'opps?',
            text: "Select area is required",
            icon: 'error'
          })
       }          
     }

     function delete_store(del_store)
     {   
       var ar_id=$("#bu_id").val().split(";");
         var return_ar_id="";
         for(count=0;count<ar_id.length;count++)
         {
            if(ar_id[count]!=del_store)
            {
               return_ar_id=return_ar_id+ar_id[count]+";";
            }
            else
            {
               $("#"+del_store).remove();
            }
         } 
         return_ar_id=return_ar_id.slice(0,-1);
         $("#bu_id").val(return_ar_id);
     }

     function add_company() 
     {
       var com_id=$("#com_id").val();
       com_id=com_id.split(";");
       
       if($("#billing_id").val()!=null)
       {  
        var arraycontainsturtles = (com_id.indexOf($("#billing_id").val()) > -1);
        if(arraycontainsturtles== false)
        {
          if($("#com_id").val()=="")
          {
            var com_id=$("#billing_id").val();
          } 
          else
          {
            var com_id=$("#com_id").val()+";"+$("#billing_id").val();
          } 
           
           $("#com_id").val(com_id);
           var e = document.getElementById("billing_id");
           var area_name=e.options[e.selectedIndex].text;
           var Defbu_name = document.getElementById('company_names').innerHTML;
           $("#company_names").html("<a id='"+$("#billing_id").val()+"' style='cursor:pointer font-size: 11px;' class='w3-animate-left'>"+area_name+"<button id='del"+$("#billing_id").val()+ "' onclick='delete_company("+$("#billing_id").val()+")' class='fa fa-trash float-right btn-danger'></button></a><br>"+Defbu_name);
           var removeClass = $("#com_id").val().split(";");            
           for(count=0;count<removeClass.length;count++)
           {
            $("#"+removeClass[count]).removeAttr("class"); 
           }              
        } 
        else
        {         
          Swal.fire(
          {
            title: 'opps?',
            text: "The company is already added!",
            icon: 'error'
          })

        }       
       }   
          else
       {         
         Swal.fire(
          {
            title: 'opps?',
            text: "Select company is required",
            icon: 'error'
          })
       }       
     }

    function delete_company(delete_company)
    {   
         var ar_id=$("#com_id").val().split(";");
         var return_ar_id="";
         for(count=0;count<ar_id.length;count++)
         {
            if(ar_id[count]!=delete_company)
            {
               return_ar_id=return_ar_id+ar_id[count]+";";
            }
            else
            {
               $("#"+delete_company).remove();
            }
         } 
         return_ar_id=return_ar_id.slice(0,-1);
         $("#com_id").val(return_ar_id);
    }

    function save_admin_user_js()
    {
        $.ajax({
              type: 'post',
               url: '<?php echo base_url(); ?>validate_record_save_route',
              data: {
                    // 'f_name': $('#first_name').val(),
                    // 'l_name': $('#last_name').val(),
                    'u_name': $('#user_name').val()
                    },
           dataType: 'json',
            success: function(data)
            {     
                if(!data.validatesss[0])
                {
                    save_record_list();
                }
                else 
                {
                    Swal.fire('Duplicate Record', '', 'error');
                }                          
            }
       });
    }

    function save_record_list()
    {
        Swal.fire
          ({
            icon: 'info',
           title: 'Are you sure?',
            text: 'You want to save!',
          showDenyButton: true,
          /* showCancelButton: true,*/
          confirmButtonText: 'Yes',
          denyButtonText: 'No',
             customClass: {
                 actions: 'my-actions',
          /*  cancelButton: 'order-1 right-gap',*/
           confirmButton: 'order-2',
              denyButton: 'order-3',
                           }
          }).then((result) => 
           {
            if (result.isConfirmed) 
                {
                    if ($('#first_name').val() == '')
                    {
                        Swal.fire('Missing First Name', 'Please enter your First Name', 'error');
                    }
                    else if ($('#last_name').val() == '') 
                    {
                        Swal.fire('Missing Last Name', 'Please enter your Last Name', 'error');
                    }
                    else if ($('#user_name').val() == '')
                    {
                        Swal.fire('Missing User Name', 'Please enter your User Name', 'error');
                    }
                    else if ($('#desig_id').val() == 'select') 
                    {       
                        Swal.fire('Missing Type', 'Please select it is required!', 'error');
                    }
                     // else if ($('#desig_id').val() != 'Finance')
                     // {
                     //    ($('#store_id').val() == 'select')
                               
                     //            Swal.fire('Missing Store', 'Please select it is required', 'error');
                               
                     // }

                    else 
                    {
                        if ($('#desig_id option:selected').val() == 'Finance' || $('#desig_id option:selected').val() == 'Administrator')
                        {
                             $.ajax({
                                        type: 'post',
                                        url: '<?php echo base_url(); ?>record_admin_users_route',
                                        data: {
                                               'f_name': $('#first_name').val(),
                                               'l_name': $('#last_name').val(),
                                               'u_name': $('#user_name').val(),
                                               'd_id'  : $('#desig_id').val(),
                                               's_id'  : '',
                                               's_name': $('#store_id option:selected').text(),
                                               'bu_id'  :'',
                                               'engr_id'  : $('#com_id').val()
                                             /*  'd_name': $('#dept_id option:selected').text()   */      
                                              },
                                    success: function(data) {
                                   Swal.fire('Submit Complete', '', 'success');
                                   // display_table_users_js();
                                   window.location.reload();
                                   $('#add_user_modal').modal('toggle');
                                 }
                                     });
                           
                        }
                        else if($('#desig_id option:selected').val() == 'Accounting Supervisor')
                        {
                            if($('#bu_id').val() == '')
                            {
                                Swal.fire('Missing Store', 'Please select it is required', 'error');
                            }
                            else
                            {

                                $.ajax({
                                        type: 'post',
                                        url: '<?php echo base_url(); ?>record_admin_users_route',
                                        data: {
                                               'f_name': $('#first_name').val(),
                                               'l_name': $('#last_name').val(),
                                               'u_name': $('#user_name').val(),
                                               'd_id'  : $('#desig_id').val(),
                                                's_id'  : $('#store_id option:selected').val(),
                                                's_name': $('#store_id option:selected').text(),
                                               'bu_id'  : $('#bu_id').val(),
                                               'engr_id'  : $('#com_id').val(),
                                             /*  'd_name': $('#dept_id option:selected').text()   */      
                                              },
                                    success: function(data) {
                                   Swal.fire('Submit Complete', '', 'success');
                                   // display_table_users_js();
                                   window.location.reload();
                                   $('#add_user_modal').modal('toggle');
                                 }
                                     });
                            }
                        }
                        else
                        {
                            if($('#store_id').val() == 'select')
                            {
                                Swal.fire('Missing Store', 'Please select it is required', 'error');
                            }
                            else
                            {
                              $.ajax({
                                        type: 'post',
                                        url: '<?php echo base_url(); ?>record_admin_users_route',
                                        data: {
                                               'f_name': $('#first_name').val(),
                                               'l_name': $('#last_name').val(),
                                               'u_name': $('#user_name').val(),
                                               'd_id'  : $('#desig_id').val(),
                                               's_id'  : $('#store_id option:selected').val(),
                                               's_name': $('#store_id option:selected').text(),
                                               'bu_id'  : $('#bu_id').val(),
                                               'engr_id'  : $('#com_id').val(),
                                             /*  'd_name': $('#dept_id option:selected').text()   */      
                                              },
                                    success: function(data) {
                                   Swal.fire('Submit Complete', '', 'success');
                                   // display_table_users_js();
                                   window.location.reload();
                                   $('#add_user_modal').modal('toggle');
                                 }
                                     });
                            }
                        }
            }       
        } 
            else if (result.isDenied) 
            {
                Swal.fire('Cancel Submit', 'Your file has been cancelled', 'error');
            }
        })
                                           
  }

    
        
</script>   
   </body>
</html>